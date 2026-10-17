@extends('layouts.admin')

@section('title', 'Edit Layanan')
@section('subtitle', 'Perbarui informasi data layanan atau produk perusahaan.')

@section('action')
    <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-dark btn-sm rounded-pill px-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke layanan
    </a>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-lg-5">

        <form action="{{ route('admin.layanan.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- Kolom kiri: foto dan deskripsi --}}
                <div class="col-lg-7">
                    <label class="form-label fw-semibold small">Ganti Foto (Opsional)</label>

                    <div class="border border-2 rounded-4 p-4 text-center position-relative overflow-hidden bg-light d-flex flex-column justify-content-center align-items-center mb-1"
                         style="min-height: 180px; cursor: pointer;"
                         onclick="document.getElementById('imageInput').click()">

                        <div id="placeholder">
                            <i class="bi bi-cloud-arrow-up fs-3 text-primary"></i>
                            <div class="fw-medium small">Klik untuk mengganti foto</div>
                            <small class="text-muted">Format: JPG, PNG, WEBP (Maks. 2MB)</small>
                        </div>

                        <div id="preview-box" class="position-absolute top-0 start-0 w-100 h-100 bg-white p-2 align-items-center justify-content-center" style="display: none;">
                            <img id="preview-img" src="" alt="Pratinjau" class="rounded-3 shadow-sm" style="max-height: 160px; max-width: 100%;">
                        </div>

                        <input type="file" name="gambar" id="imageInput" class="d-none" accept="image/*" onchange="tampilkanPratinjau(this)">
                    </div>
                    @error('gambar') <div class="text-danger small">{{ $message }}</div> @enderror

                    {{-- Foto saat ini --}}
                    @if ($service->gambar)
                        <label class="form-label fw-semibold small d-block mt-3">Foto Saat Ini:</label>
                        <div class="rounded-3 overflow-hidden border bg-light shadow-sm" style="width: 140px; height: 90px;">
                            <img src="{{ asset('storage/' . $service->gambar) }}" alt="{{ $service->nama }}" class="w-100 h-100 object-fit-cover">
                        </div>
                    @endif

                    <label class="form-label fw-semibold small mt-3">Deskripsi Layanan <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $service->deskripsi) }}</textarea>
                    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Kolom kanan: kategori, nama, tanggal, status --}}
                <div class="col-lg-5">
                    <label class="form-label fw-semibold small">Kategori Layanan <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                        <option value="" disabled>Pilih Kategori Layanan</option>
                        <option value="Web Development" {{ old('kategori', $service->kategori) == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                        <option value="Mobile Apps" {{ old('kategori', $service->kategori) == 'Mobile Apps' ? 'selected' : '' }}>Mobile Apps</option>
                        <option value="Sistem Informasi" {{ old('kategori', $service->kategori) == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                        <option value="IT Consulting & Cloud" {{ old('kategori', $service->kategori) == 'IT Consulting & Cloud' ? 'selected' : '' }}>IT Consulting & Cloud</option>
                    </select>
                    @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror

                    <label class="form-label fw-semibold small mt-4">Nama Layanan <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $service->nama) }}" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror

                    <label class="form-label fw-semibold small mt-4">Tanggal</label>
                    <input type="date" name="date" class="form-control" value="{{ old('date', $service->created_at->format('Y-m-d')) }}" required>

                    <label class="form-label fw-semibold small mt-4">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="draft" {{ old('status', $service->status) == 'draft' ? 'selected' : '' }}>Draft (belum tampil di website)</option>
                        <option value="publik" {{ old('status', $service->status) == 'publik' ? 'selected' : '' }}>Publik (tampil di website)</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Tombol --}}
                <div class="col-12 border-top pt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-dark rounded-pill px-4 shadow-sm">Simpan Perubahan</button>
                </div>

            </div>
        </form>

    </div>
</div>

<script>
    function tampilkanPratinjau(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('placeholder').style.display = 'none';
                document.getElementById('preview-box').style.display = 'flex';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection