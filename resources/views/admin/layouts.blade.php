<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('page-title', 'Admin Panel | BookingKos')</title>

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
    --ungu-muda: #ede7f6;
    --ungu-tua: #6a1b9a;
    --pink-lembut: #f9d6e2;
    --ungu: #6a1b9a;
    --ungu-hover: #e48ad8ff;
    --ungu-light: #A0E7E5;
  }

  body {
    font-family: 'Segoe UI', 'Poppins', sans-serif;
    font-size: 15px;
    color: #444;
    background-color: #f9f9fb;
  }

  /* Section Title */
  .section-title {
    font-size: 1.75rem;
    font-weight: bold;
    color: var(--ungu-tua);
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 10px;
    position: relative;
  }

  .section-title::after {
    content: "💜✨";
    position: absolute;
    right: 10px;
    font-size: 1.2rem;
  }

  /* Tables */
  .table-purple thead {
    background-color: var(--ungu-muda);
    color: var(--ungu-tua);
    text-align: center;
  }

  .table-striped tbody tr:nth-of-type(odd) {
    background-color: #faf7fc;
  }

  /* Buttons */
  .btn-purple {
    background-color: #ba68c8;
    color: white;
    font-size: 0.9rem;
    padding: 6px 14px;
    border-radius: 8px;
    text-decoration: none;
  }

  .btn-purple:hover {
    background-color: #9c27b0;
  }

  .btn-update {
    background-color: #ba68c8;
    color: white;
    border: none;
    font-size: 0.8rem;
    padding: 4px 10px;
    border-radius: 8px;
  }

  .btn-update:hover {
    background-color: #9c27b0;
  }

  /* Select */
  .form-select-sm {
    border-color: #e1bee7;
  }

  /* Status Badges */
  .badge-status {
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
  }

  .badge-pending {
    background-color: #e0d7f3;
    color: #6a1b9a;
  }

  .badge-diterima,
  .badge-tersedia {
    background-color: #d0f0e0;
    color: #388e3c;
  }

  .badge-ditolak,
  .badge-penuh {
    background-color: #f9d6e2;
    color: #c62828;
  }

  /* Image */
  .img-bukti {
    border: 2px solid #d1c4e9;
    border-radius: 6px;
  }

  img.object-cover {
    object-fit: cover;
    height: 180px;
    width: 100%;
  }

  /* Admin Header */
  .admin-header {
    background: linear-gradient(90deg, #ede7f6, #fce4ec);
    padding: 1rem 1.5rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.06);
    margin-bottom: 20px;
  }

  .admin-header h1 {
    font-size: 1.8rem;
    color: #6a1b9a;
    font-weight: 700;
  }

  .admin-header p {
    margin-bottom: 0;
    font-size: 0.95rem;
    color: #777;
  }

  /* Utility */
  .bg-ungu { background-color: var(--ungu); }
  .hover\:bg-ungu-hover:hover { background-color: var(--ungu-hover); }
  .text-ungu-light { color: var(--ungu-light); }
  .border-ungu { border-color: var(--ungu); }
</style>

</head>
<body class="bg-gray-100 text-gray-900">

  <div class="d-flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="bg-ungu text-white p-4 shadow-lg" style="min-width: 240px;">
      <div class="mb-5 border-b border-ungu pb-4">
        <h2 class="text-2xl fw-bold">BookingKos</h2>
        <p class="text-sm text-ungu-light">Admin Panel</p>
      </div>

      <!-- Sidebar Menu -->
      <nav class="flex-grow">
        <ul class="nav flex-column gap-2 text-base">
          <li class="nav-item">
            <a href="/admin/dashboard" class="nav-link text-white px-3 py-2 rounded hover:bg-ungu-hover">
              <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/kos" class="nav-link text-white px-3 py-2 rounded hover:bg-ungu-hover">
              <i class="bi bi-house me-2"></i> Data Kos
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/kamar" class="nav-link text-white px-3 py-2 rounded hover:bg-ungu-hover">
              <i class="bi bi-door-open me-2"></i> Data Kamar
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/pemesanan" class="nav-link text-white px-3 py-2 rounded hover:bg-ungu-hover">
              <i class="bi bi-receipt me-2"></i> Pemesanan
            </a>
          </li>

          <li class="nav-item mt-4 pt-4 border-top border-toska">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link text-red-300 px-3 py-2 rounded hover:bg-red-600 hover:text-white border-0 bg-transparent w-100 text-start">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow-1 p-4 overflow-auto">
      <!-- Admin Page Header -->
      <div class="admin-header d-flex justify-content-between align-items-center">
        <div>
          <h1>@yield('page-title', 'Dashboard ')</h1>
          <p>Panel kontrol untuk mengelola data BookingKos.id </p>
        </div>
        <div>
          <span class="badge rounded-pill bg-ungu text-white py-2 px-3">
            <i class="bi bi-person-circle me-1"></i> Admin
          </span>
        </div>
      </div>

      <!-- Blade Content -->
      <div class="bg-white rounded-lg shadow-sm p-4">
        @yield('content')
      </div>
    </main>
  </div>

</body>
</html>
