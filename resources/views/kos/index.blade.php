@extends('layouts.frontend')

@section('title', 'Daftar Kos')

@section('content')
<section class="py-5 text-center rounded-4 overflow-hidden hero-section-light">
  <div class="container my-3">
    <h1 class="display-4 fw-bold text-success mb-3">Welcome to BookingKos.id!</h1>
    <p class="lead fw-semibold text-secondary">
      Temukan kos idamanmu dengan mudah dan cepat hanya di <strong>BookingKos.id</strong>
    </p>
    <div class="hero-underline-light mx-auto mt-3"></div>
  </div>
</section>
<div class="container my-5"></div>
    
   <!-- Form Pencarian -->
<div class="p-4 bg-light rounded-4 shadow-sm border mb-5">
    <form method="GET" action="{{ route('kos.index') }}" class="row g-3 align-items-end">
        <!-- Kolom Input Keyword -->
        <div class="col-md-5">
            <label for="keyword" class="form-label fw-semibold text-secondary">Cari Kos</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="keyword" id="keyword"
                    class="form-control border-start-0 rounded-end"
                    placeholder="Nama / Alamat kos..." value="{{ request('keyword') }}">
            </div>
        </div>

        <!-- Kolom Pilihan Tipe Penghuni -->
        <div class="col-md-3">
            <label for="tipe_penghuni" class="form-label fw-semibold text-secondary">Tipe Penghuni</label>
            <select name="tipe_penghuni" id="tipe_penghuni" class="form-select">
                <option value="">-- Semua Tipe --</option>
                <option value="Putra" {{ request('tipe_penghuni') == 'Putra' ? 'selected' : '' }}>Putra</option>
                <option value="Putri" {{ request('tipe_penghuni') == 'Putri' ? 'selected' : '' }}>Putri</option>
                <option value="Campur" {{ request('tipe_penghuni') == 'Campur' ? 'selected' : '' }}>Campur</option>
            </select>
        </div>

        <!-- Kolom Tombol Cari -->
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100 fw-semibold rounded-3 shadow-sm">
                <i class="bi bi-search me-1"></i> Cari
            </button>
        </div>
    </form>
</div>

    <!-- List Kos -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($kos as $item)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <img src="{{ asset('storage/' . $item->gambar_utama) }}" class="card-img-top rounded-top"
                    alt="gambar kos" style="height: 230px; object-fit: cover; transition: transform 0.4s ease-in-out;">
                <div class="position-absolute top-0 end-0 p-2">
                    <span class="badge rounded-pill bg-light text-dark shadow-sm">{{ $item->tipe_penghuni }}</span>
                </div>
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="card-title mb-1 fw-bold text-dark">{{ $item->nama_kos }}</h5>
                    <p class="text-muted small mb-2"><i class="bi-geo-alt-fill me-1"></i> {{ $item->alamat }}</p>
                    <p class="mb-3 fw-semibold text-success">Rp{{ number_format($item->harga, 0, ',', '.') }}/bulan</p>

                    <div class="mt-auto">
                        <a href="{{ route('kos.detail', $item->id) }}" class="btn btn-outline-success w-100 rounded-pill">
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
</div>
@endsection
