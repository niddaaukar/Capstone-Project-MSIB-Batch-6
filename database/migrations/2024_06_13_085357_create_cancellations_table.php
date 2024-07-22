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
        Schema::create('cancellations', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('booking_id');
            $table->string('booking_code');
            $table->string('vehicle_name')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('reason');
            $table->string('refund_account')->nullable();
            $table->string('proof_payment')->nullable();
            $table->string('refund_proof')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('booking_code')->references('booking_code')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancellations');
    }
};
