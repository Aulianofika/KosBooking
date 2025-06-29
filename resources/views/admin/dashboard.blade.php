@extends('admin.layouts')

@section('content')
<div class="container mx-auto px-6 py-8 animate-fade-in">
    <h1 class="text-4xl font-bold text-blue-700 mb-2">Halo Admin</h1>
    <p class="text-gray-600 mb-8">Semangat! Awali harimu dengan keputusan yang berdampak besar</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Kos Card -->
        <div class="transition transform hover:-translate-y-1 hover:shadow-lg duration-300 bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-2xl p-6">
            <h2 class="text-sm uppercase tracking-wider mb-2">Jumlah Kos</h2>
            <p class="text-4xl font-bold mb-1">{{ $totalKos ?? '0' }}</p>
            <p class="text-xs text-white/80">Data kos aktif yang terdaftar</p>
        </div>

        <!-- Kamar Card -->
        <div class="transition transform hover:-translate-y-1 hover:shadow-lg duration-300 bg-gradient-to-br from-sky-500 to-sky-700 text-white rounded-2xl p-6">
            <h2 class="text-sm uppercase tracking-wider mb-2">Jumlah Kamar</h2>
            <p class="text-4xl font-bold mb-1">{{ $totalKamar ?? '0' }}</p>
            <p class="text-xs text-white/80">Total semua kamar dalam kos</p>
        </div>

        <!-- Galeri Card -->
        <div class="transition transform hover:-translate-y-1 hover:shadow-lg duration-300 bg-gradient-to-br from-cyan-500 to-teal-600 text-white rounded-2xl p-6">
            <h2 class="text-sm uppercase tracking-wider mb-2">Jumlah Galeri</h2>
            <p class="text-4xl font-bold mb-1">{{ $totalGambar ?? '0' }}</p>
            <p class="text-xs text-white/80">Koleksi foto & visual pendukung</p>
        </div>
    </div>
</div>

<!-- Tambahan animasi jika belum ada -->
@push('styles')
<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.8s ease-out;
    }
</style>
@endpush
@endsection
