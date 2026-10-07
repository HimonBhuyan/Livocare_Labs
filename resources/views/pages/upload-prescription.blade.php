@extends('layouts.app')

@section('title', 'Upload Doctor\'s Prescription - Livocare Labs Guwahati')
@section('meta_description', 'Upload your doctor\'s prescription. Livocare Labs pathologists will select the recommended blood tests with maximum discounts and arrange doorstep sample collection.')

@section('content')

<!-- Header Banner -->
<section class="page-header-banner">
    <div class="container container-narrow" style="text-align: center;">
        <span class="badge-tag badge-primary" style="background: rgba(2, 132, 199, 0.3); color: #7dd3fc; margin-bottom: 12px;">Fast Pathologist Callback</span>
        <h1 style="color: #ffffff; font-size: 2.5rem; margin-bottom: 10px;">Upload Doctor's Prescription</h1>
        <p style="color: #cbd5e1; font-size: 1.05rem;">
            Can't read handwritten tests? Upload a photo of your doctor's slip and our Guwahati lab team will prepare your test basket in 15 minutes.
        </p>
    </div>
</section>

<section class="section-padding">
    <div class="container container-narrow">

        @if(session('prescription_success'))
            <div style="background: #ecfdf5; border: 1.5px solid #a7f3d0; border-radius: var(--radius-lg); padding: 24px; margin-bottom: 30px; display: flex; gap: 16px; align-items: flex-start; color: #065f46; box-shadow: var(--shadow-md);">
                <div style="width: 36px; height: 36px; border-radius: 50%; background: #10b981; color: #ffffff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: 700;">✓</div>
                <div>
                    <h3 style="color: #065f46; font-size: 1.2rem; margin-bottom: 4px;">Prescription Received!</h3>
                    <p style="font-size: 0.95rem; line-height: 1.5;">{{ session('prescription_success') }}</p>
                </div>
            </div>
        @endif

        <div class="modern-card" style="box-shadow: var(--shadow-xl);">
            <form action="{{ route('prescription.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="margin-bottom: 28px;">
                    <h2 style="font-size: 1.4rem; margin-bottom: 8px;">Upload Prescription Image / PDF</h2>
                    <p style="font-size: 0.875rem; color: var(--text-muted);">
                        Take a clear photo of the prescription or upload an existing PDF file. Maximum file size: 10MB.
                    </p>
                </div>

                <!-- File Drop Zone -->
                <div class="form-group" style="margin-bottom: 24px;">
                    <label class="form-label">Attach File *</label>
                    <div class="dropzone-box" style="border: 2px dashed #93c5fd; background: #f0f9ff; border-radius: var(--radius-lg); padding: 32px 20px; text-align: center; cursor: pointer;" onclick="document.getElementById('rxFileInput').click()">
                        <div style="font-size: 2.5rem; margin-bottom: 8px;">📋</div>
                        <strong style="color: var(--primary); font-size: 1rem; display: block; margin-bottom: 4px;">Click here to choose file from your device</strong>
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block;" id="rxFileChosenLabel">
                            Supports JPG, PNG, WEBP, or PDF
                        </span>
                        <input type="file" name="prescription_file" id="rxFileInput" style="display: none;" accept="image/*,.pdf" required onchange="handleFileSelect(this)">
                    </div>
                </div>

                <div class="form-group form-row-2">
                    <div>
                        <label class="form-label">Patient Name *</label>
                        <input type="text" name="patient_name" class="form-control" placeholder="e.g. Minati Devi" required>
                    </div>
                    <div>
                        <label class="form-label">Contact Mobile / WhatsApp *</label>
                        <input type="tel" name="patient_phone" class="form-control" placeholder="10-digit mobile" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address (Optional)</label>
                    <input type="email" name="patient_email" class="form-control" placeholder="To receive quotation by email">
                </div>

                <div class="form-group">
                    <label class="form-label">Any specific questions or instructions for our pathologist?</label>
                    <textarea name="notes" rows="3" class="form-control" placeholder="e.g. Need home pickup tomorrow morning at Hatigaon, or check if fasting is required for these tests..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                    Submit Prescription for Review
                </button>
            </form>
        </div>

        <!-- 3 Step Flow -->
        <div class="flow-steps-3" style="margin-top: 40px; text-align: center;">
            <div class="modern-card" style="padding: 24px;">
                <div style="font-size: 2rem; margin-bottom: 8px;">1️⃣</div>
                <h4 style="font-size: 1rem; margin-bottom: 4px;">Upload Photo</h4>
                <p style="font-size: 0.825rem; color: var(--text-muted);">Snap a photo of the slip from your phone.</p>
            </div>
            <div class="modern-card" style="padding: 24px;">
                <div style="font-size: 2rem; margin-bottom: 8px;">2️⃣</div>
                <h4 style="font-size: 1rem; margin-bottom: 4px;">Doctor Review</h4>
                <p style="font-size: 0.825rem; color: var(--text-muted);">Our pathologist decodes all test items.</p>
            </div>
            <div class="modern-card" style="padding: 24px;">
                <div style="font-size: 2rem; margin-bottom: 8px;">3️⃣</div>
                <h4 style="font-size: 1rem; margin-bottom: 4px;">15-Min Callback</h4>
                <p style="font-size: 0.825rem; color: var(--text-muted);">Receive pricing quote & slot confirmation.</p>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function handleFileSelect(input) {
        const label = document.getElementById('rxFileChosenLabel');
        if (input.files && input.files[0]) {
            label.textContent = "Selected: " + input.files[0].name + " (" + (input.files[0].size / 1024 / 1024).toFixed(2) + " MB)";
            label.style.color = "#0284c7";
            label.style.fontWeight = "bold";
        }
    }
</script>
@endpush

@endsection
