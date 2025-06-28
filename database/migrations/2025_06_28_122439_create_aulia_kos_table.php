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
        Schema::create('aulia_kos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kos');
            $table->text('alamat');
            $table->text('deskripsi')->nullable();
            $table->integer('harga');
            $table->string('tipe_penghuni')->nullable(); // Laki / Perempuan / Campur
            $table->string('no_telp');
            $table->string('fasilitas')->nullable(); // Bisa teks biasa
            $table->string('gambar_utama')->nullable(); // Thumbnail kos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aulia_kos');
    }
};
