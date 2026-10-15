@extends('layouts.admin')

@section('title', 'Tambah Layanan')
@section('subtitle', 'Tambahkan data layanan atau produk baru yang akan ditampilkan di website.')

@section('action')
    <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke layanan
    </a>
@endsection

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4 p-lg-5">

        <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">

            {{-- Kolom kiri: foto dan deskripsi --}}
            <div class="col-lg-7">
                <label class="form-label fw-semibold small">Upload Foto <span class="text-danger">*</span></label>

                {{-- Area klik untuk memilih foto --}}
                <div class="border border-2 @error('gambar') border-danger bg-danger-subtle @else border-light-subtle bg-light @enderror rounded-4 p-4 text-center position-relative overflow-hidden d-flex flex-column justify-content-center align-items-center mb-1"
                    style="min-height: 200px; cursor: pointer;"
                    onclick="document.getElementById('imageInput').click()">

                    {{-- Tampilan awal --}}
                    <div id="placeholder">
                        <i class="bi bi-cloud-arrow-up display-5 text-primary"></i>
                        <div class="fw-medium small">Klik untuk upload foto</div>
                        <small class="text-muted">Format: JPG, PNG, WEBP (Maks. 2MB)</small>
                    </div>

                    {{-- Pratinjau (muncul setelah foto dipilih) --}}
                    <div id="preview-box" class="position-absolute top-0 start-0 w-100 h-100 bg-white p-2 align-items-center justify-content-center" style="display: none;">
                        <img id="preview-img" src="" alt="Pratinjau" class="rounded-3 shadow-sm" style="max-height: 180px; max-width: 100%;">
                    </div>

                    <input type="file" name="gambar" id="imageInput" class="d-none" accept="image/*" onchange="tampilkanPratinjau(this)">
                </div>
                
                {{-- Pesan error berwarna merah jika kosong --}}
                @error('gambar') 
                    <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div> 
                @enderror

                <label class="form-label fw-semibold small mt-3">Deskripsi Layanan <span class="text-danger">*</span></label>
                <textarea name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Jelaskan detail layanan atau produk ini..." required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

                {{-- Kolom kanan: nama, tanggal, status --}}
                <div class="col-lg-5">
                    <label class="form-label fw-semibold small">Nama Layanan</label>
                    {{-- Diubah dari name="name" menjadi name="nama" --}}
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Contoh: Pengembangan Aplikasi Web" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror

                    <label class="form-label fw-semibold small mt-4">Tanggal</label>
                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required>
                    <div class="form-text">Pilih tanggal publikasi layanan</div>
                    @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror

                    <label class="form-label fw-semibold small mt-4">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft (belum tampil di website)</option>
                        <option value="publik" {{ old('status') == 'publik' ? 'selected' : '' }}>Publik (tampil di website)</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Tombol --}}
                <div class="col-12 border-top pt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-dark rounded-pill px-4 shadow-sm">Simpan Layanan</button>
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