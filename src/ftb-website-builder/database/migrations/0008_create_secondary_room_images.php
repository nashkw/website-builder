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
        Schema::create('secondary_room_images', function (Blueprint $table) {
            $table->id('secondary_room_image_id');
            $table->foreignId('room_id');
            $table->string('secondary_room_image');
            $table->string('secondary_room_image_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secondary_room_images');
    }
};
