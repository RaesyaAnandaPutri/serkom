<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produk & Layanan - PT Solusi Koneksi Anda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #fafafa; }
        .grad { background: linear-gradient(160deg, #2f7df6 0%, #6ab0ff 55%, #c3e1ff 100%); }
    </style>
</head>
<body>

    @include('partials.navbar-front')

    {{-- JUDUL HALAMAN --}}
    <section class="py-5">
        <div class="container py-4">
            <h1 class="display-5 fw-bold text-dark mb-3">Produk & Layanan</h1>
            <p class="text-secondary mb-0" style="max-width: 520px;">
                Solusi teknologi yang kami tawarkan untuk membantu bisnis Anda bertumbuh.
            </p>
        </div>
    </section>

    {{-- DAFTAR LAYANAN --}}
    <section class="pb-5">
        <div class="container pb-4">
            <div class="row g-4">
                @forelse($layanan as $item)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('layanan.show', $item->id) }}" class="card h-100 border rounded-4 p-2 text-decoration-none text-dark shadow-sm d-block">

                        @if($item->gambar ?? $item->image)
                            <img src="{{ asset('storage/' . ($item->gambar ?? $item->image)) }}" class="rounded-4 w-100" style="height: 220px; object-fit: cover;" alt="{{ $item->nama ?? $item->name }}">
                        @else
                            <div class="grad rounded-4 text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                                <i class="bi bi-laptop fs-1"></i>
                            </div>
                        @endif

                        <div class="p-3">
                            <h5 class="fw-bold text-dark mb-2">{{ $item->nama ?? $item->name }}</h5>
                            <p class="small text-secondary mb-3 text-truncate" style="max-height: 3.6em; overflow: hidden;">{{ $item->deskripsi ?? $item->description }}</p>
                            <span class="small fw-semibold text-dark">Baca selengkapnya &rsaquo;</span>
                        </div>

                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-inbox fs-1 text-secondary"></i>
                    <p class="text-secondary mt-2 mb-0">Belum ada layanan yang dipublikasikan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('partials.footer-front')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>