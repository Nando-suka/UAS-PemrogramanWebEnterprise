@extends('layouts.app')

@section('title', 'Login - SleepyPanda')
@section('body_class', 'auth-page')
@section('welcome_text', 'Masuk menggunakan akun yang sudah terdaftar')

@section('content')
                <div class="judul">
                    <h4>Masuk menggunakan akun yang sudah kamu daftarkan</h4>
                </div>
                <!-- Alert untuk error atau success -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('login.post') }}" method="POST" id="loginForm" class="form-animate">
                    @csrf
                    
                    <!-- Email Input -->
                    <div class="form-group">
                     <div class="input-icon">
                        <i class="bi bi-envelope-fill icon"></i>
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            placeholder="Email"
                            value="{{ old('email') }}"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                     </div>
                    </div>

                    <!-- Password Input -->
                    <div class="form-group">
                        <div class="input-icon">
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                placeholder="Password"
                                required
                            >
                            <button type="button" class="password-toggle" id="togglePassword" aria-label="Toggle password visibility">👁️</button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                        </div>
                        <a href="#" class="text-decoration-none" data-bs-toggle="offcanvas" data-bs-target="#forgotOffcanvas" aria-controls="forgotOffcanvas">
                            Forgot Password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-login-green w-100 py-2 mb-3">
                        Masuk
                    </button>

                    <!-- Register Link -->
                    <div class="text-center mt-3" style="color: rgba(255, 255, 255, 0.7);">
                        Belum memiliki akun? <a href="{{ route('register') }}" style="color: #4dd4ac;">Daftar Sekarang</a>
                    </div>
                </form>
                <!-- Offcanvas bottom - inline forgot password -->
                <div class="offcanvas offcanvas-bottom" tabindex="-1" id="forgotOffcanvas" aria-labelledby="forgotOffcanvasLabel">
                    <div class="offcanvas-body py-4">
                        <div class="offcanvas-card rounded-4 p-3 mx-auto" style="max-width:420px;">
                            <div class="text-center mb-2">
                                <h5 class="text-white fw-bold mb-1">Lupa password?</h5>
                                <p class="small text-muted mb-0">Instruksi untuk melakukan reset password akan dikirim melalui email yang kamu gunakan untuk mendaftar.</p>
                            </div>

                            <form action="{{ route('forgot.password.post') }}" method="POST" id="forgotInlineForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="forgot_email" class="form-label visually-hidden">Email</label>
                                    <div class="control-box mx-auto" style="max-width:340px;">
                                        <div class="input-group">
                                            <span class="input-group-text bg-dark text-white border-0"><i class="bi bi-envelope-fill"></i></span>
                                            <input type="email" id="forgot_email" name="email" class="form-control bg-white text-dark border-0" placeholder="Email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-box mx-auto" style="max-width:340px;">
                                    <button id="forgotSubmitBtn" type="submit" class="btn btn-success w-100">Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    .auth-icon {
        font-size: 4rem;
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }
        /* untuk input icon */
        .input-icon { position: relative; }
        .input-icon .icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.85);
            font-size: 16px;
            pointer-events: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            background: rgba(255,255,255,0.02);
            border-radius: 8px;
        }
        .input-icon .form-control {
            padding-left: 56px;
            padding-right: 48px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 10px;
            color: rgba(255,255,255,0.95);
            height: 48px;
            box-shadow: none;
        }
        .input-icon .form-control::placeholder { color: rgba(255,255,255,0.5); }
        .input-icon .form-control:focus {
            background: rgba(255,255,255,0.04);
            border-color: rgba(77,212,172,0.9);
            box-shadow: 0 4px 12px rgba(77,212,172,0.06);
            color: rgba(255,255,255,0.95);
        }
        .form-group { margin-bottom: 16px; }
        /* positioned eye button inside input */
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255,255,255,0.85);
            cursor: pointer;
            padding: 6px;
            font-size: 16px;
            z-index: 3;
        }
        .password-toggle:hover { color: #ffffff; }
        /* Tombol Masuk Hijau */
        .btn-login-green {
            background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%);
            border: none;
            color: white;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }

        .btn-login-green:hover {
            background: linear-gradient(135deg, #45a049 0%, #1b5e20 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
        }

        .btn-login-green:active {
            transform: translateY(0);
        }

        .btn-login-green:disabled {
            background: rgba(76, 175, 80, 0.5);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-login-green:focus {
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.5);
        }
        /* Judul styling */
        .judul h4 {
            color: #ffffff;
            font-family: 'Urbanist', system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
            font-weight: 600;
            text-align: center;
            margin-bottom: 12px;
            font-size: 18px;
        }
            /* Offcanvas inline card styling */
            .offcanvas { background: transparent; }
            .offcanvas-card { background: rgba(11,16,32,0.96); border:1px solid rgba(255,255,255,0.06); color: #fff; }
            .offcanvas-card h5, .offcanvas-card p, .offcanvas-card label, .offcanvas-card .small { color: #ffffff !important; }
            .offcanvas-card .input-group-text { background: transparent; border: none; color: #ffffff; }
            .offcanvas-card .form-control { background: #ffffff; color: #0b1020; border-radius:8px; border:1px solid rgba(0,0,0,0.08); }
            .offcanvas-card .form-control::placeholder { color: rgba(0,0,0,0.45); }
            @media (max-width: 576px){ .offcanvas-card{ margin:0 12px; } }
</style>
@endpush

@push('scripts')
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.textContent = '🙈';
        } else {
            passwordInput.type = 'password';
            eyeIcon.textContent = '👁️';
        }
    });

    // Client-side validation
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        // Validasi email tidak boleh kosong
        if (!email || !password) {
            e.preventDefault();
            alert('Username dan password tidak boleh kosong!');
            return false;
        }
        
        // Validasi format email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            e.preventDefault();
            alert('username/password incorrect');
            return false;
        }
        
        // Validasi domain yang dilarang
        if (email.includes('@ganteng.com')) {
            e.preventDefault();
            alert('username/password incorrect');
            return false;
        }
        
        // Validasi password minimal 8 karakter
        if (password.length < 8) {
            e.preventDefault();
            alert('username/password incorrect');
            return false;
        }
    });

    // Forgot inline form validation and loading
    var forgotForm = document.getElementById('forgotInlineForm');
    if(forgotForm){
        forgotForm.addEventListener('submit', function(e){
            var email = document.getElementById('forgot_email').value.trim();
            var btn = document.getElementById('forgotSubmitBtn');
            if(!email){
                e.preventDefault();
                alert('Email tidak boleh kosong');
                return false;
            }
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(!emailRegex.test(email)){
                e.preventDefault();
                alert('Format email tidak valid');
                return false;
            }
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Mengirim...';
            btn.disabled = true;
        });
    }
</script>
