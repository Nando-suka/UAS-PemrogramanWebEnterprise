@extends('layouts.dashboard')

@section('content')

<div class="report-page">

    {{-- STAT CARDS --}}
    <div class="dashboard-stats">
        <div class="dashboard-card stat-card">
            <div class="stat-title">Total Users</div>
            <div class="stat-value">4500</div>
        </div>

        <div class="dashboard-card stat-card">
            <div class="stat-title">Insomnia Cases</div>
            <div class="stat-value danger">900</div>
        </div>

        <div class="dashboard-card stat-card">
            <div class="stat-title">Time to Sleep</div>
            <div class="stat-value">90 min</div>
        </div>

        <div class="dashboard-card stat-card">
            <div class="stat-title">Average Sleep Time</div>
            <div class="stat-value">5.2 h</div>
        </div>
    </div>

    {{-- MAIN GRID --}}
    <div class="report-grid">

        {{-- CHART --}}
        <div class="dashboard-card chart-card">
            <div class="card-header">
                <h3>Users</h3>
                <select class="card-select">
                    <option>12 Agustus - 18 Agustus 2023</option>
                </select>
            </div>

            <div class="chart-placeholder">
                Chart Area
            </div>
        </div>

        {{-- ALERT --}}
        <div class="dashboard-card alert-card">
            <div class="card-header">
                <h3>Alert Insomnia Terbaru</h3>
            </div>

            <div class="alert-list">
                <div class="alert-item">
                    <div class="alert-icon">🔔</div>
                    <div class="alert-content">
                        <strong>User ID #12388</strong>
                        <p>Tidak tidur selama 36 jam terakhir</p>
                        <span>15 menit lalu</span>
                    </div>
                </div>

                <div class="alert-item">
                    <div class="alert-icon">🔔</div>
                    <div class="alert-content">
                        <strong>User ID #16902</strong>
                        <p>Tidak tidur selama 20 jam terakhir</p>
                        <span>1 hari lalu</span>
                    </div>
                </div>

                <div class="alert-item">
                    <div class="alert-icon">🔔</div>
                    <div class="alert-content">
                        <strong>User ID #12402</strong>
                        <p>Tidak tidur selama 27 jam terakhir</p>
                        <span>2 hari lalu</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
