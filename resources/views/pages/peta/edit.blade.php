@extends('layouts.guest.app')
@section('content')

    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Edit Peta Persil</h1>
            <p>Perbarui informasi peta sesuai data persil.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('peta.index') }}">Data Peta Persil</a></li>
                    <li class="current">Edit Peta</li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="section">
        <div class="container">

            <div class="card shadow-lg border-0 p-4" data-aos="fade-up" data-aos-delay="100"
                style="border-radius: 20px;">
                <h4 class="mb-4 fw-bold">
                    <i class="bi bi-pencil-square me-2"></i> Form Edit Peta Persil
                </h4>

                {{-- FLASH MESSAGE --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                {{-- Error Message for Validations --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Gagal menyimpan perubahan. Mohon periksa kembali input Anda.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif


                <form method="POST" action="{{ route('peta.update', $peta->peta_id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        {{-- Persil --}}
                        <div class="col-md-12">
                            <label class="form-label">Persil</label>
                            <select name="persil_id" class="form-select @error('persil_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Persil --</option>
                                @foreach ($persil as $p)
                                    <option value="{{ $p->persil_id }}"
                                        {{ old('persil_id', $peta->persil_id) == $p->persil_id ? 'selected' : '' }}>
                                        {{ $p->kode_persil }}
                                    </option>
                                @endforeach
                            </select>
                            @error('persil_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- GeoJSON --}}
                        <div class="col-md-12">
                            <label class="form-label">GeoJSON</label>
                            <textarea name="geojson" class="form-control @error('geojson') is-invalid @enderror" rows="3"
                                required>{{ old('geojson', $peta->geojson) }}</textarea>
                            @error('geojson')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Panjang (m) --}}
                        <div class="col-md-6">
                            <label class="form-label">Panjang (m)</label>
                            <input type="number" step="0.01" name="panjang_m"
                                value="{{ old('panjang_m', $peta->panjang_m) }}"
                                class="form-control @error('panjang_m') is-invalid @enderror" required>
                            @error('panjang_m')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Lebar (m) --}}
                        <div class="col-md-6">
                            <label class="form-label">Lebar (m)</label>
                            <input type="number" step="0.01" name="lebar_m"
                                value="{{ old('lebar_m', $peta->lebar_m) }}"
                                class="form-control @error('lebar_m') is-invalid @enderror" required>
                            @error('lebar_m')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Upload Media Baru (Disesuaikan dengan SengketaController) --}}
                        <div class="col-md-12 mt-4">
                            <label class="form-label fw-bold">Upload Media Baru</label>
                            <input type="file" id="mediaInputPetaEdit" name="media_files[]" class="form-control" multiple accept="image/jpeg,image/png">
                            <small class="text-muted">Anda dapat mengupload lebih dari satu file (max: 5MB per file).</small>
                            <div id="preview-area-peta-edit" class="mt-3 d-flex gap-2 flex-wrap" style="max-height:200px; overflow-y:auto;">
                                {{-- Area Pratinjau Gambar Baru --}}
                            </div>
                            @error('media_files.*')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    {{-- Submit --}}
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('peta.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                    </div>

                </form>

                {{-- Foto Lama / Media Saat Ini (Disesuaikan dengan SengketaController) --}}
                @if ($peta->media && $peta->media->count() > 0)
                    <hr class="my-4">
                    <h5 class="fw-bold mb-3">Foto Lama</h5>
                    <div class="row g-3">
                        @foreach ($peta->media as $m)
                            <div class="col-md-3 col-6">
                                <div class="border rounded p-2 text-center position-relative">
                                    {{-- Pastikan path storage/uploads/peta sesuai dengan controller --}}
                                    <img src="{{ asset('storage/uploads/peta/' . $m->file_name) }}" class="img-fluid rounded" style="height:120px; width:100%; object-fit:cover;" alt="Media Peta">

                                    {{-- Menggunakan route yang sudah diseragamkan di Controller --}}
                                    <form action="{{ route('peta.media.delete', $m->media_id) }}" method="POST" class="mt-2" onsubmit="return confirm('Yakin hapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mediaInput = document.getElementById("mediaInputPetaEdit");
    const previewArea = document.getElementById('preview-area-peta-edit');

    if (mediaInput) {
        let objectUrls = [];

        mediaInput.addEventListener('change', function(e) {
            // Hapus preview lama dan revoke URL sebelumnya
            objectUrls.forEach(url => URL.revokeObjectURL(url));
            objectUrls = [];
            previewArea.innerHTML = ""; // Kosongkan area pratinjau

            const files = Array.from(e.target.files);

            files.forEach(file => {
                // Pastikan file adalah gambar
                if (!file.type.startsWith("image/")) return;

                // Batasan ukuran file (misal 5MB)
                const maxSize = 5 * 1024 * 1024;
                if (file.size > maxSize) {
                    alert(`File ${file.name} terlalu besar. Maksimal 5MB.`);
                    return;
                }

                // Buat URL Objek untuk pratinjau
                const fileUrl = URL.createObjectURL(file);
                objectUrls.push(fileUrl); // Simpan URL untuk cleanup

                // Buat elemen HTML untuk pratinjau
                const container = document.createElement('div');
                // Terapkan styling untuk container pratinjau
                container.className = "border rounded shadow-sm";
                container.style.cssText = "width:90px; height:90px; position:relative; overflow:hidden;";

                const link = document.createElement('a');
                link.href = fileUrl;
                link.target = "_blank";
                link.title = file.name;

                // Elemen gambar
                const img = document.createElement('img');
                img.src = fileUrl;
                img.className = "rounded";
                img.style.cssText = "width:90px; height:90px; object-fit:cover;";
                img.alt = file.name;

                link.appendChild(img);
                container.appendChild(link);
                previewArea.appendChild(container);
            });
        });

        // Cleanup saat halaman ditutup/ditinggalkan
        window.addEventListener('beforeunload', () => {
            objectUrls.forEach(url => URL.revokeObjectURL(url));
        });
    }
});
</script>
@endpush
