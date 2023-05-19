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
        Schema::create('hostel_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('bed_space');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('amount_paid');
            $table->integer('balance');
            //payments of two categories cash,mobile money,card
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('hostel_room_id');
            $table->timestamps();
            $table->index('tenant_id');
            $table->index('hostel_room_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostel_bookings');
    }
};
