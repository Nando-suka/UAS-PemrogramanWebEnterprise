@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')

<div class="dashboard-page">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <h2 class="text-white mb-2">Dashboard</h2>
        <p class="text-muted">Selamat datang di sistem Sleepy Panda</p>
    </div>

    <!-- Charts Row 1 - Daily, Weekly, Monthly Reports -->
    <div class="row mb-4">
        <!-- Daily Report -->
        <div class="col-lg-4 mb-3">
            <div class="chart-card">
                <div class="chart-header">
                    <h5>Daily Report</h5>
                    <div class="chart-legend">
                        <span class="legend-item">
                            <span class="legend-dot legend-female"></span>
                            Female
                        </span>
                        <span class="legend-item">
                            <span class="legend-dot legend-male"></span>
                            Male
                        </span>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="dailyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Weekly Report -->
        <div class="col-lg-4 mb-3">
            <div class="chart-card">
                <div class="chart-header">
                    <h5>Weekly Report</h5>
                    <div class="chart-legend">
                        <span class="legend-item">
                            <span class="legend-dot legend-female"></span>
                            Female
                        </span>
                        <span class="legend-item">
                            <span class="legend-dot legend-male"></span>
                            Male
                        </span>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="weeklyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Monthly Report -->
        <div class="col-lg-4 mb-3">
            <div class="chart-card">
                <div class="chart-header">
                    <h5>Monthly Report</h5>
                    <div class="chart-legend">
                        <span class="legend-item">
                            <span class="legend-dot legend-female"></span>
                            Female
                        </span>
                        <span class="legend-item">
                            <span class="legend-dot legend-male"></span>
                            Male
                        </span>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row mb-4">
        <!-- Total Users -->
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-dashboard">
                <div class="stat-header">
                    <p class="stat-label">Total Users</p>
                </div>
                <div class="stat-body">
                    <div class="stat-icon-dashboard">
                        <img src="{{ asset('/images/user.png') }}" alt="user" />
                    </div>
                    <div class="stat-number">
                        <h3>4500</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Female Users -->
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-dashboard">
                <div class="stat-header">
                    <p class="stat-label">Female Users</p>
                </div>
                <div class="stat-body">
                    <div class="stat-icon-dashboard">
                        <img src="{{ asset('/images/user.png') }}" alt="female user" />
                    </div>
                    <div class="stat-number">
                        <h3>2000</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Male Users -->
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-dashboard">
                <div class="stat-header">
                    <p class="stat-label">Male Users</p>
                </div>
                <div class="stat-body">
                    <div class="stat-icon-dashboard">
                        <img src="{{ asset('/images/user.png') }}" alt="male user" />
                    </div>
                    <div class="stat-number">
                        <h3>2500</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Time -->
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-dashboard">
                <div class="stat-header">
                    <p class="stat-label">Average Time</p>
                </div>
                <div class="stat-body">
                    <div class="stat-icon-dashboard">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <div class="stat-number">
                        <h3>154.25</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Average Users Sleep Time Chart -->
    <div class="row">
        <div class="col-12">
            <div class="chart-card chart-card-large">
                <div class="chart-header">
                    <h5>Average Users Sleep Time</h5>
                    <div class="chart-legend">
                        <span class="legend-item">
                            <span class="legend-dot legend-female"></span>
                            Female
                        </span>
                        <span class="legend-item">
                            <span class="legend-dot legend-male"></span>
                            Male
                        </span>
                    </div>
                </div>
                <div class="chart-container-large">
                    <canvas id="sleepTimeChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- JWT Token Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="chart-card">
                <div class="chart-header">
                    <h5>
                        <i class="bi bi-shield-lock text-success"></i> JWT Token Information
                    </h5>
                </div>
                
                @if(session('jwt_token'))
                <div class="alert alert-info" style="background: rgba(13, 202, 240, 0.1); border-color: rgba(13, 202, 240, 0.3); color: rgba(255, 255, 255, 0.9);">
                    <strong>🔐 Algorithm:</strong> HS256 (HMAC SHA-256)<br>
                    <strong>⏰ Expires In:</strong> 30 minutes<br>
                    <strong>📅 Valid Until:</strong> {{ session('token_expires_at') ? session('token_expires_at')->format('d M Y H:i:s') : 'N/A' }}
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: rgba(255, 255, 255, 0.9);">Your JWT Token:</label>
                    <div class="input-group">
                        <input 
                            type="text" 
                            class="form-control font-monospace small" 
                            id="jwtToken" 
                            value="{{ session('jwt_token') }}" 
                            readonly
                            style="background: rgba(255, 255, 255, 0.05); border-color: rgba(255, 255, 255, 0.1); color: rgba(255, 255, 255, 0.9);"
                        >
                        <button class="btn btn-outline-secondary" type="button" onclick="copyToken()" style="border-color: rgba(255, 255, 255, 0.2); color: rgba(255, 255, 255, 0.8);">
                            <i class="bi bi-clipboard"></i> Copy
                        </button>
                    </div>
                    <small class="text-muted" style="color: rgba(255, 255, 255, 0.6);">Use this token for API authentication</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold" style="color: rgba(255, 255, 255, 0.9);">Passport Access Token:</label>
                    <div class="input-group">
                        <input 
                            type="text" 
                            class="form-control font-monospace small" 
                            id="passportToken" 
                            value="{{ session('passport_token') ?? 'Not generated' }}" 
                            readonly
                            style="background: rgba(255, 255, 255, 0.05); border-color: rgba(255, 255, 255, 0.1); color: rgba(255, 255, 255, 0.9);"
                        >
                        <button class="btn btn-outline-secondary" type="button" onclick="copyPassportToken()" style="border-color: rgba(255, 255, 255, 0.2); color: rgba(255, 255, 255, 0.8);">
                            <i class="bi bi-clipboard"></i> Copy
                        </button>
                    </div>
                    <small class="text-muted" style="color: rgba(255, 255, 255, 0.6);">OAuth2 access token for API calls</small>
                </div>
                
                <div class="d-flex gap-2 flex-wrap">
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
                    <div class="card" style="background: rgba(0, 0, 0, 0.3); border-color: rgba(255, 255, 255, 0.1);">
                        <div class="card-body">
                            <pre id="tokenData" class="mb-0" style="color: #0f0; background: transparent; border: none; font-size: 0.85rem;"></pre>
                        </div>
                    </div>
                </div>
                @else
                <div class="alert alert-warning" style="background: rgba(255, 193, 7, 0.1); border-color: rgba(255, 193, 7, 0.3); color: rgba(255, 255, 255, 0.9);">
                    <i class="bi bi-exclamation-triangle"></i> No JWT token found. Please login again.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* ===== DASHBOARD PAGE STYLES ===== */
    .dashboard-page {
        padding: 1.5rem;
    }

    .page-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
    }

    .text-muted {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    /* ===== CHART CARDS ===== */
    .chart-card {
        background: linear-gradient(135deg, #2C2E4E 0%, #1e2240 100%);
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid rgba(55, 59, 110, 0.48);
        height: 100%;
        transition: all 0.3s ease;
    }

    .chart-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .chart-card-large {
        background: linear-gradient(135deg, #2C2E4E 0%, #1e2240 100%);
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid rgba(55, 59, 110, 0.48);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .chart-header h5 {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
    }

    .chart-legend {
        display: flex;
        gap: 1.5rem;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.8);
    }

    .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
    }

    .legend-female {
        background: #e91e8c;
    }

    .legend-male {
        background: #5b6ef0;
    }

    .chart-container {
        position: relative;
        height: 250px;
    }

    .chart-container-large {
        position: relative;
        height: 350px;
    }

    /* ===== STAT CARDS ===== */
    .stat-card-dashboard {
        background: linear-gradient(135deg, #272E49 100%, #1e2240 0%);
        border-radius: 16px;
        padding: 1rem 1.25rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
        transition: all 0.3s ease;
        height: 100%;
        justify-content: center;
    }

    .stat-card-dashboard:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .stat-icon-dashboard {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        color: #5b6ef0;
        flex-shrink: 0;
    }

    .stat-icon-dashboard img {
        width: 36px;
        height: 36px;
        object-fit: cover;
        border-radius: 8px;
        display: block;
    }

    .stat-header {
        width: 100%;
    }

    .stat-label {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.7);
        margin: 0 0 0.3rem 0;
        font-weight: 600;
    }

    .stat-body {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        width: 100%;
        gap: 0.6rem;
    }

    .stat-number h3 {
        font-size: 3.8rem;
        font-weight: 700;
        color: white;
        margin: 0;
        text-align: right;
    }

    .stat-number p {
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .chart-container {
            height: 200px;
        }

        .chart-container-large {
            height: 250px;
        }

        .chart-legend {
            gap: 1rem;
        }

        .stat-card-dashboard {
            padding: 1.2rem;
        }

        .stat-icon-dashboard {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }

        .stat-details h3 {
            font-size: 1.6rem;
        }
    }

    /* ===== JWT TOKEN SECTION STYLES ===== */
    .chart-card .alert {
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .chart-card .form-label {
        margin-bottom: 0.5rem;
    }

    .chart-card .input-group .form-control {
        font-size: 0.85rem;
    }

    .chart-card .input-group .btn {
        transition: all 0.3s ease;
    }

    .chart-card .input-group .btn:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .chart-card .d-flex.gap-2 .btn {
        transition: all 0.3s ease;
    }

    .chart-card .d-flex.gap-2 .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    #tokenResult {
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #tokenData {
        max-height: 300px;
        overflow-y: auto;
        padding: 1rem;
        border-radius: 4px;
    }

    /* Responsive untuk JWT Token Section */
    @media (max-width: 768px) {
        .chart-card .d-flex.gap-2 {
            flex-direction: column;
        }

        .chart-card .d-flex.gap-2 .btn {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart.js default config
        Chart.defaults.color = 'rgba(255, 255, 255, 0.7)';
        Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.1)';
        Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";

        // Common chart options
        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(30, 34, 64, 0.95)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.parsed.y;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.6)',
                        font: {
                            size: 11
                        }
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.6)',
                        font: {
                            size: 11
                        }
                    }
                }
            }
        };

        // Daily Report Chart
        const dailyCtx = document.getElementById('dailyChart').getContext('2d');
        new Chart(dailyCtx, {
            type: 'bar',
            data: {
                labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'],
                datasets: [
                    {
                        label: 'Female',
                        data: [180, 220, 190, 240, 200, 160, 120],
                        backgroundColor: '#e91e8c',
                        borderRadius: 8,
                        barPercentage: 0.6
                    },
                    {
                        label: 'Male',
                        data: [150, 200, 170, 210, 180, 140, 100],
                        backgroundColor: '#5b6ef0',
                        borderRadius: 8,
                        barPercentage: 0.6
                    }
                ]
            },
            options: commonOptions
        });

        // Weekly Report Chart
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        new Chart(weeklyCtx, {
            type: 'bar',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [
                    {
                        label: 'Female',
                        data: [1200, 1400, 1100, 1500],
                        backgroundColor: '#e91e8c',
                        borderRadius: 8,
                        barPercentage: 0.6
                    },
                    {
                        label: 'Male',
                        data: [1000, 1200, 900, 1300],
                        backgroundColor: '#5b6ef0',
                        borderRadius: 8,
                        barPercentage: 0.6
                    }
                ]
            },
            options: commonOptions
        });

        // Monthly Report Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                datasets: [
                    {
                        label: 'Female',
                        data: [3200, 3500, 3100, 3800, 3400, 3600, 3300, 3700, 3500, 3900],
                        backgroundColor: '#e91e8c',
                        borderRadius: 8,
                        barPercentage: 0.6
                    },
                    {
                        label: 'Male',
                        data: [2800, 3000, 2700, 3200, 2900, 3100, 2800, 3200, 3000, 3400],
                        backgroundColor: '#5b6ef0',
                        borderRadius: 8,
                        barPercentage: 0.6
                    }
                ]
            },
            options: commonOptions
        });

        // Average Users Sleep Time Chart (Line Chart)
        const sleepTimeCtx = document.getElementById('sleepTimeChart').getContext('2d');
        new Chart(sleepTimeCtx, {
            type: 'line',
            data: {
                labels: ['Jan 01', 'Jan 02', 'Jan 03', 'Jan 04', 'Jan 05', 'Jan 06'],
                datasets: [
                    {
                        label: 'Female',
                        data: [3, 5, 4, 6, 5, 7],
                        borderColor: '#e91e8c',
                        backgroundColor: 'rgba(233, 30, 140, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointBackgroundColor: '#e91e8c',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Male',
                        data: [2, 4, 3, 5, 4, 6],
                        borderColor: '#5b6ef0',
                        backgroundColor: 'rgba(91, 110, 240, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointBackgroundColor: '#5b6ef0',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 7
                    }
                ]
            },
            options: {
                ...commonOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 8,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.6)',
                            font: {
                                size: 11
                            },
                            stepSize: 2
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.6)',
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    });

    // JWT Token Functions
    // Copy JWT Token
    function copyToken() {
        const tokenInput = document.getElementById('jwtToken');
        if (tokenInput) {
            tokenInput.select();
            document.execCommand('copy');
            alert('JWT Token copied to clipboard!');
        }
    }
    
    // Copy Passport Token
    function copyPassportToken() {
        const tokenInput = document.getElementById('passportToken');
        if (tokenInput) {
            tokenInput.select();
            document.execCommand('copy');
            alert('Passport Token copied to clipboard!');
        }
    }
    
    // Verify Token via API
    async function verifyToken() {
        const tokenInput = document.getElementById('jwtToken');
        if (!tokenInput) return;
        
        const token = tokenInput.value;
        
        try {
            const response = await fetch('/api/v1/token/verify', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token
                }
            });
            
            const data = await response.json();
            
            const resultDiv = document.getElementById('tokenResult');
            const dataPre = document.getElementById('tokenData');
            
            if (resultDiv && dataPre) {
                resultDiv.style.display = 'block';
                dataPre.textContent = JSON.stringify(data, null, 2);
            }
            
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
        const tokenInput = document.getElementById('jwtToken');
        if (!tokenInput) return;
        
        const token = tokenInput.value;
        
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
                tokenInput.value = data.token;
                alert('✅ Token refreshed successfully!\nNew token expires in: ' + data.expires_in);
                // Reload page to update session
                location.reload();
            } else {
                alert('❌ Failed to refresh token: ' + data.message);
            }
        } catch (error) {
            alert('Error refreshing token: ' + error.message);
        }
    }
    
    // Decode Token (client-side)
    function decodeToken() {
        const tokenInput = document.getElementById('jwtToken');
        if (!tokenInput) return;
        
        const token = tokenInput.value;
        
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
                payload.expires_in_minutes = Math.round((payload.exp - Date.now() / 1000) / 60);
            }
            
            const resultDiv = document.getElementById('tokenResult');
            const dataPre = document.getElementById('tokenData');
            
            if (resultDiv && dataPre) {
                resultDiv.style.display = 'block';
                dataPre.textContent = JSON.stringify(payload, null, 2);
            }
            
        } catch (error) {
            alert('Error decoding token: ' + error.message);
        }
    }
</script>
@endpush
@endsection