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
        Schema::create('websites', function (Blueprint $table) {
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->char('primary_colour', 6);
            $table->char('secondary_colour', 6);
            $table->char('background_colour', 6)->default("FFFFFF");
            $table->char('text_colour', 6)->default("000000");
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
        Schema::dropIfExists('websites');
    }
};
