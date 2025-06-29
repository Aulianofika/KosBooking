@extends('admin.layouts')

@section('content')
<h3 class="text-2xl font-semibold mb-4">🖼️ Galeri Kos: {{ $kos->nama }}</h3>

@if(session('success'))
    <div class="alert alert-success mb-3">{{ session('success') }}</div>
@endif

{{-- Form upload gambar --}}
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.gallery.store', $kos->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="gambar" class="form-label">Upload Gambar (bisa banyak):</label>
                <input type="file" name="gambar[]" multiple class="form-control" required>
                @error('gambar.*') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button class="btn btn-primary">Unggah</button>
        </form>
    </div>
</div> 

{{-- Tampilkan Galeri --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @forelse ($galleries as $img)
        <div class="relative border rounded-xl overflow-hidden shadow">
            <img src="{{ asset('storage/' . $img->gambar) }}" class="w-full h-40 object-cover" alt="gambar">
            <form action="{{ route('admin.gallery.destroy', $img->id) }}" method="POST" class="absolute top-2 right-2">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger bg-red-600 text-white py-1 px-2 rounded hover:bg-red-700" onclick="return confirm('Hapus gambar ini?')">🗑</button>
            </form>
        </div>
    @empty
        <p class="text-gray-500">Belum ada gambar.</p>
    @endforelse
</div>
@endsection