<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri Kegiatan & Proyek - PT Solusi Koneksi Anda</title>

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
            <h1 class="display-5 fw-bold text-dark mb-3">Galeri Kegiatan & Proyek</h1>
            <p class="text-secondary mb-0" style="max-width: 520px;">
                Dokumentasi kegiatan, portofolio proyek, serta momen penting perusahaan kami.
            </p>
        </div>
    </section>

    {{-- DAFTAR GALERI --}}
    <section class="pb-5">
        <div class="container pb-4">
            <div class="row g-4">
                @forelse($galeri as $gal)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border rounded-4 p-2 shadow-sm">
                        @if($gal->gambar)
                            <img src="{{ asset('storage/' . $gal->gambar) }}" class="rounded-4 w-100" style="height: 240px; object-fit: cover;" alt="{{ $gal->judul }}">
                        @else
                            <div class="grad rounded-4 text-white d-flex align-items-center justify-content-center" style="height: 240px;">
                                <i class="bi bi-image fs-1"></i>
                            </div>
                        @endif
                        <div class="p-3">
                            {{-- Tanggal Publikasi --}}
                            <span class="badge bg-light border text-secondary rounded-pill mb-2">
                                <i class="bi bi-calendar3 me-1"></i> {{ $gal->created_at->translatedFormat('d M Y') }}
                            </span>
                            
                            <h5 class="fw-bold text-dark mb-2">{{ $gal->judul }}</h5>
                            @if($gal->deskripsi)
                                <p class="small text-secondary mb-0">{{ Str::limit(strip_tags($gal->deskripsi), 90) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-image fs-1 text-secondary opacity-50"></i>
                    <p class="text-secondary mt-2 mb-0">Belum ada foto galeri yang dipublikasikan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('partials.footer-front')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>