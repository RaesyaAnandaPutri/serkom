@extends('layouts.admin')

@section('title', 'Manajemen Galeri')
@section('subtitle', 'Kelola dokumentasi foto kegiatan perusahaan')

@section('action')
    <a href="{{ route('admin.galeri.create') }}" class="btn btn-dark rounded-pill px-4 shadow-sm">
        <i class="bi bi-plus-circle-fill me-1"></i> Tambah Galeri
    </a>
@endsection

@section('content')
<div x-data="{ selectedGallery: null }" @keydown.escape.window="selectedGallery = null">
<div class="card border-0 shadow-sm rounded-4 p-4">

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr class="text-secondary small text-uppercase">
                    <th>Foto</th>
                    <th>Judul Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($galleries as $gallery)
                    <tr role="button"
                        tabindex="0"
                        aria-label="Lihat detail {{ $gallery->judul }}"
                        class="gallery-row"
                        @click="selectedGallery = {
                            title: @js($gallery->judul),
                            description: @js($gallery->deskripsi ?: 'Tidak ada deskripsi.'),
                            image: @js($gallery->gambar ? asset('storage/' . $gallery->gambar) : null),
                            date: @js($gallery->created_at->translatedFormat('d M Y')),
                            status: @js($gallery->status),
                            editUrl: @js(route('admin.galeri.edit', $gallery->id))
                        }"
                        @keydown.enter.self.prevent="$el.click()"
                        @keydown.space.self.prevent="$el.click()">
                        <td>
                            <div class="rounded-3 overflow-hidden bg-light border d-flex align-items-center justify-content-center" style="width: 72px; height: 48px;">
                                @if ($gallery->gambar)
                                    <img src="{{ asset('storage/' . $gallery->gambar) }}" alt="{{ $gallery->judul }}" class="w-100 h-100 object-fit-cover">
                                @else
                                    <small class="text-muted">No Img</small>
                                @endif
                            </div>
                        </td>

                        <td class="fw-bold">{{ $gallery->judul }}</td>

                        <td class="text-secondary small">
                            <i class="bi bi-calendar3 me-1"></i>{{ $gallery->created_at->translatedFormat('d M Y') }}
                        </td>

                        <td>
                            @if ($gallery->status == 'publik')
                                <span class="badge bg-success">Publik</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>

                        <td>
                            <p class="text-muted small mb-0" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $gallery->deskripsi ?? '-' }}
                            </p>
                        </td>

                        <td class="text-center">
                            <div class="d-inline-flex gap-1" @click.stop>
                                <a href="{{ route('admin.galeri.edit', $gallery->id) }}" class="btn btn-sm btn-light border text-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto galeri ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border text-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-images fs-1 text-secondary opacity-50"></i>
                            <h6 class="fw-bold mt-2">Belum Ada Data Galeri</h6>
                            <p class="text-muted small">Silakan unggah foto kegiatan baru.</p>
                            <a href="{{ route('admin.galeri.create') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Galeri Pertama
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($galleries->hasPages())
        <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-3">
            <small class="text-muted">
                Menampilkan {{ $galleries->firstItem() }} - {{ $galleries->lastItem() }} dari {{ $galleries->total() }} data
            </small>
            {{ $galleries->links() }}
        </div>
    @endif

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
             aria-labelledby="gallery-detail-title"
             class="card border-0 rounded-4 shadow-lg overflow-hidden w-100"
             style="max-width: 680px; max-height: 90vh;">
        <div class="row g-0 h-100">
            <div class="col-md-5 bg-light d-flex align-items-center justify-content-center" style="min-height: 220px;">
                <template x-if="selectedGallery && selectedGallery.image">
                    <img :src="selectedGallery.image"
                         :alt="selectedGallery.title"
                         class="w-100 h-100 object-fit-cover"
                         style="min-height: 220px; max-height: 420px;">
                </template>
                <template x-if="selectedGallery && !selectedGallery.image">
                    <div class="text-secondary text-center p-4">
                        <i class="bi bi-image fs-1"></i>
                        <div class="small mt-2">Tidak ada foto</div>
                    </div>
                </template>
            </div>
            <div class="col-md-7 d-flex flex-column overflow-auto">
                <div class="p-4 p-lg-5">
                    <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                        <span class="badge rounded-pill"
                              :class="selectedGallery && selectedGallery.status === 'publik' ? 'bg-success' : 'bg-secondary'"
                              x-text="selectedGallery && selectedGallery.status === 'publik' ? 'Publik' : 'Draft'"></span>
                        <button type="button"
                                class="btn-close"
                                aria-label="Tutup detail galeri"
                                @click="selectedGallery = null"></button>
                    </div>
                    <h5 id="gallery-detail-title" class="fw-bold mb-2" x-text="selectedGallery && selectedGallery.title"></h5>
                    <div class="text-secondary small mb-3">
                        <i class="bi bi-calendar3 me-1"></i>
                        <span x-text="selectedGallery && selectedGallery.date"></span>
                    </div>
                    <p class="text-muted mb-4" style="white-space: pre-line;" x-text="selectedGallery && selectedGallery.description"></p>
                    <a :href="selectedGallery && selectedGallery.editUrl" class="btn btn-dark rounded-pill px-4">
                        <i class="bi bi-pencil me-1"></i> Edit Galeri
                    </a>
                </div>
            </div>
        </div>
    </section>
    </div>
</template>
</div>

<style>
    [x-cloak] { display: none !important; }
    .gallery-row { cursor: pointer; }
    .gallery-row:focus-visible { outline: 2px solid var(--bs-primary); outline-offset: -2px; }
</style>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection