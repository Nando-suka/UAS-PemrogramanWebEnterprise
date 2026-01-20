document.addEventListener('DOMContentLoaded', () => {

    /* ==========================
     * ELEMENTS
     * ========================== */
    const sidebar   = document.getElementById('sidebar');
    const hamburger = document.getElementById('hamburgerBtn');

    const jurnalToggle        = document.getElementById('jurnalToggle');
    const jurnalSubmenu       = document.getElementById('jurnalSubmenu');
    const databaseUserToggle  = document.getElementById('databaseUserToggle');
    const databaseUserSubmenu = document.getElementById('databaseUserSubmenu');

    /* ==========================
     * OVERLAY
     * ========================== */
    let overlay = document.querySelector('.sidebar-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        document.body.appendChild(overlay);
    }

    /* ==========================
     * SIDEBAR TOGGLE (MOBILE)
     * ========================== */
    function openSidebar() {
        sidebar?.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        resizeCharts();
    }

    function closeSidebar() {
        sidebar?.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
        closeAllDropdowns();
        resizeCharts();
    }

    hamburger?.addEventListener('click', (e) => {
        e.stopPropagation();
        sidebar?.classList.contains('active') ? closeSidebar() : openSidebar();
    });

    overlay.addEventListener('click', closeSidebar);

    /* ==========================
     * DROPDOWN HANDLER
     * ========================== */
    function toggleDropdown(toggleBtn, submenu) {
        toggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            closeAllDropdowns(submenu);
            toggleBtn.classList.toggle('dropdown-active');
            submenu.classList.toggle('active');
        });
    }

    jurnalToggle && jurnalSubmenu && toggleDropdown(jurnalToggle, jurnalSubmenu);
    databaseUserToggle && databaseUserSubmenu && toggleDropdown(databaseUserToggle, databaseUserSubmenu);

    function closeAllDropdowns(except = null) {
        document.querySelectorAll('.submenu').forEach(sub => {
            if (sub !== except) sub.classList.remove('active');
        });

        document.querySelectorAll('.simple-nav-item').forEach(btn => {
            if (btn !== except) btn.classList.remove('dropdown-active');
        });
    }

    /* ==========================
     * CLICK OUTSIDE (DESKTOP)
     * ========================== */
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.nav-item-dropdown')) {
            closeAllDropdowns();
        }
    });

    /* ==========================
     * ROUTE AWARE DROPDOWN
     * ========================== */
    const path = window.location.pathname;

    if (path.includes('/jurnal')) {
        jurnalSubmenu?.classList.add('active');
        jurnalToggle?.classList.add('dropdown-active');
    }

    if (path.includes('/database-user')) {
        databaseUserSubmenu?.classList.add('active');
        databaseUserToggle?.classList.add('dropdown-active');
    }

    /* ==========================
     * RESPONSIVE HANDLING
     * ========================== */
    window.addEventListener('resize', () => {
        if (window.innerWidth > 1199) {
            closeSidebar();
        }
    });

    /* ==========================
     * CHART RESIZE (SAFE)
     * ========================== */
    function resizeCharts() {
        if (typeof Chart === 'undefined') return;

        ['dailyChart','weeklyChart','monthlyChart','sleepTimeChart'].forEach(id => {
            const chart = Chart.getChart(id);
            chart && chart.resize();
        });
    }

});
