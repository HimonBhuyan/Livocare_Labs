<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\MedicalPackage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the modern homepage.
     */
    public function index(): View
    {
        $featuredPackages = MedicalPackage::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->get();

        $allPackages = MedicalPackage::where('is_active', true)
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        $categories = [
            'full_body' => 'Full Body Checkups',
            'diabetes' => 'Diabetes Screening',
            'liver' => 'Liver Function',
            'kidney' => 'Renal / Kidney Care',
            'cardiac' => 'Heart & Lipid Profile',
            'thyroid' => 'Thyroid & Hormones',
            'vitamins' => 'Vitamins & Nutrition',
            'fever' => 'Seasonal & Fever Panels',
        ];

        return view('pages.home', compact('featuredPackages', 'allPackages', 'categories'));
    }

    /**
     * Display the catalog of tests & health packages.
     */
    public function packages(Request $request): View
    {
        $category = $request->query('category');
        $search = $request->query('search');
        $sort = $request->query('sort', 'popular');

        $query = MedicalPackage::where('is_active', true);

        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('category_label', 'like', "%{$search}%");
            });
        }

        if ($sort === 'price_asc') {
            $query->orderBy('discounted_price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('discounted_price', 'desc');
        } else {
            $query->orderBy('sort_order', 'asc');
        }

        $packages = $query->paginate(12)->withQueryString();

        $categories = [
            'all' => 'All Tests & Packages',
            'full_body' => 'Full Body Health',
            'diabetes' => 'Diabetes Care',
            'liver' => 'Liver Health',
            'kidney' => 'Kidney & Renal',
            'cardiac' => 'Heart & Lipid',
            'thyroid' => 'Thyroid & Hormones',
            'vitamins' => 'Vitamins & Minerals',
            'fever' => 'Fever Panels',
        ];

        return view('pages.packages', compact('packages', 'categories', 'category', 'search', 'sort'));
    }

    /**
     * Display single package / test detailed page.
     */
    public function packageDetail(string $slug): View
    {
        $package = MedicalPackage::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $relatedPackages = MedicalPackage::where('category', $package->category)
            ->where('id', '!=', $package->id)
            ->take(3)
            ->get();

        if ($relatedPackages->isEmpty()) {
            $relatedPackages = MedicalPackage::where('is_featured', true)
                ->where('id', '!=', $package->id)
                ->take(3)
                ->get();
        }

        return view('pages.package-detail', compact('package', 'relatedPackages'));
    }

    /**
     * About Livocare Labs Guwahati.
     */
    public function about(): View
    {
        return view('pages.about');
    }

    /**
     * Contact Page.
     */
    public function contact(): View
    {
        return view('pages.contact');
    }

    /**
     * Upload Prescription View.
     */
    public function uploadPrescriptionView(): View
    {
        return view('pages.upload-prescription');
    }

    /**
     * Track Patient Report & Booking Status.
     */
    public function trackReport(Request $request): View
    {
        $query = trim((string) $request->input('tracking_id'));
        $booking = null;
        $searched = false;

        if (! empty($query)) {
            $searched = true;
            $booking = Booking::with('medicalPackage')
                ->where('booking_code', $query)
                ->orWhere('patient_phone', $query)
                ->latest()
                ->first();
        }

        return view('pages.track-report', compact('booking', 'query', 'searched'));
    }
}
