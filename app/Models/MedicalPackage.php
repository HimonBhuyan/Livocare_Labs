<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'category_label',
        'badge',
        'test_count',
        'short_description',
        'parameters',
        'original_price',
        'discounted_price',
        'discount_percent',
        'fasting_required',
        'sample_type',
        'report_time',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'parameters' => 'array',
        'original_price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'fasting_required' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
