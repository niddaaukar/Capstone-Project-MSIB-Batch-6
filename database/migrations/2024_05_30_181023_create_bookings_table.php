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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('days_count'); // jumlah hari sewa
            $table->decimal('booking_fee', 10, 2); // biaya sewa mobil
            $table->boolean('with_driver'); // apakah menggunakan driver atau tidak
            $table->enum('pickup', ['Ambil Sendiri', 'Diantar Sesuai Alamat']);
            $table->decimal('driver_fee', 10, 2)->nullable(); // biaya driver (bisa null jika tanpa driver)
            $table->decimal('total_fee', 10, 2); // total biaya
            $table->enum('booking_status', ['Menunggu Pembayaran', 'Menunggu Konfirmasi', 'Sudah Dibayar', 'Pembayaran Terkonfirmasi', 'Belum Dikembalikan', 'Selesai', 'Dibatalkan']);
            $table->uuid('booking_code')->unique();
            $table->string('snap_token')->nullable();
            // Kolom untuk mendukung jenis kendaraan
            $table->string('vehicle_type');
            $table->unsignedBigInteger('vehicle_id');
            $table->timestamps();

            // Index dan foreign key untuk vehicle_id akan ditambahkan secara manual
            $table->index(['vehicle_id', 'vehicle_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
