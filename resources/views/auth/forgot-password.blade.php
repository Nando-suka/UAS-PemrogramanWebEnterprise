@extends('layouts.app')

@section('title', 'Forgot Password - SleepyPanda')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="auth-card">

                <!-- Alert untuk error atau success -->
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

                <!-- Forgot Password Form -->
                <form action="{{ route('forgot.password.post') }}" method="POST" id="forgotPasswordForm">
                    @csrf
                    
                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            placeholder="Enter your registered email"
                            value="{{ old('email') }}"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> Masukkan email yang terdaftar di akun Anda
                        </small>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="btn btn-primary w-100 py-2 mb-3"
                        id="sendOtpBtn"
                    >
                        <i class="bi bi-envelope"></i> Send OTP
                    </button>

                    <!-- Back to Login -->
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            <i class="bi bi-arrow-left"></i> Back to Login
                        </a>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .auth-icon {
        font-size: 4rem;
        animation: shake 3s infinite;
    }
    
    @keyframes shake {
        0%, 100% {
            transform: rotate(0deg);
        }
        25% {
            transform: rotate(-10deg);
        }
        75% {
            transform: rotate(10deg);
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Client-side validation
    document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
        const email = document.getElementById('email').value;
        const btn = document.getElementById('sendOtpBtn');
        
        // Validasi email tidak boleh kosong
        if (!email) {
            e.preventDefault();
            alert('Email tidak boleh kosong');
            return false;
        }
        
        // Validasi format email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            e.preventDefault();
            alert('Email Anda Salah');
            return false;
        }
        
        // Show loading state
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Sending...';
        btn.disabled = true;
    });
</script>
@endpush