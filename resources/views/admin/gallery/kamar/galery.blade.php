@extends('admin.layouts')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow border">
    <h2 class="text-2xl font-semibold mb-4">Galeri Kamar: {{ $kamar->nama_kamar }}</h2>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.kamar.galeri.store', $kamar->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="flex gap-2 items-center">
            <input type="file" name="gambar" required>
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </form>

    <div class="grid grid-cols-3 gap-4">
        @foreach ($galeri as $g)
            <div class="relative group">
                <img src="{{ asset('storage/' . $g->gambar) }}" class="rounded shadow w-full h-32 object-cover">
                <form action="{{ route('admin.kamar.galeri.destroy', $g->id) }}" method="POST" class="absolute top-1 right-1">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white rounded-full px-2 py-1 text-xs">✕</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
