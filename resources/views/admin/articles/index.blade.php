@extends('layouts.admin')

@section('title', 'Manajemen Artikel')
@section('subtitle', 'Kelola semua data artikel atau berita yang ditampilkan di website')

@section('action')
    <a href="{{ route('admin.artikel.create') }}" class="btn btn-dark rounded-pill px-4 shadow-sm">
        <i class="bi bi-plus-circle-fill me-1"></i> Tambah Artikel
    </a>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4">

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr class="text-secondary small text-uppercase">
                    <th>Foto</th>
                    <th>Judul Artikel</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Konten</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $article)
                    <tr>
                        <td>
                            <div class="rounded-3 overflow-hidden bg-light border d-flex align-items-center justify-content-center" style="width: 72px; height: 48px;">
                                @if ($article->gambar)
                                    <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-100 h-100 object-fit-cover">
                                @else
                                    <small class="text-muted">No Img</small>
                                @endif
                            </div>
                        </td>

                        <td class="fw-bold">{{ $article->judul }}</td>

                        <td class="text-secondary small">
                            <i class="bi bi-calendar3 me-1"></i>{{ $article->created_at->translatedFormat('d M Y') }}
                        </td>

                        <td>
                            @if ($article->status == 'publik')
                                <span class="badge bg-success">Publik</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>

                        <td>
                            <p class="text-muted small mb-0" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $article->konten }}
                            </p>
                        </td>

                        <td class="text-center">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('admin.artikel.edit', $article->id) }}" class="btn btn-sm btn-light border text-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.artikel.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
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
                            <i class="bi bi-inbox fs-1 text-secondary opacity-50"></i>
                            <h6 class="fw-bold mt-2">Belum Ada Data Artikel</h6>
                            <p class="text-muted small">Silakan tambahkan artikel baru agar muncul di tabel ini.</p>
                            <a href="{{ route('admin.artikel.create') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Artikel Pertama
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($articles->hasPages())
        <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-3">
            <small class="text-muted">
                Menampilkan {{ $articles->firstItem() }} - {{ $articles->lastItem() }} dari {{ $articles->total() }} data
            </small>
            {{ $articles->links() }}
        </div>
    @endif

</div>
@endsection