<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $artikel->judul }} - PT Solusi Koneksi Anda</title>

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

    <section class="py-5">
        <div class="container py-4" style="max-width: 800px;">
            
            {{-- Tombol Kembali ke Halaman Artikel --}}
            <a href="{{ route('front.artikel') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 mb-4">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Artikel
            </a>

            {{-- Tanggal & Kategori --}}
            <div class="mb-3">
                <span class="badge bg-light border text-secondary rounded-pill">
                    <i class="bi bi-calendar3 me-1"></i> {{ $artikel->created_at->format('d M Y') }}
                </span>
            </div>

            {{-- Judul Artikel --}}
            <h1 class="fw-bold text-dark display-6 mb-4">{{ $artikel->judul }}</h1>

            {{-- Gambar Artikel --}}
            @if($artikel->gambar)
                <div class="rounded-4 overflow-hidden mb-4 shadow-sm" style="max-height: 400px;">
                    <img src="{{ asset('storage/' . $artikel->gambar) }}" class="w-100 h-100 object-fit-cover" alt="{{ $artikel->judul }}">
                </div>
            @endif

            {{-- Konten Artikel --}}
            <div class="content text-secondary lh-lg" style="white-space: pre-line; font-size: 1.05rem;">
                {!! $artikel->konten !!}
            </div>

        </div>
    </section>

    @include('partials.footer-front')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>