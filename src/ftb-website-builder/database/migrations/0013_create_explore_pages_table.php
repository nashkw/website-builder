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
        Schema::create('explore_pages', function (Blueprint $table) {
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('meta_page_title')->nullable();
            $table->string('meta_page_description')->nullable();
            $table->string('explore_page_section_header')->default("Things to do during your stay");
            $table->text('explore_page_section_paragraph')->nullable();
            $table->string('explore_page_section_image')->nullable();
            $table->string('explore_page_section_image_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('explore_pages');
    }
};
