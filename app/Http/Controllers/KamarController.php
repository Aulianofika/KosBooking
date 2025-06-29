<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuliaKamar;
use App\Models\AuliaKos;

class KamarController extends Controller
{
    public function index()
    {
        $kamar = AuliaKamar::with('kos')->get();
        return view('admin.kamar.index', compact('kamar'));
    }

    public function create()
    {
        $kos = AuliaKos::all();
        return view('admin.kamar.create', compact('kos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kos_id' => 'required|exists:aulia_kos,id',
            'nama_kamar' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'status' => 'required|in:tersedia,terisi',
        ]);

        AuliaKamar::create($request->all());

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kamar = AuliaKamar::findOrFail($id);
        $kos = AuliaKos::all();
        return view('admin.kamar.edit', compact('kamar', 'kos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kos_id' => 'required|exists:aulia_kos,id',
            'nama_kamar' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'status' => 'required|in:tersedia,terisi',
        ]);

        $kamar = AuliaKamar::findOrFail($id);
        $kamar->update($request->all());

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kamar = AuliaKamar::findOrFail($id);
        $kamar->delete();

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
