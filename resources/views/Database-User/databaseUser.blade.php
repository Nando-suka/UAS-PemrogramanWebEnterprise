@extends('layouts.dashboard')
@section('title', 'Database User')
@section('content')

<div class="database-user-page">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <h2 class="text-white mb-2">Database User</h2>
        <p class="text-muted">Kelola data pengguna sistem Sleepy Panda</p>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-info">
                    <h3>4800</h3>
                    <p>Total Users</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-person-check"></i>
                </div>
                <div class="stat-info">
                    <h3>3600</h3>
                    <p>Active Users</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-journal-text"></i>
                </div>
                <div class="stat-info">
                    <h3>900</h3>
                    <p>Journal Entries</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-moon-stars"></i>
                </div>
                <div class="stat-info">
                    <h3>800</h3>
                    <p>Sleep Records</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Actions Bar -->
    <div class="search-actions-bar">
        <div class="search-container">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Search by name, email, or ID">
        </div>
        <div class="action-buttons-top">
            <button class="btn-top-action">
                <i class="bi bi-funnel"></i>
                Sort by
            </button>
            <button class="btn-top-action" onclick="refreshTable()">
                <i class="bi bi-arrow-clockwise"></i>
                Refresh
            </button>
        </div>
    </div>

    <!-- User Table -->
    <div class="user-table-container">
        <table class="modern-user-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Contact</th>
                    <th>Sleep Status</th>
                    <th>Status</th>
                    <th>Last Active</th>
                </tr>
            </thead>
            <tbody>
                <!-- User 1 - Active -->
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-modern">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="user-info-modern">
                                <div class="user-name-modern">Alfonso de</div>
                                <div class="user-id-modern">ID #418230</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="contact-cell">
                            <div class="contact-item-modern">
                                <i class="bi bi-envelope"></i>
                                <span>Alfonso.de@gmail.com</span>
                            </div>
                            <div class="contact-item-modern">
                                <i class="bi bi-telephone"></i>
                                <span>+62123456789</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="sleep-status-cell">
                            <div class="sleep-avg">Avg. Sleep: 7.2h</div>
                            <div class="sleep-quality">Quality: 85%</div>
                        </div>
                    </td>
                    <td>
                        <span class="status-badge-modern status-active-modern">Active</span>
                    </td>
                    <td>
                        <div class="last-active-cell">
                            2024-02-01<br>14:30
                        </div>
                    </td>
                </tr>

                <!-- User 2 - Not Active -->
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-modern">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="user-info-modern">
                                <div class="user-name-modern">Alfonso de</div>
                                <div class="user-id-modern">ID #418230</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="contact-cell">
                            <div class="contact-item-modern">
                                <i class="bi bi-envelope"></i>
                                <span>Alfonso.de@gmail.com</span>
                            </div>
                            <div class="contact-item-modern">
                                <i class="bi bi-telephone"></i>
                                <span>+62123456789</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="sleep-status-cell">
                            <div class="sleep-avg">Avg. Sleep: 1.2h</div>
                            <div class="sleep-quality">Quality: 20%</div>
                        </div>
                    </td>
                    <td>
                        <span class="status-badge-modern status-inactive-modern">Not Active</span>
                    </td>
                    <td>
                        <div class="last-active-cell">
                            2024-02-01<br>14:30
                        </div>
                    </td>
                </tr>

                <!-- User 3 - Active -->
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-modern">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="user-info-modern">
                                <div class="user-name-modern">Maria Santos</div>
                                <div class="user-id-modern">ID #418231</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="contact-cell">
                            <div class="contact-item-modern">
                                <i class="bi bi-envelope"></i>
                                <span>maria.santos@gmail.com</span>
                            </div>
                            <div class="contact-item-modern">
                                <i class="bi bi-telephone"></i>
                                <span>+62123456790</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="sleep-status-cell">
                            <div class="sleep-avg">Avg. Sleep: 8.5h</div>
                            <div class="sleep-quality">Quality: 92%</div>
                        </div>
                    </td>
                    <td>
                        <span class="status-badge-modern status-active-modern">Active</span>
                    </td>
                    <td>
                        <div class="last-active-cell">
                            2024-02-01<br>16:45
                        </div>
                    </td>
                </tr>

                <!-- User 4 - Not Active -->
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-modern">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="user-info-modern">
                                <div class="user-name-modern">John Doe</div>
                                <div class="user-id-modern">ID #418232</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="contact-cell">
                            <div class="contact-item-modern">
                                <i class="bi bi-envelope"></i>
                                <span>john.doe@gmail.com</span>
                            </div>
                            <div class="contact-item-modern">
                                <i class="bi bi-telephone"></i>
                                <span>+62123456791</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="sleep-status-cell">
                            <div class="sleep-avg">Avg. Sleep: 4.8h</div>
                            <div class="sleep-quality">Quality: 45%</div>
                        </div>
                    </td>
                    <td>
                        <span class="status-badge-modern status-inactive-modern">Not Active</span>
                    </td>
                    <td>
                        <div class="last-active-cell">
                            2024-01-28<br>09:20
                        </div>
                    </td>
                </tr>

                <!-- User 5 - Active -->
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-modern">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="user-info-modern">
                                <div class="user-name-modern">Sarah Johnson</div>
                                <div class="user-id-modern">ID #418233</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="contact-cell">
                            <div class="contact-item-modern">
                                <i class="bi bi-envelope"></i>
                                <span>sarah.j@gmail.com</span>
                            </div>
                            <div class="contact-item-modern">
                                <i class="bi bi-telephone"></i>
                                <span>+62123456792</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="sleep-status-cell">
                            <div class="sleep-avg">Avg. Sleep: 7.8h</div>
                            <div class="sleep-quality">Quality: 88%</div>
                        </div>
                    </td>
                    <td>
                        <span class="status-badge-modern status-active-modern">Active</span>
                    </td>
                    <td>
                        <div class="last-active-cell">
                            2024-02-01<br>18:10
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@push('styles')
<style>
    /* ===== DATABASE USER PAGE (NEW DESIGN) ===== */
    .database-user-page {
        padding: 1.5rem;
        max-width: 100%;
    }

    /* Page Header */
    .page-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
    }

    .text-muted {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    /* ===== STAT CARDS ===== */
    .stat-card {
        background: linear-gradient(135deg, #2C2E4E 0%, #1e2240 100%);
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: #4dd4ac;
        flex-shrink: 0;
    }

    .stat-info h3 {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        margin: 0 0 0.25rem 0;
    }

    .stat-info p {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.6);
        margin: 0;
    }

    /* Search and Actions Bar */
    .search-actions-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .search-container {
        flex: 1;
        max-width: 500px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 0.8rem 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .search-container i {
        color: rgba(255, 255, 255, 0.5);
        font-size: 1.1rem;
    }

    .search-container input {
        flex: 1;
        background: transparent;
        border: none;
        outline: none;
        color: white;
        font-size: 0.95rem;
    }

    .search-container input::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .action-buttons-top {
        display: flex;
        gap: 0.8rem;
    }

    .btn-top-action {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.8);
        padding: 0.8rem 1.5rem;
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .btn-top-action:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .btn-top-action i {
        font-size: 1rem;
    }

    /* User Table Container */
    .user-table-container {
        background: linear-gradient(135deg, #2C2E4E 0%, #1e2240 100%);
        border-radius: 16px;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        overflow-x: auto;
    }

    /* Modern Table */
    .modern-user-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 1rem;
    }

    .modern-user-table thead th {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
        font-weight: 600;
        text-align: left;
        padding: 0 1.5rem 1rem 1.5rem;
        border: none;
    }

    .modern-user-table tbody tr {
        background: rgba(255, 255, 255, 0.03);
        transition: all 0.3s ease;
    }

    .modern-user-table tbody tr:hover {
        background: rgba(255, 255, 255, 0.06);
        transform: translateX(5px);
    }

    .modern-user-table tbody td {
        padding: 1.5rem;
        border: none;
        color: white;
        vertical-align: middle;
    }

    .modern-user-table tbody tr td:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    .modern-user-table tbody tr td:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    /* User Cell */
    .user-cell {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-avatar-modern {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: rgba(255, 255, 255, 0.6);
        flex-shrink: 0;
    }

    .user-info-modern {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .user-name-modern {
        font-size: 1rem;
        font-weight: 600;
        color: white;
    }

    .user-id-modern {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.5);
    }

    /* Contact Cell */
    .contact-cell {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .contact-item-modern {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
    }

    .contact-item-modern i {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.5);
    }

    /* Sleep Status Cell */
    .sleep-status-cell {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .sleep-avg {
        font-size: 0.9rem;
        color: white;
        font-weight: 500;
    }

    .sleep-quality {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.6);
    }

    /* Status Badge Modern */
    .status-badge-modern {
        display: inline-block;
        padding: 0.5rem 1.2rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-align: center;
        min-width: 100px;
    }

    .status-active-modern {
        background: rgba(91, 110, 240, 0.2);
        color: #5b6ef0;
        border: 1px solid rgba(91, 110, 240, 0.4);
    }

    .status-inactive-modern {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.4);
    }

    /* Last Active Cell */
    .last-active-cell {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .user-table-container {
            overflow-x: auto;
        }

        .modern-user-table {
            min-width: 900px;
        }
    }

    @media (max-width: 768px) {
        .search-actions-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-container {
            max-width: 100%;
        }

        .action-buttons-top {
            justify-content: space-between;
        }

        .user-table-container {
            padding: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.modern-user-table tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Refresh table
    function refreshTable() {
        location.reload();
    }
</script>
@endpush
@endsection