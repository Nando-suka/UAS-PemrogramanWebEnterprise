@extends('layouts.dashboard')
@section('title', 'Jurnal Daily Report')
@section('content')

<div class="jurnal-page">
    <!-- Page Header -->
    <div class="jurnal-header">
        <h2 class="jurnal-title">Jurnal Tidur Report</h2>
        <div class="dropdown">
            <button class="dropdown-toggle" type="button" id="periodDropdown" data-bs-toggle="dropdown">
                Daily
                <i class="bi bi-chevron-down ms-2"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="periodDropdown">
                <li><a class="dropdown-item active" href="{{ route('jurnal.daily') }}">Daily</a></li>
                <li><a class="dropdown-item" href="{{ route('jurnal.weekly') }}">Weekly</a></li>
                <li><a class="dropdown-item" href="{{ route('jurnal.monthly') }}">Monthly</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="jurnal-content">
        <!-- Left Side - Info Cards -->
        <div class="info-cards">
            <!-- Card 1: User -->
            <div class="info-card">
                <div class="card-header-info">
                    <span class="card-date">12 Agustus 2023</span>
                </div>
                <div class="card-content">
                    <div class="info-item">
                        <span class="info-icon">😴</span>
                        <div class="info-details">
                            <span class="info-label">User</span>
                            <span class="info-value">1000</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Average Durasi Tidur -->
            <div class="info-card">
                <div class="card-header-info">
                    <span class="card-date">12 Agustus 2023</span>
                </div>
                <div class="card-content">
                    <div class="info-item">
                        <span class="info-icon">💤</span>
                        <div class="info-details">
                            <span class="info-label">Average Durasi Tidur</span>
                            <span class="info-value">7 jam 2 menit</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Average Waktu Tidur -->
            <div class="info-card">
                <div class="card-header-info">
                    <span class="card-date">12 Agustus 2023</span>
                </div>
                <div class="card-content">
                    <div class="info-item">
                        <span class="info-icon">⭐</span>
                        <div class="info-details">
                            <span class="info-label">Average Waktu Tidur</span>
                            <span class="info-value">21:30 - 06:10</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Chart -->
        <div class="chart-section">
            <div class="chart-card-jurnal">
                <div class="chart-header-jurnal">
                    <h5>Users</h5>
                    <div class="date-selector">
                        <span>12 Agustus 2023</span>
                        <i class="bi bi-chevron-down ms-2"></i>
                    </div>
                </div>
                <div class="chart-container-jurnal">
                    <canvas id="usersChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* ===== JURNAL PAGE STYLES ===== */
    .jurnal-page {
        padding: 1.5rem;
    }

    /* Header */
    .jurnal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .jurnal-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        margin: 0;
    }

    .dropdown-toggle {
        background: #2C2E4E;
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .dropdown-toggle:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .dropdown-menu {
        background: #2C2E4E;
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        padding: 0.5rem;
        margin-top: 0.5rem;
    }

    .dropdown-item {
        color: rgba(255, 255, 255, 0.8);
        padding: 0.6rem 1rem;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .dropdown-item.active {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        font-weight: 600;
    }

    /* Main Content Grid */
    .jurnal-content {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 2rem;
    }

    /* Info Cards */
    .info-cards {
        display: flex;
        flex-direction: row;
        gap: 1.25rem;
        align-items: stretch;
    }

    .info-card {
        background: linear-gradient(135deg, #3a3d5f 0%, #2C2E4E 100%);
        border-radius: 12px;
        padding: 1.2rem 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        flex: 1 1 0;
        min-width: 180px;
    }

    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .card-header-info {
        margin-bottom: 0.5rem;
        width: 100%;
        text-align: center;
    }

    .card-date {
        color: rgba(255, 255, 255, 0.75);
        font-size: 0.9rem;
        font-weight: 600;
        display: block;
    }

    .card-content {
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
        align-items: center;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.4rem;
    }

    .info-icon {
        font-size: 2.2rem;
        flex-shrink: 0;
        display: block;
    }

    .info-details {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
        align-items: center;
    }

    .info-label {
        color: rgba(255, 255, 255, 0.75);
        font-size: 0.9rem;
        font-weight: 600;
    }

    .info-value {
        color: white;
        font-size: 1.25rem;
        font-weight: 800;
    }

    /* Chart Section */
    .chart-section {
        min-height: 500px;
    }

    .chart-card-jurnal {
        background: linear-gradient(135deg, #3a3d5f 0%, #2C2E4E 100%);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        height: 100%;
    }

    .chart-header-jurnal {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .chart-header-jurnal h5 {
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
    }

    .date-selector {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: rgba(255, 255, 255, 0.8);
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.9rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .date-selector:hover {
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(255, 255, 255, 0.25);
    }

    .chart-container-jurnal {
        position: relative;
        height: 420px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .jurnal-content {
            grid-template-columns: 1fr;
        }

        .info-cards {
            flex-direction: column;
            gap: 1rem;
        }
    }

    @media (max-width: 768px) {
        .jurnal-header {
            flex-direction: column;
            align-items: stretch;
        }

        .chart-container-jurnal {
            height: 300px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart.js configuration
        Chart.defaults.color = 'rgba(255, 255, 255, 0.7)';
        Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.1)';

        // Users Chart (Line Chart)
        const ctx = document.getElementById('usersChart').getContext('2d');
        
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(255, 193, 7, 0.3)');
        gradient.addColorStop(1, 'rgba(255, 193, 7, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['0j', '2j', '4j', '6j', '8j'],
                datasets: [{
                    label: 'Users',
                    data: [0, 350, 100, 150, 100, 2500],
                    borderColor: '#ffc107',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointBackgroundColor: '#ffc107',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#ffc107',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3
                }]
            },
            options: {
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
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Users: ' + context.parsed.y;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 2500,
                        ticks: {
                            stepSize: 500,
                            color: 'rgba(255, 255, 255, 0.6)',
                            font: {
                                size: 11
                            },
                            callback: function(value) {
                                return value;
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            color: 'rgba(255, 255, 255, 0.6)',
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    });
</script>
@endpush
@endsection