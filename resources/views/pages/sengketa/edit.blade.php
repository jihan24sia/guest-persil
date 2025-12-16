@extends('layouts.guest.app')
@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Edit Sengketa Persil</h1>
            <p>Perbarui data sengketa sesuai informasi persil.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('sengketa.index') }}">Data Sengketa Persil</a></li>
                    <li class="current">Edit Data</li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="section">
        <div class="container">

            <div class="card shadow-lg border-0 p-4" data-aos="fade-up" data-aos-delay="100" style="border-radius: 20px;">

                <h4 class="mb-4 fw-bold">
                    <i class="bi bi-pencil-square me-2"></i> Form Edit Sengketa Persil
                </h4>

                {{-- FLASH MESSAGE --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('sengketa.update', $sengketa->sengketa_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        {{-- Persil --}}
                        <div class="col-md-12">
                            <label class="form-label">Persil</label>
                            <select name="persil_id" class="form-select" required>
                                <option value="">-- Pilih Persil --</option>
                                @foreach ($persil as $p)
                                    <option value="{{ $p->persil_id }}" {{ $sengketa->persil_id == $p->persil_id ? 'selected' : '' }}>
                                        {{ $p->kode_persil }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Pihak 1 --}}
                        <div class="col-md-12">
                            <label class="form-label">Pihak 1</label>
                            <input type="text" name="pihak_1" value="{{ old('pihak_1', $sengketa->pihak_1) }}"
                                class="form-control @error('pihak_1') is-invalid @enderror" required>
                            @error('pihak_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pihak 2 --}}
                        <div class="col-md-12">
                            <label class="form-label">Pihak 2</label>
                            <input type="text" name="pihak_2" value="{{ old('pihak_2', $sengketa->pihak_2) }}"
                                class="form-control @error('pihak_2') is-invalid @enderror" required>
                            @error('pihak_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kronologi --}}
                        <div class="col-md-12">
                            <label class="form-label">Kronologi</label>
                            <textarea name="kronologi" class="form-control @error('kronologi') is-invalid @enderror" rows="3" required>{{ old('kronologi', $sengketa->kronologi) }}</textarea>
                            @error('kronologi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-12">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="Proses" {{ old('status', $sengketa->status) == 'Proses' ? 'selected' : '' }}>Proses</option>
                                <option value="Selesai" {{ old('status', $sengketa->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Penyelesaian --}}
                        <div class="col-md-12">
                            <label class="form-label">Penyelesaian</label>
                            <textarea name="penyelesaian" class="form-control @error('penyelesaian') is-invalid @enderror" rows="3">{{ old('penyelesaian', $sengketa->penyelesaian) }}</textarea>
                            @error('penyelesaian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Upload Media Baru --}}
                        <div class="col-md-12 mt-4">
                            <label class="form-label fw-bold">Upload Media Baru</label>
                            <input type="file" id="mediaInputSengketaEdit" name="media_files[]" class="form-control" multiple accept="image/jpeg,image/png">
                            <small class="text-muted">Anda dapat mengupload lebih dari satu file.</small>
                            <div id="preview-area-sengketa-edit" class="mt-3 d-flex gap-2 flex-wrap" style="max-height:200px; overflow-y:auto;">
                                {{-- Area Pratinjau Gambar Baru --}}
                            </div>
                        </div>

                    </div>

                    {{-- Submit --}}
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('sengketa.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                    </div>

                </form>

                @if ($sengketa->media && $sengketa->media->count() > 0)
                    <hr class="my-4">
                    <h5 class="fw-bold mb-3">Foto Lama</h5>
                    <div class="row g-3">
                        @foreach ($sengketa->media as $m)
                            <div class="col-md-3 col-6">
                                <div class="border rounded p-2 text-center position-relative">
                                    <img src="{{ asset('storage/uploads/sengketa/' . $m->file_name) }}" class="img-fluid rounded" style="height:120px; width:100%; object-fit:cover;" alt="Media Sengketa">

                                    <form action="{{ route('sengketa.media.delete', $m->media_id) }}" method="POST" class="mt-2" onsubmit="return confirm('Yakin hapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm w-100">Hapus</button>
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
    const mediaInput = document.getElementById("mediaInputSengketaEdit");
    const previewArea = document.getElementById('preview-area-sengketa-edit');

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
