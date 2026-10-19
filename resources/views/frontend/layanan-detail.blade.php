<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $layanan->nama ?? $layanan->name }} - PT Solusi Koneksi Anda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; }
        .grad { background: linear-gradient(160deg, #2f7df6 0%, #6ab0ff 55%, #c3e1ff 100%); }
        .service-header { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: white; border-radius: 1.5rem; }
    </style>
</head>
<body>

    @include('partials.navbar-front')

    <section class="py-5">
        <div class="container py-3" style="max-width: 900px;">
            
            {{-- Tombol Kembali --}}
            <a href="{{ route('front.layanan') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 mb-4 shadow-sm">
                &larr; Kembali ke Daftar Layanan
            </a>

            {{-- Header Kartu / Banner Layanan --}}
            <div class="service-header p-4 p-md-5 mb-4 shadow">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge bg-secondary bg-opacity-50 text-white rounded-pill px-3 py-2 mb-3 fw-medium">Layanan Profesional</span>
                        <h1 class="fw-bold display-6 mb-3">{{ $layanan->nama ?? $layanan->name }}</h1>
                        <p class="text-light text-opacity-75 mb-0 small">
                            <i class="bi bi-shield-check me-1 text-info"></i> Dijamin berkualitas dan ditangani oleh tim ahli berpengalaman.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Gambar Utama --}}
            @if($layanan->gambar ?? $layanan->image)
                <div class="mb-5">
                    <img src="{{ asset('storage/' . ($layanan->gambar ?? $layanan->image)) }}" class="rounded-4 w-100 shadow-sm object-fit-cover" style="max-height: 450px;" alt="{{ $layanan->nama ?? $layanan->name }}">
                </div>
            @else
                <div class="grad rounded-4 text-white d-flex align-items-center justify-content-center mb-5 shadow-sm" style="height: 320px;">
                    <i class="bi bi-laptop display-1"></i>
                </div>
            @endif

            {{-- Konten Deskripsi & Fitur --}}
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                        <h4 class="fw-bold text-dark mb-4">Tentang Layanan Ini</h4>
                        <div class="text-secondary lh-lg fs-6" style="white-space: pre-line;">
                            {!! $layanan->deskripsi ?? $layanan->description !!}
                        </div>
                    </div>
                </div>

            {{-- Sidebar Aksi / Kontak Cepat --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white text-center">
                    <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3 text-dark"
                        style="width: 60px; height: 60px;">
                        <i class="bi bi-envelope fs-3"></i>
                    </div>

                    <h5 class="fw-bold text-dark mb-2">Tertarik dengan Layanan Ini?</h5>

                    <p class="small text-dark mb-4">
                        Hubungi tim kami melalui halaman kontak untuk konsultasi kebutuhan bisnis Anda.
                    </p>

                    <a href="{{ route('front.kontak') }}"
                    class="btn btn-dark rounded-pill w-100 py-2 fw-semibold shadow-sm">
                        <i class="bi bi-envelope me-1"></i> Hubungi Kami
                    </a>
                </div>
            </div>
            </div>

        </div>
    </section>

    @include('partials.footer-front')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>