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
        Schema::create('reviews_pages', function (Blueprint $table) {
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('meta_page_title')->nullable();
            $table->string('meta_page_description')->nullable();
            $table->string('reviews_page_section_header')->default("Hear from our customers");
            $table->text('reviews_page_section_paragraph')->nullable();
            $table->string('reviews_page_section_image')->nullable();
            $table->string('reviews_page_section_image_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews_pages');
    }
};
