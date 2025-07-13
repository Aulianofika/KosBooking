<?php

namespace App\Http\Controllers;

use App\Models\AuliaKos;
use Illuminate\Http\Request;

class KosExploreController extends Controller
{
    public function index(Request $request)
    {
        $kos = AuliaKos::latest()->paginate(12); // bisa 12 per halaman
        return view('kos.explore', compact('kos'));

        
    }
}
