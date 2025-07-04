<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | BookingKos.id</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            background: linear-gradient(to right, #16A085, #2980B9);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .card-register {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            padding: 2.5rem;
            width: 100%;
            max-width: 480px;
            animation: fadeIn 0.7s ease;
        }

        .register-title {
            font-weight: 700;
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-control {
            border-radius: .75rem;
            font-size: 0.95rem;
        }

        .btn-primary {
            background-color: #16A085;
            border: none;
            font-weight: 600;
            border-radius: .75rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #138d75;
        }

        .icon-input {
            position: relative;
        }

        .icon-input svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .icon-input input {
            padding-left: 2.5rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="card-register">
        <h3 class="register-title">Daftar Akun</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3 icon-input">
                <label class="form-label">Nama</label>
                <i data-lucide="user"></i>
                <input type="text" name="name" class="form-control" required placeholder="Nama lengkap">
            </div>

            <div class="mb-3 icon-input">
                <label class="form-label">Email</label>
                <i data-lucide="mail"></i>
                <input type="email" name="email" class="form-control" required placeholder="alamat@email.com">
            </div>

            <div class="mb-3 icon-input">
                <label class="form-label">Password</label>
                <i data-lucide="lock"></i>
                <input type="password" name="password" class="form-control" required placeholder="********">
            </div>

            <div class="mb-3 icon-input">
                <label class="form-label">Konfirmasi Password</label>
                <i data-lucide="lock"></i>
                <input type="password" name="password_confirmation" class="form-control" required placeholder="********">
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Daftar</button>
        </form>

        <p class="text-center mt-4 mb-0 text-muted">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Login sekarang</a>
        </p>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
