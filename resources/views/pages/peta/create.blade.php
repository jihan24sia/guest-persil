@extends('layouts.guest.app')

@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Tambah Peta Persil</h1>
            <p>Form untuk menambahkan data peta persil.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('peta.index') }}">Peta Persil</a></li>
                    <li class="current">Tambah Peta</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section pt-4 pb-5">
        <div class="container">

            {{-- FLASH MESSAGE (SUCCESS/INFO/ETC) --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">
                    <i class="bi bi-plus-circle me-2"></i> Form Tambah Peta Persil
                </h4>

                <a href="{{ route('peta.index') }}" class="btn btn-orange btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <div class="card shadow-lg border-0 p-4" style="border-radius:16px;" data-aos="fade-up">

                {{-- ERROR VALIDATION (Umum, tapi lebih baik pakai inline error) --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('peta.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="fw-semibold">Persil <span class="text-danger">*</span></label>
                        <select name="persil_id" class="form-select @error('persil_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Persil --</option>
                            @foreach ($persil as $p)
                                <option value="{{ $p->persil_id }}"
                                    {{ old('persil_id') == $p->persil_id ? 'selected' : '' }}>
                                    {{ $p->kode_persil }}
                                </option>
                            @endforeach
                        </select>
                        @error('persil_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">GeoJSON <span class="text-danger">*</span></label>
                        <textarea name="geojson" class="form-control @error('geojson') is-invalid @enderror" rows="3" required>{{ old('geojson') }}</textarea>
                        @error('geojson')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Panjang (m) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="panjang_m" value="{{ old('panjang_m') }}"
                            class="form-control @error('panjang_m') is-invalid @enderror" required>
                        @error('panjang_m')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Lebar (m) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="lebar_m" value="{{ old('lebar_m') }}"
                            class="form-control @error('lebar_m') is-invalid @enderror" required>
                        @error('lebar_m')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Upload Media (Gambar Pendukung)</label>
                        <input type="file" id="mediaInputPeta" name="media_files[]"
                            class="form-control @error('media_files.*') is-invalid @enderror" multiple
                            accept="image/jpeg,image/png">
                        <small class="text-muted">Max. 5MB per file. Format: JPG, JPEG, PNG.</small>
                        @error('media_files.*')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        {{-- Tempat Pratinjau --}}
                        <div id="preview-area-peta" class="mt-3 d-flex gap-2 flex-wrap"></div>
                    </div>

                    <button type="submit" class="btn btn-orange px-4">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                    <a href="{{ route('peta.index') }}" class="btn btn-outline-secondary ms-2">
                        Batal
                    </a>
                </form>

            </div>

        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mediaInput = document.getElementById("mediaInputPeta");
        const previewArea = document.getElementById('preview-area-peta');

        if (mediaInput) {
            mediaInput.addEventListener('change', function (e) {
                previewArea.innerHTML = ""; // Bersihkan preview lama
                let objectUrls = []; // Array untuk menyimpan Object URL yang perlu dibersihkan

                const files = [...e.target.files];

                files.forEach(file => {

                    // Hanya proses file gambar
                    if (!file.type.startsWith("image/")) return;

                    let fileUrl = URL.createObjectURL(file);
                    objectUrls.push(fileUrl); // Simpan URL untuk cleanup

                    let container = document.createElement('div');
                    container.style.cssText = `
                        width: 90px;
                        height: 90px;
                        position: relative;
                    `;
                    container.classList.add("border", "rounded", "shadow-sm");
                    container.title = file.name;

                    let link = document.createElement('a');
                    link.href = fileUrl;
                    link.target = "_blank";

                    // IMAGE PREVIEW
                    link.style.cssText = "display: block; width: 100%; height: 100%;";
                    link.innerHTML = `
                        <img src="${fileUrl}" class="border rounded"
                            style="height: 90px; width: 90px; object-fit: cover;">
                    `;

                    container.appendChild(link);
                    previewArea.appendChild(container);
                });

                // Cleanup Object URL saat input berubah lagi
                mediaInput.onformdata = () => {
                     objectUrls.forEach(url => URL.revokeObjectURL(url));
                };

                // Opsional: Cleanup saat halaman ditinggalkan
                window.onbeforeunload = () => {
                     objectUrls.forEach(url => URL.revokeObjectURL(url));
                };
            });
        }
    });
</script>
@endpush
