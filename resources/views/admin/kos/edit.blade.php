@extends('admin.layouts')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow border">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Edit Data Kos</h2>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-400 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc pl-5 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kos.update', $kos->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        @method('PUT')

        {{-- Kolom kiri --}}
        <div class="space-y-4">
            <div>
                <label for="nama_kos" class="block text-sm font-medium text-gray-700">Nama Kos</label>
                <input type="text" name="nama_kos" id="nama_kos" required value="{{ old('nama_kos', $kos->nama_kos) }}"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">{{ old('alamat', $kos->alamat) }}</textarea>
            </div>

            <div>
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga per Bulan</label>
                <input type="number" name="harga" id="harga" required value="{{ old('harga', $kos->harga) }}"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="gambar_utama" class="block text-sm font-medium text-gray-700">Gambar Utama</label>
                <input type="file" name="gambar_utama" id="gambar_utama"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

                @if ($kos->gambar_utama)
                    <p class="text-xs mt-2">Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $kos->gambar_utama) }}" alt="Gambar Kos" class="mt-1 rounded w-32">
                @endif
            </div>
        </div>

        {{-- Kolom kanan --}}
        <div class="space-y-4">
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi', $kos->deskripsi) }}</textarea>
            </div>

            <div>
                <label for="tipe_penghuni" class="block text-sm font-medium text-gray-700">Tipe Penghuni</label>
                <select name="tipe_penghuni" id="tipe_penghuni" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="Putra" {{ old('tipe_penghuni', $kos->tipe_penghuni) == 'Putra' ? 'selected' : '' }}>Putra</option>
                    <option value="Putri" {{ old('tipe_penghuni', $kos->tipe_penghuni) == 'Putri' ? 'selected' : '' }}>Putri</option>
                    <option value="Campur" {{ old('tipe_penghuni', $kos->tipe_penghuni) == 'Campur' ? 'selected' : '' }}>Campur</option>
                </select>
            </div>

            <div>
                <label for="no_telp" class="block text-sm font-medium text-gray-700">Nomor Telepon Pemilik</label>
                <input type="text" name="no_telp" id="no_telp" required value="{{ old('no_telp', $kos->no_telp) }}"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="fasilitas" class="block text-sm font-medium text-gray-700">Fasilitas</label>
                <textarea name="fasilitas" id="fasilitas" rows="3"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">{{ old('fasilitas', $kos->fasilitas) }}</textarea>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="col-span-full flex justify-end gap-3 mt-4">
            <a href="{{ route('admin.kos.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded-md">
                Kembali
            </a>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md shadow">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
