<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ContactMessage;
use App\Models\MedicalPackage;
use App\Models\Prescription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Show admin login form.
     */
    public function loginView(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Handle staff login.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')->with('success', 'Welcome back to Livocare Labs Admin Portal');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password credentials.',
        ])->onlyInput('email');
    }

    /**
     * Admin logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }

    /**
     * Staff / Admin Dashboard.
     */
    public function dashboard(Request $request): View
    {
        $statusFilter = $request->query('status');

        $bookingsQuery = Booking::with('medicalPackage')->latest();
        if ($statusFilter && $statusFilter !== 'all') {
            $bookingsQuery->where('status', $statusFilter);
        }
        $bookings = $bookingsQuery->paginate(15);

        $stats = [
            'total_bookings' => Booking::count(),
            'pending_pickups' => Booking::whereIn('status', ['pending', 'confirmed', 'phlebotomist_assigned'])->count(),
            'in_lab' => Booking::whereIn('status', ['sample_collected', 'in_analysis'])->count(),
            'reports_ready' => Booking::where('status', 'report_ready')->count(),
            'prescriptions_count' => Prescription::count(),
            'total_revenue' => Booking::where('status', 'completed')->sum('total_amount'),
        ];

        $prescriptions = Prescription::latest()->take(10)->get();
        $messages = ContactMessage::latest()->take(10)->get();
        $packages = MedicalPackage::orderBy('sort_order')->get();

        return view('admin.dashboard', compact('bookings', 'stats', 'prescriptions', 'messages', 'packages', 'statusFilter'));
    }

    /**
     * Update booking status.
     */
    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $booking = Booking::findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,confirmed,phlebotomist_assigned,sample_collected,in_analysis,report_ready,completed,cancelled'],
            'notes' => ['nullable', 'string'],
        ]);

        $booking->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', "Booking #{$booking->booking_code} status updated to ".ucfirst(str_replace('_', ' ', $validated['status'])));
    }

    /**
     * Upload digital test report for patient.
     */
    public function uploadReport(Request $request, int $id): RedirectResponse
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'report_file' => ['required', 'file', 'mimes:pdf,jpg,png', 'max:15360'],
        ]);

        $filePath = $request->file('report_file')->store('reports', 'public');

        $booking->update([
            'report_file' => $filePath,
            'report_uploaded_at' => now(),
            'status' => 'report_ready',
        ]);

        return back()->with('success', "Medical report uploaded for {$booking->patient_name}. Patient can now track & download it.");
    }
}
