<?php

namespace App\Http\Controllers;

use App\Models\AuliaBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AuliaKamar;

class AdminPemesananController extends Controller
{
   public function index()
    {
        $bookings = AuliaBooking::with(['user', 'kos', 'kamar'])->latest()->paginate(10);
        return view('admin.pemesanan.index', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak'
        ]);

        $booking = AuliaBooking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('success', 'Status diperbarui.');
    }
}