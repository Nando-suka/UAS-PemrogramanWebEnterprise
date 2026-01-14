<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database User - SleepyPanda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-bg: #0f172a;
            --card-bg: #1e293b;
            --sidebar-bg: #111827;
            --accent-color: #3b82f6;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --border-color: #334155;
            --success-color: #10b981;
            --warning-color: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--primary-bg);
            color: var(--text-primary);
            font-family: 'Urbanist', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            background-color: var(--sidebar-bg);
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 1.5rem;
            border-right: 1px solid var(--border-color);
            z-index: 1000;
            transition: left 0.3s ease;
        }

        .sidebar-header {
            padding: 1.5rem 1rem 1rem;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 1.5rem;
        }

        .admin-site {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .admin-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1.2;
        }

        .sleepy-panda {
            font-size: 1.2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-top: 4px;
        }

        /* Navigation */
        .nav {
            padding: 0 0.5rem;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            color: var(--text-secondary);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            opacity: 0.8;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--text-primary);
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(59, 130, 246, 0.1) 100%);
            color: var(--accent-color);
            font-weight: 500;
            border-left: 3px solid var(--accent-color);
        }

        .nav-link.active i {
            color: var(--accent-color);
            opacity: 1;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 1.5rem;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1rem 0;
            min-height: 80px;
            gap: 1.5rem;
        }

        /* Header Left - Hamburger + Logo */
        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 0 0 auto;
        }

        /* Hamburger Container */
        .hamburger-container {
            display: none;
        }

        .hamburger-btn {
            background: var(--accent-color);
            border: none;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .hamburger-btn:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        /* Logo Header */
        .logo-header {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-header .logo-img {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .logo-header .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Search Container */
        .search-container-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            max-width: 500px;
            margin: 0 auto;
        }

        .search-container {
            position: relative;
            width: 100%;
            max-width: 350px;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 0.9rem;
            z-index: 1;
        }

        .search-input {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 0.65rem 1rem 0.65rem 2.5rem;
            color: var(--text-primary);
            width: 100%;
            font-size: 0.9rem;
            height: 38px;
            transition: all 0.3s ease;
        }

        .search-input::placeholder {
            color: var(--text-secondary);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--accent-color);
            background-color: rgba(59, 130, 246, 0.05);
        }

        /* User Info */
        .user-info {
            flex: 0 0 auto;
            margin-left: auto;
            position: relative;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            min-width: 200px;
            padding: 0.5rem 0;
            display: none;
            z-index: 1000;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            color: var(--text-primary);
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .dropdown-divider {
            height: 1px;
            background-color: var(--border-color);
            margin: 0.5rem 0;
        }

        /* Page Title */
        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--text-primary);
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        /* Stats Section */
        .stats-section {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background-color: var(--card-bg);
            border-radius: 15px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        /* Greeting Section */
        .greeting-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .greeting {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .greeting-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
        }

        .greeting-text h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .greeting-text p {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        /* Users Table */
        .users-table-container {
            background-color: var(--card-bg);
            border-radius: 15px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .table-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .table-filters {
            display: flex;
            gap: 0.75rem;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-secondary);
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn.active {
            background-color: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
        }

        /* Table */
        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table th {
            text-align: left;
            padding: 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-secondary);
            border-bottom: 1px solid var(--border-color);
        }

        .users-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
            font-size: 0.9rem;
        }

        .user-info-small h4 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .user-info-small p {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .contact-cell {
            font-size: 0.9rem;
        }

        .contact-email {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .contact-phone {
            color: var(--text-secondary);
            font-size: 0.85rem;
        }

        .status-cell {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-active {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .status-inactive {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .sleep-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sleep-time {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .sleep-quality {
            font-size: 0.8rem;
            color: var(--warning-color);
        }

        .history-cell {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Overlay hanya di mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Responsive */
        @media (max-width: 1199px) {
            .main-content {
                margin-left: 0;
            }
            
            .sidebar {
                left: -300px;
                padding-top: 5rem;
            }
            
            .sidebar.active {
                left: 0;
            }
            
            /* Hamburger visible di mobile */
            .hamburger-container {
                display: block;
                position: fixed;
                top: 1.5rem;
                left: 1.5rem;
                z-index: 1100;
            }
            
            /* Logo header adjustment untuk mobile */
            .logo-header {
                margin-left: 4.5rem;
            }
            
            /* Header adjustment untuk mobile */
            .header {
                padding-left: 4.5rem;
            }
            
            /* Stats grid responsive */
            .stats-section {
                grid-template-columns: repeat(2, 1fr);
            }
            
            /* Table responsive */
            .users-table {
                display: block;
                overflow-x: auto;
            }
        }

        @media (max-width: 768px) {
            .stats-section {
                grid-template-columns: 1fr;
            }
            
            .greeting-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .hamburger-container {
                top: 1rem;
                left: 1rem;
            }
            
            .hamburger-btn {
                width: 40px;
                height: 40px;
                font-size: 1.3rem;
            }
            
            .logo-header {
                margin-left: 3.5rem;
            }
            
            .header {
                padding-left: 3.5rem;
            }
            
            .logo-header .logo-text {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .search-container {
                max-width: 100%;
            }
            
            .search-input {
                padding: 0.55rem 0.8rem 0.55rem 2.2rem;
                font-size: 0.8rem;
                height: 34px;
            }
            
            .stat-card {
                padding: 1rem;
            }
            
            .stat-value {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <!-- Admin Site Section -->
        <div class="sidebar-header">
            <div class="admin-site">
                <div class="admin-icon">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div>
                    <div class="admin-title">Admin Site</div>
                    <div class="sleepy-panda">Sleepy Panda</div>
                </div>
            </div>
        </div>

        <!-- Menu Navigasi -->
        <nav class="nav flex-column">
            <div class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-journal-text"></i>
                    <span>Jurnal</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Report</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('database.user') }}" class="nav-link active">
                    <i class="bi bi-people"></i>
                    <span>Database User</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <!-- Left: Hamburger + Logo -->
            <div class="header-left">
                <div class="hamburger-container">
                    <button class="hamburger-btn" id="hamburgerBtn">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
                
                <div class="logo-header">
                    <div class="logo-img">
                        🐼
                    </div>
                    <div class="logo-text">SleepyPanda</div>
                </div>
            </div>
            
            <!-- Middle: Search with Icon -->
            <div class="search-container-wrapper">
                <div class="search-container">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search users...">
                </div>
            </div>
            
            <!-- Right: User Profile -->
            <div class="user-info">
                <div class="user-profile" id="userProfile">
                    <div class="profile-img">
                        {{ strtoupper(substr(auth()->user()->email, 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-size: 0.95rem; font-weight: 600;">{{ auth()->user()->email }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-secondary);">Admin</div>
                    </div>
                    <i class="bi bi-chevron-down" style="margin-left: 0.5rem;"></i>
                </div>
                
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-person"></i> Profile
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item" style="background: none; border: none; width: 100%; text-align: left; color: #ef4444;">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Page Title -->
        <div class="page-title">Database User</div>
        <div class="page-subtitle">Manage and monitor all registered users</div>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-value">4500</div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">3500</div>
                <div class="stat-label">Active Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">500</div>
                <div class="stat-label">New This Month</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">500</div>
                <div class="stat-label">Sleep Analysis</div>
            </div>
        </div>

        <!-- Greeting Section -->
        <div class="greeting-section">
            <div class="greeting">
                <div class="greeting-icon">
                    <i class="bi bi-hand-wave"></i>
                </div>
                <div class="greeting-text">
                    <h2>Halo, Anthony!</h2>
                    <p>Here's your user database overview</p>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="users-table-container">
            <div class="table-header">
                <div class="table-title">User Contact Status</div>
                <div class="table-filters">
                    <button class="filter-btn active">All</button>
                    <button class="filter-btn">Active</button>
                    <button class="filter-btn">Sleep Status</button>
                    <button class="filter-btn">Last History</button>
                </div>
            </div>

            <table class="users-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Contact</th>
                        <th>Sleep Status</th>
                        <th>Last History</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- User 1 -->
                    <tr>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar">AD</div>
                                <div class="user-info-small">
                                    <h4>Alliance de</h4>
                                    <p>ID: 6148239</p>
                                </div>
                            </div>
                        </td>
                        <td class="contact-cell">
                            <div class="contact-email">Alliance de@gmall.com</div>
                            <div class="contact-phone">+62123456789</div>
                        </td>
                        <td class="status-cell">
                            <span class="status-badge status-active">Active</span>
                            <div class="sleep-info">
                                <div class="sleep-time">Ang. Sleep 7:21</div>
                                <div class="sleep-quality">Quality: 65%</div>
                            </div>
                        </td>
                        <td class="history-cell">2024-02-14 14:50</td>
                    </tr>
                    <!-- User 2 -->
                    <tr>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar">JS</div>
                                <div class="user-info-small">
                                    <h4>John Smith</h4>
                                    <p>ID: 6148240</p>
                                </div>
                            </div>
                        </td>
                        <td class="contact-cell">
                            <div class="contact-email">john.smith@email.com</div>
                            <div class="contact-phone">+62123456788</div>
                        </td>
                        <td class="status-cell">
                            <span class="status-badge status-active">Active</span>
                            <div class="sleep-info">
                                <div class="sleep-time">Ang. Sleep 6:45</div>
                                <div class="sleep-quality">Quality: 72%</div>
                            </div>
                        </td>
                        <td class="history-cell">2024-02-15 09:30</td>
                    </tr>
                    <!-- User 3 -->
                    <tr>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar">MS</div>
                                <div class="user-info-small">
                                    <h4>Maria Silva</h4>
                                    <p>ID: 6148241</p>
                                </div>
                            </div>
                        </td>
                        <td class="contact-cell">
                            <div class="contact-email">maria.silva@email.com</div>
                            <div class="contact-phone">+62123456787</div>
                        </td>
                        <td class="status-cell">
                            <span class="status-badge status-inactive">Inactive</span>
                            <div class="sleep-info">
                                <div class="sleep-time">Ang. Sleep 5:30</div>
                                <div class="sleep-quality">Quality: 58%</div>
                            </div>
                        </td>
                        <td class="history-cell">2024-02-10 22:15</td>
                    </tr>
                    <!-- User 4 -->
                    <tr>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar">RK</div>
                                <div class="user-info-small">
                                    <h4>Robert Kim</h4>
                                    <p>ID: 6148242</p>
                                </div>
                            </div>
                        </td>
                        <td class="contact-cell">
                            <div class="contact-email">robert.kim@email.com</div>
                            <div class="contact-phone">+62123456786</div>
                        </td>
                        <td class="status-cell">
                            <span class="status-badge status-active">Active</span>
                            <div class="sleep-info">
                                <div class="sleep-time">Ang. Sleep 8:15</div>
                                <div class="sleep-quality">Quality: 80%</div>
                            </div>
                        </td>
                        <td class="history-cell">2024-02-16 07:45</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Overlay untuk mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Cek apakah device mobile
        function isMobile() {
            return window.innerWidth <= 1199;
        }

        // Hamburger menu toggle - hanya di mobile
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        // Fungsi toggle sidebar
        function toggleSidebar() {
            if (!isMobile()) return; // Hanya aktif di mobile
            
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
            
            // Toggle icon
            const icon = hamburgerBtn.querySelector('i');
            if (sidebar.classList.contains('active')) {
                icon.classList.remove('bi-list');
                icon.classList.add('bi-x');
            } else {
                icon.classList.remove('bi-x');
                icon.classList.add('bi-list');
            }
        }

        // Event listener untuk hamburger (hanya di mobile)
        if (hamburgerBtn) {
            hamburgerBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleSidebar();
            });
        }

        // Close sidebar when clicking overlay
        sidebarOverlay.addEventListener('click', function() {
            if (!isMobile()) return;
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            
            // Reset icon
            const icon = hamburgerBtn.querySelector('i');
            icon.classList.remove('bi-x');
            icon.classList.add('bi-list');
        });

        // Close sidebar when clicking outside (mobile only)
        document.addEventListener('click', function(e) {
            if (!isMobile()) return;
            
            if (!sidebar.contains(e.target) && 
                !hamburgerBtn.contains(e.target) && 
                sidebar.classList.contains('active')) {
                
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                
                // Reset icon
                const icon = hamburgerBtn.querySelector('i');
                icon.classList.remove('bi-x');
                icon.classList.add('bi-list');
            }
        });

        // Close sidebar with Escape key (mobile only)
        document.addEventListener('keydown', function(e) {
            if (!isMobile()) return;
            
            if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                
                // Reset icon
                const icon = hamburgerBtn.querySelector('i');
                icon.classList.remove('bi-x');
                icon.classList.add('bi-list');
            }
        });

        // User profile dropdown
        document.getElementById('userProfile').addEventListener('click', function(e) {
            e.stopPropagation();
            document.getElementById('dropdownMenu').classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.user-info')) {
                document.getElementById('dropdownMenu').classList.remove('show');
            }
        });

        // Filter buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Handle window resize
        function handleResize() {
            if (!isMobile()) {
                // Di desktop: pastikan sidebar terbuka dan overlay hidden
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                
                // Reset icon
                const icon = hamburgerBtn.querySelector('i');
                icon.classList.remove('bi-x');
                icon.classList.add('bi-list');
            }
        }

        window.addEventListener('resize', handleResize);

        // Initial check
        handleResize();

        // Search functionality
        document.querySelector('.search-input').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.users-table tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>