<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - Solusi Koneksi Anda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root { --bs-primary: #64748b; --bs-primary-rgb: 100, 116, 139; --bs-body-font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: linear-gradient(160deg, #f1f3f5, #e9ecef); font-size: .88rem; }
        .app { max-width: 1600px; }
        .app-card { min-height: calc(100vh - 2rem); }
        .nav-pills { --bs-nav-pills-link-active-bg: #64748b; }
        .avatar { width: 52px; height: 52px; }
    </style>
</head>
<body class="min-vh-100 p-2 p-md-3">
    <div class="app w-100 mx-auto">
        <div class="app-card row g-0 bg-white rounded-5 overflow-hidden shadow border">

            @include('partials.sidebar')

            <main class="col-12 col-lg-9 bg-light p-4 d-flex flex-column">
                {{-- Judul halaman --}}
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                    <div>
                        <h4 class="fw-bold mb-0">@yield('title')</h4>
                        <small class="text-muted">@yield('subtitle', 'Kelola data website dengan mudah dan cepat.')</small>
                    </div>
                    @yield('action')
                </div>

                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 rounded-4" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')

                <p class="text-center text-muted small border-top pt-3 mt-auto mb-0">&copy; {{ date('Y') }} PT Solusi Koneksi Anda</p>
            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>