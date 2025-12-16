@extends('layouts.guest.app')

@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Tambah Data Dokumen</h1>
            <p>Masukkan informasi dokumen sesuai data persil.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('dokumen.index') }}">Data Dokumen</a></li>
                    <li class="current">Tambah Data</li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="section">
        <div class="container">

            <div class="card shadow-lg border-0 p-4" data-aos="fade-up" data-aos-delay="100" style="border-radius: 20px;">
                <h4 class="mb-4 fw-bold">
                    <i class="bi bi-plus-circle me-2"></i> Form Tambah Dokumen
                </h4>

                {{-- FLASH MESSAGE --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('dokumen.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">

                        {{-- Persil --}}
                        <div class="col-md-6">
                            <label class="form-label">Persil</label>
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

                        {{-- Jenis Dokumen --}}
                        <div class="col-md-6">
                            <label class="form-label">Jenis Dokumen</label>
                            <input type="text" name="jenis_dokumen" value="{{ old('jenis_dokumen') }}"
                                class="form-control @error('jenis_dokumen') is-invalid @enderror" required>
                            @error('jenis_dokumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nomor --}}
                        <div class="col-md-6">
                            <label class="form-label">Nomor Dokumen</label>
                            <input type="text" name="nomor" value="{{ old('nomor') }}"
                                class="form-control @error('nomor') is-invalid @enderror" required>
                            @error('nomor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Keterangan --}}
                        <div class="col-md-6">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Upload Media --}}
                        <div class="col-md-12">
                            <label class="form-label">Upload Media (optional)</label>

                            <input type="file" id="mediaInput" name="media_files[]"
                                class="form-control @error('media_files.*') is-invalid @enderror" multiple
                                accept="image/*,application/pdf">

                            <small class="text-muted">
                                File diizinkan: JPG, PNG, JPEG & PDF. Maks 4MB per file.
                            </small>

                            @error('media_files.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <div id="preview-area" class="mt-3 d-flex gap-2 flex-wrap"></div>
                        </div>

                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>

                        <a href="{{ route('dokumen.index') }}" class="btn btn-outline-secondary ms-2">
                            Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.getElementById("mediaInput").addEventListener('change', function (e) {
        let previewArea = document.getElementById('preview-area');
        previewArea.innerHTML = ""; // Bersihkan preview lama

        const files = [...e.target.files];

        files.forEach(file => {

            if (!file.type.startsWith("image/") && file.type !== "application/pdf") return;

            // BUAT URL CEPAT TANPA FILEREADER
            let fileUrl = URL.createObjectURL(file);

            let container = document.createElement('div');
            container.style.cssText = `
                width: 90px;
                height: 90px;
                position: relative;
            `;
            container.classList.add("border", "rounded");
            container.title = file.name;

            let link = document.createElement('a');
            link.href = fileUrl;
            link.target = "_blank";

            // IMAGE PREVIEW
            if (file.type.startsWith("image/")) {
                link.style.cssText = "display: block; width: 100%; height: 100%;";
                link.innerHTML = `
                    <img src="${fileUrl}" class="border rounded"
                        style="height: 90px; width: 90px; object-fit: cover;">
                `;
            }
            // PDF PREVIEW
            else {
                link.className =
                    "border rounded d-flex flex-column align-items-center justify-content-center text-center p-1 text-decoration-none text-dark bg-light";
                link.style.cssText =
                    "width:90px; height:90px; font-size:11px; overflow:hidden; line-height:1.1; color:#495057; display:block;";
                link.innerHTML = `
                    <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size:24px;"></i>
                    <span class="text-truncate px-1" style="max-width:86px;">${file.name}</span>
                `;
            }

            container.appendChild(link);
            previewArea.appendChild(container);
        });
    });
</script>
@endpush
