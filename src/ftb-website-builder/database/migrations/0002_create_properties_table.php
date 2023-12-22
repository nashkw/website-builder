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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('property_name');
            $table->string('property_address_line_1');
            $table->string('property_address_line_2')->nullable();
            $table->string('property_address_area');
            $table->string('property_address_country');
            $table->string('property_address_postcode');
            $table->string('property_telephone');
            $table->string('property_email')->nullable();
            $table->string('property_twitter_link')->nullable();
            $table->string('property_youtube_link')->nullable();
            $table->string('property_linkedin_link')->nullable();
            $table->string('property_facebook_link')->nullable();
            $table->string('property_instagram_link')->nullable();
            $table->string('property_tripadvisor_link')->nullable();
            $table->string('property_logo')->nullable();
            $table->string('property_booking_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
