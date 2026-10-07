<!-- Main Site Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-widget">
                <div class="brand-logo" style="margin-bottom: 20px;">
                    <a href="{{ route('home') }}" aria-label="LIVOCARE LABS" style="text-decoration: none; display: inline-block;">
                        <img src="{{ asset('images/logo.png') }}" alt="LIVOCARE LABS" class="brand-logo-img brand-logo-footer">
                    </a>
                </div>
                <p>
                    Livocare Diagnostic & Research Center provides cutting-edge medical laboratory testing, full-body health checks, and doorstep sample collection across Guwahati. Automated analyzers, barcoded samples, and pathologist-certified reports.
                </p>
                <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 16px;">
                    <span class="badge-tag badge-navy" style="background: rgba(255,255,255,0.1); color: #e2e8f0; font-size: 0.75rem;">NABL Compliant</span>
                    <span class="badge-tag badge-navy" style="background: rgba(255,255,255,0.1); color: #e2e8f0; font-size: 0.75rem;">ISO 9001:2015</span>
                    <span class="badge-tag badge-navy" style="background: rgba(255,255,255,0.1); color: #e2e8f0; font-size: 0.75rem;">100% Barcoded</span>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-widget">
                <h3>Quick Navigation</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home Page</a></li>
                    <li><a href="{{ route('packages.index') }}">All Health Checkups</a></li>
                    <li><a href="{{ route('booking.create') }}">Book Home Sample Pickup</a></li>
                    <li><a href="{{ route('prescription.view') }}">Upload Doctor's Prescription</a></li>
                    <li><a href="{{ route('track.report') }}">Track & Download Report</a></li>
                    <li><a href="{{ route('about') }}">About Our Guwahati Center</a></li>
                    <li><a href="{{ route('contact') }}">Contact & Directions</a></li>
                </ul>
            </div>

            <!-- Popular Tests -->
            <div class="footer-widget">
                <h3>Popular Packages</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('packages.index', ['category' => 'full_body']) }}">Aarogyam Monsoon Basic (₹999)</a></li>
                    <li><a href="{{ route('packages.index', ['category' => 'full_body']) }}">Full Body Guwahati Special (₹1,699)</a></li>
                    <li><a href="{{ route('packages.index', ['category' => 'diabetes']) }}">Jaanch Diabetic Screening (₹499)</a></li>
                    <li><a href="{{ route('packages.index', ['category' => 'liver']) }}">Liver Function Tests - LFT 12 (₹599)</a></li>
                    <li><a href="{{ route('packages.index', ['category' => 'kidney']) }}">Renal / KIDPRO Profile 7 (₹499)</a></li>
                    <li><a href="{{ route('packages.index', ['category' => 'vitamins']) }}">Vitamin D3 & B12 Duo (₹899)</a></li>
                    <li><a href="{{ route('packages.index', ['category' => 'cardiac']) }}">Cardiac & Lipid Profile (₹650)</a></li>
                </ul>
            </div>

            <!-- Contact & Hours -->
            <div class="footer-widget">
                <h3>Guwahati Lab Center</h3>
                <ul class="footer-contact-list">
                    <li class="footer-contact-item">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Hatigaon, Anupam Nagar, Guwahati, Assam - 781038</span>
                    </li>
                    <li class="footer-contact-item">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span><strong>Phone:</strong> +91 60025 09536 / 6002509536</span>
                    </li>
                    <li class="footer-contact-item">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span><strong>Email:</strong> Livocarelabs@gmail.com</span>
                    </li>
                    <li class="footer-contact-item">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span><strong>Operating Hours:</strong><br>Mon – Sat: 6:30 AM – 8:30 PM<br>Sunday: 7:00 AM – 2:00 PM</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom Bar -->
        <div class="footer-bottom">
            <div>
                © {{ date('Y') }} Livocare Diagnostic & Research Labs. All rights reserved. | Serving Guwahati & Assam
            </div>
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 16px; align-items: center;">
                <a href="{{ route('about') }}">Privacy Policy</a>
                <a href="{{ route('contact') }}">Terms of Service</a>
                <a href="{{ route('admin.login') }}" style="color: #64748b; font-size: 0.8rem;">Staff Portal</a>
            </div>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp Action -->
<a href="https://wa.me/916002509536?text=Hi%20Livocare%20Labs%2C%20I%20would%20like%20to%20book%20a%20blood%20test%20%2F%20health%20checkup%20in%20Guwahati." target="_blank" rel="noopener" class="floating-whatsapp" aria-label="Chat on WhatsApp with Lab Phlebotomist">
    <span class="tooltip">Chat with Phlebotomist</span>
    <svg width="32" height="32" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.58 20.15 12.04 20.15C10.56 20.15 9.11 19.76 7.85 19.01L7.55 18.83L4.43 19.65L5.26 16.61L5.06 16.29C4.24 14.99 3.81 13.47 3.81 11.91C3.81 7.37 7.5 3.67 12.05 3.67M9.53 7.33C9.33 7.33 9.03 7.4 8.78 7.67C8.52 7.94 7.81 8.61 7.81 9.96C7.81 11.31 8.8 12.61 8.93 12.79C9.07 12.97 10.87 15.75 13.63 16.94C14.29 17.22 14.8 17.39 15.2 17.52C15.86 17.73 16.47 17.7 16.95 17.63C17.48 17.55 18.59 16.96 18.82 16.31C19.05 15.66 19.05 15.11 18.98 14.99C18.92 14.87 18.75 14.8 18.5 14.67C18.25 14.55 17.02 13.94 16.79 13.86C16.56 13.77 16.39 13.73 16.23 13.98C16.06 14.23 15.58 14.8 15.43 14.96C15.29 15.13 15.14 15.15 14.89 15.03C14.64 14.9 13.59 14.56 12.35 13.45C11.38 12.59 10.73 11.53 10.6 11.31C10.47 11.08 10.59 10.96 10.71 10.84C10.82 10.73 10.96 10.55 11.08 10.4C11.21 10.26 11.25 10.15 11.33 9.99C11.41 9.83 11.37 9.69 11.31 9.56C11.25 9.44 10.76 8.24 10.55 7.74C10.35 7.25 10.15 7.32 9.99 7.31C9.85 7.31 9.69 7.33 9.53 7.33Z"/>
    </svg>
</a>

<!-- Mobile Sticky Bottom Bar -->
<div class="mobile-bottom-bar">
    <div class="mobile-bottom-actions">
        <a href="tel:+916002509536" class="btn btn-secondary btn-sm" style="padding: 10px;">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
            Call Lab
        </a>
        <a href="{{ route('booking.create') }}" class="btn btn-primary btn-sm" style="padding: 10px;">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Book Pickup
        </a>
    </div>
</div>

<!-- Global Package Parameters Modal -->
<div class="modal-backdrop" id="packageDetailsModal">
    <div class="modal-window">
        <button class="modal-close" data-close-modal>✕</button>
        <div style="margin-bottom: 20px;">
            <span class="badge-tag badge-primary" id="modalPkgCount" style="margin-bottom: 8px;">Parameters Included</span>
            <h3 id="modalPkgTitle" style="font-size: 1.4rem; color: var(--text-heading); margin-top: 6px;">Package Title</h3>
            <div style="display: flex; align-items: baseline; gap: 8px; margin-top: 6px;">
                <span style="font-size: 1.5rem; font-weight: 800; color: var(--primary);" id="modalPkgPrice">₹999</span>
                <span style="font-size: 0.85rem; color: var(--text-muted);">including sample collection & digital report</span>
            </div>
        </div>

        <div style="background: var(--bg-page); border-radius: var(--radius-md); padding: 18px; margin-bottom: 24px; max-height: 320px; overflow-y: auto;">
            <p style="font-size: 0.85rem; font-weight: 700; color: var(--text-heading); margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.05em;">Tests & Parameter Breakdown</p>
            <ul id="modalPkgParamsList" class="pkg-params-list">
                <!-- Dynamically populated via JS -->
            </ul>
        </div>

        <div style="display: flex; gap: 12px;">
            <button class="btn btn-outline" data-close-modal style="flex: 1;">Close</button>
            <a href="#" id="modalPkgBookBtn" class="btn btn-primary" style="flex: 2;">Book This Package Now</a>
        </div>
    </div>
</div>
