<?php

namespace App\Http\Controllers;

use App\Models\AuliaKos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KosController extends Controller
{
    public function index()
    {
        $kos = AuliaKos::all();
        return view('admin.kos.index', compact('kos'));
    }

    public function create()
    {
        return view('admin.kos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kos' => 'required|string|max:255',
            'alamat' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'tipe_penghuni' => 'required|in:Putra,Putri,Campur',
            'no_telp' => 'required|string|max:20',
            'no_rekening' => 'required|string|max:20',
            'fasilitas' => 'nullable|string',
            'gambar_utama' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambar_utama = $request->file('gambar_utama')->store('kos', 'public');

        AuliaKos::create([
            'nama_kos' => $request->nama_kos,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'tipe_penghuni' => $request->tipe_penghuni,
            'no_telp' => $request->no_telp,
            'no_rekening' => $request->no_rekening,
            'fasilitas' => $request->fasilitas,
            'gambar_utama' => $gambar_utama,
        ]);

        return redirect()->route('admin.kos.index')->with('success', 'Data kos berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kos = AuliaKos::findOrFail($id);
        return view('admin.kos.edit', compact('kos'));
    }

    public function update(Request $request, $id)
    {
        $kos = AuliaKos::findOrFail($id);

        $request->validate([
            'nama_kos' => 'required|string|max:255',
            'alamat' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'tipe_penghuni' => 'required|in:Putra,Putri,Campur',
            'no_telp' => 'required|string|max:20',
            'no_rekening' => 'required|string|max:20',
            'fasilitas' => 'nullable|string',
            'gambar_utama' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar_utama')) {
            if ($kos->gambar_utama && Storage::disk('public')->exists($kos->gambar_utama)) {
                Storage::disk('public')->delete($kos->gambar_utama);
            }
            $kos->gambar_utama = $request->file('gambar_utama')->store('kos', 'public');
        }

        $kos->update([
            'nama_kos' => $request->nama_kos,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'tipe_penghuni' => $request->tipe_penghuni,
            'no_telp' => $request->no_telp,
            'no_rekening' => $request->no_rekening,
            'fasilitas' => $request->fasilitas,
            'gambar_utama' => $kos->gambar_utama,
        ]);

        return redirect()->route('admin.kos.index')->with('success', 'Data kos berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kos = AuliaKos::findOrFail($id);
        if ($kos->gambar_utama && Storage::disk('public')->exists($kos->gambar_utama)) {
            Storage::disk('public')->delete($kos->gambar_utama);
        }
        $kos->delete();

        return redirect()->route('admin.kos.index')->with('success', 'Data kos berhasil dihapus.');
    }
}
