<?php

namespace App\Http\Controllers;

use App\Models\AuliaKos;
use App\Models\AuliaKamar;
use App\Models\AuliaBooking;
use App\Models\AuliaGallery;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKos = AuliaKos::count();
        $totalKamar = AuliaKamar::count();
        $totalGambar = AuliaGallery::count();
        $totalBooking = AuliaBooking::count();
        $recentBookings = AuliaBooking::with(['user', 'kos'])->latest()->take(5)->get();
        $pendingBookingCount = AuliaBooking::where('status', 'pending')->count();
        return view('admin.dashboard', compact('totalKos', 'totalKamar', 'totalGambar', 'totalBooking', 'recentBookings', 'pendingBookingCount'));
    }
}
