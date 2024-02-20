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
        Schema::create('page_flags', function (Blueprint $table) {
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->boolean('has_home_page')->default(false);
            $table->boolean('has_rooms_page')->default(false);
            $table->boolean('has_reviews_page')->default(false);
            $table->boolean('has_about_page')->default(false);
            $table->boolean('has_explore_page')->default(false);
            $table->boolean('has_find_us_page')->default(false);
            $table->boolean('has_faq_page')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_flags');
    }
};
