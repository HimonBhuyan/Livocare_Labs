<!-- Announcement Top Bar -->
<div class="topbar">
    <div class="container topbar-content">
        <div class="topbar-info">
            <span class="topbar-info-item">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Hatigaon, Anupam Nagar, Guwahati - 781038
            </span>
            <span class="topbar-info-item">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Mon - Sat: 6:30 AM - 8:30 PM | Sun: 7:00 AM - 2:00 PM
            </span>
            <span class="topbar-info-item text-teal" style="font-weight: 700;">
                ✦ FREE Home Sample Pickup Across Guwahati
            </span>
        </div>
        <div class="topbar-info">
            <a href="tel:+916002509536" class="topbar-info-item" style="color: #ffffff; font-weight: 700;">
                <svg width="15" height="15" fill="none" stroke="#38bdf8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                +91 60025 09536
            </a>
            <a href="{{ route('track.report') }}" class="topbar-info-item" style="color: #93c5fd; text-decoration: underline;">
                Download Reports
            </a>
        </div>
    </div>
</div>

<!-- Main Sticky Header -->
<header class="site-header">
    <div class="container nav-container">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="brand-logo" aria-label="LIVOCARE LABS">
            <img src="{{ asset('images/logo.png') }}" alt="LIVOCARE LABS" class="brand-logo-img">
        </a>

        <!-- Desktop Navigation -->
        <nav>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('packages.index') }}" class="nav-link {{ request()->routeIs('packages.*') || request()->routeIs('package.*') ? 'active' : '' }}">Tests & Packages</a></li>
                <li><a href="{{ route('prescription.view') }}" class="nav-link {{ request()->routeIs('prescription.*') ? 'active' : '' }}">Upload Rx</a></li>
                <li><a href="{{ route('track.report') }}" class="nav-link {{ request()->routeIs('track.*') ? 'active' : '' }}">Track Report</a></li>
                <li><a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About Lab</a></li>
                <li><a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
        </nav>

        <!-- Right Action Buttons -->
        <div class="nav-actions">
            <!-- Theme Toggle Button -->
            <button class="theme-toggle-btn theme-toggle-trigger" aria-label="Toggle Dark Mode" title="Toggle Dark/Light Mode">
                <svg class="sun-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <svg class="moon-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>

            <a href="tel:+916002509536" class="btn btn-outline btn-sm" title="Call Lab Now">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                <span>60025 09536</span>
            </a>

            <a href="{{ route('booking.create') }}" class="btn btn-primary btn-sm">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span>Book Home Visit</span>
            </a>

            <!-- Mobile Drawer Button -->
            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Open Menu">
                <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Navigation Drawer -->
<div class="mobile-nav-backdrop" id="mobileNavDrawer">
    <div class="mobile-drawer-content" id="mobileDrawerContent">
        <!-- Drawer Header -->
        <div class="drawer-header">
            <a href="{{ route('home') }}" class="brand-logo" aria-label="LIVOCARE LABS" style="text-decoration: none;">
                <img src="{{ asset('images/logo.png') }}" alt="LIVOCARE LABS" class="brand-logo-img brand-logo-drawer">
            </a>
            <div style="display: flex; align-items: center; gap: 8px;">
                <button class="theme-toggle-btn theme-toggle-trigger" aria-label="Toggle Dark Mode" title="Toggle Dark/Light Mode" style="width: 36px; height: 36px;">
                    <svg class="sun-icon" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <svg class="moon-icon" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>
                <button class="drawer-close-btn" id="mobileNavClose" aria-label="Close Navigation">✕</button>
            </div>
        </div>

        <!-- Drawer Body -->
        <div class="drawer-body">
            <!-- Nav Links -->
            <ul class="drawer-nav-list">
                <li>
                    <a href="{{ route('home') }}" class="drawer-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <span class="drawer-link-icon">🏠</span>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('packages.index') }}" class="drawer-nav-link {{ request()->routeIs('packages.*') || request()->routeIs('package.*') ? 'active' : '' }}">
                        <span class="drawer-link-icon">🧪</span>
                        <span>Tests & Health Packages</span>
                        <span class="drawer-badge">14+ Tests</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('booking.create') }}" class="drawer-nav-link drawer-nav-link-cta {{ request()->routeIs('booking.*') ? 'active' : '' }}">
                        <span class="drawer-link-icon" style="color: var(--primary);">✦</span>
                        <span>Book Home Collection</span>
                        <span class="drawer-badge-pill">Free</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('prescription.view') }}" class="drawer-nav-link {{ request()->routeIs('prescription.*') ? 'active' : '' }}">
                        <span class="drawer-link-icon">📋</span>
                        <span>Upload Prescription</span>
                        <span class="drawer-badge">15 min</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('track.report') }}" class="drawer-nav-link {{ request()->routeIs('track.*') ? 'active' : '' }}">
                        <span class="drawer-link-icon">🔍</span>
                        <span>Track & Download Report</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('about') }}" class="drawer-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                        <span class="drawer-link-icon">🏥</span>
                        <span>About Laboratory</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="drawer-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                        <span class="drawer-link-icon">📍</span>
                        <span>Contact & Directions</span>
                    </a>
                </li>
            </ul>

            <!-- Guwahati Laboratory Trust Highlights (fills dead space productively) -->
            <div class="drawer-trust-box">
                <div class="drawer-trust-title">✦ Laboratory Highlights</div>
                <div class="drawer-trust-item">
                    <span>🚐</span>
                    <span><strong>Free Pickup</strong> in Hatigaon & all Guwahati</span>
                </div>
                <div class="drawer-trust-item">
                    <span>⚡</span>
                    <span><strong>Same-Day Reports</strong> on WhatsApp</span>
                </div>
                <div class="drawer-trust-item">
                    <span>🔬</span>
                    <span><strong>NABL & ISO</strong> Automated Analyzers</span>
                </div>
            </div>
        </div>

        <!-- Drawer Footer -->
        <div class="drawer-footer">
            <div style="font-size: 0.785rem; color: var(--text-muted); margin-bottom: 8px; font-weight: 600;">Direct Lab Desk (Guwahati)</div>
            <div style="display: flex; gap: 8px; margin-bottom: 10px;">
                <a href="tel:+916002509536" class="btn btn-secondary btn-sm" style="flex: 1; padding: 10px 6px; font-size: 0.825rem;">
                    📞 60025 09536
                </a>
                <a href="https://wa.me/916002509536?text=Hi%20Livocare%20Labs%2C%20I%20have%20an%20inquiry." target="_blank" rel="noopener" class="btn btn-primary btn-sm" style="background: #25d366; border-color: #25d366; flex: 1; padding: 10px 6px; font-size: 0.825rem; color: #ffffff;">
                    💬 WhatsApp
                </a>
            </div>
            <a href="{{ route('admin.login') }}" style="display: block; text-align: center; font-size: 0.75rem; color: var(--text-muted);">
                Staff / Admin Portal
            </a>
        </div>
    </div>
</div>
