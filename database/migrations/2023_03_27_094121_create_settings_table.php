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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('logo');
            $table->string('alamat');
            $table->string('phone');
            $table->string('email');
            $table->text('jam_buka');
            $table->text('footer_description');
            $table->text('tentang_perusahaan');
            $table->text('sejarah_perusahaan');
            $table->text('tentang_team');
            $table->text('hubungi_kami');
            $table->text('maps');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('twitter');
            $table->string('linkedin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};