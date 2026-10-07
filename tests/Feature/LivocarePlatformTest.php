<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\MedicalPackage;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LivocarePlatformTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_homepage_loads_successfully_with_packages(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('LIVOCARE', false);
        $response->assertSee('Aarogyam Monsoon Basic Package');
    }

    public function test_packages_catalog_displays_and_filters(): void
    {
        $response = $this->get('/packages?category=diabetes');

        $response->assertStatus(200);
        $response->assertSee('Diabetic', false);

        $searchResponse = $this->get('/packages?search=Liver');
        $searchResponse->assertStatus(200);
        $searchResponse->assertSee('Liver Function', false);
    }

    public function test_package_detail_page_loads_with_parameters(): void
    {
        $pkg = MedicalPackage::where('slug', 'aarogyam-monsoon-basic-package')->first();
        $this->assertNotNull($pkg);

        $response = $this->get('/package/'.$pkg->slug);
        $response->assertStatus(200);
        $response->assertSee($pkg->name);
        $response->assertSee('Blood &amp; Urine', false);
    }

    public function test_patient_can_create_home_collection_booking(): void
    {
        $pkg = MedicalPackage::first();

        $bookingData = [
            'patient_name' => 'Rahul Sharma',
            'patient_phone' => '9876543210',
            'patient_email' => 'rahul@example.com',
            'patient_age' => 38,
            'patient_gender' => 'Male',
            'collection_type' => 'home_collection',
            'address' => 'House 42, Hatigaon Main Road, Guwahati',
            'preferred_date' => now()->addDay()->format('Y-m-d'),
            'time_slot' => '06:30 AM - 08:30 AM',
            'medical_package_id' => $pkg->id,
            'special_instructions' => 'Fasting test, call 10 mins before arrival',
        ];

        $response = $this->post('/book', $bookingData);

        $this->assertDatabaseHas('bookings', [
            'patient_name' => 'Rahul Sharma',
            'patient_phone' => '9876543210',
            'medical_package_id' => $pkg->id,
            'collection_type' => 'home_collection',
        ]);

        $booking = Booking::where('patient_phone', '9876543210')->first();
        $this->assertNotNull($booking);
        $this->assertStringStartsWith('LVC-2026-', $booking->booking_code);

        $response->assertRedirect(route('booking.confirmation', ['code' => $booking->booking_code]));

        $confirmResponse = $this->get(route('booking.confirmation', ['code' => $booking->booking_code]));
        $confirmResponse->assertStatus(200);
        $confirmResponse->assertSee($booking->booking_code);
    }

    public function test_patient_can_track_report_by_code_and_phone(): void
    {
        $pkg = MedicalPackage::first();
        $booking = Booking::create([
            'booking_code' => 'LVC-2026-TEST1',
            'patient_name' => 'Deepak Bora',
            'patient_phone' => '9854012345',
            'patient_email' => 'deepak@example.com',
            'patient_age' => 45,
            'patient_gender' => 'Male',
            'collection_type' => 'home_collection',
            'address' => 'Dispur, Guwahati',
            'preferred_date' => now()->format('Y-m-d'),
            'time_slot' => '08:30 AM - 10:30 AM',
            'medical_package_id' => $pkg->id,
            'package_name' => $pkg->name,
            'total_amount' => $pkg->discounted_price,
            'status' => 'pending',
        ]);

        $response = $this->get('/track-report?tracking_id='.$booking->booking_code);
        $response->assertStatus(200);
        $response->assertSee($booking->patient_name);
        $response->assertSee($booking->booking_code);

        $phoneResponse = $this->get('/track-report?tracking_id='.$booking->patient_phone);
        $phoneResponse->assertStatus(200);
        $phoneResponse->assertSee($booking->patient_name);
    }

    public function test_patient_can_upload_doctor_prescription(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('prescription.jpg', 200, 'image/jpeg');

        $response = $this->from('/upload-prescription')->post('/upload-prescription', [
            'patient_name' => 'Anuradha Das',
            'patient_phone' => '9123456789',
            'patient_email' => 'anuradha@example.com',
            'prescription_file' => $file,
            'notes' => 'Please quote the package price for these tests',
        ]);

        $response->assertRedirect('/upload-prescription');
        $response->assertSessionHas('prescription_success');

        $this->assertDatabaseHas('prescriptions', [
            'patient_name' => 'Anuradha Das',
            'patient_phone' => '9123456789',
        ]);
    }

    public function test_admin_portal_flow(): void
    {
        $admin = User::first();
        $this->assertNotNull($admin);

        // Access login view
        $loginView = $this->get('/admin/login');
        $loginView->assertStatus(200);
        $loginView->assertSee('admin-login-card');

        // Create a booking so table is rendered
        $pkg = MedicalPackage::first();
        Booking::create([
            'booking_code' => 'LVC-2026-ADM1',
            'patient_name' => 'Admin Test Patient',
            'patient_phone' => '9876500000',
            'patient_age' => 30,
            'patient_gender' => 'Female',
            'collection_type' => 'home_collection',
            'address' => 'Guwahati Test Address',
            'preferred_date' => now()->format('Y-m-d'),
            'time_slot' => '07:00 AM - 09:00 AM',
            'medical_package_id' => $pkg->id,
            'package_name' => $pkg->name,
            'total_amount' => $pkg->discounted_price,
            'status' => 'pending',
        ]);

        // Authenticate as admin
        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Patient Sample Bookings');
        $response->assertSee('admin-topbar');
        $response->assertSee('admin-table-responsive');
        $response->assertSee('admin-filter-scroll');
    }
}
