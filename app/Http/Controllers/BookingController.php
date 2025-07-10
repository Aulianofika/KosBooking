<?php

namespace App\Http\Controllers;

use App\Models\AuliaBooking;
use App\Models\AuliaKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request, $kamar_id)
    {
        $request->validate([
            'kos_id' => 'required|exists:aulia_kos,id',
            'tanggal_mulai' => 'required|date',
            'catatan' => 'nullable|string',
            'harga' => 'required|numeric',
            'bukti_transaksi' => 'nullable|image|max:2048',
        ]);

        $kamar = AuliaKamar::findOrFail($kamar_id);

        // Simpan bukti transaksi jika diupload
        $buktiPath = null;
        if ($request->hasFile('bukti_transaksi')) {
            $buktiPath = $request->file('bukti_transaksi')->store('bukti', 'public');
        }

        AuliaBooking::create([
            'user_id' => Auth::id(),
            'kos_id' => $request->kos_id,
            'kamar_id' => $kamar_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'catatan' => $request->catatan,
            'harga' => $request->harga,
            'status' => 'pending',
            'bukti_transaksi' => $buktiPath,
        ]);

        return redirect()->route('riwayat.booking')->with('success', 'Pesanan berhasil dikirim!');
    }

    public function riwayat()
    {
        $bookings = AuliaBooking::with(['kamar', 'kos'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('booking.riwayat', compact('bookings'));
    }
}