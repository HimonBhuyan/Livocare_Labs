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
        Schema::create('medical_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->index();
            $table->string('category_label')->nullable();
            $table->string('badge')->nullable();
            $table->integer('test_count')->default(1);
            $table->text('short_description')->nullable();
            $table->json('parameters')->nullable();
            $table->decimal('original_price', 10, 2);
            $table->decimal('discounted_price', 10, 2);
            $table->integer('discount_percent')->default(0);
            $table->boolean('fasting_required')->default(true);
            $table->string('sample_type')->default('Blood & Urine');
            $table->string('report_time')->default('Within 12 Hours');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_packages');
    }
};
