<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Test - SleepyPanda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            padding: 20px;
        }
        .api-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .endpoint {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            border-left: 4px solid #667eea;
        }
        .response-box {
            background: #1e1e1e;
            color: #0f0;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>🔌 API Testing Dashboard</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                ← Back to Dashboard
            </a>
        </div>

        <!-- JWT Token Input -->
        <div class="api-card">
            <h5>🔐 JWT Token Configuration</h5>
            <div class="mb-3">
                <label class="form-label">Your JWT Token:</label>
                <input type="text" class="form-control" id="jwtToken" value="{{ session('jwt_token') }}" placeholder="Paste your JWT token here">
            </div>
        </div>

        <!-- API Endpoints -->
        <div class="row">
            <!-- Verify Token -->
            <div class="col-md-6">
                <div class="api-card">
                    <h6>✅ Verify Token</h6>
                    <div class="endpoint mb-3">
                        POST /api/v1/token/verify
                    </div>
                    <button class="btn btn-primary btn-sm" onclick="testVerifyToken()">
                        Test Endpoint
                    </button>
                    <div id="verifyResponse" class="response-box mt-3" style="display: none;"></div>
                </div>
            </div>

            <!-- Refresh Token -->
            <div class="col-md-6">
                <div class="api-card">
                    <h6>🔄 Refresh Token</h6>
                    <div class="endpoint mb-3">
                        POST /api/v1/token/refresh
                    </div>
                    <button class="btn btn-success btn-sm" onclick="testRefreshToken()">
                        Test Endpoint
                    </button>
                    <div id="refreshResponse" class="response-box mt-3" style="display: none;"></div>
                </div>
            </div>

            <!-- Get User Info -->
            <div class="col-md-6">
                <div class="api-card">
                    <h6>👤 Get User Info</h6>
                    <div class="endpoint mb-3">
                        GET /api/v1/user
                    </div>
                    <button class="btn btn-info btn-sm" onclick="testGetUser()">
                        Test Endpoint
                    </button>
                    <div id="userResponse" class="response-box mt-3" style="display: none;"></div>
                </div>
            </div>

            <!-- Health Check -->
            <div class="col-md-6">
                <div class="api-card">
                    <h6>💚 Health Check</h6>
                    <div class="endpoint mb-3">
                        GET /api/health
                    </div>
                    <button class="btn btn-secondary btn-sm" onclick="testHealth()">
                        Test Endpoint
                    </button>
                    <div id="healthResponse" class="response-box mt-3" style="display: none;"></div>
                </div>
            </div>
        </div>

        <!-- Documentation -->
        <div class="api-card">
            <h5>📚 API Documentation</h5>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Endpoint</th>
                        <th>Method</th>
                        <th>Auth Required</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>/api/v1/login</code></td>
                        <td><span class="badge bg-primary">POST</span></td>
                        <td>No</td>
                        <td>Login and get JWT token</td>
                    </tr>
                    <tr>
                        <td><code>/api/v1/register</code></td>
                        <td><span class="badge bg-primary">POST</span></td>
                        <td>No</td>
                        <td>Register new user</td>
                    </tr>
                    <tr>
                        <td><code>/api/v1/token/verify</code></td>
                        <td><span class="badge bg-primary">POST</span></td>
                        <td>Yes</td>
                        <td>Verify JWT token validity</td>
                    </tr>
                    <tr>
                        <td><code>/api/v1/token/refresh</code></td>
                        <td><span class="badge bg-primary">POST</span></td>
                        <td>Yes</td>
                        <td>Refresh JWT token</td>
                    </tr>
                    <tr>
                        <td><code>/api/v1/user</code></td>
                        <td><span class="badge bg-success">GET</span></td>
                        <td>Yes</td>
                        <td>Get authenticated user info</td>
                    </tr>
                    <tr>
                        <td><code>/api/health</code></td>
                        <td><span class="badge bg-success">GET</span></td>
                        <td>No</td>
                        <td>Check API health status</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const baseUrl = window.location.origin;

        async function testVerifyToken() {
            const token = document.getElementById('jwtToken').value;
            const responseDiv = document.getElementById('verifyResponse');
            
            try {
                const response = await fetch(`${baseUrl}/api/v1/token/verify`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json'
                    }
                });
                
                const data = await response.json();
                responseDiv.style.display = 'block';
                responseDiv.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                responseDiv.style.display = 'block';
                responseDiv.textContent = 'Error: ' + error.message;
            }
        }

        async function testRefreshToken() {
            const token = document.getElementById('jwtToken').value;
            const responseDiv = document.getElementById('refreshResponse');
            
            try {
                const response = await fetch(`${baseUrl}/api/v1/token/refresh`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json'
                    }
                });
                
                const data = await response.json();
                responseDiv.style.display = 'block';
                responseDiv.textContent = JSON.stringify(data, null, 2);
                
                if (data.success && data.token) {
                    document.getElementById('jwtToken').value = data.token;
                }
            } catch (error) {
                responseDiv.style.display = 'block';
                responseDiv.textContent = 'Error: ' + error.message;
            }
        }

        async function testGetUser() {
            const token = document.getElementById('jwtToken').value;
            const responseDiv = document.getElementById('userResponse');
            
            try {
                const response = await fetch(`${baseUrl}/api/v1/user`, {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                responseDiv.style.display = 'block';
                responseDiv.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                responseDiv.style.display = 'block';
                responseDiv.textContent = 'Error: ' + error.message;
            }
        }

        async function testHealth() {
            const responseDiv = document.getElementById('healthResponse');
            
            try {
                const response = await fetch(`${baseUrl}/api/health`);
                const data = await response.json();
                responseDiv.style.display = 'block';
                responseDiv.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                responseDiv.style.display = 'block';
                responseDiv.textContent = 'Error: ' + error.message;
            }
        }
    </script>
</body>
</html>