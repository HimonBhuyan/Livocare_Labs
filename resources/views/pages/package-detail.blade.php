@extends('layouts.app')

@section('title', $package->name . ' in Guwahati - Livocare Labs')
@section('meta_description', 'Book ' . $package->name . ' (' . $package->test_count . ' Tests) at ₹' . number_format($package->discounted_price) . ' in Guwahati with free home sample pickup.')

@section('content')

<!-- Breadcrumb Header -->
<div class="page-header-banner" style="padding: 40px 0 50px;">
    <div class="container">
        <div style="font-size: 0.85rem; color: #94a3b8; margin-bottom: 12px;">
            <a href="{{ route('home') }}" style="color: #cbd5e1;">Home</a> / 
            <a href="{{ route('packages.index') }}" style="color: #cbd5e1;">Packages</a> / 
            <span style="color: #38bdf8;">{{ $package->name }}</span>
        </div>
        
        <div style="display: flex; gap: 12px; align-items: center; margin-bottom: 12px;">
            <span class="badge-tag badge-coral">{{ $package->badge ?? $package->category_label }}</span>
            <span class="badge-tag badge-emerald">{{ $package->test_count }} Parameters Included</span>
        </div>

        <h1 style="color: #ffffff; font-size: clamp(1.85rem, 5.5vw, 2.6rem); margin-bottom: 12px;">{{ $package->name }}</h1>
        <p style="color: #cbd5e1; font-size: 1.05rem; max-width: 750px; line-height: 1.6;">
            {{ $package->short_description }}
        </p>
    </div>
</div>

<div class="section-padding">
    <div class="container">
        <div class="responsive-split">
            <!-- Left Detailed Column -->
            <div>
                <!-- Parameter List Card -->
                <div class="modern-card" style="margin-bottom: 32px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 1px solid var(--border); padding-bottom: 16px;">
                        <h2 style="font-size: 1.6rem;">Included Tests & Parameters</h2>
                        <span class="badge-tag badge-primary">{{ $package->test_count }} Tests</span>
                    </div>

                    <ul style="list-style: none; display: grid; grid-template-columns: 1fr; gap: 14px;">
                        @if(is_array($package->parameters))
                            @foreach($package->parameters as $index => $param)
                                <li style="display: flex; align-items: center; gap: 14px; padding: 12px 16px; background: #f8fafc; border-radius: var(--radius-md); border: 1px solid #e2e8f0;">
                                    <div style="width: 28px; height: 28px; border-radius: 50%; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; font-weight: 700; flex-shrink: 0;">
                                        {{ $index + 1 }}
                                    </div>
                                    <span style="font-weight: 600; color: var(--text-heading); font-size: 0.95rem;">{{ $param }}</span>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Test Preparation Guidelines -->
                <div class="modern-card" style="margin-bottom: 32px;">
                    <h2 style="font-size: 1.6rem; margin-bottom: 20px;">Patient Preparation Instructions</h2>
                    
                    <div class="form-row-2">
                        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; padding: 20px; border-radius: var(--radius-md);">
                            <h4 style="color: #15803d; margin-bottom: 8px;">⏳ Fasting Requirement</h4>
                            <p style="font-size: 0.9rem; color: #166534;">
                                @if($package->fasting_required)
                                    Overnight fasting of 10 to 12 hours is mandatory before giving blood. You can sip plain water.
                                @else
                                    No fasting required for this test. Sample can be given at any time of the day.
                                @endif
                            </p>
                        </div>

                        <div style="background: #eff6ff; border: 1px solid #bfdbfe; padding: 20px; border-radius: var(--radius-md);">
                            <h4 style="color: #1e40af; margin-bottom: 8px;">🩸 Sample Type</h4>
                            <p style="font-size: 0.9rem; color: #1e3a8a;">
                                {{ $package->sample_type }}. Drawn using single-use vacuum tubes by our certified phlebotomist.
                            </p>
                        </div>
                    </div>

                    <div style="margin-top: 20px; font-size: 0.9rem; color: var(--text-muted); line-height: 1.6;">
                        <strong>Note:</strong> Avoid heavy exercise or excessive caffeine intake prior to testing. Continue your prescribed regular medications unless your consulting physician has advised otherwise.
                    </div>
                </div>

                <!-- Why Book with Livocare -->
                <div class="modern-card">
                    <h3 style="font-size: 1.3rem; margin-bottom: 16px;">The Livocare Labs Guarantee</h3>
                    <div class="form-row-2" style="font-size: 0.9rem;">
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <span style="color: var(--teal); font-size: 1.2rem;">✓</span> Free Home Sample Pickup in Guwahati
                        </div>
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <span style="color: var(--teal); font-size: 1.2rem;">✓</span> Automated Robotic Analyzers
                        </div>
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <span style="color: var(--teal); font-size: 1.2rem;">✓</span> 100% Barcoded Sample Tubes
                        </div>
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <span style="color: var(--teal); font-size: 1.2rem;">✓</span> Pathologist Signed Digital Reports
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sticky Booking Card -->
            <div>
                <div class="modern-card" style="border: 2px solid var(--primary); box-shadow: var(--shadow-xl);">
                    <span class="badge-tag badge-emerald" style="margin-bottom: 12px;">Special Offer Price</span>
                    
                    <div style="display: flex; align-items: baseline; flex-wrap: wrap; gap: 10px; margin-bottom: 8px;">
                        <span style="font-size: 2.5rem; font-weight: 800; color: var(--text-heading); font-family: var(--font-heading);">
                            ₹{{ number_format($package->discounted_price) }}
                        </span>
                        <span style="font-size: 1.2rem; color: #94a3b8; text-decoration: line-through;">
                            ₹{{ number_format($package->original_price) }}
                        </span>
                        <span class="badge-tag badge-coral" style="font-size: 0.8rem;">
                            Save {{ $package->discount_percent }}%
                        </span>
                    </div>

                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 24px;">
                        * Taxes and doorstep sample collection included. No hidden charges.
                    </p>

                    <div style="background: #f8fafc; border-radius: var(--radius-md); padding: 16px; margin-bottom: 24px; font-size: 0.85rem; display: flex; flex-direction: column; gap: 8px;">
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--text-muted);">Turnaround Time:</span>
                            <strong>{{ $package->report_time }}</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--text-muted);">Coverage:</span>
                            <strong>All areas in Guwahati</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--text-muted);">Payment:</span>
                            <strong>Pay after collection (Cash/UPI)</strong>
                        </div>
                    </div>

                    <a href="{{ route('booking.create', ['package_id' => $package->id]) }}" class="btn btn-primary btn-lg" style="width: 100%; margin-bottom: 12px;">
                        Book Doorstep Collection
                    </a>

                    <a href="https://wa.me/916002509536?text=Hi%2C%20I%20want%20to%20book%20the%20{{ urlencode($package->name) }}%20at%20Rs.{{ number_format($package->discounted_price) }}." 
                       target="_blank" rel="noopener" 
                       class="btn btn-outline" style="width: 100%; color: #15803d; border-color: #86efac; background: #f0fdf4;">
                        💬 Book via WhatsApp
                    </a>

                    <div style="text-align: center; margin-top: 16px;">
                        <a href="tel:+916002509536" style="font-size: 0.85rem; color: var(--text-heading); font-weight: 600;">
                            📞 Need help? Call +91 60025 09536
                        </a>
                    </div>
                </div>

                @if($relatedPackages->isNotEmpty())
                    <div style="margin-top: 32px;">
                        <h4 style="font-size: 1.1rem; margin-bottom: 16px; color: var(--text-heading);">Other Recommended Packages</h4>
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            @foreach($relatedPackages as $rel)
                                <a href="{{ route('package.show', $rel->slug) }}" class="modern-card" style="padding: 16px; display: flex; justify-content: space-between; align-items: center; text-decoration: none;">
                                    <div>
                                        <div style="font-weight: 700; font-size: 0.95rem; color: var(--text-heading);">{{ $rel->name }}</div>
                                        <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $rel->test_count }} Tests</div>
                                    </div>
                                    <div style="font-weight: 800; color: var(--primary);">
                                        ₹{{ number_format($rel->discounted_price) }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
