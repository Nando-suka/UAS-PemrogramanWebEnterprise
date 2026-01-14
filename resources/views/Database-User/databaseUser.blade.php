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
                    <h3>{{ $totalUsers ?? 4800 }}</h3>
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
                    <h3>{{ $activeUsers ?? 3600 }}</h3>
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
                    <h3>{{ $journalEntries ?? 900 }}</h3>
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
                    <h3>{{ $sleepRecords ?? 800 }}</h3>
                    <p>Sleep Records</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <!-- Table Header Actions -->
        <div class="table-actions">
            <div class="table-actions-left">
                <div class="search-box-table">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari user...">
                </div>
            </div>
            <div class="table-actions-right">
                <button class="btn-action" onclick="sortTable()">
                    <i class="bi bi-funnel"></i>
                    Sortir
                </button>
                <button class="btn-action" onclick="refreshTable()">
                    <i class="bi bi-arrow-clockwise"></i>
                    Refresh
                </button>
                <button class="btn-action btn-primary" onclick="openAddUserModal()">
                    <i class="bi bi-plus-circle"></i>
                    Tambah User
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="user-table" id="userTable">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Contact</th>
                        <th>Status Jurnal</th>
                        <th>Status</th>
                        <th>Last Login</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users ?? [] as $user)
                    <tr>
                        <!-- User -->
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($user->email, 0, 1)) }}
                                </div>
                                <div class="user-details">
                                    <div class="user-name">{{ $user->name ?? 'User ' . $user->id }}</div>
                                    <div class="user-id">#{{ $user->id }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Contact -->
                        <td>
                            <div class="contact-info">
                                <div class="contact-email">
                                    <i class="bi bi-envelope"></i>
                                    {{ $user->email }}
                                </div>
                                <div class="contact-phone">
                                    <i class="bi bi-telephone"></i>
                                    {{ $user->phone ?? '+62 812-xxxx-xxxx' }}
                                </div>
                            </div>
                        </td>

                        <!-- Status Jurnal -->
                        <td>
                            <div class="journal-status">
                                <span class="journal-count">{{ $user->journals_count ?? rand(5, 50) }} entries</span>
                                <div class="journal-date">Last: {{ $user->last_journal_date ?? now()->subDays(rand(1, 7))->format('d/m/Y') }}</div>
                            </div>
                        </td>

                        <!-- Status -->
                        <td>
                            @if($user->is_active ?? (rand(0, 1) == 1))
                                <span class="status-badge status-active">Active</span>
                            @else
                                <span class="status-badge status-inactive">Inactive</span>
                            @endif
                        </td>

                        <!-- Last Login -->
                        <td>
                            <div class="last-login">
                                {{ $user->last_login_at ? $user->last_login_at->format('d M Y, H:i') : 'Never' }}
                            </div>
                        </td>

                        <!-- Actions -->
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon" title="View Details" onclick="viewUser({{ $user->id }})">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-icon" title="Edit User" onclick="editUser({{ $user->id }})">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn-icon btn-danger" title="Delete User" onclick="deleteUser({{ $user->id }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="empty-state">
                                <i class="bi bi-inbox" style="font-size: 3rem; opacity: 0.5;"></i>
                                <p class="mt-3 mb-0">Belum ada data user</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="table-pagination">
            <div class="pagination-info">
                Showing 1 to 10 of {{ count($users ?? []) }} entries
            </div>
            <div class="pagination-controls">
                <button class="page-btn" disabled>
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* ===== DATABASE USER PAGE STYLES ===== */
    .database-user-page {
        padding: 1.5rem;
    }

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

    /* ===== TABLE CARD ===== */
    .table-card {
        background: #2C2E4E;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .table-actions {
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        flex-wrap: wrap;
        gap: 1rem;
    }

    .table-actions-left,
    .table-actions-right {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .search-box-table {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 0.6rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 250px;
    }

    .search-box-table i {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.9rem;
    }

    .search-box-table input {
        background: transparent;
        border: none;
        outline: none;
        color: white;
        width: 100%;
        font-size: 0.9rem;
    }

    .search-box-table input::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .btn-action {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.8);
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-action:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .btn-action.btn-primary {
        background: #4dd4ac;
        border-color: #4dd4ac;
        color: #1e2240;
    }

    .btn-action.btn-primary:hover {
        background: #3ec99a;
        border-color: #3ec99a;
    }

    /* ===== TABLE ===== */
    .table-responsive {
        overflow-x: auto;
    }

    .user-table {
        width: 100%;
        border-collapse: collapse;
    }

    .user-table thead {
        background: rgba(255, 255, 255, 0.03);
    }

    .user-table th {
        padding: 1rem 1.5rem;
        text-align: left;
        font-size: 0.85rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.7);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .user-table td {
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
    }

    .user-table tbody tr {
        transition: all 0.3s ease;
    }

    .user-table tbody tr:hover {
        background: rgba(255, 255, 255, 0.03);
    }

    /* User Info */
    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #4dd4ac 0%, #3ec99a 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
        color: #1e2240;
    }

    .user-details {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
    }

    .user-name {
        font-weight: 600;
        color: white;
        font-size: 0.95rem;
    }

    .user-id {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.5);
    }

    /* Contact Info */
    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .contact-email,
    .contact-phone {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
    }

    .contact-email i,
    .contact-phone i {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.5);
    }

    /* Journal Status */
    .journal-status {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .journal-count {
        font-weight: 600;
        color: white;
        font-size: 0.9rem;
    }

    .journal-date {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.5);
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 0.4rem 0.9rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-active {
        background: rgba(77, 212, 172, 0.15);
        color: #4dd4ac;
        border: 1px solid rgba(77, 212, 172, 0.3);
    }

    .status-inactive {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    /* Last Login */
    .last-login {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.7);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-icon {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: rgba(255, 255, 255, 0.7);
    }

    .btn-icon:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border-color: rgba(255, 255, 255, 0.2);
    }

    .btn-icon.btn-danger:hover {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
        border-color: rgba(239, 68, 68, 0.3);
    }

    /* Pagination */
    .table-pagination {
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .pagination-info {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
    }

    .pagination-controls {
        display: flex;
        gap: 0.5rem;
    }

    .page-btn {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        color: rgba(255, 255, 255, 0.7);
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .page-btn:hover:not(:disabled) {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .page-btn.active {
        background: #4dd4ac;
        color: #1e2240;
        border-color: #4dd4ac;
        font-weight: 600;
    }

    .page-btn:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    /* Empty State */
    .empty-state {
        color: rgba(255, 255, 255, 0.5);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .table-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .table-actions-left,
        .table-actions-right {
            width: 100%;
            justify-content: space-between;
        }

        .search-box-table {
            min-width: auto;
            flex: 1;
        }

        .table-pagination {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#userTable tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Sort table
    function sortTable() {
        alert('Sort functionality coming soon!');
    }

    // Refresh table
    function refreshTable() {
        location.reload();
    }

    // View user
    function viewUser(id) {
        window.location.href = `/database-user/${id}`;
    }

    // Edit user
    function editUser(id) {
        window.location.href = `/database-user/${id}/edit`;
    }

    // Delete user
    function deleteUser(id) {
        if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
            // Implement delete logic
            alert('Delete user #' + id);
        }
    }

    // Add user modal
    function openAddUserModal() {
        alert('Add user modal coming soon!');
    }
</script>
@endpush
@endsection