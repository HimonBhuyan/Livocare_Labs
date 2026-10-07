@extends('layouts.app')

@section('title', 'Book Home Sample Collection in Guwahati - Livocare Labs')
@section('meta_description', 'Book an in-home blood sample collection or lab appointment in Guwahati. Professional phlebotomist visits your doorstep.')

@section('content')

<!-- Header Banner -->
<section class="page-header-banner">
    <div class="container container-narrow" style="text-align: center;">
        <span class="badge-tag badge-primary" style="background: rgba(2, 132, 199, 0.3); color: #7dd3fc; margin-bottom: 12px;">Doorstep Phlebotomy</span>
        <h1 style="color: #ffffff; font-size: 2.5rem; margin-bottom: 10px;">Book Home Sample Collection</h1>
        <p style="color: #cbd5e1; font-size: 1.05rem;">
            Free sample pickup across Guwahati. Fill in patient details below and our lab will assign a certified phlebotomist.
        </p>
    </div>
</section>

<section class="section-padding">
    <div class="container container-narrow">
        <div class="modern-card" style="box-shadow: var(--shadow-xl);">
            <form action="{{ route('booking.store') }}" method="POST" id="mainBookingForm">
                @csrf

                <!-- Section 1: Health Package -->
                <div style="margin-bottom: 32px; padding-bottom: 24px; border-bottom: 1px solid var(--border);">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--primary); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700;">1</div>
                        <h2 style="font-size: 1.35rem;">Select Test or Health Checkup</h2>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Chosen Package *</label>
                        <select name="medical_package_id" id="packageSelect" class="form-control" required style="font-weight: 600;">
                            <option value="" disabled {{ !$selectedPackage ? 'selected' : '' }}>-- Select Diagnostic Package --</option>
                            @foreach($allPackages as $pkg)
                                <option value="{{ $pkg->id }}" 
                                        data-price="{{ $pkg->discounted_price }}"
                                        data-count="{{ $pkg->test_count }}"
                                        {{ ($selectedPackage && $selectedPackage->id == $pkg->id) ? 'selected' : '' }}>
                                    {{ $pkg->name }} ({{ $pkg->test_count }} Tests) - ₹{{ number_format($pkg->discounted_price) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="selectedPackageSummary" style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: var(--radius-md); padding: 14px 18px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-top: 12px;">
                        <div>
                            <div style="font-weight: 700; color: #166534;" id="summaryPkgName">
                                {{ $selectedPackage ? $selectedPackage->name : 'Select a package above' }}
                            </div>
                            <div style="font-size: 0.825rem; color: #15803d;" id="summaryPkgDetails">
                                {{ $selectedPackage ? $selectedPackage->test_count . ' Tests Included • Same-day digital report' : 'Free home collection in Guwahati' }}
                            </div>
                        </div>
                        <div style="font-size: 1.5rem; font-weight: 800; color: #166534;" id="summaryPkgPrice">
                            ₹{{ $selectedPackage ? number_format($selectedPackage->discounted_price) : '0' }}
                        </div>
                    </div>
                </div>

                <!-- Section 2: Patient Details -->
                <div style="margin-bottom: 32px; padding-bottom: 24px; border-bottom: 1px solid var(--border);">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--primary); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700;">2</div>
                        <h2 style="font-size: 1.35rem;">Patient Information</h2>
                    </div>

                    <div class="form-group form-row-phone-age">
                        <div>
                            <label class="form-label">Full Name of Patient *</label>
                            <input type="text" name="patient_name" class="form-control" placeholder="e.g. Ramesh Sarma" required>
                        </div>
                        <div>
                            <label class="form-label">WhatsApp Mobile Number *</label>
                            <input type="tel" name="patient_phone" class="form-control" placeholder="10-digit phone" required>
                        </div>
                    </div>

                    <div class="form-group form-row-3">
                        <div>
                            <label class="form-label">Age *</label>
                            <input type="number" name="patient_age" class="form-control" placeholder="Age" min="1" max="120" required>
                        </div>
                        <div>
                            <label class="form-label">Gender *</label>
                            <select name="patient_gender" class="form-control" required>
                                <option value="" disabled selected>-- Gender --</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Email (Optional)</label>
                            <input type="email" name="patient_email" class="form-control" placeholder="For PDF report copy">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Appointment Schedule & Collection Location -->
                <div style="margin-bottom: 32px;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--primary); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700;">3</div>
                        <h2 style="font-size: 1.35rem;">Pickup Schedule & Location</h2>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Collection Type *</label>
                        <div class="collection-type-grid">
                            <label style="border: 2px solid var(--primary); padding: 14px; border-radius: var(--radius-md); cursor: pointer; display: flex; align-items: center; gap: 10px;">
                                <input type="radio" name="collection_type" value="home_collection" checked id="typeHomeRadio">
                                <div>
                                    <strong style="color: var(--text-heading);">Home Sample Pickup</strong>
                                    <div style="font-size: 0.8rem; color: var(--text-muted);">Free doorstep visit in Guwahati</div>
                                </div>
                            </label>

                            <label style="border: 1px solid var(--border); padding: 14px; border-radius: var(--radius-md); cursor: pointer; display: flex; align-items: center; gap: 10px;">
                                <input type="radio" name="collection_type" value="lab_visit" id="typeLabRadio">
                                <div>
                                    <strong style="color: var(--text-heading);">Walk-in Lab Visit</strong>
                                    <div style="font-size: 0.8rem; color: var(--text-muted);">Hatigaon, Anupam Nagar</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="form-group form-row-2">
                        <div>
                            <label class="form-label">Preferred Date *</label>
                            <input type="date" name="preferred_date" id="preferredDateInput" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div>
                            <label class="form-label">Preferred Time Slot *</label>
                            <select name="time_slot" class="form-control" required>
                                <option value="06:30 AM - 08:30 AM">06:30 AM - 08:30 AM (Recommended for Fasting)</option>
                                <option value="08:30 AM - 10:30 AM" selected>08:30 AM - 10:30 AM</option>
                                <option value="10:30 AM - 12:30 PM">10:30 AM - 12:30 PM</option>
                                <option value="04:00 PM - 06:30 PM">04:00 PM - 06:30 PM (Evening)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="addressFieldGroup">
                        <label class="form-label">Doorstep Address in Guwahati *</label>
                        <textarea name="address" rows="2" class="form-control" placeholder="House/Flat number, Landmark, Area (e.g. Hatigaon, Dispur, Kahilipara, Bhangagarh, Ulubari)..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Special Instructions or Notes (Optional)</label>
                        <input type="text" name="special_instructions" class="form-control" placeholder="e.g. Elderly patient, please call 10 mins before arriving...">
                    </div>
                </div>

                <div class="modern-card" style="padding: 18px; margin-bottom: 24px;">
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 0.875rem; color: var(--text-heading); font-weight: 600;">
                        <span style="color: var(--accent-emerald);">✓</span> Pay securely after sample collection (UPI / Cash / Card)
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 0.875rem; color: var(--text-heading); font-weight: 600; margin-top: 6px;">
                        <span style="color: var(--accent-emerald);">✓</span> 100% Free Doorstep Collection across Guwahati
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                    Confirm Appointment & Request Phlebotomist
                </button>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    const pkgSelect = document.getElementById('packageSelect');
    const summaryName = document.getElementById('summaryPkgName');
    const summaryDetails = document.getElementById('summaryPkgDetails');
    const summaryPrice = document.getElementById('summaryPkgPrice');

    if (pkgSelect) {
        pkgSelect.addEventListener('change', () => {
            const opt = pkgSelect.options[pkgSelect.selectedIndex];
            if (opt) {
                summaryName.textContent = opt.text.split(' - ')[0];
                const count = opt.getAttribute('data-count');
                const price = opt.getAttribute('data-price');
                summaryDetails.textContent = `${count} Tests Included • Same-day digital report`;
                summaryPrice.textContent = `₹${Number(price).toLocaleString('en-IN')}`;
            }
        });
    }

    const typeHome = document.getElementById('typeHomeRadio');
    const typeLab = document.getElementById('typeLabRadio');
    const addressGroup = document.getElementById('addressFieldGroup');

    if (typeHome && typeLab && addressGroup) {
        typeHome.addEventListener('change', () => {
            addressGroup.style.display = 'block';
            addressGroup.querySelector('textarea').required = true;
        });
        typeLab.addEventListener('change', () => {
            addressGroup.style.display = 'none';
            addressGroup.querySelector('textarea').required = false;
        });
    }
</script>
@endpush

@endsection
