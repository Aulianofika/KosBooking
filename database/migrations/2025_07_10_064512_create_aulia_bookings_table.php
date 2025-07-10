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
        Schema::create('aulia_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('aulia_users')->onDelete('cascade');
            $table->foreignId('kos_id')->constrained('aulia_kos')->onDelete('cascade');
            $table->foreignId('kamar_id')->constrained('aulia_kamar')->onDelete('cascade');
            $table->date('tanggal_mulai');
            $table->text('catatan')->nullable();
            $table->integer('harga'); 
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->string('bukti_transaksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aulia_bookings');
    }
};
