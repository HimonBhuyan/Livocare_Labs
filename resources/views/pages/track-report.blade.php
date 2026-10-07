@extends('layouts.app')

@section('title', 'Track Test Report & Sample Status - Livocare Labs Guwahati')
@section('meta_description', 'Track your diagnostic test sample status or download digital pathologist-certified reports using your Booking ID or mobile number.')

@section('content')

<!-- Header Banner -->
<section class="page-header-banner">
    <div class="container container-narrow" style="text-align: center;">
        <span class="badge-tag badge-primary" style="background: rgba(2, 132, 199, 0.3); color: #7dd3fc; margin-bottom: 12px;">Real-Time Diagnostic Tracking</span>
        <h1 style="color: #ffffff; font-size: 2.5rem; margin-bottom: 10px;">Track Sample & Download Report</h1>
        <p style="color: #cbd5e1; font-size: 1.05rem;">
            Enter your <strong>Booking Reference Code (e.g. LVC-2026-...)</strong> or 10-digit registered mobile number below.
        </p>
    </div>
</section>

<section class="section-padding">
    <div class="container container-narrow">
        <!-- Search Box -->
        <div class="modern-card" style="margin-bottom: 36px; box-shadow: var(--shadow-lg);">
            <form action="{{ route('track.report') }}" method="GET" class="track-form">
                <input type="text" name="tracking_id" value="{{ $query }}" class="form-control" placeholder="Enter Booking ID (e.g. LVC-2026-XXXX) or Phone Number" style="flex: 1; min-width: 240px; padding: 14px 18px; font-size: 1rem;" required>
                <button type="submit" class="btn btn-primary" style="padding: 14px 28px; font-size: 1rem;">
                    Track Status
                </button>
            </form>
        </div>

        @if($searched)
            @if($booking)
                <!-- Found Booking Card -->
                <div class="modern-card" style="padding: 40px; box-shadow: var(--shadow-xl);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid var(--border); padding-bottom: 20px; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
                        <div>
                            <span class="badge-tag badge-primary" style="margin-bottom: 6px;">Live Status</span>
                            <h2 style="font-size: 1.6rem; color: var(--text-heading);">Booking #{{ $booking->booking_code }}</h2>
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 4px;">
                                Patient: <strong>{{ $booking->patient_name }}</strong> • Package: <strong>{{ $booking->package_name }}</strong>
                            </p>
                        </div>
                        <div>
                            <span class="badge-tag {{ $booking->status === 'report_ready' || $booking->status === 'completed' ? 'badge-emerald' : 'badge-coral' }}" style="font-size: 0.85rem;">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </div>
                    </div>

                    <!-- Visual Timeline -->
                    @php
                        $statuses = [
                            'pending' => 'Booking Received',
                            'phlebotomist_assigned' => 'Phlebotomist Assigned',
                            'sample_collected' => 'Sample Collected',
                            'in_analysis' => 'In Laboratory Analysis',
                            'report_ready' => 'Report Verified & Ready'
                        ];

                        $currentIndex = 0;
                        if ($booking->status === 'confirmed' || $booking->status === 'phlebotomist_assigned') $currentIndex = 1;
                        elseif ($booking->status === 'sample_collected') $currentIndex = 2;
                        elseif ($booking->status === 'in_analysis') $currentIndex = 3;
                        elseif ($booking->status === 'report_ready' || $booking->status === 'completed') $currentIndex = 4;
                    @endphp

                    <!-- Visual Timeline Stepper -->
                    <div class="tracker-stepper-wrap">
                        <!-- Desktop Horizontal Stepper -->
                        <div class="tracker-stepper-horizontal">
                            <!-- Progress line -->
                            <div class="tracker-stepper-line">
                                <div class="tracker-stepper-line-fill" style="width: {{ ($currentIndex / 4) * 100 }}%;"></div>
                            </div>

                            @php $i = 0; @endphp
                            @foreach($statuses as $stKey => $stTitle)
                                @php
                                    $isPast = $i <= $currentIndex;
                                    $isCurrent = $i === $currentIndex;
                                    $i++;
                                @endphp
                                <div class="tracker-stepper-step">
                                    <div class="tracker-stepper-circle {{ $isCurrent ? 'active' : ($isPast ? 'completed' : '') }}">
                                        @if($isPast) ✓ @else {{ $loop->iteration }} @endif
                                    </div>
                                    <span class="tracker-stepper-label {{ $isCurrent ? 'current' : '' }}">
                                        {{ $stTitle }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Mobile Vertical Stepper (<=768px) -->
                        <div class="tracker-stepper-vertical">
                            <div class="tracker-stepper-vertical-line">
                                <div class="tracker-stepper-vertical-line-fill" style="height: {{ ($currentIndex / 4) * 100 }}%;"></div>
                            </div>

                            @php $j = 0; @endphp
                            @foreach($statuses as $stKey => $stTitle)
                                @php
                                    $isPast = $j <= $currentIndex;
                                    $isCurrent = $j === $currentIndex;
                                    $j++;
                                @endphp
                                <div class="tracker-stepper-vertical-step">
                                    <div class="tracker-stepper-circle {{ $isCurrent ? 'active' : ($isPast ? 'completed' : '') }}">
                                        @if($isPast) ✓ @else {{ $loop->iteration }} @endif
                                    </div>
                                    <div class="tracker-stepper-label {{ $isCurrent ? 'current' : '' }}">
                                        <strong>{{ $stTitle }}</strong>
                                        @if($isCurrent)
                                            <div style="font-size: 0.785rem; color: var(--primary); margin-top: 2px;">In Progress</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Report Download Action Box -->
                    @if($booking->report_file)
                        <div style="background: #f0fdf4; border: 1.5px solid #86efac; border-radius: var(--radius-lg); padding: 24px; text-align: center; margin-top: 30px;">
                            <div style="font-size: 2.2rem; margin-bottom: 8px;">📄</div>
                            <h3 style="color: #15803d; font-size: 1.3rem; margin-bottom: 6px;">Your Medical Report is Ready!</h3>
                            <p style="color: #166534; font-size: 0.9rem; margin-bottom: 18px;">
                                Pathologist verified on {{ $booking->report_uploaded_at ? $booking->report_uploaded_at->format('d M, Y h:i A') : 'Today' }}.
                            </p>
                            <a href="{{ asset('storage/' . $booking->report_file) }}" target="_blank" class="btn btn-primary btn-lg" style="background: #16a34a; border-color: #16a34a; width: 100%; max-width: 320px;">
                                📥 Download Digital PDF Report
                            </a>
                        </div>
                    @else
                        <div class="modern-card" style="padding: 20px; text-align: center; margin-top: 30px; font-size: 0.925rem; color: var(--text-secondary);">
                            <span style="font-size: 1.2rem;">⏳</span> Your test sample is currently progressing through analysis. Average turnaround is 6 to 12 hours. A copy will also be messaged automatically to <strong>{{ $booking->patient_phone }}</strong> on WhatsApp once ready.
                        </div>
                    @endif

                    <div style="margin-top: 24px; text-align: center;">
                        <a href="https://wa.me/916002509536?text=Hi%2C%20checking%20status%20for%20Booking%20ID%20{{ $booking->booking_code }}" target="_blank" rel="noopener" style="font-size: 0.875rem; color: #16a34a; font-weight: 600;">
                            💬 Need instant update? WhatsApp our lab coordinator
                        </a>
                    </div>
                </div>
            @else
                <div class="modern-card" style="text-align: center; padding: 50px 20px; border-radius: var(--radius-xl);">
                    <div style="font-size: 3rem; margin-bottom: 12px;">🔍</div>
                    <h3 style="font-size: 1.4rem; color: var(--text-heading); margin-bottom: 8px;">No matching records found</h3>
                    <p style="color: var(--text-muted); max-width: 450px; margin: 0 auto 20px;">
                        We couldn't locate any booking matching "<strong>{{ $query }}</strong>". Please verify your Booking ID or registered phone number.
                    </p>
                    <a href="tel:+916002509536" class="btn btn-outline">
                        📞 Call Support: 60025 09536
                    </a>
                </div>
            @endif
        @else
            <!-- Default Help Box -->
            <div class="form-row-2">
                <div class="modern-card" style="padding: 24px;">
                    <h3 style="font-size: 1.15rem; margin-bottom: 8px;">Where do I find my Booking ID?</h3>
                    <p style="font-size: 0.875rem; color: var(--text-muted); line-height: 1.5;">
                        Your Booking ID (e.g. <code>LVC-2026-XXXX</code>) was displayed on screen upon booking and sent via SMS / WhatsApp after confirmation.
                    </p>
                </div>
                <div class="modern-card" style="padding: 24px;">
                    <h3 style="font-size: 1.15rem; margin-bottom: 8px;">Can I search with Mobile Number?</h3>
                    <p style="font-size: 0.875rem; color: var(--text-muted); line-height: 1.5;">
                        Yes! Just type the 10-digit mobile number provided during sample booking to retrieve your most recent reports.
                    </p>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
