<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Booking Kos')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
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
    </style>
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
    <main class="container my-5">
      @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-success text-white text-center py-3">
      &copy; 2025 BookingKos.id • Developed by Aulia
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
