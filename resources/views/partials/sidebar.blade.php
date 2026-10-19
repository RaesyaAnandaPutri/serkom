<aside class="col-12 col-lg-3 bg-white border-end p-3 p-xl-4 d-flex flex-column">

    {{-- Header Logo / Brand (Clean SaaS Header) --}}
    <div class="d-flex align-items-center justify-content-between mb-4 px-1">
        <div class="d-flex align-items-center gap-2">
            <div class="rounded-circle bg-primary" style="width: 8px; height: 8px;"></div>
            <span class="fw-bold text-dark" style="font-size: 0.95rem; letter-spacing: -0.3px;">Solusi Koneksi Anda</span>
        </div>
        <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebar"></button>
    </div>

    {{-- Profil singkat --}}
    <div class="text-center bg-light rounded-4 p-3 mb-4">
        <div class="avatar rounded-circle bg-primary bg-opacity-10 text-primary fw-bold fs-5 d-flex align-items-center justify-content-center mx-auto mb-2 border border-2 border-white shadow-sm" style="width: 52px; height: 52px;">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
        <div class="fw-bold">{{ auth()->user()->name }}</div>
        <small class="text-muted">{{ auth()->user()->email }}</small>
    </div>

    {{-- Menu --}}
    <ul class="nav nav-pills flex-column gap-1">

        {{-- Dashboard --}}
        <li class="nav-item">
            <a href="{{ url('/admin') }}" class="nav-link text-nowrap rounded-3 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('admin') ? 'active shadow-sm' : 'text-secondary' }}">
                <i class="bi bi-grid me-2"></i>Dashboard
            </a>
        </li>

        {{-- Profil Perusahaan --}}
        <li class="nav-item">
            <a href="{{ url('/admin/profil') }}" class="nav-link text-nowrap rounded-3 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('admin/profil*') ? 'active shadow-sm' : 'text-secondary' }}">
                <i class="bi bi-building me-2"></i>Profil Perusahaan
            </a>
        </li>

        {{-- Produk / Layanan --}}
        <li class="nav-item">
            <a href="{{ url('/admin/layanan') }}" class="nav-link text-nowrap rounded-3 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('admin/layanan*') ? 'active shadow-sm' : 'text-secondary' }}">
                <i class="bi bi-box-seam me-2"></i>Produk / Layanan
            </a>
        </li>

         {{-- Galeri Kegiatan --}}
        <li class="nav-item">
            <a href="{{ url('/admin/galeri') }}" class="nav-link text-nowrap rounded-3 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('admin/galeri*') ? 'active shadow-sm' : 'text-secondary' }}">
                <i class="bi bi-images me-2"></i>Galeri Kegiatan
            </a>
        </li>

        {{-- Artikel --}}
        <li class="nav-item">
            <a href="{{ url('/admin/artikel') }}" class="nav-link text-nowrap rounded-3 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('admin/artikel*') ? 'active shadow-sm' : 'text-secondary' }}">
                <i class="bi bi-journal-text me-2"></i>Artikel
            </a>
        </li>

        {{-- Kontak --}}
        <li class="nav-item">
            <a href="{{ url('/admin/kontak') }}" class="nav-link text-nowrap rounded-3 px-3 py-2 d-flex align-items-center gap-2 {{ request()->is('admin/kontak*') ? 'active shadow-sm' : 'text-secondary' }}">
                <i class="bi bi-envelope me-2"></i>Kontak
            </a>
        </li>

    </ul>

    {{-- Bagian bawah (Lihat Website & Logout) --}}
    <div class="border-top mt-auto pt-3 d-flex flex-column gap-1">
        <a href="{{ url('/') }}" target="_blank" class="nav-link text-secondary text-nowrap px-3 py-2 rounded-3 d-flex align-items-center gap-2 text-decoration-none">
            <i class="bi bi-box-arrow-up-right me-2"></i>Lihat Website
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link text-danger text-nowrap px-3 py-2 rounded-3 d-flex align-items-center gap-2 text-decoration-none fw-medium border-0 bg-transparent w-100">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </button>
        </form>
    </div>
</aside>