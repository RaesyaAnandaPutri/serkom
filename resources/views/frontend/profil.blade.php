<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Perusahaan - {{ $profil->name ?? 'PT Solusi Koneksi Anda' }}</title>

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

    {{-- 1. TENTANG KAMI --}}
    <section class="py-5">
        <div class="container py-4">
            <h1 class="display-5 fw-bold text-dark mb-3">Profil Perusahaan</h1>
            <h5 class="fw-bold text-secondary mb-3">{{ $profil->name ?? 'PT Solusi Koneksi Anda' }}</h5>
            <p class="text-secondary" style="max-width: 640px; white-space: pre-line;">{{ $profil->deskripsi ?? 'Perusahaan penyedia layanan IT yang berfokus pada pengembangan website, aplikasi web, dan konsultasi sistem informasi.' }}</p>
        </div>
    </section>

    {{-- 2. VISI & MISI --}}
    <section class="py-5 bg-white border-top">
        <div class="container py-4">
            <div class="row g-4">

                <div class="col-lg-6">
                    <div class="card h-100 border rounded-4 p-4">
                        <div class="bg-dark text-white rounded-4 d-flex align-items-center justify-content-center mb-3" style="width: 52px; height: 52px;">
                            <i class="bi bi-eye fs-4"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Visi</h4>
                        <p class="text-secondary mb-0" style="white-space: pre-line;">{{ $profil->visi ?? 'Menjadi mitra teknologi terpercaya bagi dunia usaha di Indonesia.' }}</p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card h-100 border rounded-4 p-4">
                        <div class="bg-dark text-white rounded-4 d-flex align-items-center justify-content-center mb-3" style="width: 52px; height: 52px;">
                            <i class="bi bi-rocket-takeoff fs-4"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Misi</h4>
                        <p class="text-secondary mb-0" style="white-space: pre-line;">{{ $profil->misi ?? 'Menyediakan layanan IT yang profesional, cepat, dan berorientasi pada kepuasan klien.' }}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 3. KONTAK & PETA --}}
    <section class="py-5 border-top">
        <div class="container py-4">
            <h2 class="fw-bold text-dark mb-4">Kontak kami</h2>

            <div class="row g-4">
                @foreach([
                    ['bi-geo-alt',   'Alamat',  $profil->alamat  ?? 'Bogor, Jawa Barat'],
                    ['bi-telephone', 'Telepon', $profil->telepon ?? '(0251) 888-999'],
                    ['bi-envelope',  'Email',   $profil->email   ?? 'info@solusikoneksianda.co.id'],
                ] as [$ikon, $label, $isi])
                <div class="col-md-4">
                    <div class="d-flex gap-3">
                        <div class="bg-dark text-white rounded-4 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 52px; height: 52px;">
                            <i class="bi {{ $ikon }} fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-1">{{ $label }}</h6>
                            <p class="small text-secondary mb-0">{{ $isi }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if(!empty($profil->peta))
            <div class="ratio ratio-21x9 rounded-4 overflow-hidden border mt-5">
                {!! $profil->peta !!}
            </div>
            @endif
        </div>
    </section>

    @include('partials.footer-front')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>