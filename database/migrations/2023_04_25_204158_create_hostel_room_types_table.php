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
        Schema::create('hostel_room_types', function (Blueprint $table) {
            $table->id();
            $table->string('room_type')->unique();;
            $table->integer('room_price');
            $table->integer('room_capacity');
            $table->string('room_description');
            $table->string('room_type_photo', 300);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostel_room_types');
    }
};
