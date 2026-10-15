@extends('layouts.admin')

@section('title', 'Tambah Artikel')
@section('subtitle', 'Tambahkan data artikel atau berita baru yang akan ditampilkan di website.')

@section('action')
    <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke artikel
    </a>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-lg-5">

        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">

                <div class="col-lg-7">
                    <label class="form-label fw-semibold small">Upload Foto <span class="text-danger">*</span></label>

                    <div class="border border-2 @error('gambar') border-danger bg-danger-subtle @else border-light-subtle bg-light @enderror rounded-4 p-4 text-center position-relative overflow-hidden d-flex flex-column justify-content-center align-items-center mb-1"
                         style="min-height: 200px; cursor: pointer;"
                         onclick="document.getElementById('imageInput').click()">

                        <div id="placeholder">
                            <i class="bi bi-cloud-arrow-up display-5 text-primary"></i>
                            <div class="fw-medium small">Klik untuk upload foto</div>
                            <small class="text-muted">Format: JPG, PNG, WEBP (Maks. 2MB)</small>
                        </div>

                        <div id="preview-box" class="position-absolute top-0 start-0 w-100 h-100 bg-white p-2 align-items-center justify-content-center" style="display: none;">
                            <img id="preview-img" src="" alt="Pratinjau" class="rounded-3 shadow-sm" style="max-height: 180px; max-width: 100%;">
                        </div>

                        <input type="file" name="gambar" id="imageInput" class="d-none" accept="image/*" onchange="tampilkanPratinjau(this)">
                    </div>
                    @error('gambar') <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div> @enderror

                    <label class="form-label fw-semibold small mt-3">Isi Artikel / Konten <span class="text-danger">*</span></label>
                    <textarea name="konten" rows="5" class="form-control @error('konten') is-invalid @enderror" placeholder="Tulis isi artikel di sini..." required>{{ old('konten') }}</textarea>
                    @error('konten') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-lg-5">
                    <label class="form-label fw-semibold small">Judul Artikel <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" placeholder="Contoh: Perkembangan Teknologi Cloud" required>
                    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror

                    <label class="form-label fw-semibold small mt-4">Tanggal</label>
                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required>
                    <div class="form-text">Pilih tanggal publikasi artikel</div>
                    @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror

                    <label class="form-label fw-semibold small mt-4">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft (belum tampil di website)</option>
                        <option value="publik" {{ old('status') == 'publik' ? 'selected' : '' }}>Publik (tampil di website)</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12 border-top pt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-dark rounded-pill px-4 shadow-sm">Simpan Artikel</button>
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