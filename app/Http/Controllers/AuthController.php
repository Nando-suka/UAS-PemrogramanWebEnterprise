<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\JWTService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login dengan validasi lengkap
     */
    public function login(Request $request)
    {
        // Validasi 1: Username dan password tidak boleh kosong
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'username/password incorrect',
            'email.email' => 'username/password incorrect',
            'password.required' => 'username/password incorrect',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->email;
        $password = $request->password;

        // Validasi 2: Cek domain yang dilarang (@ganteng.com)
        $blockedDomains = ['@ganteng.com'];
        foreach ($blockedDomains as $domain) {
            if (str_contains($email, $domain)) {
                return back()->withErrors([
                    'email' => 'username/password incorrect'
                ])->withInput();
            }
        }

        // Validasi 3: Password harus lebih dari 8 karakter
        if (strlen($password) < 8) {
            return back()->withErrors([
                'password' => 'username/password incorrect'
            ])->withInput();
        }

        // Validasi 4: Cek kredensial di database
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->hashed_password)) {
            return back()->withErrors([
                'email' => 'username/password incorrect'
            ])->withInput();
        }

        // Login berhasil - Generate JWT Token dengan SHA-256
        $jwtPayload = [
            'user_id' => $user->id,
            'email' => $user->email,
            'login_time' => now()->toDateTimeString(),
        ];
        
        // Generate JWT token
        $jwtToken = JWTService::generateToken($jwtPayload);
        
        // Generate Passport token (optional, dengan error handling)
        $passportToken = null;
        try {
            $passportToken = $user->createToken('auth_token')->accessToken;
        } catch (\Exception $e) {
            // Jika Passport belum configured, skip
            // Log error untuk debugging
            \Log::warning('Passport token creation failed: ' . $e->getMessage());
        }
        
        // Simpan ke session
        auth()->login($user, $request->filled('remember'));
        session([
            'jwt_token' => $jwtToken,
            'passport_token' => $passportToken,
            'token_expires_at' => now()->addMinutes(30),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Login berhasil!')
            ->with('jwt_token', $jwtToken);
    }

    /**
     * Tampilkan halaman register
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi
     */
    public function register(Request $request)
    {
        // Validasi akan dilakukan via AJAX di frontend
        // Validasi final di backend
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->email;

        // Cek domain yang dilarang
        $blockedDomains = ['@ganteng.com'];
        foreach ($blockedDomains as $domain) {
            if (str_contains($email, $domain)) {
                return back()->withErrors([
                    'email' => 'username/password incorrect'
                ])->withInput();
            }
        }

        // Buat user baru
        $user = User::create([
            'email' => $email,
            'hashed_password' => Hash::make($request->password),
        ]);

        // Auto login setelah register - Generate JWT
        $jwtPayload = [
            'user_id' => $user->id,
            'email' => $user->email,
            'registered_at' => now()->toDateTimeString(),
        ];
        
        $jwtToken = JWTService::generateToken($jwtPayload);
        
        // Generate Passport token (optional)
        $passportToken = null;
        try {
            $passportToken = $user->createToken('auth_token')->accessToken;
        } catch (\Exception $e) {
            \Log::warning('Passport token creation failed: ' . $e->getMessage());
        }
        
        auth()->login($user);
        session([
            'jwt_token' => $jwtToken,
            'passport_token' => $passportToken,
            'token_expires_at' => now()->addMinutes(30),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Registrasi berhasil!')
            ->with('jwt_token', $jwtToken);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        // Revoke token
        if (auth()->user()) {
            $user = auth()->user();
            $user->tokens()->delete();
        }

        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}