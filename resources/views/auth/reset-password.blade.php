@extends('layouts.app')

@section('title', 'Reset Password - SleepyPanda')

@section('content')
<div class="auth-page vh-100 d-flex align-items-center justify-content-center">
    <div class="auth-card shadow-lg rounded-4 p-4" style="max-width:520px; width:92%;">
        <div class="text-center mb-3">
            <img src="{{ asset('images/logoPanda.png') }}" alt="SleepyPanda" style="width:96px;height:96px;object-fit:contain;">
        </div>

        <h4 class="text-white text-center fw-bold mb-1">Reset Password</h4>
        <p class="text-center text-muted small mb-3">Masukkan kode OTP dan buat password baru untuk akun Anda.</p>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('reset.password.post') }}" method="POST" id="resetPasswordForm">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label for="otp" class="form-label text-white">Kode OTP</label>
                <div class="control-box mx-auto" style="max-width:360px;">
                    <input 
                        type="text" 
                        class="form-control form-control-lg text-center bg-dark text-white @error('otp') is-invalid @enderror" 
                        id="otp" 
                        name="otp" 
                        placeholder="000000"
                        maxlength="6"
                        required
                        style="letter-spacing: 10px; font-size: 24px; font-weight: bold;"
                    >
                </div>
                @error('otp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted d-block mt-2"><i class="bi bi-envelope"></i> Periksa email untuk kode OTP 6 digit</small>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-white">Password Baru</label>
                <div class="control-box mx-auto" style="max-width:360px;">
                    <div class="input-group">
                        <input 
                            type="password" 
                            class="form-control bg-dark text-white @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password baru"
                            required
                        >
                        <button class="btn btn-outline-light" type="button" id="togglePassword">
                            <span id="eyeIcon">👁️</span>
                        </button>
                    </div>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <small class="text-muted d-block mt-2">Password minimal 8 karakter</small>
                <div class="progress mt-2" style="height: 5px; display: none;" id="passwordStrength">
                    <div class="progress-bar" id="strengthBar" role="progressbar" style="width: 0%"></div>
                </div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label text-white">Konfirmasi Password</label>
                <div class="control-box mx-auto" style="max-width:360px;">
                    <input 
                        type="password" 
                        class="form-control bg-dark text-white" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Masukkan kembali password baru"
                        required
                    >
                </div>
                <div class="invalid-feedback" id="confirmPasswordError" style="display: none;">
                    Password tidak cocok
                </div>
            </div>

            <div class="control-box mx-auto mb-3" style="max-width:360px;">
                <button 
                    type="submit" 
                    class="btn btn-success w-100 py-2"
                    id="resetBtn"
                >
                    <i class="bi bi-shield-check"></i> Reset Password
                </button>
            </div>

            <div class="text-center mb-2">
                <small class="text-muted">Tidak menerima OTP?</small>
                <a href="{{ route('forgot.password') }}" class="text-decoration-none fw-bold ms-2">Kirim ulang OTP</a>
            </div>

            <div class="text-center mt-2">
                <a href="{{ route('login') }}" class="text-decoration-none text-white"><i class="bi bi-arrow-left"></i> Kembali ke masuk</a>
            </div>
        </form>

        <div class="mt-3 p-2 text-center">
            <small class="text-muted"><i class="bi bi-clock"></i> OTP expires in: <strong id="countdown" class="text-danger">30:00</strong></small>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .auth-icon {
        font-size: 4rem;
        animation: rotate 3s infinite;
    }
    
    @keyframes rotate {
        0%, 100% {
            transform: rotate(0deg);
        }
        50% {
            transform: rotate(20deg);
        }
    }

    /* Card and input styling to match app layout */
    .auth-page{ background: linear-gradient(180deg,#0b1020 0%, #0f1730 100%); }
    .auth-card{ background: rgba(255,255,255,0.04); backdrop-filter: blur(6px); border:1px solid rgba(255,255,255,0.06); }
    .control-box { width:100%; }
    .control-box .form-control.bg-dark{ background: rgba(255,255,255,0.03); color:#fff; border:1px solid rgba(255,255,255,0.06); }
    .control-box .form-control.bg-dark::placeholder{ color: rgba(255,255,255,0.5); }

    #otp:focus, .control-box .form-control:focus {
        border-color: rgba(77,212,172,0.9);
        box-shadow: 0 4px 12px rgba(77,212,172,0.06);
    }
</style>
@endpush

@push('scripts')
<script>
    // OTP Input - Only allow numbers
    document.getElementById('otp').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            confirmPasswordInput.type = 'text';
            eyeIcon.textContent = '🙈';
        } else {
            passwordInput.type = 'password';
            confirmPasswordInput.type = 'password';
            eyeIcon.textContent = '👁️';
        }
    });

    // Password strength indicator
    const passwordInput = document.getElementById('password');
    const passwordStrength = document.getElementById('passwordStrength');
    const strengthBar = document.getElementById('strengthBar');

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        
        if (password.length === 0) {
            passwordStrength.style.display = 'none';
            return;
        }
        
        passwordStrength.style.display = 'block';
        
        let strength = 0;
        if (password.length >= 8) strength += 25;
        if (password.length >= 12) strength += 25;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password)) strength += 15;
        if (/[^a-zA-Z0-9]/.test(password)) strength += 10;
        
        strengthBar.style.width = strength + '%';
        
        if (strength < 40) {
            strengthBar.className = 'progress-bar bg-danger';
        } else if (strength < 70) {
            strengthBar.className = 'progress-bar bg-warning';
        } else {
            strengthBar.className = 'progress-bar bg-success';
        }
    });

    // Real-time confirm password validation
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const confirmPasswordError = document.getElementById('confirmPasswordError');

    confirmPasswordInput.addEventListener('input', function() {
        if (passwordInput.value !== this.value && this.value.length > 0) {
            confirmPasswordInput.classList.add('is-invalid');
            confirmPasswordError.style.display = 'block';
        } else {
            confirmPasswordInput.classList.remove('is-invalid');
            confirmPasswordError.style.display = 'none';
        }
    });

    // Form validation
    document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
        const otp = document.getElementById('otp').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const btn = document.getElementById('resetBtn');
        
        // Validasi OTP
        if (otp.length !== 6) {
            e.preventDefault();
            alert('OTP harus 6 digit');
            return false;
        }
        
        // Validasi password
        if (password.length < 8) {
            e.preventDefault();
            alert('Password minimal 8 karakter');
            return false;
        }
        
        // Validasi confirm password
        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Password konfirmasi tidak cocok');
            return false;
        }
        
        // Show loading state
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Resetting...';
        btn.disabled = true;
    });

    // Countdown Timer (30 minutes = 1800 seconds)
    let timeLeft = 1800;
    const countdownElement = document.getElementById('countdown');
    
    function updateCountdown() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        
        countdownElement.textContent = 
            String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
        
        if (timeLeft === 0) {
            countdownElement.textContent = 'EXPIRED';
            countdownElement.classList.add('text-danger', 'fw-bold');
            alert('OTP telah kadaluarsa! Silakan request ulang.');
        } else {
            timeLeft--;
        }
    }
    
    // Update countdown every second
    setInterval(updateCountdown, 1000);
    updateCountdown(); // Initial call
</script>
@endpush