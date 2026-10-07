@extends('layouts.app')

@section('title', 'About Us - Livocare Diagnostic & Research Labs Guwahati')
@section('meta_description', 'Learn about Livocare Labs Guwahati. Committed to clinical precision, high-tech automation, and patient-centric diagnostic pathology.')

@section('content')

<!-- Header Banner -->
<section class="page-header-banner">
    <div class="container">
        <div style="max-width: 750px;">
            <div class="badge-tag badge-primary" style="background: rgba(2, 132, 199, 0.3); color: #7dd3fc; margin-bottom: 12px;">About Our Facility</div>
            <h1 style="color: #ffffff; font-size: clamp(1.85rem, 5.5vw, 2.75rem); margin-bottom: 12px;">Precision Diagnostics with Compassionate Care</h1>
            <p style="color: #cbd5e1; font-size: 1.1rem; line-height: 1.6;">
                Founded in Guwahati with a clear vision: bringing world-class laboratory pathology, reliable digital reporting, and doorstep convenience to every family in Assam.
            </p>
        </div>
    </div>
</section>

<!-- Vision & Story -->
<section class="section-padding">
    <div class="container">
        <div class="responsive-split" style="align-items: center;">
            <div>
                <span class="badge-tag badge-primary" style="margin-bottom: 10px;">Our Mission</span>
                <h2 style="font-size: clamp(1.65rem, 5vw, 2.2rem); margin-bottom: 20px;">Redefining the Pathology Experience in Northeast India</h2>
                <p style="color: var(--text-secondary); font-size: 1.05rem; line-height: 1.7; margin-bottom: 18px;">
                    At <strong>Livocare Labs</strong>, we believe an accurate diagnostic report is the foundation of effective medical treatment. A doctor's diagnosis and a patient's recovery hinge directly on the fidelity of laboratory data.
                </p>
                <p style="color: var(--text-secondary); font-size: 1.05rem; line-height: 1.7; margin-bottom: 24px;">
                    Located centrally in <strong>Hatigaon, Guwahati</strong>, our facility combines cutting-edge automated robotic analyzers with rigorous multi-tier pathologist reviews. We eliminate the stress of crowded hospital waiting rooms by bringing clinical phlebotomy directly to your doorstep.
                </p>

                <div class="form-row-2">
                    <div style="background: #f8fafc; border-left: 4px solid var(--primary); padding: 16px 20px; border-radius: 0 var(--radius-md) var(--radius-md) 0;">
                        <h4 style="font-size: 1.1rem; color: var(--text-heading); margin-bottom: 4px;">Zero Contamination</h4>
                        <p style="font-size: 0.85rem; color: var(--text-muted);">Pre-vacuum closed tubes ensure sterile sampling.</p>
                    </div>

                    <div style="background: #f8fafc; border-left: 4px solid var(--teal); padding: 16px 20px; border-radius: 0 var(--radius-md) var(--radius-md) 0;">
                        <h4 style="font-size: 1.1rem; color: var(--text-heading); margin-bottom: 4px;">Smart Automation</h4>
                        <p style="font-size: 0.85rem; color: var(--text-muted);">Bidirectional analyzer interfaces avoid transcription errors.</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="modern-card" style="background: linear-gradient(180deg, #ffffff 0%, #f0fdf4 100%); border: 1.5px solid #bbf7d0;">
                    <span class="badge-tag badge-emerald" style="margin-bottom: 12px;">Guwahati Center Highlights</span>
                    <h3 style="font-size: 1.4rem; margin-bottom: 16px; color: var(--text-heading);">Our Clinical Standards</h3>
                    
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 14px; font-size: 0.95rem;">
                        <li style="display: flex; gap: 12px; align-items: flex-start;">
                            <span style="color: #16a34a; font-weight: 700; font-size: 1.2rem;">✓</span>
                            <span><strong>Internal Quality Control (IQC):</strong> Automated daily calibration runs before analyzing patient batches.</span>
                        </li>
                        <li style="display: flex; gap: 12px; align-items: flex-start;">
                            <span style="color: #16a34a; font-weight: 700; font-size: 1.2rem;">✓</span>
                            <span><strong>Cold Chain Sample Integrity:</strong> Temperature-controlled cool bags during doorstep transit.</span>
                        </li>
                        <li style="display: flex; gap: 12px; align-items: flex-start;">
                            <span style="color: #16a34a; font-weight: 700; font-size: 1.2rem;">✓</span>
                            <span><strong>Pathologist Consultation:</strong> Direct access to speak with our doctors regarding abnormal markers.</span>
                        </li>
                        <li style="display: flex; gap: 12px; align-items: flex-start;">
                            <span style="color: #16a34a; font-weight: 700; font-size: 1.2rem;">✓</span>
                            <span><strong>WhatsApp Report Cloud:</strong> Permanent access to historical test records on your smartphone.</span>
                        </li>
                    </ul>

                    <div style="margin-top: 24px; padding-top: 20px; border-top: 1px dashed #86efac; text-align: center;">
                        <a href="{{ route('booking.create') }}" class="btn btn-primary" style="width: 100%;">
                            Book a Home Collection Today
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values & Ethics -->
<section class="section-padding section-alt">
    <div class="container">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 48px;">
            <span class="badge-tag badge-primary" style="margin-bottom: 8px;">Our Core Pillars</span>
            <h2 style="font-size: clamp(1.75rem, 5vw, 2.25rem);">Built on Trust & Scientific Integrity</h2>
        </div>

        <div class="flow-steps-3">
            <div class="modern-card">
                <div style="font-size: 2.2rem; margin-bottom: 12px;">🔬</div>
                <h3 style="font-size: 1.25rem; margin-bottom: 8px;">Scientific Accuracy</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6;">
                    No shortcuts, no compromises. We maintain strict internal protocols and run external quality assurance programs.
                </p>
            </div>

            <div class="modern-card">
                <div style="font-size: 2.2rem; margin-bottom: 12px;">🤝</div>
                <h3 style="font-size: 1.25rem; margin-bottom: 8px;">Patient First</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6;">
                    From painless capillary draws to compassionate elderly care, our phlebotomists are trained in patient empathy.
                </p>
            </div>

            <div class="modern-card" style="padding: 32px;">
                <div style="font-size: 2.2rem; margin-bottom: 12px;">⚡</div>
                <h3 style="font-size: 1.25rem; margin-bottom: 8px;">Digital Efficiency</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6;">
                    Track test status live online, receive WhatsApp alerts, and download high-resolution PDF reports anywhere in the world.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
