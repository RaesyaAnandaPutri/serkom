@extends('layouts.admin')

@section('title', 'Detail Pesan & Rating')
@section('subtitle', 'Rincian pesan masuk dan penilaian dari pengunjung website')

@section('action')
    <a href="{{ route('admin.kontak.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Pesan
    </a>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
    <div class="d-flex justify-content-between align-items-start border-bottom pb-3 mb-4">
        <div>
            <h5 class="fw-bold text-dark mb-1">Pesan dari {{ $contact->nama }}</h5>
            <span class="text-muted small">Diterima pada: {{ $contact->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
        </div>
        <form action="{{ route('admin.kontak.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                <i class="bi bi-trash me-1"></i> Hapus Pesan
            </button>
        </form>
    </div>

    <div class="row g-4">
        <div class="col-md-4 border-end">
            <h6 class="fw-semibold text-secondary small text-uppercase mb-3">Informasi Pengirim</h6>
            
            <div class="mb-3">
                <small class="text-muted d-block">Nama Lengkap</small>
                <span class="fw-bold text-dark fs-5">{{ $contact->nama }}</span>
            </div>

            <div class="mb-3">
                <small class="text-muted d-block">Email</small>
                <a href="mailto:{{ $contact->email }}" class="text-primary text-decoration-none fw-medium">{{ $contact->email ?? '-' }}</a>
            </div>

            <div class="mb-3">
                <small class="text-muted d-block">Penilaian / Rating Diberikan</small>
                <div class="text-warning fs-5">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $contact->rating)
                            <i class="bi bi-star-fill"></i>
                        @else
                            <i class="bi bi-star text-muted opacity-25"></i>
                        @endif
                    @endfor
                    <span class="ms-1 fw-bold text-dark fs-6">({{ $contact->rating ?? 0 }}/5)</span>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <h6 class="fw-semibold text-secondary small text-uppercase mb-3">Isi Pesan / Ulasan</h6>
            <div class="p-4 bg-light rounded-4 text-dark lh-base fs-5" style="white-space: pre-line;">
                {{ $contact->pesan }}
            </div>
        </div>
    </div>
</div>
@endsection