<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        // Create pivot table for room types and amenities
        Schema::create('amenity_room_type', function (Blueprint $table) {
            $table->foreignId('amenity_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_type_id')->constrained()->onDelete('cascade');
            $table->primary(['amenity_id', 'room_type_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('amenity_room_type');
        Schema::dropIfExists('amenities');
    }
}; 