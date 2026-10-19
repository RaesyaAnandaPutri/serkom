<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kontak & Konsultasi Layanan - PT Solusi Koneksi Anda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #fafafa; }
    </style>
</head>
<body>

    @include('partials.navbar-front')

    {{-- JUDUL HALAMAN --}}
    <section class="py-5">
        <div class="container py-4 text-center" style="max-width: 700px;">
            <h1 class="display-5 fw-bold text-dark mb-3">Konsultasikan Kebutuhan Layanan Anda</h1>
            <p class="text-secondary mb-0">
                Temukan solusi jaringan dan teknologi yang tepat untuk bisnis Anda. Kirimkan pertanyaan atau permintaan informasi layanan melalui formulir di bawah ini.
            </p>
        </div>
    </section>

    {{-- FORM PESAN & KONSULTASI LAYANAN --}}
    <section class="pb-5">
        <div class="container pb-4" style="max-width: 650px;">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                
                {{-- Alert Sukses --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('front.kontak.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-semibold small text-dark">Nama Anda <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control rounded-3 @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap Anda" required>
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold small text-dark">Email Anda <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small text-dark">Subjek Layanan <span class="text-danger">*</span></label>
                        <input type="text" name="subjek" class="form-control rounded-3 @error('subjek') is-invalid @enderror" placeholder="Contoh: Konsultasi Layanan Jaringan / Maintenance" value="{{ old('subjek') }}" required>
                        @error('subjek')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small text-dark">Pesan / Detail Kebutuhan Layanan <span class="text-danger">*</span></label>
                        <textarea name="pesan" rows="5" class="form-control rounded-3 @error('pesan') is-invalid @enderror" placeholder="Tuliskan detail kebutuhan layanan atau pertanyaan Anda di sini..." required>{{ old('pesan') }}</textarea>
                        @error('pesan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-dark rounded-pill px-4 py-2 fw-semibold shadow-sm w-100">
                        <i class="bi bi-send me-1"></i> Kirim Pesan Konsultasi
                    </button>
                </form>
            </div>
        </div>
    </section>

    @include('partials.footer-front')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>