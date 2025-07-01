@extends('layouts.frontend')

@section('title', 'Daftar Kos')

@section('content')
<div class="container-xl py-5">
    <h3 class="mb-2 fw-bold text-success">Daftar Kos Tersedia</h3>
    <p class="text-muted mb-4">Temukan kos idamanmu dengan mudah dan cepat hanya di <strong>BookingKos.id</strong></p>

    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('kos.index') }}" class="row g-3 mb-4 align-items-center">
        <div class="col-md-5">
            <input type="text" name="keyword" class="form-control" placeholder="Cari nama/alamat kos..."
                value="{{ request('keyword') }}">
        </div>
        <div class="col-md-3">
            <select name="tipe_penghuni" class="form-select">
                <option value="">-- Semua Tipe --</option>
                <option value="Putra" {{ request('tipe_penghuni') == 'Putra' ? 'selected' : '' }}>Putra</option>
                <option value="Putri" {{ request('tipe_penghuni') == 'Putri' ? 'selected' : '' }}>Putri</option>
                <option value="Campur" {{ request('tipe_penghuni') == 'Campur' ? 'selected' : '' }}>Campur</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Cari</button>
        </div>
    </form>

    <!-- List Kos -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($kos as $item)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm">
                <img src="{{ asset('storage/' . $item->gambar_utama) }}" class="card-img-top rounded-top"
                    alt="gambar kos" style="height: 220px; object-fit: cover;">

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mb-1 fw-bold text-dark">{{ $item->nama_kos }}</h5>
                    <p class="text-muted small mb-2"><i class="bi bi-geo-alt"></i> {{ $item->alamat }}</p>
                    <p class="mb-3 fw-semibold text-success">Rp{{ number_format($item->harga, 0, ',', '.') }}/bulan</p>

                    <div class="mt-auto">
                        <a href="{{ route('kos.detail', $item->id) }}" class="btn btn-success w-100">
                            <i class="bi bi-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">
                Tidak ada kos yang ditemukan.
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $kos->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
