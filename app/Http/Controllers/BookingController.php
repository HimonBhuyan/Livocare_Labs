<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ContactMessage;
use App\Models\MedicalPackage;
use App\Models\Prescription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Show booking form for home collection or lab visit.
     */
    public function create(Request $request): View
    {
        $selectedPackage = null;
        if ($request->has('package_id')) {
            $selectedPackage = MedicalPackage::find($request->input('package_id'));
        } elseif ($request->has('slug')) {
            $selectedPackage = MedicalPackage::where('slug', $request->input('slug'))->first();
        }

        $allPackages = MedicalPackage::where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.book', compact('selectedPackage', 'allPackages'));
    }

    /**
     * Store newly created booking into database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_name' => ['required', 'string', 'max:150'],
            'patient_phone' => ['required', 'string', 'max:20'],
            'patient_email' => ['nullable', 'email', 'max:150'],
            'patient_age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'patient_gender' => ['nullable', 'string', 'in:Male,Female,Other'],
            'collection_type' => ['required', 'string', 'in:home_collection,lab_visit'],
            'address' => ['nullable', 'string', 'max:500'],
            'preferred_date' => ['required', 'date', 'after_or_equal:today'],
            'time_slot' => ['required', 'string', 'max:50'],
            'medical_package_id' => ['nullable', 'exists:medical_packages,id'],
            'special_instructions' => ['nullable', 'string', 'max:1000'],
        ]);

        $package = null;
        $packageName = 'General Health Consultation';
        $totalAmount = 0.00;

        if (! empty($validated['medical_package_id'])) {
            $package = MedicalPackage::find($validated['medical_package_id']);
            if ($package) {
                $packageName = $package->name;
                $totalAmount = $package->discounted_price;
            }
        }

        // Generate unique booking code
        $bookingCode = 'LVC-'.date('Y').'-'.strtoupper(substr(uniqid(), -5));

        $booking = Booking::create([
            'booking_code' => $bookingCode,
            'patient_name' => $validated['patient_name'],
            'patient_phone' => $validated['patient_phone'],
            'patient_email' => $validated['patient_email'] ?? null,
            'patient_age' => $validated['patient_age'] ?? null,
            'patient_gender' => $validated['patient_gender'] ?? 'Not Specified',
            'collection_type' => $validated['collection_type'],
            'address' => $validated['address'] ?? ($validated['collection_type'] === 'lab_visit' ? 'In-Lab Visit (Hatigaon, Guwahati)' : 'Doorstep Collection'),
            'city' => 'Guwahati',
            'preferred_date' => $validated['preferred_date'],
            'time_slot' => $validated['time_slot'],
            'medical_package_id' => $package ? $package->id : null,
            'package_name' => $packageName,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'special_instructions' => $validated['special_instructions'] ?? null,
        ]);

        return redirect()->route('booking.confirmation', ['code' => $booking->booking_code])
            ->with('success', 'Your booking has been received successfully! Our phlebotomist team will call you shortly.');
    }

    /**
     * Show booking confirmation receipt.
     */
    public function confirmation(string $code): View
    {
        $booking = Booking::with('medicalPackage')->where('booking_code', $code)->firstOrFail();

        return view('pages.booking-confirmation', compact('booking'));
    }

    /**
     * Handle prescription upload.
     */
    public function uploadPrescription(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_name' => ['required', 'string', 'max:150'],
            'patient_phone' => ['required', 'string', 'max:20'],
            'patient_email' => ['nullable', 'email', 'max:150'],
            'prescription_file' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf,webp', 'max:10240'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $filePath = $request->file('prescription_file')->store('prescriptions', 'public');

        Prescription::create([
            'patient_name' => $validated['patient_name'],
            'patient_phone' => $validated['patient_phone'],
            'patient_email' => $validated['patient_email'] ?? null,
            'file_path' => $filePath,
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->back()->with('prescription_success', 'Prescription uploaded successfully! Our medical team in Guwahati will analyze the doctor\'s advice and call you back with the test list and discounted quotation within 15 minutes.');
    }

    /**
     * Handle contact message submission.
     */
    public function contactSubmit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:150'],
            'subject' => ['nullable', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ContactMessage::create($validated);

        return redirect()->back()->with('contact_success', 'Thank you! Your inquiry has been submitted. Our lab team will get in touch with you right away.');
    }
}
