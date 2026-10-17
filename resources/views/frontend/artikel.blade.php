<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artikel & Informasi - PT Solusi Koneksi Anda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #fafafa; }
        .grad { background: linear-gradient(160deg, #2f7df6 0%, #6ab0ff 55%, #c3e1ff 100%); }

        /* Kustomisasi Tombol Pindah Halaman (Pagination) */
        .pagination .page-item.active .page-link {
            background-color: #212529 !important;
            border-color: #212529 !important;
            color: #ffffff !important;
        }
        .pagination .page-link {
            color: #212529;
        }
        .pagination .page-link:hover {
            color: #000;
            background-color: #e9ecef;
        }
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            color: #6c757d !important; /* Warna abu-abu / secondary untuk panah */
        }
        .pagination .page-item.disabled .page-link {
            color: #adb5bd !important;
        }
    </style>
</head>
<body>

    @include('partials.navbar-front')

    {{-- JUDUL HALAMAN & SEARCH BAR --}}
    <section class="py-5">
        <div class="container py-4">
            <div class="row align-items-center justify-content-between g-4">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold text-dark mb-2">Artikel & Informasi Terkini</h1>
                    <p class="text-secondary mb-0">
                        Berita, wawasan, dan tips seputar teknologi dan perkembangan digital untuk bisnis Anda.
                    </p>
                </div>

                {{-- Form Search Bar --}}
                <div class="col-lg-5">
                    <form action="{{ route('front.artikel') }}" method="GET">
                        <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white border">
                            <input type="text" name="cari" class="form-control border-0 px-4 py-3 shadow-none" placeholder="Cari artikel atau wawasan..." value="{{ request('cari') }}">
                            <button class="btn btn-dark px-4" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- DAFTAR ARTIKEL --}}
    <section class="pb-5">
        <div class="container pb-4">
            <div class="row g-4">
                @forelse($artikel as $art)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border rounded-4 p-2 bg-white shadow-sm">
                        <div class="overflow-hidden rounded-4">
                            @if($art->gambar)
                                <img src="{{ asset('storage/' . $art->gambar) }}" class="rounded-4 w-100" style="height: 200px; object-fit: cover;" alt="{{ $art->judul }}">
                            @else
                                <div class="grad rounded-4 text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="bi bi-newspaper fs-1"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-3">
                            <span class="badge bg-light border text-secondary rounded-pill mb-2">
                                <i class="bi bi-calendar3 me-1"></i> {{ $art->created_at->translatedFormat('d M Y') }}
                            </span>
                            <h5 class="fw-bold text-dark mb-2">{{ $art->judul }}</h5>
                            <p class="small text-secondary mb-3">{{ Str::limit(strip_tags($art->konten), 90) }}</p>
                            
                            <a href="{{ route('artikel.show', $art->id) }}" class="text-dark fw-semibold small text-decoration-none">
                                Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-newspaper fs-1 text-secondary opacity-50"></i>
                    <p class="text-secondary mt-2 mb-0">Tidak ada artikel yang ditemukan.</p>
                </div>
                @endforelse
            </div>

            {{-- Tombol Navigasi Halaman Artikel --}}
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $artikel->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer-front')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>