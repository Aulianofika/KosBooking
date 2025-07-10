@extends('layouts.frontend')

@section('title', 'Riwayat Pemesanan')

@section('content')
<div class="container py-4">
    <h2 class="text-2xl font-bold mb-4">Riwayat Pemesanan Anda</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($bookings as $booking)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $booking->kos->nama_kos }} - {{ $booking->kamar->nama_kamar }}</h5>
                <p><strong>Tanggal Mulai:</strong> {{ $booking->tanggal_mulai }}</p>
                <p><strong>Harga:</strong> Rp{{ number_format($booking->harga, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-{{ $booking->status == 'pending' ? 'warning text-dark' : ($booking->status == 'diterima' ? 'success' : 'danger') }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </p>
                @if ($booking->catatan)
                    <p><strong>Catatan:</strong> {{ $booking->catatan }}</p>
                @endif
            </div>
        </div>
    @empty
        <p>Belum ada pemesanan kamar.</p>
    @endforelse
</div>
@endsection