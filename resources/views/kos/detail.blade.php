@extends('layouts.frontend')

@section('content')
<div class="container py-5">

    <div class="row g-4 mb-5">
        {{-- Kiri: Foto & Map --}}
        <div class="col-md-6">
            {{-- Gambar utama sebagai carousel --}} 
@if($kos->galleries && count($kos->galleries))
    <div id="kosCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
        <div class="carousel-inner rounded shadow-sm">
            @foreach($kos->galleries as $index => $gbr)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalKosGambar{{ $gbr->id }}">
                        <img src="{{ asset('storage/' . $gbr->gambar) }}"
                             class="d-block w-100"
                             style="height: 250px; object-fit: cover; cursor: zoom-in;"
                             alt="Foto Kos {{ $index + 1 }}">
                    </a>
                </div>

                {{-- Modal Preview --}}
                <div class="modal fade" id="modalKosGambar{{ $gbr->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
                        <div class="modal-content border-0">
                            <img src="{{ asset('storage/' . $gbr->gambar) }}" class="img-fluid rounded" alt="Preview Gambar Kos">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Navigasi Panah --}}
        @if(count($kos->galleries) > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#kosCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#kosCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        @endif
    </div>
@endif




            {{-- Google Maps embed (bisa disesuaikan dengan lokasi sebenarnya) --}}
            <iframe 
                src="https://maps.google.com/maps?q={{ urlencode($kos->alamat) }}&output=embed" 
                width="100%" 
                height="250" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>

        {{-- Kanan: Detail --}}
        <div class="col-md-6">
            {{-- Detail Pemilik --}}
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3 border-bottom pb-2 text-success">Detail Pemilik</h6>
                    <p><i class="bi bi-person-fill me-2"></i> <strong>Nama:</strong> {{ $kos->nama_kos ?? 'Tidak diketahui' }}</p>
                    <p><i class="bi bi-geo-alt-fill me-2"></i> <strong>Alamat:</strong> {{ $kos->pemilik->alamat ?? '-' }}</p>
                    <p><i class="bi bi-telephone-fill me-2"></i> <strong>No. HP:</strong> {{ $kos->no_telp }}</p>
                </div>
            </div>

            {{-- Detail Kos --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3 border-bottom pb-2 text-success">Detail Kos</h6>
                    <p><strong>Deskripsi:</strong> {{ $kos->deskripsi }}</p>
                    <p><strong>Alamat:</strong> {{ $kos->alamat }}</p>
                    <p><strong>Tipe Penghuni:</strong> 
                        <span class="badge bg-{{ $kos->tipe_penghuni === 'Putra' ? 'primary' : ($kos->tipe_penghuni === 'Putri' ? 'warning text-dark' : 'secondary') }}">
                            {{ $kos->tipe_penghuni ?? 'Campur' }}
                        </span>
                    </p>
                    <p><strong>Harga:</strong> <span class="text-success fw-semibold">Rp{{ number_format($kos->harga, 0, ',', '.') }}/bulan</span></p>
                    @if($kos->fasilitas)
                        <p class="fw-bold mb-2">Fasilitas:</p>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach(explode(',', $kos->fasilitas) as $fasilitas)
                                @php
                                    $fas = strtolower(trim($fasilitas));
                                    $icon = $icons[$fas] ?? 'bi-check-circle';
                                @endphp
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi {{ $icon }} text-success"></i>
                                    <span>{{ ucfirst($fas) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>

    {{-- PEMBATAS --}}
    <hr class="my-5" style="border-top: 3px solid #198754;">

    {{-- KAMAR TERSEDIA --}}
    <h4 class="fw-bold text-success mb-4">Kamar Tersedia</h4>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($kos->kamar as $kamar)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    @if($kamar->galleries && count($kamar->galleries))
                        <img src="{{ asset('storage/' . $kamar->galleries[0]->gambar) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Foto Kamar">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-semibold">{{ $kamar->nama_kamar }}</h6>
                        <p class="text-muted small mb-1">{{ $kamar->deskripsi }}</p>
                        <p class="text-success fw-bold mb-2">Rp{{ number_format($kamar->harga, 0, ',', '.') }}/bulan</p>

                        <span class="badge bg-{{ $kamar->status === 'tersedia' ? 'success' : 'secondary' }} mb-2">
                            {{ ucfirst($kamar->status) }}
                        </span>

                        
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada kamar yang tersedia.</div>
            </div>
        @endforelse
    </div>

</div>
@endsection
