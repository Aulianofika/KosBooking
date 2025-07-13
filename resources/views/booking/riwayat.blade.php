@extends('layouts.frontend')

@section('title', 'Riwayat Pemesanan')

@section('content')
<div class="container py-4">
    <h2 class="section-title text-center mb-5 fs-3 fw-bold text-purple">Riwayat Pemesanan Anda</h2>

    @if (session('success'))
        <div class="alert alert-success text-center rounded-pill shadow-sm fw-semibold">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    @forelse ($bookings as $booking)
        <div class="card mb-4 border-0 shadow-sm rounded-4 overflow-hidden animate-fade-in">
            <div class="row g-0">
                {{-- Thumbnail Gambar --}}
                <div class="col-md-3 d-none d-md-block bg-light">
                    @if ($booking->kamar->galleries->count())
                        <img src="{{ asset('storage/' . $booking->kamar->galleries[0]->gambar) }}"
                             class="img-fluid w-100 h-100 rounded-start"
                             style="object-fit: cover; max-height: 200px;" 
                             alt="Gambar Kamar">
                    @else
                        <div class="h-100 d-flex align-items-center justify-content-center bg-white text-muted" style="height: 200px;">
                            <i class="bi bi-image fs-1"></i>
                        </div>
                    @endif
                </div>

                {{-- Detail Booking --}}
                <div class="col-md-9">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <div>
                                <h5 class="fw-bold text-purple mb-2 fs-5">
                                    {{ $booking->kos->nama_kos }} <small class="text-muted">/ {{ $booking->kamar->nama_kamar }}</small>
                                </h5>
                                <p class="text-muted small mb-3 "><i class="bi bi-geo-alt me-1 text-purple"></i> {{ $booking->kos->alamat }}</p>

                                <ul class="list-unstyled text-muted mb-0 fs-6">
                                    <li><i class="bi bi-calendar me-1 text-purple"></i> <strong>Mulai:</strong> {{ $booking->tanggal_mulai }}</li>
                                    <li><i class="bi bi-cash me-1 text-purple" ></i> <strong>Harga:</strong> Rp{{ number_format($booking->harga, 0, ',', '.') }}</li>
                                    @if ($booking->catatan)
                                        <li><i class="bi bi-chat-left-dots me-1 text-purple"></i> <strong>Catatan:</strong> {{ $booking->catatan }}</li>
                                    @endif
                                </ul>
                            </div>
                            </div>{{-- Status dan Aksi --}}
                            <div class="text-end mt-3 mt-md-0">
                                <span class="badge px-3 py-2 rounded-pill shadow-sm fs-6
                                    {{ $booking->status == 'pending' ? 'bg-warning text-dark' :
                                       ($booking->status == 'diterima' ? 'bg-success' : 'bg-danger') }}">
                                    <i class="bi 
                                        {{ $booking->status == 'pending' ? 'bi-hourglass-split' :
                                           ($booking->status == 'diterima' ? 'bi-check-circle-fill' : 'bi-x-circle-fill') }} me-1"></i>
                                    {{ ucfirst($booking->status) }}
                                </span>

                                @if($booking->status === 'ditolak')
                                    <a href="{{ route('kos.detail', $booking->kos->id) }}" class="btn btn-outline-danger btn-sm rounded-pill mt-2">
                                        <i class="bi bi-arrow-clockwise me-1"></i> Pesan Ulang
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center shadow-sm rounded-pill fs-5">
            <i class="bi bi-inbox me-1"></i> Belum ada pemesanan kamar.
        </div>
    @endforelse
</div>
@endsection