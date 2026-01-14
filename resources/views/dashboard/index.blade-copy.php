<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SleepyPanda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .dashboard-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 30px;
            margin: 30px 0;
        }
        .navbar {
            background: white !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
        }
        .stats-icon {
            font-size: 3rem;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                🐼 SleepyPanda
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ $user->email }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="dashboard-card">
            <!-- Welcome Message -->
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="fw-bold">Welcome back! 👋</h2>
                    <p class="text-muted">Logged in as: <strong>{{ $user->email }}</strong></p>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase">Total Users</h6>
                                <h2 class="fw-bold mb-0">{{ \App\Models\User::count() }}</h2>
                            </div>
                            <div class="stats-icon">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase">Sleep Journals</h6>
                                <h2 class="fw-bold mb-0">0</h2>
                            </div>
                            <div class="stats-icon">
                                <i class="bi bi-journal"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase">Active Sessions</h6>
                                <h2 class="fw-bold mb-0">1</h2>
                            </div>
                            <div class="stats-icon">
                                <i class="bi bi-activity"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-info-circle text-primary"></i> Account Information
                            </h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                    <p><strong>User ID:</strong> {{ $user->id }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Registered:</strong> {{ $user->created_at->format('d M Y H:i') }}</p>
                                    <p><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- JWT Token Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-shield-lock text-success"></i> JWT Token Information
                            </h5>
                            <hr>
                            
                            @if(session('jwt_token'))
                            <div class="alert alert-info">
                                <strong>🔐 Algorithm:</strong> HS256 (HMAC SHA-256)<br>
                                <strong>⏰ Expires In:</strong> 30 minutes<br>
                                <strong>📅 Valid Until:</strong> {{ session('token_expires_at') ? session('token_expires_at')->format('d M Y H:i:s') : 'N/A' }}
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Your JWT Token:</label>
                                <div class="input-group">
                                    <input 
                                        type="text" 
                                        class="form-control font-monospace small" 
                                        id="jwtToken" 
                                        value="{{ session('jwt_token') }}" 
                                        readonly
                                    >
                                    <button class="btn btn-outline-secondary" type="button" onclick="copyToken()">
                                        <i class="bi bi-clipboard"></i> Copy
                                    </button>
                                </div>
                                <small class="text-muted">Use this token for API authentication</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Passport Access Token:</label>
                                <div class="input-group">
                                    <input 
                                        type="text" 
                                        class="form-control font-monospace small" 
                                        id="passportToken" 
                                        value="{{ session('passport_token') ?? 'Not generated' }}" 
                                        readonly
                                    >
                                    <button class="btn btn-outline-secondary" type="button" onclick="copyPassportToken()">
                                        <i class="bi bi-clipboard"></i> Copy
                                    </button>
                                </div>
                                <small class="text-muted">OAuth2 access token for API calls</small>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-primary" onclick="verifyToken()">
                                    <i class="bi bi-check-circle"></i> Verify Token
                                </button>
                                <button class="btn btn-sm btn-success" onclick="refreshToken()">
                                    <i class="bi bi-arrow-clockwise"></i> Refresh Token
                                </button>
                                <button class="btn btn-sm btn-info" onclick="decodeToken()">
                                    <i class="bi bi-eye"></i> Decode Token
                                </button>
                            </div>
                            
                            <!-- Token decode result -->
                            <div id="tokenResult" class="mt-3" style="display: none;">
                                <div class="card bg-dark text-light">
                                    <div class="card-body">
                                        <pre id="tokenData" class="mb-0" style="color: #0f0;"></pre>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle"></i> No JWT token found. Please login again.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mt-4">
                <div class="col-12">
                    <h5 class="mb-3">Quick Actions</h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> New Sleep Journal
                        </button>
                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-graph-up"></i> View Statistics
                        </button>
                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-gear"></i> Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Copy JWT Token
        function copyToken() {
            const tokenInput = document.getElementById('jwtToken');
            tokenInput.select();
            document.execCommand('copy');
            alert('JWT Token copied to clipboard!');
        }
        
        // Copy Passport Token
        function copyPassportToken() {
            const tokenInput = document.getElementById('passportToken');
            tokenInput.select();
            document.execCommand('copy');
            alert('Passport Token copied to clipboard!');
        }
        
        // Verify Token via API
        async function verifyToken() {
            const token = document.getElementById('jwtToken').value;
            
            try {
                const response = await fetch('/api/v1/token/verify', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + token
                    }
                });
                
                const data = await response.json();
                
                document.getElementById('tokenResult').style.display = 'block';
                document.getElementById('tokenData').textContent = JSON.stringify(data, null, 2);
                
                if (data.success) {
                    alert('✅ Token is valid!\nExpires in: ' + data.expires_in);
                } else {
                    alert('❌ Token is invalid or expired!');
                }
            } catch (error) {
                alert('Error verifying token: ' + error.message);
            }
        }
        
        // Refresh Token
        async function refreshToken() {
            const token = document.getElementById('jwtToken').value;
            
            try {
                const response = await fetch('/api/v1/token/refresh', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + token
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    document.getElementById('jwtToken').value = data.token;
                    alert('✅ Token refreshed successfully!\nNew token expires in: ' + data.expires_in);
                } else {
                    alert('❌ Failed to refresh token: ' + data.message);
                }
            } catch (error) {
                alert('Error refreshing token: ' + error.message);
            }
        }
        
        // Decode Token (client-side)
        function decodeToken() {
            const token = document.getElementById('jwtToken').value;
            
            try {
                // JWT format: header.payload.signature
                const parts = token.split('.');
                
                if (parts.length !== 3) {
                    throw new Error('Invalid JWT format');
                }
                
                // Decode payload (base64)
                const payload = JSON.parse(atob(parts[1]));
                
                // Format timestamps
                if (payload.iat) {
                    payload.issued_at = new Date(payload.iat * 1000).toLocaleString();
                }
                if (payload.exp) {
                    payload.expires_at = new Date(payload.exp * 1000).toLocaleString();
                }
                
                document.getElementById('tokenResult').style.display = 'block';
                document.getElementById('tokenData').textContent = JSON.stringify(payload, null, 2);
                
            } catch (error) {
                alert('Error decoding token: ' + error.message);
            }
        }
    </script>
</body>
</html>