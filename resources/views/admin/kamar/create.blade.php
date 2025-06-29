@extends('admin.layouts')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow border">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Tambah Kamar</h2>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-400 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc pl-5 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kamar.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="kos_id" class="block text-sm font-medium text-gray-700">Nama Kos</label>
            <select name="kos_id" id="kos_id" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                <option value="">-- Pilih Kos --</option>
                @foreach ($kos as $item)
                    <option value="{{ $item->id }}" {{ old('kos_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_kos }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="nama_kamar" class="block text-sm font-medium text-gray-700">Nama Kamar</label>
            <input type="text" name="nama_kamar" id="nama_kamar" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md"
                value="{{ old('nama_kamar') }}">
        </div>

        <div>
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" name="harga" id="harga" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md"
                value="{{ old('harga') }}">
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="terisi" {{ old('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
            </select>
        </div>

        <div class="flex justify-end gap-3 mt-4">
            <a href="{{ route('admin.kamar.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-md">
                Batal
            </a>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md shadow">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
