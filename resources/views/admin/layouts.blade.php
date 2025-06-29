<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin | BookingKos.id</title>

  <!-- Bootstrap 5 (masih bisa dipakai jika dibutuhkan) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap JS (modal) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    .nav-link {
      transition: background 0.2s ease-in-out, color 0.2s ease-in-out;
    }

    .nav-link.active {
      background-color: #1f2937; /* gray-800 */
    }
  </style>
</head>

<body class="bg-gray-100 text-gray-800">

  <div class="d-flex min-vh-100">
    <!-- Sidebar -->
    <aside class="bg-slate-900 text-white p-4 shadow-lg" style="min-width: 240px;">
      <div class="mb-5">
        <h2 class="text-xl fw-semibold tracking-wide border-b border-slate-700 pb-3 mb-4">BookingKos Admin</h2>
        <ul class="nav flex-column gap-2">
          <li class="nav-item">
            <a href="/admin/dashboard"
               class="nav-link text-white px-3 py-2 rounded-md bg-slate-800 hover:bg-slate-700">
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/kos"
               class="nav-link text-white px-3 py-2 rounded-md hover:bg-slate-700">
              Data Kos
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/kamar"
               class="nav-link text-white px-3 py-2 rounded-md hover:bg-slate-700">
              Data Kamar
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/gallery"
               class="nav-link text-white px-3 py-2 rounded-md hover:bg-slate-700">
              Galeri Kos
            </a>
          </li>
          <li class="nav-item mt-4">
            <a href="/logout"
               class="nav-link text-red-400 px-3 py-2 rounded-md hover:bg-red-700 hover:text-white">
              Logout
            </a>
          </li>
        </ul>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow-1 p-4">
      <div class="bg-white rounded-xl shadow-sm p-5">
        @yield('content')
      </div>
    </main>
  </div>

</body>
</html>
