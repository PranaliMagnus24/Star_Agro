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
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');  
            $table->text('summary')->nullable(); 
            $table->longtext('description')->nullable(); 
            $table->string('image')->nullable();  
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->longtext('meta_description')->nullable();
            $table->string('og_title')->nullable();
            $table->longtext('og_description')->nullable();
            $table->string('og_img')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_pages');
    }
};
