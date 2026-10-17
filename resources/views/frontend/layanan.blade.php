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

        /* Kustomisasi Pagination agar sesuai tema (Dark & Secondary) */
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
    </style>
</head>
<body>

    @include('partials.navbar-front')

    {{-- JUDUL HALAMAN & SEARCH BAR --}}
    <section class="py-5">
        <div class="container py-4">
            <div class="row align-items-center justify-content-between g-4">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold text-dark mb-2">Produk & Layanan</h1>
                    <p class="text-secondary mb-0">
                        Solusi teknologi profesional yang kami tawarkan untuk membantu bisnis Anda bertumbuh secara digital.
                    </p>
                </div>
                
                {{-- Form Search Bar --}}
                <div class="col-lg-5">
                    <form action="{{ route('front.layanan') }}" method="GET">
                        {{-- Pertahankan kategori yang sedang aktif saat melakukan pencarian --}}
                        @if(request('kategori'))
                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        @endif

                        <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white border">
                            <input type="text" name="cari" class="form-control border-0 px-4 py-3 shadow-none" placeholder="Cari layanan IT..." value="{{ request('cari') }}">
                            <button class="btn btn-dark px-4" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- TOMBOL FILTER KATEGORI LAYANAN --}}
            <div class="d-flex flex-wrap gap-2 mt-4 pt-2">
                <a href="{{ route('front.layanan', ['cari' => request('cari')]) }}" class="btn {{ request('kategori') == '' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill px-4 py-2 small fw-semibold">
                    Semua
                </a>
                <a href="{{ route('front.layanan', ['kategori' => 'Web Development', 'cari' => request('cari')]) }}" class="btn {{ request('kategori') == 'Web Development' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill px-4 py-2 small fw-semibold">
                    Web Development
                </a>
                <a href="{{ route('front.layanan', ['kategori' => 'Mobile Apps', 'cari' => request('cari')]) }}" class="btn {{ request('kategori') == 'Mobile Apps' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill px-4 py-2 small fw-semibold">
                    Mobile Apps
                </a>
                <a href="{{ route('front.layanan', ['kategori' => 'Sistem Informasi', 'cari' => request('cari')]) }}" class="btn {{ request('kategori') == 'Sistem Informasi' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill px-4 py-2 small fw-semibold">
                    Sistem Informasi
                </a>
                <a href="{{ route('front.layanan', ['kategori' => 'IT Consulting & Cloud', 'cari' => request('cari')]) }}" class="btn {{ request('kategori') == 'IT Consulting & Cloud' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill px-4 py-2 small fw-semibold">
                    IT Consulting & Cloud
                </a>
            </div>
        </div>
    </section>

    {{-- DAFTAR LAYANAN --}}
    <section class="pb-5">
        <div class="container pb-4">
            <div class="row g-4">
                @forelse($layanan as $item)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('layanan.show', $item->id) }}" class="card h-100 border rounded-4 p-2 text-decoration-none text-dark shadow-sm d-block bg-white">
                        <div class="mb-2 overflow-hidden rounded-4 position-relative">
                            {{-- Badge Kategori di atas gambar --}}
                            <div class="position-absolute top-0 start-0 m-3 z-1">
                                <span class="badge bg-dark bg-opacity-75 backdrop-blur px-3 py-2 rounded-pill small">
                                    {{ $item->kategori ?? 'Layanan' }}
                                </span>
                            </div>

                            @if($item->gambar ?? $item->image)
                                <img src="{{ asset('storage/' . ($item->gambar ?? $item->image)) }}" class="rounded-4 w-100" style="height: 220px; object-fit: cover;" alt="{{ $item->nama ?? $item->name }}">
                            @else
                                <div class="grad rounded-4 text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                                    <i class="bi bi-laptop fs-1"></i>
                                </div>
                            @endif
                        </div>
                        
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
                    <p class="text-secondary mt-2 mb-0">Tidak ada layanan yang ditemukan pada kategori ini.</p>
                </div>
                @endforelse
            </div>

            {{-- Tombol Navigasi Halaman Layanan --}}
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $layanan->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer-front')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>