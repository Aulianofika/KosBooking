<?php

namespace App\Http\Controllers;

use App\Models\AuliaKos;
use App\Models\AuliaGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserKosController extends Controller
{
    public function index(Request $request)
{
    $query = AuliaKos::query();

    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('nama_kos', 'like', '%' . $request->keyword . '%')
              ->orWhere('alamat', 'like', '%' . $request->keyword . '%');
        });
    }

    if ($request->filled('tipe_penghuni')) {
        $query->where('tipe_penghuni', $request->tipe_penghuni);
    }

    $kos = $query->latest()->paginate(6)->withQueryString();

    return view('kos.index', compact('kos'));
}


    public function show($id)
    {
        if (!Auth::check() || Auth::user()->role === 'admin') {
        return redirect('/login')->with('error', 'Silakan login sebagai pengguna untuk melihat detail.');
    }
        $kos = AuliaKos::with('kamar')->findOrFail($id);
        $galleries = $kos->galleries;
        
        return view('kos.detail', compact('kos', 'galleries'));
    }

    
}