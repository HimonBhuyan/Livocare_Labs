<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->string('patient_name');
            $table->string('patient_phone');
            $table->string('patient_email')->nullable();
            $table->integer('patient_age')->nullable();
            $table->string('patient_gender')->nullable();
            $table->string('collection_type')->default('home_collection');
            $table->text('address')->nullable();
            $table->string('city')->default('Guwahati');
            $table->string('pincode')->nullable();
            $table->date('preferred_date');
            $table->string('time_slot');
            $table->foreignId('medical_package_id')->nullable()->constrained('medical_packages')->nullOnDelete();
            $table->string('package_name');
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('pending');
            $table->text('special_instructions')->nullable();
            $table->string('report_file')->nullable();
            $table->timestamp('report_uploaded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
