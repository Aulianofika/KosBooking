<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuliaKamar extends Model
{
    protected $table = 'aulia_kamar';

    protected $fillable = ['kos_id', 'nama_kamar', 'harga', 'status'];

    public function kos()
    {
        return $this->belongsTo(AuliaKos::class, 'kos_id');
    }

    public function galleries()
    {
        return $this->hasMany(AuliaKamarGallery::class, 'kamar_id');
    }
    public function bookings() 
    {
        return $this->hasMany(AuliaBooking::class, 'kamar_id');
    }
}
