@php $p = $profil ?? \App\Models\CompanyProfile::first(); @endphp

<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">

            <div class="col-md-4">
                <h5 class="fw-bold">{{ $p->name ?? 'Solusi Koneksi Anda' }}</h5>
                <p class="small text-white-50 mb-0">IT Solution & Web Development</p>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold mb-3">Menu</h6>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-2"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li class="mb-2"><a href="{{ url('/profil-perusahaan') }}" class="text-white-50 text-decoration-none">Profil Perusahaan</a></li>
                    <li class="mb-2"><a href="{{ url('/layanan') }}" class="text-white-50 text-decoration-none">Produk & Layanan</a></li>
                    <li class="mb-2"><a href="{{ url('/artikel') }}" class="text-white-50 text-decoration-none">Artikel</a></li>
                    <li class="mb-2"><a href="{{ url('/galeri') }}" class="text-white-50 text-decoration-none">Galeri Kegiatan</a></li>
                    <li><a href="{{ url('/kontak') }}" class="text-white-50 text-decoration-none">Kontak Kami</a></li>
                </ul>
            </div>

            <div class="col-md-4">
                <h6 class="fw-bold mb-3">Kontak</h6>
                <ul class="list-unstyled small text-white-50 mb-0">
                    <li class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i>{{ $p->alamat ?? 'Bogor, Jawa Barat' }}</li>
                    <li class="mb-2"><i class="bi bi-telephone-fill me-2"></i>{{ $p->telepon ?? '(0251) 888-999' }}</li>
                    <li><i class="bi bi-envelope-fill me-2"></i>{{ $p->email ?? 'info@solusikoneksianda.co.id' }}</li>
                </ul>
            </div>

        </div>

        <hr class="border-secondary my-4">
        <p class="small text-white-50 text-center mb-0">&copy; {{ date('Y') }} {{ $p->name ?? 'PT Solusi Koneksi Anda' }}. All rights reserved.</p>
    </div>
</footer>