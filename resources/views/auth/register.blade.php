@extends('layouts.app')

@section('title', 'Register - SleepyPanda')
@section('body_class', 'auth-page')

@section('content')
                <div class="judul">
                    <h4>Daftar menggunakan email yang valid</h4>
                </div>
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        
        <!-- Register Form -->
        <form action="{{ route('register.post') }}" method="POST" id="registerForm" class="form-animate">
            @csrf
            
            <!-- Email Input -->
            <div class="form-group">
            <div class="input-icon">
                <i class="bi bi-envelope-fill icon"></i>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>
            </div>
            
            <!-- Password Input -->
            <div class="form-group">
            <div class="input-icon" style="position: relative;">
                <i class="bi bi-lock-fill icon"></i>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <button type="button" class="password-toggle" id="togglePassword">👁️</button>
            </div>
            </div>
            
            <!-- Confirm Password Input -->
            <div class="form-group">
                <div class="input-icon">
                <div style="position: relative;">
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Confirm Password"
                        required
                    >
                </div>
                </div>
            </div>
            
            <!-- Validation Status -->
            <div class="validation-status" id="validationStatus">
                <div class="validation-item" id="emailStatus">
                    <span class="icon">⏳</span>
                    <span>Email valid</span>
                </div>
                <div class="validation-item" id="passwordStatus">
                    <span class="icon">⏳</span>
                    <span>Password minimal 8 karakter</span>
                </div>
                <div class="validation-item" id="confirmStatus">
                    <span class="icon">⏳</span>
                    <span>Password cocok</span>
                </div>
            </div>
            
            <!-- Register Button -->
            <button type="submit" class="btn-register" id="registerBtn" disabled>
                <span id="btnText">Register</span>
                <span id="btnSpinner" class="spinner-border spinner-border-sm d-none"></span>
            </button>
            
            <!-- Daftar Button (Alternative) -->
        </form>
        
        <!-- Login Link -->
        <div class="login-link">
            Sudah memiliki akun? <a href="{{ route('login') }}">Masuk Sekarang</a>
        </div>
    </div>
    @endsection
    
    @push('styles')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(180deg, #1a1d3f 0%, #2d3561 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        
        .register-container {
            max-width: 400px;
            width: 100%;
            padding: 40px 30px;
        }
        
        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .logo-section img {
            width: 120px;
            height: auto;
            margin-bottom: 15px;
            animation: fadeInDown 0.8s ease-out;
        }
        
        .logo-section h4 {
            font-family: 'Urbanist', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 0;
            animation: fadeInUp 0.8s ease-out;
            letter-spacing: -0.2px;
            line-height: 1.1;
        }
        
        .welcome-text {
            color: rgba(255, 255, 255, 0.8);
            text-align: center;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-out;
        }
        
        .form-group { 
            margin-bottom: 16px; 
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 14px 18px;
            color: white;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #4dd4ac;
            box-shadow: 0 0 0 3px rgba(77, 212, 172, 0.2);
            color: white;
        }
        
        .form-control.is-invalid {
            border-color: #ff6b6b;
            background: rgba(255, 107, 107, 0.1);
        }
        
        .form-control.is-valid {
            border-color: #4dd4ac;
            background: rgba(77, 212, 172, 0.1);
        }
        
        .invalid-feedback {
            color: #ff6b6b;
            font-size: 13px;
            margin-top: 5px;
        }
        
        .btn-register {
            background: #4dd4ac;
            border: none;
            border-radius: 8px;
            padding: 14px;
            color: #1a1d3f;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(77, 212, 172, 0.3);
        }
        
        .btn-register:hover {
            background: #3ec99a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(77, 212, 172, 0.4);
        }
        
        .btn-register:active {
            transform: translateY(0);
        }
        
        .btn-register:disabled {
            background: rgba(77, 212, 172, 0.5);
            cursor: not-allowed;
            transform: none;
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid white;
            border-radius: 8px;
            padding: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }
        
        .divider span {
            background: linear-gradient(180deg, #1a1d3f 0%, #2d3561 100%);
            padding: 0 10px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            position: relative;
            z-index: 1;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
        }
        
        .login-link a {
            color: #4dd4ac;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .login-link a:hover {
            color: #3ec99a;
            text-decoration: underline;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            padding: 5px;
            font-size: 18px;
            transition: color 0.3s ease;
        }
        
        .password-toggle:hover {
            color: white;
        }
        
        .validation-status {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            display: none;
        }
        
        .validation-status.show {
            display: block;
        }
        
        .validation-item {
            color: rgba(255, 255, 255, 0.7);
            font-size: 13px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }
        
        .validation-item:last-child {
            margin-bottom: 0;
        }
        
        .validation-item .icon {
            margin-right: 8px;
            font-size: 16px;
        }
        
        .validation-item.valid {
            color: #4dd4ac;
        }
        
        .validation-item.invalid {
            color: #ff6b6b;
        }
        
        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        .form-animate {
            animation: fadeInUp 1s ease-out 0.2s both;
        }
        
        /* Alert Styling */
        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
            animation: fadeIn 0.5s ease-out;
        }
        
        .alert-danger {
            background: rgba(255, 107, 107, 0.2);
            color: #ff6b6b;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }
        
        .alert-success {
            background: rgba(77, 212, 172, 0.2);
            color: #4dd4ac;
            border: 1px solid rgba(77, 212, 172, 0.3);
        }
        
        /* Loading Spinner */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 2px;
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
        .judul h4 {
            color: #ffffff;
            font-family: 'Urbanist', system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
            font-weight: 600;
            text-align: center;
            margin-bottom: 12px;
            font-size: 18px;
        }
    </style>
    @endpush

    @push('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Validation state
        let validationState = {
            email: false,
            password: false,
            confirmPassword: false
        };

        // Blocked domains
        const blockedDomains = ['@ganteng.com'];

        // DOM Elements
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const registerBtn = document.getElementById('registerBtn');
        const validationStatus = document.getElementById('validationStatus');
        const emailStatus = document.getElementById('emailStatus');
        const passwordStatus = document.getElementById('passwordStatus');
        const confirmStatus = document.getElementById('confirmStatus');

        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            confirmPasswordInput.type = type;
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });

        // Email validation
        emailInput.addEventListener('input', function() {
            validateEmail();
        });

        function validateEmail() {
            const email = emailInput.value.trim();
            validationStatus.classList.add('show');
            
            if (!email) {
                emailInput.classList.remove('is-valid', 'is-invalid');
                updateStatus(emailStatus, 'pending', 'Email required');
                validationState.email = false;
                updateButton();
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                emailInput.classList.remove('is-valid');
                emailInput.classList.add('is-invalid');
                updateStatus(emailStatus, 'invalid', 'Email tidak valid');
                validationState.email = false;
                updateButton();
                return;
            }

            // Check blocked domains
            let isBlocked = false;
            for (let domain of blockedDomains) {
                if (email.includes(domain)) {
                    isBlocked = true;
                    break;
                }
            }

            if (isBlocked) {
                emailInput.classList.remove('is-valid');
                emailInput.classList.add('is-invalid');
                updateStatus(emailStatus, 'invalid', 'Domain tidak diizinkan');
                validationState.email = false;
                updateButton();
                return;
            }

            emailInput.classList.remove('is-invalid');
            emailInput.classList.add('is-valid');
            updateStatus(emailStatus, 'valid', 'Email valid');
            validationState.email = true;
            updateButton();
        }

        // Password validation
        passwordInput.addEventListener('input', function() {
            validatePassword();
            validateConfirmPassword();
        });

        function validatePassword() {
            const password = passwordInput.value;
            validationStatus.classList.add('show');
            
            if (!password) {
                passwordInput.classList.remove('is-valid', 'is-invalid');
                updateStatus(passwordStatus, 'pending', 'Password required');
                validationState.password = false;
                updateButton();
                return;
            }

            if (password.length < 8) {
                passwordInput.classList.remove('is-valid');
                passwordInput.classList.add('is-invalid');
                updateStatus(passwordStatus, 'invalid', 'Password minimal 8 karakter');
                validationState.password = false;
                updateButton();
                return;
            }

            passwordInput.classList.remove('is-invalid');
            passwordInput.classList.add('is-valid');
            updateStatus(passwordStatus, 'valid', 'Password kuat');
            validationState.password = true;
            updateButton();
        }

        // Confirm password validation
        confirmPasswordInput.addEventListener('input', function() {
            validateConfirmPassword();
        });

        function validateConfirmPassword() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            validationStatus.classList.add('show');
            
            if (!confirmPassword) {
                confirmPasswordInput.classList.remove('is-valid', 'is-invalid');
                updateStatus(confirmStatus, 'pending', 'Konfirmasi password');
                validationState.confirmPassword = false;
                updateButton();
                return;
            }

            if (password !== confirmPassword) {
                confirmPasswordInput.classList.remove('is-valid');
                confirmPasswordInput.classList.add('is-invalid');
                updateStatus(confirmStatus, 'invalid', 'Password tidak cocok');
                validationState.confirmPassword = false;
                updateButton();
                return;
            }

            confirmPasswordInput.classList.remove('is-invalid');
            confirmPasswordInput.classList.add('is-valid');
            updateStatus(confirmStatus, 'valid', 'Password cocok');
            validationState.confirmPassword = true;
            updateButton();
        }

        // Update status display
        function updateStatus(element, status, text) {
            const icon = element.querySelector('.icon');
            const span = element.querySelector('span:last-child');
            
            element.classList.remove('valid', 'invalid');
            
            if (status === 'valid') {
                icon.textContent = '✅';
                element.classList.add('valid');
            } else if (status === 'invalid') {
                icon.textContent = '❌';
                element.classList.add('invalid');
            } else {
                icon.textContent = '⏳';
            }
            
            span.textContent = text;
        }

        // Update button state
        function updateButton() {
            const allValid = validationState.email && 
                            validationState.password && 
                            validationState.confirmPassword;
            
            registerBtn.disabled = !allValid;
        }

        // Form submission
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            document.getElementById('btnText').textContent = 'Processing...';
            document.getElementById('btnSpinner').classList.remove('d-none');
            registerBtn.disabled = true;
        });
    </script>
    @endpush