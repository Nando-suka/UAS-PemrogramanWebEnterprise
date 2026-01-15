@extends('layouts.dashboard')
@section('title', 'Jurnal Monthly Report')
@section('content')

<div class="jurnal-page">
    <!-- Page Header -->
    <div class="jurnal-header">
        <h2 class="jurnal-title">Jurnal Tidur Report</h2>
        <div class="dropdown">
            <button class="dropdown-toggle" type="button" id="periodDropdown" data-bs-toggle="dropdown">
                Monthly
                <i class="bi bi-chevron-down ms-2"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="periodDropdown">
                <li><a class="dropdown-item" href="{{ route('jurnal.daily') }}">Daily</a></li>
                <li><a class="dropdown-item" href="{{ route('jurnal.weekly') }}">Weekly</a></li>
                <li><a class="dropdown-item active" href="{{ route('jurnal.monthly') }}">Monthly</a></li>
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
                    <span class="card-date">Oktober 2023</span>
                </div>
                <div class="card-content">
                    <div class="info-item">
                        <span class="info-icon">😴</span>
                        <div class="info-details">
                            <span class="info-label">User</span>
                            <span class="info-value">28000</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Average Durasi Tidur -->
            <div class="info-card">
                <div class="card-header-info">
                    <span class="card-date">Oktober 2023</span>
                </div>
                <div class="card-content">
                    <div class="info-item">
                        <span class="info-icon">💤</span>
                        <div class="info-details">
                            <span class="info-label">Average Durasi Tidur</span>
                            <span class="info-value">7 jam 30 menit</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Average Waktu Tidur -->
            <div class="info-card">
                <div class="card-header-info">
                    <span class="card-date">Oktober 2023</span>
                </div>
                <div class="card-content">
                    <div class="info-item">
                        <span class="info-icon">⭐</span>
                        <div class="info-details">
                            <span class="info-label">Average Waktu Tidur</span>
                            <span class="info-value">22:15 - 06:45</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Chart -->
        <div class="chart-section">
            <div class="chart-card-jurnal">
                <div class="chart-header-jurnal">
                    <div class="date-selector-top">
                        <span>2023</span>
                        <i class="bi bi-chevron-down ms-2"></i>
                    </div>
                </div>
                <div class="chart-container-jurnal">
                    <canvas id="usersChartMonthly"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .jurnal-page { padding: 1.5rem; }
    .jurnal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
    .jurnal-title { font-size: 1.8rem; font-weight: 700; color: white; margin: 0; }
    .dropdown-toggle { background: #2C2E4E; border: 1px solid rgba(255, 255, 255, 0.15); color: white; padding: 0.6rem 1.5rem; border-radius: 8px; font-size: 1rem; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease; }
    .dropdown-toggle:hover { background: rgba(255, 255, 255, 0.08); border-color: rgba(255, 255, 255, 0.3); }
    .dropdown-menu { background: #2C2E4E; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 8px; padding: 0.5rem; margin-top: 0.5rem; }
    .dropdown-item { color: rgba(255, 255, 255, 0.8); padding: 0.6rem 1rem; border-radius: 6px; transition: all 0.3s ease; }
    .dropdown-item:hover { background: rgba(255, 255, 255, 0.1); color: white; }
    .dropdown-item.active { background: rgba(255, 255, 255, 0.15); color: white; font-weight: 600; }
    .jurnal-content { display: grid; grid-template-columns: 300px 1fr; gap: 2rem; }
    .info-cards { display: flex; flex-direction: column; gap: 1.5rem; }
    .info-card { background: linear-gradient(135deg, #3a3d5f 0%, #2C2E4E 100%); border-radius: 12px; padding: 1.2rem; border: 1px solid rgba(255, 255, 255, 0.1); transition: all 0.3s ease; }
    .info-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3); border-color: rgba(255, 255, 255, 0.2); }
    .card-header-info { margin-bottom: 1rem; }
    .card-date { color: rgba(255, 255, 255, 0.6); font-size: 0.85rem; font-weight: 500; }
    .card-content { display: flex; flex-direction: column; gap: 0.8rem; }
    .info-item { display: flex; align-items: center; gap: 1rem; }
    .info-icon { font-size: 2.5rem; flex-shrink: 0; }
    .info-details { display: flex; flex-direction: column; gap: 0.3rem; }
    .info-label { color: rgba(255, 255, 255, 0.7); font-size: 0.85rem; font-weight: 500; }
    .info-value { color: white; font-size: 1.1rem; font-weight: 700; }
    .chart-section { min-height: 500px; }
    .chart-card-jurnal { background: linear-gradient(135deg, #3a3d5f 0%, #2C2E4E 100%); border-radius: 12px; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.1); height: 100%; }
    .chart-header-jurnal { display: flex; justify-content: flex-end; align-items: center; margin-bottom: 1.5rem; }
    .date-selector-top { background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.15); color: white; padding: 0.6rem 1.2rem; border-radius: 6px; font-size: 0.9rem; font-weight: 500; cursor: pointer; display: flex; align-items: center; transition: all 0.3s ease; }
    .date-selector-top:hover { background: rgba(255, 255, 255, 0.12); border-color: rgba(255, 255, 255, 0.25); }
    .chart-container-jurnal { position: relative; height: 420px; }
    @media (max-width: 1024px) { .jurnal-content { grid-template-columns: 1fr; } .info-cards { grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); } }
    @media (max-width: 768px) { .jurnal-header { flex-direction: column; align-items: stretch; } .chart-container-jurnal { height: 300px; } }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Chart.defaults.color = 'rgba(255, 255, 255, 0.7)';
        Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.1)';

        const ctx = document.getElementById('usersChartMonthly').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Hours',
                    data: [6, 7, 5, 8, 6, 7, 5, 6, 8, 7, 6, 5],
                    backgroundColor: function(context) {
                        const index = context.dataIndex;
                        return index === 3 ? '#ef5350' : '#e57373';
                    },
                    borderRadius: 8,
                    barPercentage: 0.7,
                    categoryPercentage: 0.9
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
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
                                return context.parsed.y + 'j';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10,
                        ticks: { stepSize: 2, color: 'rgba(255, 255, 255, 0.6)', font: { size: 11 }, callback: function(value) { return value + 'j'; } },
                        grid: { color: 'rgba(255, 255, 255, 0.05)', drawBorder: false }
                    },
                    x: {
                        ticks: { color: 'rgba(255, 255, 255, 0.6)', font: { size: 10 } },
                        grid: { display: false, drawBorder: false }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection