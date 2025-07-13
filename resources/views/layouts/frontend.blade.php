<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Booking Kos')</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Optional: SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
      :root {
      --ungu: #7e57c2;
      --ungu-hover: #6a1b9a;
      --ungu-muda: #ede7f6;
      --ungu-soft: #d1c4e9;
    }
      body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f5f5;
      }
      .navbar {
      background-color: var(--ungu);
      }
      .navbar-brand {
        font-weight: bold;
      }
      .hero {
      background-color: var(--ungu-muda);
      padding: 70px 0;
      text-align: center;
    }

    .hero h1 {
      color: var(--ungu);
      font-weight: 700;
      font-size: 2.5rem;
    }
     .hero p {
      font-size: 1.1rem;
      color: #5f5f5f;
    }
     .btn-ungu {
      background-color: var(--ungu);
      color: white;
      font-weight: 600;
      border-radius: 30px;
    }

    .btn-ungu:hover {
      background-color: var(--ungu-hover);
    }
      footer {
      background-color: var(--ungu);
      color: white;
      text-align: center;
      padding: 16px 0;
        margin-top: 4rem;
      }
      .text-purple-700 { color: var(--ungu-hover); }
      .border-purple-300 { border-color: var(--ungu-soft) !important; }
      
      .text-purple {
        color: #7e57c2;
      }
      .btn-outline-purple {
        border: 1px solid #7e57c2;
        color: #7e57c2;
      }
      .btn-outline-purple:hover {
        background-color: #7e57c2;
        color: #fff;
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
       .section-title {
      font-weight: 700;
      font-size: 1.8rem;
      color: var(--ungu-hover);
    }

    .testimonial-card {
      background-color: white;
      padding: 1.5rem;
      border-radius: 1rem;
      box-shadow: 0 4px 16px rgba(0,0,0,0.05);
      border-left: 4px solid var(--ungu-soft);
      min-height: 160px;
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
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><i class="bi bi-house-heart-fill me-1"></i> BookingKos.id</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
               <i class="bi bi-house-door-fill me-1"></i>Home</a>
            </li>
            @auth
              @if(auth()->user()->role === 'user')
                
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('explore.kos') ? 'active' : '' }}" href="{{ route('explore.kos') }}">
                    <i class="bi bi-compass me-1"></i> Jelajah Kos
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('riwayat.booking') ? 'active' : '' }}" href="{{ route('riwayat.booking') }}"><i class="bi bi-clock-history me-1"></i> Riwayat</a>
                </li>
              @endif
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                
            <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item text-purple">
                      <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                  </form>
                </li>
              </ul>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login
              </a>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

       <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1>Selamat Datang di BookingKos.id 💜</h1>
      <p>Temukan kos terbaikmu dengan nyaman dan cepat</p>
      <a href="{{ route('explore.kos') }}" class="btn btn-ungu mt-3 px-4 py-2">
        <i class="bi bi-search me-1"></i> Mulai Cari
      </a>
    </div>
  </section>


    <!-- Content -->
    <main class="container my-4">
      @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center">
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
