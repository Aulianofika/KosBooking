<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BookingKos.id - Cari Kos Mudah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">BookingKos.id</a>

        <div class="ms-auto">
            @if(Auth::check())
                <span class="text-white me-2">Hai, {{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
            @endif
        </div>
    </div>
</nav>

<div class="container py-4">
    <h3 class="mb-4">Daftar Kos Tersedia</h3>

    <div class="row">
        @foreach($kos as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $item->gambar_utama) }}" class="card-img-top" alt="gambar kos">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama_kos }}</h5>
                        <p class="card-text">{{ $item->alamat }}</p>
                        <p class="card-text"><strong>Rp{{ number_format($item->harga, 0, ',', '.') }}/bulan</strong></p>

                        @if(Auth::check() && Auth::user()->role === 'user')
                            <a href="{{ route('kos.show', $item->id) }}" class="btn btn-primary w-100">Lihat Detail</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary w-100">Login untuk Lihat Detail</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
