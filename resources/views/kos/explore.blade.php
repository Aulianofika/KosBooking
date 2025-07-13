@extends('layouts.frontend')

@section('title', 'Jelajah Kos')

@section('content')
<div class="container py-5">
  <h2 class="text-center section-title mb-4">🧭 Jelajahi Semua Kos</h2>

  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @forelse($kos as $item)
      <div class="col">
        <div class="card kos-card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white">
          <img src="{{ asset('storage/' . $item->gambar_utama) }}" class="card-img-top"
               alt="gambar kos" style="height: 220px; object-fit: cover;">
          <div class="card-body d-flex flex-column p-4">
            <h5 class="card-title text-purple-700 fw-bold mb-1">{{ $item->nama_kos }}</h5>
            <p class="text-muted small mb-2"><i class="bi bi-geo-alt-fill me-1"></i> {{ $item->alamat }}</p>
            <p class="mb-3 fw-semibold text-purple-600">Rp{{ number_format($item->harga, 0, ',', '.') }}/bulan</p>
            <a href="{{ route('kos.detail', $item->id) }}" class="btn btn-outline-purple w-100 rounded-pill mt-auto">
              <i class="bi bi-eye"></i> Lihat Detail
            </a>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-warning text-center">Belum ada kos yang tersedia.</div>
      </div>
    @endforelse
  </div>

  {{-- Pagination --}}
  <div class="mt-5 d-flex justify-content-center">
    {{ $kos->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection
