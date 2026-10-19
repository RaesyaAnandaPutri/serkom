@extends('layouts.admin')

@section('title', 'Profil Perusahaan')
@section('subtitle', 'Kelola informasi dan identitas perusahaan')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 p-lg-5">
                <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                    <div>
                        <h2 class="h5 fw-bold mb-1 text-dark">Informasi Profil Perusahaan</h2>
                        <p class="text-muted small mb-0">Perbarui data identitas, visi-misi, serta kontak perusahaan yang akan ditampilkan pada website publik.</p>
                    </div>
                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle d-none d-sm-grid" style="width: 48px; height: 48px; place-items: center;">
                        <i class="bi bi-building fs-5"></i>
                    </div>
                </div>

                <form action="{{ route('admin.profil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold small text-secondary">Nama Perusahaan</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $profile->nama ?? '') }}" required>
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold small text-secondary">Tentang Perusahaan (Deskripsi)</label>
                            <textarea name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $profile->deskripsi ?? '') }}</textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-secondary">Visi</label>
                            <textarea name="visi" rows="3" class="form-control @error('visi') is-invalid @enderror">{{ old('visi', $profile->visi ?? '') }}</textarea>
                            @error('visi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-secondary">Misi</label>
                            <textarea name="misi" rows="3" class="form-control @error('misi') is-invalid @enderror">{{ old('misi', $profile->misi ?? '') }}</textarea>
                            @error('misi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-secondary">Nomor Telepon</label>
                            <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon', $profile->telepon ?? '') }}" required>
                            @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-secondary">Email Perusahaan</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $profile->email ?? '') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-secondary">Alamat Lengkap</label>
                            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat', $profile->alamat ?? 'Jl. M.H. Thamrin No. 12, Kebon Sirih, Kec. Menteng, Jakarta Pusat, DKI Jakarta 10340') }}" required>
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold small text-secondary">Google Maps Embed (Iframe)</label>
                            <input type="text" name="peta" class="form-control @error('peta') is-invalid @enderror" value="{{ old('peta', $profile->peta ?? '') }}" placeholder="Tempel kode iframe dari Google Maps">
                            @error('peta')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12 text-end mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-dark px-4 py-2 fw-medium">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection