@extends('layouts.app')

@section('title', 'Contact Us & Laboratory Location in Guwahati - Livocare Labs')
@section('meta_description', 'Contact Livocare Labs at Hatigaon, Anupam Nagar, Guwahati. Call +91 60025 09536 or send an inquiry for tests, home collections, or doctor tie-ups.')

@section('content')

<!-- Header Banner -->
<section class="page-header-banner">
    <div class="container">
        <div style="max-width: 750px;">
            <div class="badge-tag badge-primary" style="background: rgba(2, 132, 199, 0.3); color: #7dd3fc; margin-bottom: 12px;">Get In Touch</div>
            <h1 style="color: #ffffff; font-size: 2.75rem; margin-bottom: 12px;">Contact Livocare Labs</h1>
            <p style="color: #cbd5e1; font-size: 1.1rem; line-height: 1.6;">
                Have questions about a blood test, need to schedule corporate screenings, or want doorstep collection? Our Guwahati team is here to assist.
            </p>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">

        @if(session('contact_success'))
            <div style="background: #ecfdf5; border: 1.5px solid #a7f3d0; border-radius: var(--radius-lg); padding: 20px 24px; margin-bottom: 36px; display: flex; gap: 14px; align-items: center; color: #065f46; box-shadow: var(--shadow-sm);">
                <div style="width: 32px; height: 32px; border-radius: 50%; background: #10b981; color: #ffffff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: 700;">✓</div>
                <div style="font-weight: 600; font-size: 0.95rem;">{{ session('contact_success') }}</div>
            </div>
        @endif

        <div class="responsive-split-reverse">
            <!-- Left Contact Info Cards -->
            <div>
                <div class="modern-card" style="margin-bottom: 24px;">
                    <h2 style="font-size: 1.5rem; margin-bottom: 24px;">Lab Center Contact Details</h2>

                    <div style="display: flex; flex-direction: column; gap: 24px;">
                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="width: 44px; height: 44px; border-radius: var(--radius-md); background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h4 style="font-size: 1.05rem; margin-bottom: 4px;">Laboratory Location</h4>
                                <p style="font-size: 0.925rem; color: var(--text-muted); line-height: 1.5;">
                                    Hatigaon, Anupam Nagar, Guwahati, Assam - 781038
                                </p>
                            </div>
                        </div>

                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="width: 44px; height: 44px; border-radius: var(--radius-md); background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <h4 style="font-size: 1.05rem; margin-bottom: 4px;">Direct Phone / WhatsApp</h4>
                                <p style="font-size: 0.925rem; color: var(--text-muted); line-height: 1.5;">
                                    <a href="tel:+916002509536" style="color: var(--primary); font-weight: 700;">+91 60025 09536</a><br>
                                    <span style="font-size: 0.85rem;">(Available 7 days a week)</span>
                                </p>
                            </div>
                        </div>

                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="width: 44px; height: 44px; border-radius: var(--radius-md); background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 style="font-size: 1.05rem; margin-bottom: 4px;">Email Support</h4>
                                <p style="font-size: 0.925rem; color: var(--text-muted); line-height: 1.5;">
                                    Livocarelabs@gmail.com
                                </p>
                            </div>
                        </div>

                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="width: 44px; height: 44px; border-radius: var(--radius-md); background: #ede9fe; color: #7c3aed; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 style="font-size: 1.05rem; margin-bottom: 4px;">Operating Hours</h4>
                                <p style="font-size: 0.925rem; color: var(--text-muted); line-height: 1.5;">
                                    Monday – Saturday: <strong>6:30 AM – 8:30 PM</strong><br>
                                    Sunday: <strong>7:00 AM – 2:00 PM</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Google Map Embed Box -->
                <div class="modern-card" style="padding: 16px; overflow: hidden; margin-bottom: 24px;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14327.348496452243!2d91.78280655!3d26.13689455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375a593e8e19c3b1%3A0xb5b7df7db61a7a28!2sHatigaon%2C%20Guwahati%2C%20Assam!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" 
                        width="100%" 
                        height="240" 
                        style="border:0; border-radius: var(--radius-md);" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Right Contact Form -->
            <div class="modern-card" style="box-shadow: var(--shadow-xl);">
                <h2 style="font-size: 1.6rem; margin-bottom: 8px;">Send an Inquiry</h2>
                <p style="color: var(--text-muted); font-size: 0.925rem; margin-bottom: 28px;">
                    Fill out the form below and our diagnostic patient coordinator will respond promptly.
                </p>

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf

                    <div class="form-group form-row-2">
                        <div>
                            <label class="form-label">Your Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Bipul Goswami" required>
                        </div>
                        <div>
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" name="phone" class="form-control" placeholder="10-digit mobile" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Inquiry Subject</label>
                        <select name="subject" class="form-control">
                            <option value="Home Sample Collection">Home Sample Collection Query</option>
                            <option value="Health Package Details">Health Checkup Package Details</option>
                            <option value="Report Status Query">Report Delivery / Status Inquiry</option>
                            <option value="Corporate / Doctor Tie-up">Corporate / Doctor Partnership</option>
                            <option value="Other">Other Query</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message / Details *</label>
                        <textarea name="message" rows="4" class="form-control" placeholder="Please describe how we can assist you..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                        Submit Inquiry Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
