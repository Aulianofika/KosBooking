@extends('layouts.frontend')

@section('content')
<div class="container py-5">

    {{-- Detail Galeri & Google Maps --}}
    <div class="row g-4 mb-5">
        {{-- Galeri --}}
        <div class="col-md-6">
            @if($kos->galleries && count($kos->galleries))
                <div id="kosCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner rounded shadow-sm">
                        @foreach($kos->galleries as $index => $gbr)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalKosGambar{{ $gbr->id }}">
                                    <img src="{{ asset('storage/' . $gbr->gambar) }}" class="d-block w-100" style="height: 250px; object-fit: cover; cursor: zoom-in;" alt="Foto Kos">
                                </a>
                            </div>

                            {{-- Modal Gambar --}}
                            <div class="modal fade" id="modalKosGambar{{ $gbr->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
                                    <div class="modal-content border-0">
                                        <img src="{{ asset('storage/' . $gbr->gambar) }}" class="img-fluid rounded" alt="Preview Gambar Kos">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

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

            {{-- Google Maps --}}
            <iframe 
                src="https://maps.google.com/maps?q={{ urlencode($kos->alamat) }}&output=embed" 
                width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>

        {{-- Detail Kos --}}
        <div class="col-md-6">
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3 border-bottom pb-2 text-purple">Detail Pemilik</h6>
                    <p><i class="bi bi-person-fill me-2"></i> <strong>Nama:</strong> {{ $kos->nama_kos }}</p>
                    <p><i class="bi bi-geo-alt-fill me-2"></i> <strong>Alamat:</strong> {{ $kos->pemilik->alamat ?? '-' }}</p>
                    <p><i class="bi bi-telephone-fill me-2"></i> <strong>No. HP:</strong> {{ $kos->no_telp }}</p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3 border-bottom pb-2 text-purple">Detail Kos</h6>
                    <p><strong>Deskripsi:</strong> {{ $kos->deskripsi }}</p>
                    <p><strong>Alamat:</strong> {{ $kos->alamat }}</p>
                    <p><strong>Tipe Penghuni:</strong> 
                        <span class="badge bg-{{ $kos->tipe_penghuni === 'Putra' ? 'primary' : ($kos->tipe_penghuni === 'Putri' ? 'warning text-dark' : 'secondary') }}">
                            {{ $kos->tipe_penghuni }}
                        </span>
                    </p>
                    <p><strong>Harga:</strong> <span class="text-purple fw-semibold">Rp{{ number_format($kos->harga, 0, ',', '.') }}/bulan</span></p>

                    @if($kos->fasilitas)
                        <p class="fw-bold mb-2">Fasilitas:</p>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach(explode(',', $kos->fasilitas) as $fasilitas)
                                @php
                                    $fas = strtolower(trim($fasilitas));
                                    $icon = $icons[$fas] ?? 'bi-check-circle';
                                @endphp
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi {{ $icon }} text-purple"></i>
                                    <span>{{ ucfirst($fas) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Pemisah --}}
    <hr class="my-5" style="border-top: 3px solid #198754;">

    {{-- Kamar --}}
    <h4 class="fw-bold text-purple mb-4">Kamar Tersedia</h4>
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
                        <p class="text-purple fw-bold mb-2">Rp{{ number_format($kamar->harga, 0, ',', '.') }}/bulan</p>

                        

                        @auth
                            @if(auth()->user()->role === 'user' && $kamar->status === 'tersedia')
                                <!-- Tombol Pesan Sekarang -->
                                <button class="btn btn-sm btn-outline-purple mt-auto" data-bs-toggle="modal" data-bs-target="#modalBooking{{ $kamar->id }}">
                                    Pesan Sekarang
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

            {{-- Modal Booking --}}  
        <div class="modal fade" id="modalBooking{{ $kamar->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('booking.store', $kamar->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf

            {{-- Hidden input --}}
            <input type="hidden" name="kos_id" value="{{ $kos->id }}">
            <input type="hidden" name="harga" value="{{ $kamar->harga }}">

            <div class="modal-header">
                <h5 class="modal-title">Pesan Kamar: {{ $kamar->nama_kamar }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                <label for="tanggal_mulai_{{ $kamar->id }}" class="form-label">Tanggal Mulai Sewa</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai_{{ $kamar->id }}" class="form-control" required min="{{ date('Y-m-d') }}">
                </div>

                <div class="mb-3">
                <label for="catatan_{{ $kamar->id }}" class="form-label">Catatan (Opsional)</label>
                <textarea name="catatan" id="catatan_{{ $kamar->id }}" class="form-control" rows="3" placeholder="Contoh: ingin kamar dekat jendela"></textarea>
                </div>

                <div class="mb-3">
                <label for="bukti_transaksi_{{ $kamar->id }}" class="form-label">Upload Bukti Pembayaran</label>
                <input type="file" name="bukti_transaksi" id="bukti_transaksi_{{ $kamar->id }}" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-purple">Kirim Pemesanan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
            </form>
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
