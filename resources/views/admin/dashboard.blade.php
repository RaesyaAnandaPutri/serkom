@extends('layouts.admin')

@section('title', 'Hello, Admin')
@section('subtitle', now()->locale('id')->translatedFormat('l, d F Y'))

@section('action')
    <a href="{{ url('/') }}" target="_blank" class="btn btn-dark btn-sm rounded-pill px-4">Lihat Website</a>
@endsection

@section('content')

    {{-- ===== Tiga kartu ringkasan ===== --}}
    <div class="row g-3 mb-4">

        {{-- Kartu Layanan --}}
        <div class="col-md-4">
            <a href="{{ url('/admin/layanan') }}" class="d-block text-white text-decoration-none rounded-4 p-4 shadow-sm" style="background-color: #64748b;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge rounded-pill bg-white bg-opacity-25 fw-medium">Layanan</span>
                    <i class="bi bi-box-seam fs-5"></i>
                </div>
                <div class="fs-2 fw-bold lh-1">{{ $jumlahLayanan }}</div>
                <div class="small mb-2">Total produk / layanan</div>
                <small>Lihat semua &rsaquo;</small>
            </a>
        </div>

        {{-- Kartu Artikel --}}
        <div class="col-md-4">
            <a href="{{ url('/admin/artikel') }}" class="d-block text-white text-decoration-none rounded-4 p-4 shadow-sm" style="background-color: #64748b;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge rounded-pill bg-white bg-opacity-25 fw-medium">Artikel</span>
                    <i class="bi bi-journal-text fs-5"></i>
                </div>
                <div class="fs-2 fw-bold lh-1">{{ $jumlahArtikel }}</div>
                <div class="small mb-2">Total artikel dipublikasi</div>
                <small>Lihat semua &rsaquo;</small>
            </a>
        </div>

        {{-- Kartu Galeri --}}
        <div class="col-md-4">
            <a href="{{ url('/admin/galeri') }}" class="d-block text-white text-decoration-none rounded-4 p-4 shadow-sm" style="background-color: #64748b;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge rounded-pill bg-white bg-opacity-25 fw-medium">Galeri</span>
                    <i class="bi bi-images fs-5"></i>
                </div>
                <div class="fs-2 fw-bold lh-1">{{ $jumlahGaleri }}</div>
                <div class="small mb-2">Total foto kegiatan</div>
                <small>Lihat semua &rsaquo;</small>
            </a>
        </div>

    </div>

    {{-- ===== Baris bawah ===== --}}
    <div class="row g-3">

        {{-- Aksi cepat --}}
        <div class="col-lg-4">
            <div class="card rounded-4 h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Aksi Cepat</h6>
                    <div class="d-flex flex-column gap-2">

                        <a href="{{ url('/admin/layanan/create') }}" class="d-flex justify-content-between align-items-center bg-light rounded-3 p-3 text-dark text-decoration-none border-start border-4" style="border-color: #64748b !important;">
                            Tambah Layanan <i class="bi bi-plus-lg text-muted"></i>
                        </a>

                        <a href="{{ url('/admin/artikel/create') }}" class="d-flex justify-content-between align-items-center bg-light rounded-3 p-3 text-dark text-decoration-none border-start border-4" style="border-color: #64748b !important;">
                            Tambah Artikel <i class="bi bi-plus-lg text-muted"></i>
                        </a>

                        <a href="{{ url('/admin/galeri/create') }}" class="d-flex justify-content-between align-items-center bg-light rounded-3 p-3 text-dark text-decoration-none border-start border-4" style="border-color: #64748b !important;">
                            Tambah Galeri <i class="bi bi-plus-lg text-muted"></i>
                        </a>

                        <a href="{{ url('/admin/profil') }}" class="d-flex justify-content-between align-items-center bg-light rounded-3 p-3 text-dark text-decoration-none border-start border-4" style="border-color: #cbd5e1 !important;">
                            Edit Profil Perusahaan <small class="text-muted">{{ $profil ? 'Sudah diisi' : 'Belum diisi' }}</small>
                        </a>

                    </div>
                </div>
            </div>
        </div>

{{-- Layanan terbaru --}}
        <div class="col-lg-4">
            <div class="card rounded-4 h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold mb-0">Layanan Terbaru</h6>
                        <a href="{{ url('/admin/layanan') }}" class="small text-primary text-decoration-none">Lihat semua</a>
                    </div>
                    @forelse ($layananTerbaru as $layanan)
                        <div class="d-flex align-items-center justify-content-between gap-2 py-2 border-bottom">
                            <div class="d-flex align-items-center gap-2 flex-grow-1" style="min-width: 0;">
                                {{-- Thumbnail Gambar Layanan --}}
                                @if($layanan->gambar)
                                    <img src="{{ asset('storage/' . $layanan->gambar) }}" alt="{{ $layanan->nama ?? $layanan->judul }}" class="rounded-3 object-fit-cover flex-shrink-0" style="width: 40px; height: 40px;">
                                @else
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted flex-shrink-0" style="width: 40px; height: 40px;">
                                        <i class="bi bi-image small"></i>
                                    </div>
                                @endif
                                <span class="text-dark fw-semibold small text-truncate" style="min-width: 0;" title="{{ $layanan->nama ?? $layanan->judul }}">{{ $layanan->nama ?? $layanan->judul }}</span>
                            </div>
                            <small class="text-muted text-nowrap flex-shrink-0" style="font-size: 0.75rem;">{{ $layanan->created_at->translatedFormat('d M Y') }}</small>
                        </div>
                    @empty
                        <p class="text-muted text-center py-3 mb-0 small">Belum ada layanan.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Artikel terbaru --}}
        <div class="col-lg-4">
            <div class="card rounded-4 h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold mb-0">Artikel Terbaru</h6>
                        <a href="{{ url('/admin/artikel') }}" class="small text-primary text-decoration-none">Lihat semua</a>
                    </div>
                    @forelse ($artikelTerbaru as $artikel)
                        <div class="d-flex align-items-center justify-content-between gap-2 py-2 border-bottom">
                            <div class="d-flex align-items-center gap-2 flex-grow-1" style="min-width: 0;">
                                {{-- Thumbnail Gambar Artikel --}}
                                @if($artikel->gambar)
                                    <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="rounded-3 object-fit-cover flex-shrink-0" style="width: 40px; height: 40px;">
                                @else
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted flex-shrink-0" style="width: 40px; height: 40px;">
                                        <i class="bi bi-image small"></i>
                                    </div>
                                @endif
                                <span class="text-dark fw-semibold small text-truncate" style="min-width: 0;" title="{{ $artikel->judul }}">{{ $artikel->judul }}</span>
                            </div>
                            <small class="text-muted text-nowrap flex-shrink-0" style="font-size: 0.75rem;">{{ $artikel->created_at->translatedFormat('d M Y') }}</small>
                        </div>
                    @empty
                        <p class="text-muted text-center py-3 mb-0 small">Belum ada artikel.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
@endsection