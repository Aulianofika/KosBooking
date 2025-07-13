@extends('layouts.frontend')

@section('title', 'Daftar Kos')

@section('content')
<div class="container my-5">
    
 <!-- Fitur Booking -->
  <section class="text-center py-5">
    <h2 class="fw-bold text-purple-700 mb-5">Kenapa Memilih BookingKos.id?</h2>
    <div class="row g-4 justify-content-center">
      <div class="col-md-3">
        <div>
          <div class="text-purple-700 fs-1 mb-2"><i class="bi bi-clock"></i></div>
          <h6 class="fw-bold text-dark">Proses Cepat</h6>
          <p class="text-muted small">Pemesanan langsung dan instan tanpa ribet.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div>
          <div class="text-purple-700 fs-1 mb-2"><i class="bi bi-shield-check"></i></div>
          <h6 class="fw-bold text-dark">Data Aman</h6>
          <p class="text-muted small">Privasi dan keamanan data Anda terjamin.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div>
          <div class="text-purple-700 fs-1 mb-2"><i class="bi bi-geo-alt"></i></div>
          <h6 class="fw-bold text-dark">Banyak Pilihan</h6>
          <p class="text-muted small">Temukan kos sesuai lokasi & kategori favorit Anda.</p>
        </div>
      </div>
    </div>
  </section>
    
   <!-- Form Pencarian -->
<div class="p-4 bg-light rounded-4 shadow-sm border mb-5">
    <form method="GET" action="{{ route('kos.index') }}" class="row g-3 align-items-end">
        <!-- Kolom Input Keyword -->
        <div class="col-md-6">
            <label for="keyword" class="form-label fw-semibold text-secondary">Cari Kos</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="keyword" id="keyword"
                    class="form-control border-start-0 rounded-end"
                    placeholder="Nama / Alamat kos..." value="{{ request('keyword') }}">
            </div>
        </div>

        <!-- Kolom Pilihan Tipe Penghuni -->
        <div class="col-md-4">
            <label for="tipe_penghuni" class="form-label fw-semibold text-secondary">Kategori</label>
            <select name="tipe_penghuni" id="tipe_penghuni" class="form-select">
                <option value="">-- Semua Tipe --</option>
                <option value="Putra" {{ request('tipe_penghuni') == 'Putra' ? 'selected' : '' }}>Putra</option>
                <option value="Putri" {{ request('tipe_penghuni') == 'Putri' ? 'selected' : '' }}>Putri</option>
                <option value="Campur" {{ request('tipe_penghuni') == 'Campur' ? 'selected' : '' }}>Campur</option>
            </select>
        </div>

        <!-- Kolom Tombol Cari -->
        <div class="col-md-2">
            <button type="submit" class="btn btn-ungu w-100 fw-semibold rounded-3 shadow-sm">
                <i class="bi bi-search me-1"></i> Cari
            </button>
        </div>
    </form>
</div>

    <!-- List Kos -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
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
                    <p class="mb-3 fw-semibold text-purple">Rp{{ number_format($item->harga, 0, ',', '.') }}/bulan</p>

                    <div class="mt-auto">
                        <a href="{{ route('kos.detail', $item->id) }}" class="btn btn-outline-purple w-100 rounded-pill">
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
    </div>
    </section>  
    <!-- Petunjuk Eksplorasi -->
<section class="container py-5">
  <h2 class="text-center section-title mb-4">Mulai Jelajahi BookingKos.id</h2>
  <p class="text-center text-muted mb-5">Kami bantu kamu temukan kos terbaik sesuai kebutuhanmu 💜</p>
  
  <div class="row g-4 text-center">
    <div class="col-md-4">
      <div class="p-4 border rounded-4 shadow-sm h-100">
        <i class="bi bi-search fs-2 text-purple mb-3"></i>
        <h5 class="fw-bold">Cari Kos</h5>
        <p class="text-muted">Gunakan fitur pencarian untuk temukan kos sesuai nama, lokasi, atau kategori.</p>
            <a href="{{ route('kos.index') }}" class="btn btn-outline-purple btn-sm rounded-pill mt-2">
                <i class="bi bi-search me-1"></i> Lihat Daftar Kos
            </a>
      </div>
    </div>

    <div class="col-md-4">
      <div class="p-4 border rounded-4 shadow-sm h-100">
        <i class="bi bi-journal-text fs-2 text-purple mb-3"></i>
        <h5 class="fw-bold">Buat Pemesanan</h5>
        <p class="text-muted">Pilih kos yang kamu suka, isi formulir pemesanan dan tunggu konfirmasi admin.</p>
        <a href="{{ route('explore.kos') }}" class="btn btn-outline-purple btn-sm rounded-pill mt-2">
          <i class="bi bi-pencil-square me-1"></i> Pesan Sekarang
        </a>
      </div>
    </div>

    <div class="col-md-4">
      <div class="p-4 border rounded-4 shadow-sm h-100">
        <i class="bi bi-clock-history fs-2 text-purple mb-3"></i>
        <h5 class="fw-bold">Pantau Riwayat</h5>
        <p class="text-muted">Login untuk melihat status pesanan dan riwayat pemesanan kamu sebelumnya.</p>
        @auth
          <a href="{{ route('riwayat.booking') }}" class="btn btn-outline-purple btn-sm rounded-pill mt-2">
            <i class="bi bi-clock-history me-1"></i> Riwayat Pesanan
          </a>
        @else
          <a href="{{ route('login') }}" class="btn btn-outline-purple btn-sm rounded-pill mt-2">
            <i class="bi bi-box-arrow-in-right me-1"></i> Login untuk Lanjut
          </a>
        @endauth
      </div>
    </div>
  </div>
</section>

    <!-- Pagination -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $kos->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
</div>
@endsection
