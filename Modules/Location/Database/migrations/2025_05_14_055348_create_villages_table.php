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
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('taluka_id');
            $table->integer('village_code');
            $table->string('village_name')->nullable();
            $table->enum('village_status', ['Inhabitant', 'Un-Inhabitant'])->nullable();
            $table->enum('village_category', ['Rural', 'Urban'])->nullable();
            $table->enum('status', ['Active', 'Inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};
