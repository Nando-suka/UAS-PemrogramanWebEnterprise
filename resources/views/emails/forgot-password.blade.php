<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SleepyPanda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
        }
        .email-icon {
            font-size: 60px;
            margin-bottom: 10px;
        }
        .email-body {
            padding: 40px 30px;
            color: #333;
        }
        .email-body h2 {
            color: #667eea;
            margin-top: 0;
        }
        .otp-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 8px;
            text-align: center;
            padding: 20px;
            margin: 30px 0;
            border-radius: 10px;
            font-family: 'Courier New', monospace;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .btn-reset {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .warning {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="email-icon">🐼</div>
            <h1>SleepyPanda</h1>
            <p>Password Reset Request</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <h2>Hello!</h2>
            <p>Kami menerima permintaan untuk reset password akun Anda dengan email: <strong>{{ $user->email }}</strong></p>

            <p>Gunakan kode OTP berikut untuk reset password Anda:</p>

            <!-- OTP Box -->
            <div class="otp-box">
                {{ $otp }}
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <strong>⏰ Kode OTP ini berlaku selama 30 menit</strong><br>
                Setelah itu, Anda perlu melakukan request ulang.
            </div>

            <p>Atau klik tombol di bawah ini untuk langsung reset password:</p>

            <center>
                <a href="{{ $resetUrl }}" class="btn-reset">Reset Password Sekarang</a>
            </center>

            <p>Jika tombol di atas tidak berfungsi, copy dan paste URL berikut ke browser Anda:</p>
            <p style="word-break: break-all; color: #667eea;">{{ $resetUrl }}</p>

            <div class="info-box">
                <p class="warning">⚠️ PERHATIAN:</p>
                <ul>
                    <li>Jangan bagikan OTP ini kepada siapapun</li>
                    <li>Tim SleepyPanda tidak akan pernah meminta OTP Anda</li>
                    <li>Jika Anda tidak melakukan request ini, abaikan email ini</li>
                </ul>
            </div>

            <p>Terima kasih,<br><strong>Tim SleepyPanda</strong></p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} SleepyPanda. All rights reserved.</p>
            <p style="font-size: 12px; color: #999;">
                Email dikirim pada: {{ now()->format('d M Y, H:i') }} WIB
            </p>
        </div>
    </div>
</body>
</html>