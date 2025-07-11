@extends('admin.layouts')

@section('content')
<div class="container mx-auto px-6 py-8 animate-fade-in">
    <!-- Greeting -->
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-purple-700 mb-1">💜 Halo Admin!</h1>
        <p class="text-gray-600 text-sm">Kontrol semua kos & pemesanan hanya dari dashboard ini 💼</p>
    </div>

    <!-- Notifikasi Pemesanan Pending -->
    @if ($pendingBookingCount > 0)
        <div class="bg-yellow-100/80 border border-yellow-300 text-yellow-800 px-5 py-4 rounded-xl shadow-sm mb-8 flex items-center gap-3">
            <i class="bi bi-bell-fill text-xl"></i>
            <div>
                <strong>{{ $pendingBookingCount }}</strong> pemesanan butuh konfirmasi.
                <a href="{{ route('admin.pemesanan.index') }}" class="text-underline text-yellow-800 hover:font-bold">Lihat sekarang</a>
            </div>
        </div>
    @endif

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        @php
            $cards = [
                ['title' => 'Jumlah Kos', 'icon' => 'bi-house-door', 'value' => $totalKos ?? 0, 'desc' => 'Kos aktif', 'color' => 'from-violet-400 to-purple-600'],
                ['title' => 'Jumlah Kamar', 'icon' => 'bi-door-open', 'value' => $totalKamar ?? 0, 'desc' => 'Kamar tersedia', 'color' => 'from-pink-400 to-fuchsia-500'],
                ['title' => 'Jumlah Galeri', 'icon' => 'bi-images', 'value' => $totalGambar ?? 0, 'desc' => 'Foto & visual', 'color' => 'from-indigo-400 to-indigo-600'],
                ['title' => 'Pemesanan', 'icon' => 'bi-calendar-check', 'value' => $totalBooking ?? 0, 'desc' => 'Total transaksi', 'color' => 'from-rose-400 to-pink-600'],
            ];
        @endphp

        @foreach ($cards as $card)
        <div class="bg-gradient-to-br {{ $card['color'] }} text-white rounded-2xl shadow-md p-5 transition hover:shadow-2xl hover:scale-[1.02] duration-300">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-sm uppercase font-medium tracking-wide">{{ $card['title'] }}</h3>
                <i class="bi {{ $card['icon'] }} text-2xl opacity-90"></i>
            </div>
            <p class="text-4xl font-extrabold mb-1">{{ $card['value'] }}</p>
            <p class="text-sm text-white/80">{{ $card['desc'] }}</p>
        </div>
        @endforeach
    </div>

  <!-- Pemesanan Terbaru -->
<div class="mt-12">
    <h2 class="text-2xl font-bold text-purple-800 mb-6">Pemesanan Terbaru</h2>
    <div class="bg-white shadow-lg rounded-2xl p-6 border-l-4 border-purple-300">
        @forelse($recentBookings as $booking)
            <div class="flex flex-col lg:flex-row justify-between gap-4 mb-6 pb-4 border-b border-gray-200">
                <div>
                    <h4 class="text-xl font-semibold text-purple-700 mb-1">
                        <i class="bi bi-person-fill-check me-1"></i>
                        {{ $booking->user->name ?? 'User dihapus' }}
                    </h4>
                    <p class="text-lg text-gray-700">
                        memesan kos <strong class="text-indigo-700">{{ $booking->kos->nama_kos ?? '-' }}</strong>
                        <span class="text-base text-gray-500">• {{ $booking->kamar->nama_kamar ?? '-' }}</span>
                    </p>
                    <p class="text-sm text-gray-500 mt-1">
                        <i class="bi bi-calendar-event me-1"></i> Mulai: {{ $booking->tanggal_mulai }}
                    </p>
                </div>
                <div class="self-center">
                    <span class="inline-flex items-center px-4 py-2 text-base font-medium rounded-full 
                        {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-700' :
                           ($booking->status === 'diterima' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                        <i class="bi {{ 
                            $booking->status === 'pending' ? 'bi-hourglass-split' : 
                            ($booking->status === 'diterima' ? 'bi-check-circle-fill' : 'bi-x-circle-fill') }} me-2"></i>
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
            </div>
        @empty
            <div class="text-center text-lg text-gray-500">Belum ada pemesanan baru 💬</div>
        @endforelse
    </div>
</div>


</div>

@push('styles')
<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.6s ease-out both;
    }
</style>
@endpush
@endsection
