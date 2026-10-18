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

        /* Kustomisasi Pagination (Dark & Secondary) */
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
            color: #6c757d !important;
        }
        .pagination .page-item.disabled .page-link {
            color: #adb5bd !important;
        }
        [x-cloak] { display: none !important; }
        .gallery-card { cursor: pointer; }
        .gallery-card:focus-visible { outline: 3px solid #2f7df6; outline-offset: 3px; }
    </style>
</head>
<body x-data="{ selectedGallery: null }" @keydown.escape.window="selectedGallery = null">

    @include('partials.navbar-front')

    {{-- JUDUL HALAMAN & SEARCH BAR --}}
    <section class="py-5">
        <div class="container py-4">
            <div class="row align-items-center justify-content-between g-4">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold text-dark mb-2">Galeri Kegiatan & Proyek</h1>
                    <p class="text-secondary mb-0">
                        Dokumentasi kegiatan, portofolio proyek, serta momen penting perusahaan kami.
                    </p>
                </div>

                {{-- Form Search Bar --}}
                <div class="col-lg-5">
                    <form action="{{ route('front.galeri') }}" method="GET">
                        <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white border">
                            <input type="text" name="cari" class="form-control border-0 px-4 py-3 shadow-none" placeholder="Cari galeri atau proyek..." value="{{ request('cari') }}">
                            <button class="btn btn-dark px-4" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- DAFTAR GALERI --}}
    <section class="pb-5">
        <div class="container pb-4">
            <div class="row g-4">
                @forelse($galeri as $gal)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border rounded-4 p-2 shadow-sm bg-white gallery-card"
                         role="button"
                         tabindex="0"
                         aria-label="Lihat detail {{ $gal->judul }}"
                         @click="selectedGallery = {
                            title: @js($gal->judul),
                            description: @js($gal->deskripsi ? strip_tags($gal->deskripsi) : 'Tidak ada deskripsi.'),
                            image: @js($gal->gambar ? asset('storage/' . $gal->gambar) : null),
                            date: @js($gal->created_at->translatedFormat('d M Y'))
                         }"
                         @keydown.enter.prevent="$el.click()"
                         @keydown.space.prevent="$el.click()">
                        <div class="mb-2 overflow-hidden rounded-4">
                            @if($gal->gambar)
                                <img src="{{ asset('storage/' . $gal->gambar) }}" class="rounded-4 w-100" style="height: 240px; object-fit: cover;" alt="{{ $gal->judul }}">
                            @else
                                <div class="grad rounded-4 text-white d-flex align-items-center justify-content-center" style="height: 240px;">
                                    <i class="bi bi-image fs-1"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-3">
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
                    <p class="text-secondary mt-2 mb-0">Tidak ada galeri yang ditemukan.</p>
                </div>
                @endforelse
            </div>

            <template x-if="selectedGallery">
                <div x-transition.opacity
                     class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center p-3"
                     style="z-index: 1080; background: rgba(15, 23, 42, .6);"
                     role="presentation"
                     @click.self="selectedGallery = null">
                    <section x-transition
                             role="dialog"
                             aria-modal="true"
                             aria-labelledby="public-gallery-detail-title"
                             class="card border-0 rounded-4 shadow-lg overflow-hidden w-100"
                             style="max-width: 760px; max-height: 90vh;">
                        <div class="row g-0">
                            <div class="col-md-6 bg-light d-flex align-items-center justify-content-center" style="min-height: 240px;">
                                <template x-if="selectedGallery.image">
                                    <img :src="selectedGallery.image"
                                         :alt="selectedGallery.title"
                                         class="w-100 h-100 object-fit-cover"
                                         style="min-height: 240px; max-height: 520px;">
                                </template>
                                <template x-if="!selectedGallery.image">
                                    <div class="grad w-100 h-100 text-white d-flex align-items-center justify-content-center" style="min-height: 240px;">
                                        <i class="bi bi-image fs-1"></i>
                                    </div>
                                </template>
                            </div>
                            <div class="col-md-6 d-flex flex-column overflow-auto">
                                <div class="p-4 p-lg-5">
                                    <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                        <span class="badge bg-light border text-secondary rounded-pill">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            <span x-text="selectedGallery.date"></span>
                                        </span>
                                        <button type="button"
                                                class="btn-close"
                                                aria-label="Tutup detail galeri"
                                                @click="selectedGallery = null"></button>
                                    </div>
                                    <h2 id="public-gallery-detail-title" class="h4 fw-bold text-dark mb-3" x-text="selectedGallery.title"></h2>
                                    <p class="text-secondary mb-0" style="white-space: pre-line;" x-text="selectedGallery.description"></p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </template>

            {{-- Tombol Navigasi Halaman Galeri --}}
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $galeri->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer-front')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.17.4/dist/cdn.min.js"></script>
</body>
</html>