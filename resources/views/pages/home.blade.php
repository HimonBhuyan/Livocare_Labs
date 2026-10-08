@extends('layouts.app')

@section('title', 'Livocare Labs - Advanced Pathology & Diagnostic Center Guwahati | Home Sample Pickup')
@section('meta_description', 'Guwahati’s trusted diagnostic laboratory. Book Full Body Health Checkups, Aarogyam Packages, CBC, LFT, KFT, Thyroid & Diabetes tests with free doorstep blood collection.')

@section('content')

<!-- Hero Section -->
<section class="hero-section hero-has-video">
    <!-- Glowing DNA Helix Laboratory Background Video -->
    <div class="hero-video-wrapper" aria-hidden="true">
        <video class="hero-bg-video" autoplay muted loop playsinline preload="auto">
            <source src="{{ asset('videos/Glowing_DNA_helix_in_laboratory_20261008111036.mp4') }}" type="video/mp4">
        </video>
        <div class="hero-video-overlay"></div>
    </div>

    <div class="container hero-grid">
        <!-- Hero Text -->
        <div>
            <div class="hero-badge-pill">
                <span class="pulse-dot"></span>
                <span>NABL Quality Aligned • Guwahati's Trusted Diagnostic Center</span>
            </div>

            <h1 class="hero-title">
                Precision Diagnostics, <br>
                <span class="text-gradient">Trusted Care at Your Doorstep.</span>
            </h1>

            <p class="hero-subtitle">
                Don't wait in clinic queues. Book comprehensive health checkups and blood tests with <strong>free home sample collection across Guwahati</strong>. Fast, barcoded accuracy and certified pathologist reports on WhatsApp in 6–12 hours.
            </p>

            <div class="hero-actions">
                <a href="{{ route('booking.create') }}" class="btn btn-primary btn-lg">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>Book Home Sample Collection</span>
                </a>

                <a href="{{ route('packages.index') }}" class="btn btn-outline btn-lg">
                    <span>View Health Packages</span>
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>

            <ul class="hero-features-list">
                <li>
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    <span>100% Sterile Vacutainers</span>
                </li>
                <li>
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    <span>Free Home Pickup</span>
                </li>
                <li>
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    <span>WhatsApp Reports</span>
                </li>
            </ul>
        </div>

        <!-- Hero Quick Book Card -->
        <div>
            <div class="hero-visual-card">
                <div class="quick-book-box">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                        <h3>Instant Home Pickup</h3>
                        <span class="badge-tag badge-emerald">Available Today</span>
                    </div>
                    <p>Enter your details and a trained phlebotomist will contact you in 10 minutes.</p>

                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="collection_type" value="home_collection">

                        <div class="form-group">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="patient_name" class="form-control" placeholder="e.g. Rahul Barman" required>
                        </div>

                        <div class="form-group form-row-phone-age">
                            <div>
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" name="patient_phone" class="form-control" placeholder="10-digit mobile" required>
                            </div>
                            <div>
                                <label class="form-label">Patient Age</label>
                                <input type="number" name="patient_age" class="form-control" placeholder="Age" min="1" max="120">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Select Test / Package *</label>
                            <select name="medical_package_id" class="form-control" required>
                                <option value="" disabled selected>-- Choose Health Package --</option>
                                @foreach($featuredPackages as $pkg)
                                    <option value="{{ $pkg->id }}">
                                        {{ $pkg->name }} ({{ $pkg->test_count }} Tests) - ₹{{ number_format($pkg->discounted_price) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-row-2">
                            <div>
                                <label class="form-label">Date *</label>
                                <input type="date" name="preferred_date" id="preferredDateInput" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div>
                                <label class="form-label">Slot *</label>
                                <select name="time_slot" class="form-control" required>
                                    <option value="06:30 AM - 08:30 AM">06:30 AM - 08:30 AM (Fasting)</option>
                                    <option value="08:30 AM - 10:30 AM" selected>08:30 AM - 10:30 AM</option>
                                    <option value="10:30 AM - 12:30 PM">10:30 AM - 12:30 PM</option>
                                    <option value="04:00 PM - 06:30 PM">04:00 PM - 06:30 PM</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Address / Area in Guwahati</label>
                            <input type="text" name="address" class="form-control" placeholder="e.g. House 14, Hatigaon / Dispur / Ulubari" required>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; font-size: 1rem;">
                            Confirm Booking & Request Pickup
                        </button>

                        <div style="text-align: center; margin-top: 10px; font-size: 0.8rem; color: var(--text-muted);">
                            🔒 Pay after sample collection (Cash / UPI) • Zero cancellation charges
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Bar -->
<div class="container">
    <div class="stats-bar">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">50,000<span>+</span></div>
                <div class="stat-label">Happy Patients in Guwahati</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">99.8<span>%</span></div>
                <div class="stat-label">Diagnostic Precision Rate</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">60<span>m</span></div>
                <div class="stat-label">Average Phlebotomist Reach Time</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">6-12<span>h</span></div>
                <div class="stat-label">Fast Digital Report Turnaround</div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Action Shortcuts -->
<section class="section-padding">
    <div class="container">
        <div class="actions-grid">
            <div class="action-card">
                <div>
                    <div class="action-icon" style="background: #e0f2fe; color: #0284c7;">
                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <h3>Book Home Collection</h3>
                    <p>Certified phlebotomist arrives at your home with sterilized kits. Free across Guwahati.</p>
                </div>
                <a href="{{ route('booking.create') }}" class="btn btn-outline btn-sm" style="width: 100%;">
                    Book Doorstep Visit
                </a>
            </div>

            <div class="action-card">
                <div>
                    <div class="action-icon" style="background: #fef3c7; color: #d97706;">
                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3>Upload Prescription</h3>
                    <p>Have a doctor's slip? Upload a photo and our lab team will call back with tests & discounts.</p>
                </div>
                <a href="{{ route('prescription.view') }}" class="btn btn-outline btn-sm" style="width: 100%;">
                    Upload Rx Slip
                </a>
            </div>

            <div class="action-card">
                <div>
                    <div class="action-icon" style="background: #dcfce7; color: #16a34a;">
                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3>Track & Download Reports</h3>
                    <p>Check the live testing status of your sample or download the digital signed PDF report.</p>
                </div>
                <a href="{{ route('track.report') }}" class="btn btn-outline btn-sm" style="width: 100%;">
                    Check Report
                </a>
            </div>

            <div class="action-card">
                <div>
                    <div class="action-icon" style="background: #ede9fe; color: #7c3aed;">
                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3>Full Body Packages</h3>
                    <p>Explore comprehensive profiles starting at just ₹499 with up to 55% discount on MRP.</p>
                </div>
                <a href="{{ route('packages.index') }}" class="btn btn-outline btn-sm" style="width: 100%;">
                    Browse All Tests
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Health Packages -->
<section class="section-padding section-alt">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; flex-wrap: wrap; gap: 20px;">
            <div>
                <span class="badge-tag badge-primary" style="margin-bottom: 8px;">Popular Packages</span>
                <h2 style="font-size: 2.25rem;">Comprehensive Health Checkup Profiles</h2>
                <p style="color: var(--text-muted); font-size: 1rem; margin-top: 6px;">
                    Curated by senior pathologists to detect hidden illness, protect organs, and evaluate immunity.
                </p>
            </div>
            <div>
                <a href="{{ route('packages.index') }}" class="btn btn-outline">
                    View All 14+ Packages & Tests →
                </a>
            </div>
        </div>

        <div class="packages-grid">
            @foreach($featuredPackages->take(3) as $pkg)
                <div class="package-card {{ $pkg->is_featured ? 'featured' : '' }}">
                    <div>
                        <div class="pkg-header">
                            <div>
                                <span class="badge-tag {{ $pkg->badge === 'Bestseller' ? 'badge-coral' : 'badge-primary' }}" style="font-size: 0.72rem; margin-bottom: 6px;">
                                    {{ $pkg->badge ?? 'Special Package' }}
                                </span>
                                <h3 class="pkg-title">{{ $pkg->name }}</h3>
                            </div>
                            <span class="pkg-tests-badge">{{ $pkg->test_count }} Tests</span>
                        </div>

                        <p class="pkg-desc">{{ $pkg->short_description }}</p>

                        <div class="pkg-params-box">
                            <div class="pkg-params-title">Major Parameters Included:</div>
                            <ul class="pkg-params-list">
                                @if(is_array($pkg->parameters))
                                    @foreach(array_slice($pkg->parameters, 0, 4) as $p)
                                        <li>
                                            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                            <span>{{ $p }}</span>
                                        </li>
                                    @endforeach
                                    @if(count($pkg->parameters) > 4)
                                        <li style="color: var(--primary); font-weight: 600;">
                                            + {{ count($pkg->parameters) - 4 }} more test profiles...
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>

                        <div class="pkg-meta-row">
                            <span>
                                🩸 {{ $pkg->sample_type }}
                            </span>
                            <span>
                                ⏳ {{ $pkg->fasting_required ? '10-12 hrs Fasting' : 'No Fasting Req.' }}
                            </span>
                            <span>
                                📄 {{ $pkg->report_time }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <div class="pkg-price-row">
                            <span class="price-current">₹{{ number_format($pkg->discounted_price) }}</span>
                            <span class="price-original">₹{{ number_format($pkg->original_price) }}</span>
                            <span class="price-discount-tag">{{ $pkg->discount_percent }}% OFF</span>
                        </div>

                        <div class="pkg-actions">
                            <button type="button" class="btn btn-outline btn-sm" 
                                data-inspect-package
                                data-pkg-id="{{ $pkg->id }}"
                                data-pkg-name="{{ $pkg->name }}"
                                data-pkg-count="{{ $pkg->test_count }}"
                                data-pkg-price="{{ number_format($pkg->discounted_price) }}"
                                data-pkg-params="{{ json_encode($pkg->parameters) }}">
                                View Details
                            </button>
                            <a href="{{ route('booking.create', ['package_id' => $pkg->id]) }}" class="btn btn-primary btn-sm">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Organ & Specialized Category Explorer -->
<section class="section-padding">
    <div class="container">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 48px;">
            <span class="badge-tag badge-primary" style="margin-bottom: 8px;">Diagnostic Focus</span>
            <h2 style="font-size: 2.25rem;">Targeted Care by Health Concern</h2>
            <p style="color: var(--text-muted); margin-top: 8px;">
                Whether you need routine liver monitoring, diabetic screening, or thyroid evaluation, find specialized panels for every organ.
            </p>
        </div>

        <div class="categories-grid">
            <a href="{{ route('packages.index', ['category' => 'full_body']) }}" class="category-card">
                <div class="category-icon">🩺</div>
                <h3>Full Body Checkup</h3>
                <span>Aarogyam Series (68 to 110 tests)</span>
            </a>

            <a href="{{ route('packages.index', ['category' => 'diabetes']) }}" class="category-card">
                <div class="category-icon">🩸</div>
                <h3>Diabetes Care</h3>
                <span>HbA1c, Fasting Glucose, HOMA-IR</span>
            </a>

            <a href="{{ route('packages.index', ['category' => 'liver']) }}" class="category-card">
                <div class="category-icon">🧪</div>
                <h3>Liver Function (LFT)</h3>
                <span>12 Parameters (Enzymes, Bilirubin)</span>
            </a>

            <a href="{{ route('packages.index', ['category' => 'kidney']) }}" class="category-card">
                <div class="category-icon">💧</div>
                <h3>Renal Care (KIDPRO)</h3>
                <span>7 Parameters (Creatinine, BUN, Uric Acid)</span>
            </a>

            <a href="{{ route('packages.index', ['category' => 'cardiac']) }}" class="category-card">
                <div class="category-icon">❤️</div>
                <h3>Heart & Lipid Profile</h3>
                <span>Cholesterol, Triglycerides, HDL, LDL</span>
            </a>

            <a href="{{ route('packages.index', ['category' => 'thyroid']) }}" class="category-card">
                <div class="category-icon">🦋</div>
                <h3>Thyroid & Hormones</h3>
                <span>UTSH, T3, T4, LH, FSH, Prolactin</span>
            </a>

            <a href="{{ route('packages.index', ['category' => 'vitamins']) }}" class="category-card">
                <div class="category-icon">☀️</div>
                <h3>Vitamins & Minerals</h3>
                <span>Vitamin D3, B12, Iron, Calcium</span>
            </a>

            <a href="{{ route('packages.index', ['category' => 'fever']) }}" class="category-card">
                <div class="category-icon">🌡️</div>
                <h3>Fever & Infection</h3>
                <span>Dengue, Malaria, Typhoid, CBC</span>
            </a>
        </div>
    </div>
</section>

<!-- 4-Step Doorstep Process -->
<section class="section-padding section-alt">
    <div class="container">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 50px;">
            <span class="badge-tag badge-primary" style="margin-bottom: 8px;">Seamless Experience</span>
            <h2 style="font-size: 2.25rem;">How Home Sample Collection Works</h2>
            <p style="color: var(--text-muted); margin-top: 8px;">
                Reliable healthcare without leaving the comfort and safety of your home in Guwahati.
            </p>
        </div>

        <div class="process-grid">
            <div class="process-card">
                <div class="step-number">1</div>
                <div class="step-icon">📱</div>
                <h3>Book Online or Call</h3>
                <p>Select your desired test package online or give us a quick call at 60025 09536.</p>
            </div>

            <div class="process-card">
                <div class="step-number">2</div>
                <div class="step-icon">🚐</div>
                <h3>Doorstep Sample Collection</h3>
                <p>A vaccinated, trained phlebotomist visits with single-use sterile needles and barcoded tubes.</p>
            </div>

            <div class="process-card">
                <div class="step-number">3</div>
                <div class="step-icon">🔬</div>
                <h3>Automated Lab Testing</h3>
                <p>Samples are processed in temperature-monitored containers using high-precision automated analyzers.</p>
            </div>

            <div class="process-card">
                <div class="step-number">4</div>
                <div class="step-icon">📄</div>
                <h3>Digital PDF on WhatsApp</h3>
                <p>Receive your pathologist-verified diagnostic report via WhatsApp & email within 6 to 12 hours.</p>
            </div>
        </div>
    </div>
</section>

<!-- Prescription Upload Callout Banner -->
<section class="section-padding-sm page-header-banner">
    <div class="container">
        <div class="responsive-banner">
            <div>
                <span class="badge-tag badge-primary" style="background: rgba(2, 132, 199, 0.3); color: #7dd3fc; margin-bottom: 12px;">Quick Prescription Service</span>
                <h2 style="color: #ffffff; font-size: 2.2rem; margin-bottom: 12px;">Have a Doctor's Prescription?</h2>
                <p style="color: #cbd5e1; font-size: 1.05rem; line-height: 1.6; max-width: 600px;">
                    Don't worry about searching individual medical terms. Upload a photo of your doctor's prescription and our Guwahati pathologist team will review it, select all required tests, and apply maximum package discounts for you!
                </p>
            </div>
            <div style="text-align: right;">
                <a href="{{ route('prescription.view') }}" class="btn btn-coral btn-lg" style="box-shadow: 0 10px 25px rgba(234, 88, 12, 0.4);">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    <span>Upload Prescription Now</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Why Doctors & Families in Guwahati Trust Livocare -->
<section class="section-padding why-section">
    <div class="container">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 48px;">
            <span class="badge-tag badge-primary" style="margin-bottom: 8px;">Quality Assurance</span>
            <h2 style="font-size: 2.25rem;">Why Choose Livocare Labs?</h2>
            <p style="color: var(--text-muted); margin-top: 8px;">
                Committed to delivering diagnostic accuracy you and your consulting doctor can rely upon unconditionally.
            </p>
        </div>

        <div class="trust-features-grid">
            <div class="trust-feature-card">
                <div class="trust-icon-box">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <div>
                    <h3>100% Barcoded Safety</h3>
                    <p>Every sample tube is barcoded on-the-spot at your doorstep to prevent any sample mix-up or tracking errors.</p>
                </div>
            </div>

            <div class="trust-feature-card">
                <div class="trust-icon-box">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <div>
                    <h3>Fully Automated Analyzers</h3>
                    <p>Biochemistry and hematology machines minimize manual error, calibrated regularly against international standards.</p>
                </div>
            </div>

            <div class="trust-feature-card">
                <div class="trust-icon-box">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <h3>MD Pathologist Supervision</h3>
                    <p>Every diagnostic report is inspected and digitally signed by experienced pathologists before release.</p>
                </div>
            </div>

            <div class="trust-feature-card">
                <div class="trust-icon-box">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3>Same-Day Fast Turnaround</h3>
                    <p>Routine tests like CBC, Sugar, LFT, and Kidney profiles are delivered the same evening on WhatsApp.</p>
                </div>
            </div>

            <div class="trust-feature-card">
                <div class="trust-icon-box">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div>
                    <h3>Doorstep Service in Guwahati</h3>
                    <p>From Hatigaon, Dispur, Khanapara to Jalukbari, our phlebotomists cover all major zones in Guwahati.</p>
                </div>
            </div>

            <div class="trust-feature-card">
                <div class="trust-icon-box">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3>Transparent Pricing</h3>
                    <p>No hidden phlebotomy fees, no unexpected sample transport charges. Clear, discounted health packages.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Verified Patient Reviews -->
<section class="section-padding section-alt">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; flex-wrap: wrap; gap: 20px;">
            <div>
                <span class="badge-tag badge-emerald" style="margin-bottom: 8px;">★ 4.9 / 5.0 Google Rating</span>
                <h2 style="font-size: 2.25rem;">What Guwahati Residents Say</h2>
            </div>
            <div style="font-size: 0.95rem; color: var(--text-muted);">
                Over 1,200+ five-star experiences across Assam
            </div>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div>
                    <div class="star-rating">★★★★★</div>
                    <p class="testimonial-text">
                        "Booked the Aarogyam Monsoon package for my parents in Hatigaon. The phlebotomist reached sharp at 7:00 AM, was very gentle, and we had the full report on WhatsApp by 4 PM. Highly impressed with Livocare!"
                    </p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">DB</div>
                    <div class="author-info">
                        <h4>Dr. Debajit Baruah</h4>
                        <span>Hatigaon, Guwahati</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div>
                    <div class="star-rating">★★★★★</div>
                    <p class="testimonial-text">
                        "I needed regular HbA1c and Kidney tests done. In big hospitals, waiting in billing alone takes an hour. Livocare collection is completely hassle-free and prices are 50% cheaper. Great service for working professionals."
                    </p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">PS</div>
                    <div class="author-info">
                        <h4>Priyanka Saikia</h4>
                        <span>Dispur, Guwahati</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div>
                    <div class="star-rating">★★★★★</div>
                    <p class="testimonial-text">
                        "Just uploaded my doctor's prescription through their website and within 10 minutes their executive called back with exact test details. The digital report was clear and easy to read. Strongly recommend Livocare Labs."
                    </p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">AK</div>
                    <div class="author-info">
                        <h4>Anupam Kalita</h4>
                        <span>Zoo Road, Guwahati</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Frequently Asked Questions -->
<section class="section-padding">
    <div class="container">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 40px;">
            <span class="badge-tag badge-primary" style="margin-bottom: 8px;">Got Questions?</span>
            <h2 style="font-size: 2.25rem;">Frequently Asked Questions</h2>
            <p style="color: var(--text-muted); margin-top: 8px;">
                Everything you need to know about booking tests and getting your reports.
            </p>
        </div>

        <div class="faq-list">
            <div class="faq-item active">
                <button class="faq-question">
                    <span>How do I book a home blood sample collection?</span>
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-answer">
                    You can book directly using the form on this website, select your preferred date and time slot, or message us on WhatsApp at <strong>+91 60025 09536</strong>. Our phlebotomy coordinator will confirm the appointment immediately.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span>Do I need to fast before giving my blood sample?</span>
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-answer">
                    For packages that include Fasting Blood Sugar (FBS), Lipid Profile, and full body checkups, <strong>10 to 12 hours of overnight fasting</strong> is recommended. You may drink plain water. Routine tests like CBC, Thyroid, or Vitamin D do not require strict fasting.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span>When and how will I receive my test reports?</span>
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-answer">
                    Most routine test reports (CBC, Liver, Kidney, Lipid, Sugar) are delivered on the <strong>same day within 6 to 12 hours</strong> directly to your registered WhatsApp number and email. You can also download them from the "Track Report" page on this website.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span>Are home collection services free across Guwahati?</span>
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-answer">
                    Yes! Home sample collection is completely free for all our standard health packages across major areas of Guwahati (Hatigaon, Dispur, Kahilipara, Bhangagarh, Ulubari, Beltola, Jalukbari, etc.).
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
