<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SleepyPanda')</title>
    
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
        
        .auth-container {
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
            color: rgba(255,255,255,0.6);
            font-size: 18px;
            pointer-events: none;
        }
        .input-icon .form-control {
        padding-left: 44px;
        }
    .form-group {
            margin-bottom: 20px;
        }
        /* frame border around auth screens (login/register/forgot) */
        .auth-frame {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 420px;
            width: 100%;
            padding: 18px;
            border: 2px solid rgba(255,255,255,0.85);
            border-radius: 8px;
            box-sizing: border-box;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="auth-frame">
        <div class="auth-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <img src="{{ asset('images/logoPanda.png') }}" alt="Sleepy Panda Logo">
        </div>
        
        <!-- Welcome Text
        <div class="welcome-text">
            @yield('welcome_text', 'Selamat datang di SleepyPanda')
        </div> -->
        
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
        
        <!-- Main Content -->
        @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>