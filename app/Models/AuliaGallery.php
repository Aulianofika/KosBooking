<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuliaGallery extends Model
{
    protected $table = 'aulia_galleries';

    protected $fillable = ['kos_id', 'gambar'];

    public function kos()
    {
        return $this->belongsTo(AuliaKos::class, 'kos_id');
    }
}
