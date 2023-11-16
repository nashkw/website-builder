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
        Schema::create('attractions', function (Blueprint $table) {
            $table->id('attraction_id');
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('attraction_header');
            $table->string('attraction_paragraph');
            $table->string('attraction_image')->nullable();
            $table->string('attraction_image_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attractions');
    }
};
