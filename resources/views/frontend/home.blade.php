<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $profil->name ?? 'PT Solusi Koneksi Anda' }} - IT Solution & Web Development</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #fafafa; }
        .grad { background: linear-gradient(160deg, #2f7df6 0%, #6ab0ff 55%, #c3e1ff 100%); }
        .hero-title { letter-spacing: -1px; }
        .hero-visual { min-height: 500px; border-radius: 28px; }
    </style>
</head>
<body>

    @include('partials.navbar-front')

    {{-- ============ 1. HERO ============ --}}
    <section class="hero d-flex align-items-center py-5">
        <div class="container">
            <div class="row g-5 align-items-stretch">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 class="hero-title display-5 fw-bold lh-sm text-dark mb-4">
                        Solusi IT & Web Development untuk Bisnis Anda
                    </h1>
                    <p class="text-secondary mb-4" style="max-width: 480px;">
                        {{ Str::limit($profil->deskripsi ?? 'Kami membantu perusahaan membangun sistem informasi dan website yang cepat, aman, dan mudah dikembangkan.', 150) }}
                    </p>
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <a href="{{ url('/profil-perusahaan') }}" class="btn bg-dark text-white rounded-pill px-4 py-3 fw-semibold">Baca Selengkapnya</a>
                        <a href="{{ url('/layanan') }}" class="text-dark fw-semibold text-decoration-none">Lihat Layanan</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-visual position-relative h-100 overflow-hidden"
                         style="background-image: url('{{ asset('images/hero.png') }}'), linear-gradient(160deg, #2f7df6, #c3e1ff); background-size: cover; background-position: center;">
                        <div class="position-absolute top-0 start-0 m-4 bg-dark text-white rounded-pill px-3 py-2 small fw-semibold">
                            <i class="bi bi-code-slash me-1"></i> Web Development
                        </div>
                        <div class="position-absolute bottom-0 start-0 m-4 bg-white rounded-pill shadow d-flex align-items-center gap-2 py-2 pe-4 ps-2">
                            <span class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            <span class="small fw-semibold text-dark">Siap mendukung<br>transformasi digital</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ 2. WHY CHOOSE US ============ --}}
    <section class="py-5">
        <div class="container py-4">
            <div class="row g-4 align-items-center">
                <div class="col-lg-4 d-flex flex-column gap-4">
                    <div class="d-flex gap-3">
                        <div class="bg-dark text-white rounded-4 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 52px; height: 52px;">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark">Tim Berpengalaman</h5>
                            <p class="small text-secondary mb-0">Developer dan konsultan kami sudah menangani berbagai proyek website dan sistem informasi.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="bg-dark text-white rounded-4 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 52px; height: 52px;">
                            <i class="bi bi-bullseye fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark">Sesuai Kebutuhan</h5>
                            <p class="small text-secondary mb-0">Setiap proyek dirancang dari kebutuhan bisnis Anda, bukan template yang sama untuk semua klien.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="text-center py-4">
                        <h2 class="hero-title display-4 fw-bold text-dark mb-3">Why choose us?</h2>
                        <p class="text-secondary mb-0">Alasan bisnis Anda layak bermitra dengan kami.</p>
                    </div>
                </div>
                <div class="col-lg-4 d-flex flex-column gap-4">
                    <div class="d-flex gap-3">
                        <div class="bg-dark text-white rounded-4 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 52px; height: 52px;">
                            <i class="bi bi-shield-check fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark">Aman & Andal</h5>
                            <p class="small text-secondary mb-0">Sistem dibangun dengan standar keamanan yang baik dan diuji dulu sebelum diserahkan.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="bg-dark text-white rounded-4 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 52px; height: 52px;">
                            <i class="bi bi-headset fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark">Dukungan Berkelanjutan</h5>
                            <p class="small text-secondary mb-0">Kami tetap mendampingi dan merawat sistem setelah berjalan, bukan berhenti saat proyek selesai.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ 3. LAYANAN ============ --}}
    <section class="py-5">
        <div class="container py-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-5">
                <div style="max-width: 520px;">
                    <h2 class="hero-title fw-bold text-dark mb-2">Layanan IT untuk mengembangkan bisnis Anda</h2>
                    <p class="text-secondary mb-0">Dari pembuatan website sampai konsultasi sistem informasi.</p>
                </div>
                <a href="{{ url('/layanan') }}" class="btn btn-outline-dark rounded-pill px-4">Lihat Semua</a>
            </div>

            <div class="row g-4">
                @forelse($layanan->take(3) as $item)
                <div class="col-md-4">
                    {{-- Bungkus card dengan tag <a> agar bisa diklik menuju halaman detail --}}
                    <a href="{{ route('layanan.show', $item->id) }}" class="card h-100 border rounded-4 p-2 text-decoration-none text-dark shadow-sm d-block transition-card">
                        
                        {{-- Menampilkan gambar layanan jika ada, jika tidak tampilkan ikon default --}}
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="rounded-4 w-100" style="height: 200px; object-fit: cover;" alt="{{ $item->nama }}">
                        @else
                            <div class="grad rounded-4 text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="bi bi-laptop fs-1"></i>
                            </div>
                        @endif

                        <div class="p-3">
                            <h5 class="fw-bold text-dark mb-2">{{ $item->nama }}</h5>
                            <p class="small text-secondary mb-3">{{ Str::limit(strip_tags($item->deskripsi), 90) }}</p>
                            <span class="small fw-semibold text-dark">Baca selengkapnya &rsaquo;</span>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-secondary">Belum ada layanan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

{{-- ============ 4. GALERI ============ --}}
    <section class="py-5 bg-white border-top">
        <div class="container py-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-5">
                <h2 class="hero-title fw-bold text-dark mb-0">Galeri kegiatan & proyek</h2>
                <a href="{{ url('/galeri') }}" class="btn btn-outline-dark rounded-pill px-4">Lihat Semua</a>
            </div>

            <div class="row g-4">
                @forelse($galeri->take(3) as $gal)
                <div class="col-md-4">
                    <div class="card h-100 border rounded-4 p-2 shadow-sm">
                        @if($gal->gambar ?? $gal->image)
                            <img src="{{ asset('storage/' . ($gal->gambar ?? $gal->image)) }}" class="rounded-4 w-100" style="height: 220px; object-fit: cover;" alt="{{ $gal->judul ?? $gal->title }}">
                        @else
                            <div class="grad rounded-4 text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                                <i class="bi bi-image fs-1"></i>
                            </div>
                        @endif
                        <div class="p-3">
                            {{-- Tanggal Publikasi --}}
                            <span class="badge bg-light border text-secondary rounded-pill mb-2">
                                <i class="bi bi-calendar3 me-1"></i> {{ $gal->created_at->translatedFormat('d M Y') }}
                            </span>

                            <h6 class="fw-bold text-dark mb-0">{{ $gal->judul ?? $gal->title }}</h6>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-secondary mb-0">Belum ada foto galeri.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

{{-- ============ 5. ARTIKEL ============ --}}
    <section class="py-5 border-top">
        <div class="container py-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-5">
                <h2 class="hero-title fw-bold text-dark mb-0">Artikel & informasi terkini</h2>
                <a href="{{ url('/artikel') }}" class="btn btn-outline-dark rounded-pill px-4">Lihat Semua</a>
            </div>

            <div class="row g-4">
                @forelse($artikel->take(3) as $art)
                <div class="col-md-4">
                    <div class="card h-100 border rounded-4 p-2">
                        @if($art->gambar)
                            <img src="{{ asset('storage/' . $art->gambar) }}" class="rounded-4 w-100" style="height: 200px; object-fit: cover;" alt="{{ $art->judul }}">
                        @else
                            <div class="grad rounded-4 text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="bi bi-newspaper fs-1"></i>
                            </div>
                        @endif
                        <div class="p-3">
                            <span class="badge bg-light border text-secondary rounded-pill mb-2">
                                <i class="bi bi-calendar3 me-1"></i> {{ $art->created_at->format('d M Y') }}
                            </span>
                            <h5 class="fw-bold text-dark">{{ $art->judul }}</h5>
                            <p class="small text-secondary mb-3">{{ Str::limit(strip_tags($art->konten), 90) }}</p>
                            
                            {{-- Tombol Baca Selengkapnya --}}
                            <a href="{{ route('artikel.show', $art->id) }}" class="text-dark fw-semibold small text-decoration-none">
                                Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-secondary">Belum ada artikel.</p>
                @endforelse
            </div>
        </div>
    </section>

    @include('partials.footer-front')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>