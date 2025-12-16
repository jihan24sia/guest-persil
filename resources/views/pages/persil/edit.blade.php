@extends('layouts.guest.app')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Edit Data Persil</h1>
            <p>Perbarui data persil sesuai informasi lahan.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('persil.index') }}">Data Persil</a></li>
                    <li class="current">Edit Data</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="container">

            <div class="card shadow-lg border-0 p-4" data-aos="fade-up" data-aos-delay="100" style="border-radius: 20px;">

                <h4 class="mb-4 fw-bold">
                    <i class="bi bi-pencil-square me-2"></i> Form Edit Persil
                </h4>

                <!-- Form Update Persil -->
                <form method="POST" action="{{ route('persil.update', $persil) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Kode Persil</label>
                            <input type="text" name="kode_persil" value="{{ old('kode_persil', $persil->kode_persil) }}"
                                class="form-control @error('kode_persil') is-invalid @enderror">
                            @error('kode_persil')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pemilik (Warga)</label>
                            <select name="pemilik_warga_id" class="form-select @error('pemilik_warga_id') is-invalid @enderror">
                                <option value="">-- Pilih Warga --</option>
                                @foreach ($warga as $w)
                                    <option value="{{ $w->warga_id }}" {{ old('pemilik_warga_id', $persil->pemilik_warga_id) == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }} ({{ $w->no_ktp }})
                                    </option>
                                @endforeach
                            </select>
                            @error('pemilik_warga_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Luas (m²)</label>
                            <input type="number" name="luas_m2" value="{{ old('luas_m2', $persil->luas_m2) }}"
                                class="form-control @error('luas_m2') is-invalid @enderror">
                            @error('luas_m2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Penggunaan</label>
                            <select name="penggunaan" class="form-select @error('penggunaan') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                @foreach (['Rumah', 'Kebun', 'Lahan Kosong', 'Toko', 'Gudang', 'Kantor'] as $item)
                                    <option value="{{ $item }}" {{ old('penggunaan', $persil->penggunaan) == $item ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('penggunaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Alamat Lahan</label>
                            <input type="text" name="alamat_lahan" value="{{ old('alamat_lahan', $persil->alamat_lahan) }}"
                                class="form-control @error('alamat_lahan') is-invalid @enderror">
                            @error('alamat_lahan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">RT</label>
                            <input type="text" name="rt" value="{{ old('rt', $persil->rt) }}"
                                class="form-control @error('rt') is-invalid @enderror">
                            @error('rt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">RW</label>
                            <input type="text" name="rw" value="{{ old('rw', $persil->rw) }}"
                                class="form-control @error('rw') is-invalid @enderror">
                            @error('rw')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12 mt-4">
                            <label class="form-label fw-bold">Upload Foto Baru (Multiple)</label>
                            <input type="file" name="media_files[]" id="media_files"
                                class="form-control @error('media_files.*') is-invalid @enderror" multiple accept="image/*">
                            <small class="text-muted">Anda dapat menambahkan lebih dari satu foto.</small>
                            @error('media_files.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div id="preview-container" class="mt-3 d-flex flex-wrap gap-3"></div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update</button>
                        <a href="{{ route('persil.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                    </div>
                </form>

                @if ($persil->media && $persil->media->count() > 0)
                <hr class="my-4">
                <h5 class="fw-bold mb-3">Foto Lama</h5>
                <div class="row g-3">
                    @foreach ($persil->media as $m)
                    <div class="col-md-3 col-6">
                        <div class="border rounded p-2 text-center position-relative">

                            <img src="{{ asset('storage/uploads/persil/' . $m->file_name) }}" class="img-fluid rounded" style="height:120px; width:100%; object-fit:cover;">

                            <form action="{{ route('persil.media.delete', $m->media_id) }}" method="POST" class="mt-2"
                                onsubmit="return confirm('Yakin hapus foto ini?')">
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
document.getElementById('media_files').addEventListener('change', function(event) {
    const previewContainer = document.getElementById('preview-container');
    previewContainer.innerHTML = "";
    const input = event.target;

    [...input.files].forEach((file) => {
        if (!file.type.startsWith("image/")) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            const wrapper = document.createElement("div");
            wrapper.classList.add("preview-item", "position-relative");
            wrapper.style.width = "140px";
            wrapper.file = file;

            wrapper.innerHTML = `
                <img src="${e.target.result}" class="img-thumbnail" style="height: 120px; object-fit: cover; border-radius: 10px;">
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle remove-preview" style="transform: translate(40%, -40%)">&times;</button>
            `;
            previewContainer.appendChild(wrapper);
        };
        reader.readAsDataURL(file);
    });

    setTimeout(bindRemoveButtons, 300);
});

function bindRemoveButtons() {
    document.querySelectorAll(".remove-preview").forEach(btn => {
        btn.onclick = function() {
            const wrapper = this.parentElement;
            wrapper.remove();

            const input = document.getElementById('media_files');
            const dt = new DataTransfer();

            document.querySelectorAll(".preview-item").forEach(item => {
                dt.items.add(item.file);
            });

            input.files = dt.files;
        };
    });
}
</script>
@endpush
