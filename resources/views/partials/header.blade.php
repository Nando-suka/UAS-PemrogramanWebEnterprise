<div class="header sleepy-header">

    <!-- Left / Logo -->
    <div class="header-left">
        <img src="{{ asset('images/logoPanda.png') }}" alt="Sleepy Panda Logo" class="panda-logo">
        <span class="brand-text">Sleepy Panda</span>
    </div>

    <!-- Center / Search -->
    <div class="header-center">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Search">
        </div>
    </div>

    <!-- Right / User Profile -->
    <div class="header-right position-relative">

        <div class="user-profile" id="userProfile">

            <!-- Avatar: Huruf awal email -->
            <div class="profile-avatar">
                {{ strtoupper(substr(auth()->user()->email, 0, 1)) }}
            </div>

            <div class="profile-info">
                <div class="profile-email">
                    {{ auth()->user()->email }}
                </div>
                <div class="profile-role">
                    Admin
                </div>
            </div>

            <i class="bi bi-chevron-down"></i>
        </div>

        <!-- Dropdown -->
        <div class="profile-dropdown" id="profileDropdown">
            <a href="#" class="dropdown-item">
                <i class="bi bi-person"></i> Profile
            </a>

            <a href="#" class="dropdown-item">
                <i class="bi bi-gear"></i> Settings
            </a>

            <div class="dropdown-divider"></div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>

    </div>
</div>
