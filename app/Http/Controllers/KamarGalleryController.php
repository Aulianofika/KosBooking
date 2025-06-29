<?php

namespace App\Http\Controllers;

use App\Models\AuliaKamar;
use Illuminate\Http\Request;
use App\Models\AuliaKamarGallery;
use Illuminate\Support\Facades\Storage;

class KamarGalleryController extends Controller
{
    public function index($kamar_id)
    {
        $kamar = AuliaKamar::findOrFail($kamar_id);
        $galeri = AuliaKamarGallery::where('kamar_id', $kamar_id)->get();
        return view('admin.gallery.kamar.galery', compact('kamar', 'galeri'));
    }

    public function store(Request $request, $kamar_id)
    {
        $request->validate([
            'gambar' => 'required|image|max:2048'
        ]);

        $path = $request->file('gambar')->store('kamar', 'public');

        AuliaKamarGallery::create([
            'kamar_id' => $kamar_id,
            'gambar' => $path
        ]);

        return back()->with('success', 'Gambar berhasil diupload!');
    }

    public function destroy($id)
    {
        $item = AuliaKamarGallery::findOrFail($id);
        Storage::disk('public')->delete($item->gambar);
        $item->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}
