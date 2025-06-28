@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Selamat Datang di Halaman Admin</h1>
        <p class="text-gray-600 mb-4">Gunakan sidebar di sebelah kiri untuk mengelola data kos, kamar, dan galeri.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-500 text-white rounded-xl shadow-lg p-5">
                <h2 class="text-lg font-semibold">Total Kos</h2>
                <p class="text-3xl">{{ $totalKos ?? '-' }}</p>
            </div>
            <div class="bg-green-500 text-white rounded-xl shadow-lg p-5">
                <h2 class="text-lg font-semibold">Total Kamar</h2>
                <p class="text-3xl">{{ $totalKamar ?? '-' }}</p>
            </div>
            <div class="bg-purple-500 text-white rounded-xl shadow-lg p-5">
                <h2 class="text-lg font-semibold">Total Galeri</h2>
                <p class="text-3xl">{{ $totalGambar ?? '-' }}</p>
            </div>
        </div>
    </div>
@endsection
