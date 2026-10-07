@extends('layouts.app')

@section('title', 'Booking Confirmed - Livocare Labs')

@section('content')

<section class="section-padding">
    <div class="container container-narrow">
        <div class="modern-card" style="text-align: center; box-shadow: var(--shadow-xl);">
            <!-- Success Icon -->
            <div style="width: 72px; height: 72px; border-radius: 50%; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>

            <span class="badge-tag badge-emerald" style="margin-bottom: 8px;">Order Successfully Placed</span>
            <h1 style="font-size: clamp(1.85rem, 5vw, 2.2rem); color: var(--text-heading); margin-bottom: 10px;">Booking Confirmed!</h1>
            <p style="color: var(--text-muted); font-size: 1.05rem; margin-bottom: 30px;">
                Thank you, <strong>{{ $booking->patient_name }}</strong>. Our Guwahati phlebotomist team has received your appointment request.
            </p>

            <!-- Booking Card Box -->
            <div class="modern-card" style="padding: 24px; text-align: left; margin-bottom: 32px;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed var(--border); padding-bottom: 16px; margin-bottom: 16px; flex-wrap: wrap; gap: 8px;">
                    <div>
                        <div style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Booking Reference ID</div>
                        <div style="font-size: 1.5rem; font-weight: 800; color: var(--primary); font-family: var(--font-heading);">
                            #{{ $booking->booking_code }}
                        </div>
                    </div>
                    <span class="badge-tag badge-primary">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span>
                </div>

                <div class="booking-details-grid">
                    <div>
                        <span style="color: var(--text-muted); display: block; font-size: 0.8rem;">Patient Name:</span>
                        <strong>{{ $booking->patient_name }} ({{ $booking->patient_age }}y / {{ $booking->patient_gender }})</strong>
                    </div>

                    <div>
                        <span style="color: var(--text-muted); display: block; font-size: 0.8rem;">Contact Phone:</span>
                        <strong>{{ $booking->patient_phone }}</strong>
                    </div>

                    <div>
                        <span style="color: var(--text-muted); display: block; font-size: 0.8rem;">Package / Test:</span>
                        <strong>{{ $booking->package_name }}</strong>
                    </div>

                    <div>
                        <span style="color: var(--text-muted); display: block; font-size: 0.8rem;">Scheduled Date & Slot:</span>
                        <strong>{{ $booking->preferred_date->format('d M, Y') }} ({{ $booking->time_slot }})</strong>
                    </div>

                    <div style="grid-column: span 2;">
                        <span style="color: var(--text-muted); display: block; font-size: 0.8rem;">Collection Location:</span>
                        <strong>{{ $booking->address }}, Guwahati</strong>
                    </div>

                    <div style="grid-column: span 2; border-top: 1px dashed var(--border); padding-top: 14px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                        <span style="font-size: 1.05rem; font-weight: 600; color: var(--text-heading);">Total Amount Payable:</span>
                        <span style="font-size: 1.6rem; font-weight: 800; color: var(--text-heading);">
                            ₹{{ number_format($booking->total_amount) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Pre-filled WhatsApp notification button -->
            @php
                $waText = "Hello Livocare Labs, I have booked an appointment online!%0ABooking ID: {$booking->booking_code}%0APatient: {$booking->patient_name}%0APhone: {$booking->patient_phone}%0APackage: {$booking->package_name}%0ADate: {$booking->preferred_date->format('d M Y')}%0ASlot: {$booking->time_slot}%0AAddress: {$booking->address}";
            @endphp

            <div style="display: flex; flex-direction: column; gap: 12px; max-width: 440px; margin: 0 auto;">
                <a href="https://wa.me/916002509536?text={{ $waText }}" target="_blank" rel="noopener" class="btn btn-primary btn-lg" style="background: #25d366; border-color: #25d366; color: #ffffff;">
                    💬 Send Details to Lab on WhatsApp
                </a>

                <a href="{{ route('track.report', ['tracking_id' => $booking->booking_code]) }}" class="btn btn-outline">
                    Track Live Report Status
                </a>

                <a href="{{ route('home') }}" style="font-size: 0.875rem; color: var(--text-muted); margin-top: 8px;">
                    Return to Homepage
                </a>
            </div>

            <div style="margin-top: 40px; padding: 18px; background: #fffbeb; border: 1px solid #fef3c7; border-radius: var(--radius-md); font-size: 0.875rem; color: #92400e; text-align: left;">
                <strong>⚠️ Patient Preparation Reminder:</strong> If your package includes fasting blood sugar or lipid profile, please ensure 10-12 hours of overnight fasting before the phlebotomist arrives. You may have sips of plain water.
            </div>
        </div>
    </div>
</section>

@endsection
