<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'patient_name',
        'patient_phone',
        'patient_email',
        'patient_age',
        'patient_gender',
        'collection_type',
        'address',
        'city',
        'pincode',
        'preferred_date',
        'time_slot',
        'medical_package_id',
        'package_name',
        'total_amount',
        'status',
        'special_instructions',
        'report_file',
        'report_uploaded_at',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'total_amount' => 'decimal:2',
        'report_uploaded_at' => 'datetime',
    ];

    public function medicalPackage(): BelongsTo
    {
        return $this->belongsTo(MedicalPackage::class);
    }
}
