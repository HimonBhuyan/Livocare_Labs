<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Public Front-Facing Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/packages', [HomeController::class, 'packages'])->name('packages.index');
Route::get('/package/{slug}', [HomeController::class, 'packageDetail'])->name('package.show');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [BookingController::class, 'contactSubmit'])->name('contact.submit');

// Online Booking & Prescription
Route::get('/book', [BookingController::class, 'create'])->name('booking.create');
Route::post('/book', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking-confirmed/{code}', [BookingController::class, 'confirmation'])->name('booking.confirmation');
Route::get('/upload-prescription', [HomeController::class, 'uploadPrescriptionView'])->name('prescription.view');
Route::post('/upload-prescription', [BookingController::class, 'uploadPrescription'])->name('prescription.upload');

// Track Patient Test Report
Route::get('/track-report', [HomeController::class, 'trackReport'])->name('track.report');

// Admin / Staff Portal Routes
Route::get('/admin/login', [AdminController::class, 'loginView'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/booking/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.booking.status');
    Route::post('/admin/booking/{id}/report', [AdminController::class, 'uploadReport'])->name('admin.booking.report');
});
