<div class="sidebar simple-sidebar" id="sidebar">
    <div class="simple-sidebar-header">
        Admin Site
    </div>
    <div class="simple-nav">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="simple-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
        
        <!-- Jurnal dengan Dropdown -->
        <div class="nav-item-dropdown">
            <a href="#" class="simple-nav-item" id="jurnalToggle">
                <span>Jurnal</span>
                <i class="bi bi-chevron-down dropdown-icon"></i>
            </a>
            
            <!-- Submenu Jurnal -->
            <div class="submenu" id="jurnalSubmenu">
                <a href="{{ route('jurnal.daily') }}" class="submenu-item {{ request()->routeIs('jurnal.daily') ? 'active' : '' }}">
                    <i class="bi bi-calendar-day"></i>
                    Jurnal Daily
                </a>
                <a href="{{ route('jurnal.weekly') }}" class="submenu-item {{ request()->routeIs('jurnal.weekly') ? 'active' : '' }}">
                    <i class="bi bi-calendar-week"></i>
                    Jurnal Weekly
                </a>
                <a href="{{ route('jurnal.monthly') }}" class="submenu-item {{ request()->routeIs('jurnal.monthly') ? 'active' : '' }}">
                    <i class="bi bi-calendar-month"></i>
                    Jurnal Monthly
                </a>
            </div>
        </div>
        
        <!-- Report -->
        <a href="#" class="simple-nav-item">Report</a>
        
        <!-- Database User dengan Dropdown -->
        <div class="nav-item-dropdown">
            <a href="#" class="simple-nav-item" id="databaseUserToggle">
                <span>Database User</span>
                <i class="bi bi-chevron-down dropdown-icon"></i>
            </a>
            
            <!-- Submenu Database User -->
            <div class="submenu" id="databaseUserSubmenu">
                <a href="{{ route('database.user') }}" class="submenu-item {{ request()->routeIs('database.user*') ? 'active' : '' }}">
                    <i class="bi bi-database"></i>
                    Database User
                </a>
                <a href="#" class="submenu-item">
                    <i class="bi bi-arrow-clockwise"></i>
                    Update Data
                </a>
                <a href="#" class="submenu-item">
                    <i class="bi bi-key"></i>
                    Read Password
                </a>
            </div>
        </div>
    </div>
</div>