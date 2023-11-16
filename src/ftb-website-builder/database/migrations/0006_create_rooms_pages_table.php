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
        Schema::create('rooms_pages', function (Blueprint $table) {
            $table->foreignId('property_id');
            $table->string('meta_page_title')->nullable();
            $table->string('meta_page_description')->nullable();
            $table->string('rooms_page_section_header')->default("Our rooms");
            $table->string('rooms_page_section_paragraph')->nullable();
            $table->string('rooms_page_section_image')->nullable();
            $table->string('rooms_page_section_image_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms_pages');
    }
};
