@extends('layouts.admin')

@section('title', 'Pesan Masuk & Subjek')
@section('subtitle', 'Daftar pesan, subjek, dan pertanyaan dari pengunjung website')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4">

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr class="text-secondary small text-uppercase">
                    <th>Pengirim</th>
                    <th>Subjek</th>
                    <th>Pesan Singkat</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $contact)
                    <tr class="{{ $contact->status == 'unread' ? 'fw-bold bg-light bg-opacity-50' : '' }}">
                        <td>
                            <div class="fw-bold text-dark">{{ $contact->nama }}</div>
                            <div class="text-muted small fw-normal">{{ $contact->email }}</div>
                        </td>

                        {{-- Tampilan Subjek Pesan --}}
                        <td>
                            <span class="badge bg-light text-dark border px-2 py-1 fw-semibold">
                                {{ $contact->subjek }}
                            </span>
                        </td>

                        <td>
                            <p class="text-muted small mb-0" style="display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $contact->pesan }}
                            </p>
                        </td>

                        <td class="text-secondary small">
                            <i class="bi bi-clock me-1"></i>{{ $contact->created_at->translatedFormat('d M Y, H:i') }}
                        </td>

                        <td>
                            @if ($contact->status == 'unread')
                                <span class="badge bg-warning text-dark">Belum Dibaca</span>
                            @else
                                <span class="badge bg-secondary">Sudah Dibaca</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('admin.kontak.show', $contact->id) }}" class="btn btn-sm btn-light border text-primary" title="Lihat Pesan">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('admin.kontak.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
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
                            <i class="bi bi-envelope-open fs-1 text-primary opacity-50"></i>
                            <h6 class="fw-bold mt-2">Belum Ada Pesan Masuk</h6>
                            <p class="text-muted small">Pesan dan pertanyaan pengunjung melalui form kontak akan muncul di sini.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($contacts->hasPages())
        <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-3">
            <small class="text-muted">
                Menampilkan {{ $contacts->firstItem() }} - {{ $contacts->lastItem() }} dari {{ $contacts->total() }} data
            </small>
            {{ $contacts->links() }}
        </div>
    @endif

</div>
@endsection