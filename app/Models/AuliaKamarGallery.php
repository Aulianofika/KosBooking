<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuliaKamarGallery extends Model
{
    protected $table = 'aulia_kamar_galleries';

    protected $fillable = ['kamar_id', 'gambar'];

    public function kamar()
    {
        return $this->belongsTo(AuliaKamar::class, 'kamar_id');
    }
}
