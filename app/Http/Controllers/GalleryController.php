<?php

namespace App\Http\Controllers;

use App\Models\AuliaGallery;
use App\Models\AuliaKos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index($kos_id)
    {
        $kos = AuliaKos::findOrFail($kos_id);
        $galleries = $kos->galleries;
        return view('admin.gallery.index', compact('kos', 'galleries'));
    }

    public function store(Request $request, $kos_id)
    {
        $request->validate([
            'gambar.*' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        foreach ($request->file('gambar') as $file) {
            $path = $file->store('galeri', 'public');
            AuliaGallery::create([
                'kos_id' => $kos_id,
                'gambar' => $path
            ]);
        }

        return redirect()->route('admin.gallery.index', $kos_id)->with('success', 'Gambar berhasil diunggah.');
    }

    public function destroy($id)
    {
        $gallery = AuliaGallery::findOrFail($id);
        $kos_id = $gallery->kos_id;

        if (Storage::disk('public')->exists($gallery->gambar)) {
            Storage::disk('public')->delete($gallery->gambar);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index', $kos_id)->with('success', 'Gambar berhasil dihapus.');
    }
}
