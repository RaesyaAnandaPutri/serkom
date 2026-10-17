<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - PT Solusi Koneksi Anda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fafafa;
            color: #1e293b;
        }
        .btn-dark {
            background-color: #1e293b;
            border-color: #1e293b;
            transition: all 0.2s ease;
        }
        .btn-dark:hover {
            background-color: #0f172a;
            border-color: #0f172a;
        }
        .form-control:focus {
            border-color: #64748b;
            box-shadow: 0 0 0 0.25rem rgba(100, 116, 139, 0.15);
        }
        .brand-box {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }
    </style>
</head>
<body class="d-flex align-items-center min-vh-100 py-5">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                
                {{-- Logo / Identitas Perusahaan di Atas Card --}}
                <div class="text-center mb-4">
                    <a href="{{ url('/') }}" class="d-inline-flex align-items-center gap-2 text-decoration-none text-dark fw-bold fs-5 mb-2">
                        <img src="{{ asset('images/logo solusi koneksi anda.png') }}" alt="Logo Solusi Koneksi Anda" style="width: 50px; height: 50px; object-fit: contain;" class="rounded-3">
                        Solusi Koneksi Anda
                    </a>
                    <p class="text-secondary small mb-0">Masuk ke panel kontrol admin</p>
                </div>

                {{-- Card Login --}}
                <div class="card border-0 rounded-4 shadow-sm p-4 bg-white">
                    <div class="card-body">
                        
                        {{-- Session Status (jika ada pesan sukses/reset password) --}}
                        @if (session('status'))
                            <div class="alert alert-success small py-2 mb-3" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.authenticate') }}">
                            @csrf

                            {{-- Input Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label small fw-semibold text-secondary">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control bg-light border-start-0 rounded-end-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@gmail.com">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Input Password --}}
                            <div class="mb-3">
                                <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control bg-light border-start-0 rounded-end-3 @error('password') is-invalid @enderror" name="password" required placeholder="••••••••">
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Remember Me & Lupa Password --}}
                            <div class="d-flex justify-content-between align-items-center mb-4 small">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-secondary" for="remember">
                                        Ingat saya
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none text-primary" href="{{ route('password.request') }}">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>

                            {{-- Tombol Login --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark rounded-pill py-2 fw-semibold shadow-sm">
                                    Masuk ke Dashboard
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

                {{-- Tombol Kembali ke Website Utama --}}
                <div class="text-center mt-4">
                    <a href="{{ url('/') }}" class="text-decoration-none text-secondary small">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda Website
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>