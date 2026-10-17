@extends('layouts.admin')

@section('title', 'Manajemen Layanan')
@section('subtitle', 'Kelola semua data layanan atau produk yang ditampilkan di website')

@section('action')
    <a href="{{ route('admin.layanan.create') }}" class="btn btn-dark rounded-pill px-4 shadow-sm">
        <i class="bi bi-plus-circle-fill me-1"></i> Tambah Layanan
    </a>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4">

    {{-- Tabel data layanan --}}
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr class="text-secondary small text-uppercase">
                    <th>Foto</th>
                    <th>Nama Layanan</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr>
                        {{-- Foto --}}
                        <td>
                            <div class="rounded-3 overflow-hidden bg-light border d-flex align-items-center justify-content-center" style="width: 72px; height: 48px;">
                                @if ($service->gambar)
                                    <img src="{{ asset('storage/' . $service->gambar) }}" alt="{{ $service->nama }}" class="w-100 h-100 object-fit-cover">
                                @else
                                    <small class="text-muted">No Img</small>
                                @endif
                            </div>
                        </td>

                        {{-- Nama --}}
                        <td class="fw-bold">{{ $service->nama }}</td>

                        {{-- Kategori --}}
                        <td>
                            <span class="badge bg-light text-dark border px-2 py-1">
                                {{ $service->kategori ?? '-' }}
                            </span>
                        </td>

                        {{-- Tanggal --}}
                        <td class="text-secondary small">
                            <i class="bi bi-calendar3 me-1"></i>{{ $service->created_at->translatedFormat('d M Y') }}
                        </td>

                        {{-- Status --}}
                        <td>
                            @if ($service->status == 'publik')
                                <span class="badge bg-success">Publik</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>

                        {{-- Deskripsi singkat --}}
                        <td>
                            <p class="text-muted small mb-0" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $service->deskripsi }}
                            </p>
                        </td>

                        {{-- Aksi --}}
                        <td class="text-center">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('admin.layanan.edit', $service->id) }}" class="btn btn-sm btn-light border text-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.layanan.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
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
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-primary opacity-50"></i>
                            <h6 class="fw-bold mt-2">Belum Ada Data Layanan</h6>
                            <p class="text-muted small">Silakan tambahkan layanan baru agar muncul di tabel ini.</p>
                            <a href="{{ route('admin.layanan.create') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Layanan Pertama
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($services->hasPages())
        <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-3">
            <small class="text-muted">
                Menampilkan {{ $services->firstItem() }} - {{ $services->lastItem() }} dari {{ $services->total() }} data
            </small>
            {{ $services->links() }}
        </div>
    @endif

</div>
@endsection