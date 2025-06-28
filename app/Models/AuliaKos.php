<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class AuliaKos extends Model
{
    protected $table = 'aulia_kos';

    protected $fillable = [
        'nama_kos', 'alamat', 'deskripsi', 'harga',
        'tipe_penghuni', 'no_telp', 'fasilitas', 'gambar_utama'
    ];

    public function kamar()
    {
        return $this->hasMany(AuliaKamar::class, 'kos_id');
    }

    public function galleries()
    {
        return $this->hasMany(AuliaGallery::class, 'kos_id');
    }
}

