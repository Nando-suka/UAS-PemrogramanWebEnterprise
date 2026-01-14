document.addEventListener('DOMContentLoaded', function() {
    // ===== JURNAL DROPDOWN =====
    const jurnalToggle = document.getElementById('jurnalToggle');
    const jurnalSubmenu = document.getElementById('jurnalSubmenu');
    
    if (jurnalToggle && jurnalSubmenu) {
        jurnalToggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Close other dropdowns
            closeAllDropdowns(jurnalSubmenu);
            
            // Toggle active class
            this.classList.toggle('dropdown-active');
            jurnalSubmenu.classList.toggle('active');
        });
    }
    
    // ===== DATABASE USER DROPDOWN =====
    const databaseUserToggle = document.getElementById('databaseUserToggle');
    const databaseUserSubmenu = document.getElementById('databaseUserSubmenu');
    
    if (databaseUserToggle && databaseUserSubmenu) {
        databaseUserToggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Close other dropdowns
            closeAllDropdowns(databaseUserSubmenu);
            
            // Toggle active class
            this.classList.toggle('dropdown-active');
            databaseUserSubmenu.classList.toggle('active');
        });
    }
    
    // ===== CLOSE ALL DROPDOWNS (except current) =====
    function closeAllDropdowns(exceptSubmenu) {
        const allSubmenus = document.querySelectorAll('.submenu');
        const allToggles = document.querySelectorAll('.simple-nav-item');
        
        allSubmenus.forEach(submenu => {
            if (submenu !== exceptSubmenu) {
                submenu.classList.remove('active');
            }
        });
        
        allToggles.forEach(toggle => {
            if (toggle.id && toggle.id.includes('Toggle')) {
                const relatedSubmenu = document.getElementById(toggle.id.replace('Toggle', 'Submenu'));
                if (relatedSubmenu !== exceptSubmenu) {
                    toggle.classList.remove('dropdown-active');
                }
            }
        });
    }
    
    // ===== CLOSE SUBMENU WHEN CLICKING OUTSIDE =====
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.nav-item-dropdown')) {
            // Close all dropdowns
            jurnalToggle?.classList.remove('dropdown-active');
            jurnalSubmenu?.classList.remove('active');
            
            databaseUserToggle?.classList.remove('dropdown-active');
            databaseUserSubmenu?.classList.remove('active');
        }
    });
    
    // ===== HIGHLIGHT ACTIVE SUBMENU ITEM & KEEP DROPDOWN OPEN =====
    const currentPath = window.location.pathname;
    const submenuItems = document.querySelectorAll('.submenu-item');
    
    submenuItems.forEach(item => {
        const itemHref = item.getAttribute('href');
        
        if (itemHref === currentPath) {
            item.classList.add('active');
            
            // Find parent submenu and toggle
            const parentSubmenu = item.closest('.submenu');
            if (parentSubmenu) {
                parentSubmenu.classList.add('active');
                
                // Find related toggle button
                const parentDropdown = parentSubmenu.closest('.nav-item-dropdown');
                if (parentDropdown) {
                    const toggleBtn = parentDropdown.querySelector('.simple-nav-item');
                    if (toggleBtn) {
                        toggleBtn.classList.add('dropdown-active');
                    }
                }
            }
        }
    });
    
    // ===== CHECK ROUTE AND KEEP DROPDOWN OPEN =====
    // Jurnal routes
    if (currentPath.includes('/jurnal')) {
        jurnalSubmenu?.classList.add('active');
        jurnalToggle?.classList.add('dropdown-active');
    }
    
    // Database User routes
    if (currentPath.includes('/database-user')) {
        databaseUserSubmenu?.classList.add('active');
        databaseUserToggle?.classList.add('dropdown-active');
    }
});