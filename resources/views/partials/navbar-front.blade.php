<nav class="navbar navbar-expand-lg sticky-top border-bottom py-3" style="background: #fafafa;">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-dark" href="{{ url('/') }}">
            <span class="bg-dark text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                <i class="bi bi-hdd-network-fill"></i>
            </span>
            Solusi Koneksi Anda
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-lg-auto mt-3 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link small {{ request()->is('/') ? 'text-dark fw-bold' : 'text-secondary' }}" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link small {{ request()->is('profil-perusahaan*') ? 'text-dark fw-bold' : 'text-secondary' }}" href="{{ url('/profil-perusahaan') }}">Profil Perusahaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link small {{ request()->is('layanan*') ? 'text-dark fw-bold' : 'text-secondary' }}" href="{{ url('/layanan') }}">Produk & Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link small {{ request()->is('galeri*') ? 'text-dark fw-bold' : 'text-secondary' }}" href="{{ url('/galeri') }}">Galeri Kegiatan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link small {{ request()->is('artikel*') ? 'text-dark fw-bold' : 'text-secondary' }}" href="{{ url('/artikel') }}">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link small {{ request()->is('kontak*') ? 'text-dark fw-bold' : 'text-secondary' }}" href="{{ url('/kontak') }}">Kontak Kami</a>
                </li>
            </ul>
        </div>

    </div>
</nav>