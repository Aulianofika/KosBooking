<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuliaBooking extends Model
{
    protected $table = 'aulia_bookings';
    protected $fillable = [
        'user_id', 'kos_id', 'kamar_id', 'tanggal_mulai', 'catatan', 'harga', 'status','bukti_transaksi'
    ];

    public function user() {
        return $this->belongsTo(AuliaUser::class);
    }

    public function kos() {
        return $this->belongsTo(AuliaKos::class, 'kos_id');
    }

    public function kamar() {
        return $this->belongsTo(AuliaKamar::class, 'kamar_id');
    }
}