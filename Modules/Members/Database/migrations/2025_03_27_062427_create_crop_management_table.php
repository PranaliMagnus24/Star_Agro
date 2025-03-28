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
        Schema::create('crop_management', function (Blueprint $table) {
            $table->id();
            $table->string('crop_name')->nullable();
            $table->date('planating_date')->nullable();
            $table->date('harvesting_date')->nullable();
            $table->string('expected_price')->nullable();
            $table->string('min_qty')->nullable();
            $table->string('max_qty')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop_management');
    }
};
