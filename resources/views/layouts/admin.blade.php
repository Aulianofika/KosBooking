<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | BookingKos.id</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-gray-900 text-white p-4 min-vh-100" style="min-width: 250px;">
            <h2 class="text-xl font-bold mb-4">🏠 BookingKos Admin</h2>
            <ul class="nav flex-column space-y-2">
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link text-white hover:bg-gray-800 rounded px-2 py-1">📊 Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/kos" class="nav-link text-white hover:bg-gray-800 rounded px-2 py-1">🏘️ Data Kos</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/kamar" class="nav-link text-white hover:bg-gray-800 rounded px-2 py-1">🛏️ Data Kamar</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/gallery" class="nav-link text-white hover:bg-gray-800 rounded px-2 py-1">🖼️ Galeri Kos</a>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link text-red-400 hover:bg-red-800 rounded px-2 py-1">🚪 Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Main content -->
        <div class="flex-grow-1 p-5">
            <div class="bg-white rounded-xl shadow-lg p-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
