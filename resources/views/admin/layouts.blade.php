<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel | BookingKos</title>

  <!-- Bootstrap & Tailwind -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    :root {
      --toska: #014D4E;
      --toska-hover: #036666;
      --toska-light: #A0E7E5;
    }

    .bg-toska { background-color: var(--toska); }
    .hover\:bg-toska-hover:hover { background-color: var(--toska-hover); }
    .text-toska-light { color: var(--toska-light); }
    .border-toska { border-color: var(--toska); }

    body {
      font-family: 'Inter', sans-serif;
    }

    img.object-cover {
      object-fit: cover;
      height: 180px;
      width: 100%;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-900">

  <div class="d-flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="bg-toska text-white p-4 shadow-lg" style="min-width: 240px;">
      <div class="mb-5 border-b border-toska pb-4">
        <h2 class="text-2xl fw-bold">BookingKos</h2>
        <p class="text-sm text-toska-light">Admin Panel</p>
      </div>

      <!-- Sidebar Menu -->
      <nav class="flex-grow">
        <ul class="nav flex-column gap-2 text-base">
          <li class="nav-item">
            <a href="/admin/dashboard" class="nav-link text-white px-3 py-2 rounded hover:bg-toska-hover">
              <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/kos" class="nav-link text-white px-3 py-2 rounded hover:bg-toska-hover">
              <i class="bi bi-house me-2"></i> Data Kos
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/kamar" class="nav-link text-white px-3 py-2 rounded hover:bg-toska-hover">
              <i class="bi bi-door-open me-2"></i> Data Kamar
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/gallery" class="nav-link text-white px-3 py-2 rounded hover:bg-toska-hover">
              <i class="bi bi-images me-2"></i> Galeri Kos
            </a>
          </li>

          <li class="nav-item mt-4 pt-4 border-top border-toska">
            <a href="/logout" class="nav-link text-red-300 px-3 py-2 rounded hover:bg-red-600 hover:text-white">
              <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow-1 p-4 overflow-auto">
      <div class="bg-white rounded-lg shadow-sm p-5">
        @yield('content')
      </div>
    </main>
  </div>

</body>
</html>
