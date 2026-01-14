<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Tampilkan halaman forgot password
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Kirim OTP ke email user
     */
    public function sendResetLink(Request $request)
    {
        // Validasi email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email Anda Salah',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->email;

        // Cek apakah user dengan email ini ada
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email Anda Salah'
            ])->withInput();
        }

        // Generate OTP (6 digit random number)
        $otp = rand(100000, 999999);
        
        // Generate token untuk reset password
        $token = Str::random(60);

        // Simpan token dan OTP ke database
        $user->reset_token = $token;
        $user->reset_token_expire = now()->addMinutes(30); // Expire dalam 30 menit
        $user->save();

        // Kirim email dengan OTP
        try {
            Mail::send('emails.forgot-password', [
                'user' => $user,
                'otp' => $otp,
                'token' => $token,
                'resetUrl' => route('reset.password', ['token' => $token])
            ], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Reset Password - SleepyPanda');
            });

            // Simpan OTP ke session untuk verifikasi nanti
            session(['password_reset_otp' => $otp]);
            session(['password_reset_email' => $email]);
            session(['password_reset_token' => $token]);

            return redirect()->route('reset.password', ['token' => $token])
                ->with('success', 'OTP telah dikirim ke email Anda! Silakan cek inbox/spam.');

        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Gagal mengirim email. Error: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Tampilkan halaman reset password dengan OTP
     */
    public function showResetPassword($token)
    {
        // Verifikasi token
        $user = User::where('reset_token', $token)
            ->where('reset_token_expire', '>', now())
            ->first();

        if (!$user) {
            return redirect()->route('forgot.password')
                ->withErrors(['token' => 'Token reset password tidak valid atau sudah kadaluarsa.']);
        }

        return view('auth.reset-password', compact('token'));
    }

    /**
     * Proses reset password dengan verifikasi OTP
     */
    public function resetPassword(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'otp' => 'required|numeric|digits:6',
            'password' => 'required|min:8|confirmed',
        ], [
            'otp.required' => 'OTP tidak boleh kosong',
            'otp.numeric' => 'OTP harus berupa angka',
            'otp.digits' => 'OTP harus 6 digit',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password konfirmasi tidak cocok',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Verifikasi token
        $user = User::where('reset_token', $request->token)
            ->where('reset_token_expire', '>', now())
            ->first();

        if (!$user) {
            return back()->withErrors([
                'token' => 'Token tidak valid atau sudah kadaluarsa'
            ]);
        }

        // Verifikasi OTP
        $sessionOtp = session('password_reset_otp');
        if ($sessionOtp != $request->otp) {
            return back()->withErrors([
                'otp' => 'OTP yang Anda masukkan salah'
            ])->withInput(['token' => $request->token]);
        }

        // Update password
        $user->hashed_password = Hash::make($request->password);
        $user->reset_token = null;
        $user->reset_token_expire = null;
        $user->save();

        // Hapus session OTP
        session()->forget(['password_reset_otp', 'password_reset_email', 'password_reset_token']);

        return redirect()->route('login')
            ->with('success', 'Password berhasil direset! Silakan login dengan password baru Anda.');
    }
}