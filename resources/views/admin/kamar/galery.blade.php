@extends('admin.layouts')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">🛏 Galeri Kamar: {{ $kamar->nama_kamar }}</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 border border-green-400 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.kamar.galeri.store', $kamar->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <input type="file" name="gambar" required>
        <button type="submit" class="btn btn-primary ml-2">Upload</button>
    </form>

    <div class="grid grid-cols-3 gap-4">
        @foreach ($galeri as $g)
            <div class="relative">
                <a href="{{ asset('storage/' . $g->gambar) }}" target="_blank">
                    <img src="{{ asset('storage/' . $g->gambar) }}" class="w-full h-32 object-cover rounded shadow">
                </a>
                <form action="{{ route('admin.kamar.galeri.destroy', $g->id) }}" method="POST" class="absolute top-1 right-1">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white text-xs rounded px-2 py-1">✕</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
