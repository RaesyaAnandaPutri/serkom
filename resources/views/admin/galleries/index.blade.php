@extends('layouts.admin')

@section('title', 'Manajemen Galeri')
@section('subtitle', 'Kelola dokumentasi foto kegiatan perusahaan')

@section('action')
    <a href="{{ route('admin.galeri.create') }}" class="btn btn-dark rounded-pill px-4 shadow-sm">
        <i class="bi bi-plus-circle-fill me-1"></i> Tambah Galeri
    </a>
@endsection

@section('content')
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
                    <tr>
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
                            <div class="d-inline-flex gap-1">
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
                            <i class="bi bi-images fs-1 text-primary opacity-50"></i>
                            <h6 class="fw-bold mt-2">Belum Ada Data Galeri</h6>
                            <p class="text-muted small">Silakan unggah foto kegiatan baru.</p>
                            <a href="{{ route('admin.galeri.create') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
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
@endsection