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
        Schema::create('website_details', function (Blueprint $table) {
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('primary_colour');
            $table->string('secondary_colour');
            $table->string('background_colour')->default("FFFFFF");
            $table->string('text_colour')->default("000000");
            $table->string('divider_art')->nullable();
            $table->string('font_family')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_details');
    }
};
