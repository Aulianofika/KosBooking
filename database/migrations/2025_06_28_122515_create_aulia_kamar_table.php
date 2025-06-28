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
        Schema::create('aulia_kamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kos_id')->constrained('aulia_kos')->onDelete('cascade');
            $table->string('nama_kamar');
            $table->integer('harga');
            $table->enum('status', ['tersedia', 'terisi'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aulia_kamar');
    }
};
