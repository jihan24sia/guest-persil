@extends('layouts.guest.app')
@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Edit Data Dokumen</h1>
            <p>Perbarui data dokumen sesuai informasi persil.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('dokumen.index') }}">Data Dokumen</a></li>
                    <li class="current">Edit Data</li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="section">
        <div class="container">

            <div class="card shadow-lg border-0 p-4" data-aos="fade-up" data-aos-delay="100" style="border-radius: 20px;">

                <h4 class="mb-4 fw-bold">
                    <i class="bi bi-pencil-square me-2"></i> Form Edit Dokumen
                </h4>

                {{-- FLASH MESSAGE --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div id="ajax-notification-area"></div>

                <form method="POST" action="{{ route('dokumen.update', $dokumen->dokumen_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        {{-- Persil --}}
                        <div class="col-md-6">
                            <label class="form-label">Persil</label>
                            <select name="persil_id" class="form-select @error('persil_id') is-invalid @enderror" required>
                                @foreach ($persil as $p)
                                    <option value="{{ $p->persil_id }}" {{ old('persil_id', $dokumen->persil_id) == $p->persil_id ? 'selected' : '' }}>
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
                            <input type="text" name="jenis_dokumen"
                                value="{{ old('jenis_dokumen', $dokumen->jenis_dokumen) }}"
                                class="form-control @error('jenis_dokumen') is-invalid @enderror" required>
                            @error('jenis_dokumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nomor Dokumen --}}
                        <div class="col-md-6">
                            <label class="form-label">Nomor Dokumen</label>
                            <input type="text" name="nomor" value="{{ old('nomor', $dokumen->nomor) }}"
                                class="form-control @error('nomor') is-invalid @enderror" required>
                            @error('nomor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Keterangan --}}
                        <div class="col-md-6">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                rows="3">{{ old('keterangan', $dokumen->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Upload Media Baru --}}
                        <div class="col-md-12 mt-4">
                            <label class="form-label fw-bold">Upload Media Baru (Optional)</label>
                            <input type="file" name="media_files[]" id="mediaInput"
                                class="form-control @error('media_files.*') is-invalid @enderror"
                                accept="image/*,application/pdf" multiple>
                            <small class="text-muted">File diizinkan: JPG, PNG, JPEG & PDF. Maks 4MB per file.</small>
                            @error('media_files.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <div class="row g-3 mt-2" id="previewContainer"></div>
                        </div>

                    </div>

                    {{-- Submit --}}
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Update Dokumen
                        </button>
                        <a href="{{ route('dokumen.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                    </div>

                </form>

                {{-- Media Lama --}}
                @if ($dokumen->media && $dokumen->media->count() > 0)
                    <hr class="my-4">
                    <div class="col-md-12">
                        <label class="form-label fw-bold mt-3">Media Saat Ini</label>
                        <div class="row g-3" id="existingMediaContainer">
                            @foreach ($dokumen->media as $m)
                                @php
                                    $filePath = asset('storage/uploads/dokumen/' . $m->file_name);
                                    $isImage = str_contains($m->mime_type, 'image/');
                                @endphp
                                <div class="col-md-3 col-6" id="media-item-{{ $m->media_id }}">
                                    <div class="border rounded p-2 text-center position-relative">
                                        @if ($isImage)
                                            <a href="{{ $filePath }}" target="_blank">
                                                <img src="{{ $filePath }}" class="img-fluid rounded"
                                                    style="height:120px; width:100%; object-fit:cover;"
                                                    title="{{ $m->file_name }}">
                                            </a>
                                        @else
                                            <a href="{{ $filePath }}" target="_blank"
                                                class="d-flex flex-column align-items-center justify-content-center text-center text-decoration-none text-dark"
                                                style="height:120px;">
                                                <i class="bi bi-file-earmark-pdf-fill text-danger"
                                                    style="font-size: 40px;"></i>
                                                <span class="small text-truncate mt-1" style="max-width: 100%;">{{ $m->file_name }}</span>
                                            </a>
                                        @endif
                                        <button class="btn btn-danger btn-sm w-100 mt-2 delete-media-btn"
                                            data-id="{{ $m->media_id }}" type="button">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </section>

@endsection

@push('scripts')
<script>
    // PREVIEW UPLOAD BARU
    document.getElementById('mediaInput').addEventListener('change', function(e) {
        const files = e.target.files;
        const preview = document.getElementById('previewContainer');
        preview.innerHTML = "";

        Array.from(files).forEach(file => {
            if (!file.type.startsWith("image/") && file.type !== "application/pdf") return;
            let fileUrl = URL.createObjectURL(file);
            let col = document.createElement("div");
            col.className = "col-md-3 col-6";

            if (file.type.startsWith("image/")) {
                col.innerHTML = `
                    <div class="border rounded p-2 text-center">
                        <a href="${fileUrl}" target="_blank">
                            <img src="${fileUrl}" class="img-fluid rounded" style="height:120px; width:100%; object-fit:cover;">
                        </a>
                        <p class="small mt-2 text-truncate">${file.name}</p>
                    </div>`;
            } else if (file.type === "application/pdf") {
                col.innerHTML = `
                    <div class="border rounded p-3 text-center">
                        <a href="${fileUrl}" target="_blank"
                            class="d-flex flex-column align-items-center justify-content-center text-center text-decoration-none text-dark"
                            style="height:120px;">
                            <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size: 40px;"></i>
                            <span class="small text-truncate mt-1" style="max-width: 100%;">${file.name}</span>
                        </a>
                    </div>`;
            }
            preview.appendChild(col);
        });
    });

    // HAPUS MEDIA LAMA (AJAX)
    document.querySelectorAll('.delete-media-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const mediaId = this.dataset.id;
            const container = document.getElementById(`media-item-${mediaId}`);
            if (!confirm("Apakah Anda yakin ingin menghapus media ini?")) return;

            fetch(`{{ url('dokumen/media') }}/${mediaId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    container.remove();
                    alert('Media berhasil dihapus!');
                } else {
                    alert('Gagal menghapus media!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus media!');
            });
        });
    });
</script>
@endpush
