<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Booking Kos')</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <!-- Optional: SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
      body {
        background-color: #f5f5f5;
      }
      .navbar-brand {
        font-weight: bold;
      }
      footer {
        margin-top: 4rem;
      }

      .kos-card {
        transition: box-shadow 0.3s ease-in-out;
      }

      .kos-card:hover {
        box-shadow: 0 12px 28px rgba(60, 169, 110, 0.25);
        transform: translateY(-5px);
      }

      .kos-card:hover img {
        transform: scale(1.05);
        transition: transform 0.3s ease;
      }

      .badge {
        font-size: 0.85rem;
        background-color: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(2px);
      }
    </style>

    @stack('head')
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">BookingKos.id</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
            </li>
            @auth
              @if(auth()->user()->role === 'user')
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('riwayat.booking') ? 'active' : '' }}" href="{{ route('riwayat.booking') }}">Riwayat Pesanan</a>
                </li>
              @endif
            @endauth
          </ul>

          <ul class="navbar-nav ms-auto">
            @auth
              <li class="nav-item">
                <a class="nav-link disabled">{{ Auth::user()->name }}</a>
              </li>
              <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?')">
                  @csrf
                  <button type="submit" class="btn btn-link nav-link text-white">Logout</button>
                </form>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
              </li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>

    <!-- Content -->
    <main class="container my-4">
      @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-success text-white text-center py-3">
      &copy; 2025 BookingKos.id • Developed by Aulia
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert for session success message -->
    @if(session('success'))
    <script>
      Swal.fire({
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK'
      });
    </script>
    @endif

    @stack('scripts')
  </body>
</html>
