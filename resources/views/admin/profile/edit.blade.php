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
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $profile->name ?? '') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold small text-secondary">Tentang Perusahaan (Deskripsi)</label>
                            {{-- Diperbaiki agar mengambil langsung dari $profile->deskripsi --}}
                            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $profile->deskripsi ?? '') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-secondary">Visi</label>
                            <textarea name="vision" rows="3" class="form-control @error('vision') is-invalid @enderror">{{ old('vision', $profile->visi ?? '') }}</textarea>
                            @error('vision')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-secondary">Misi</label>
                            <textarea name="mission" rows="3" class="form-control @error('mission') is-invalid @enderror">{{ old('mission', $profile->misi ?? '') }}</textarea>
                            @error('mission')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-secondary">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $profile->telepon ?? '') }}" required>
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-secondary">Email Perusahaan</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $profile->email ?? '') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold small text-secondary">Alamat Lengkap</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $profile->alamat ?? '') }}" required>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold small text-secondary">Google Maps Embed (URL / Iframe)</label>
                            <input type="text" name="maps_embed" class="form-control @error('maps_embed') is-invalid @enderror" value="{{ old('maps_embed', $profile->peta ?? '') }}" placeholder="Masukkan link embed iframe Google Maps">
                            @error('maps_embed')<div class="invalid-feedback">{{ $message }}</div>@enderror
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