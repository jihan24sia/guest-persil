@extends('layouts.guest.app')
@section('content')
        <!-- Page Title -->
        <div class="page-title dark-background" data-aos="fade"
            style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
            <div class="container position-relative">
                <h1>Tambah Data Persil</h1>
                <p>Masukkan informasi persil sesuai data lahan.</p>

                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ route('persil.index') }}">Data Persil</a></li>
                        <li class="current">Tambah Data</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="container">

                <div class="card shadow-lg border-0 p-4" data-aos="fade-up" data-aos-delay="100"
                    style="border-radius: 20px;">
                    <h4 class="mb-4 fw-bold">
                        <i class="bi bi-plus-circle me-2"></i> Form Tambah Persil
                    </h4>

                    <form method="POST" action="{{ route('persil.store') }}" enctype="multipart/form-data">

                        @csrf

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Kode Persil</label>
                                <input type="text" name="kode_persil" value="{{ old('kode_persil') }}"
                                    class="form-control @error('kode_persil') is-invalid @enderror">
                                @error('kode_persil')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Pemilik (Warga)</label>
                                <select name="pemilik_warga_id" class="form-select">
                                    <option value="">-- Pilih Warga --</option>
                                    @foreach ($warga as $w)
                                        <option value="{{ $w->warga_id }}"
                                            {{ old('pemilik_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} - ({{ $w->no_ktp }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Luas (m²)</label>
                                <input type="number" name="luas_m2" value="{{ old('luas_m2') }}"
                                    class="form-control @error('luas_m2') is-invalid @enderror">
                                @error('luas_m2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Penggunaan</label>
                                <select name="penggunaan" class="form-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="Rumah" {{ old('penggunaan') == 'Rumah' ? 'selected' : '' }}>Rumah
                                    </option>
                                    <option value="Kebun" {{ old('penggunaan') == 'Kebun' ? 'selected' : '' }}>Kebun
                                    </option>
                                    <option value="Lahan Kosong"
                                        {{ old('penggunaan') == 'Lahan Kosong' ? 'selected' : '' }}>
                                        Lahan Kosong</option>
                                    <option value="Toko" {{ old('penggunaan') == 'Toko' ? 'selected' : '' }}>Toko
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Alamat Lahan</label>
                                <input type="text" name="alamat_lahan" value="{{ old('alamat_lahan') }}"
                                    class="form-control @error('alamat_lahan') is-invalid @enderror">
                                @error('alamat_lahan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">RT</label>
                                <input type="text" name="rt" value="{{ old('rt') }}"
                                    class="form-control @error('rt') is-invalid @enderror">
                                @error('rt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">RW</label>
                                <input type="text" name="rw" value="{{ old('rw') }}"
                                    class="form-control @error('rw') is-invalid @enderror">
                                @error('rw')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Foto Persil</label>

                                <input type="file" name="media_files[]" id="media_files"
                                    class="form-control @error('media_files.*') is-invalid @enderror" multiple
                                    accept="image/*">

                                @error('media_files.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- PREVIEW CONTAINER -->
                                <div id="preview-container" class="mt-3 d-flex flex-wrap gap-3"></div>
                            </div>

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>

                            <a href="{{ route('persil.index') }}" class="btn btn-outline-secondary ms-2">
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
document.getElementById('media_files').addEventListener('change', function(event) {

    const previewContainer = document.getElementById('preview-container');
    previewContainer.innerHTML = ""; // Kosongkan preview sebelumnya

    [...event.target.files].forEach((file, index) => {
        if (!file.type.startsWith("image/")) return;

        const reader = new FileReader();
        reader.onload = function(e) {

            const wrapper = document.createElement("div");
            wrapper.classList.add("position-relative");
            wrapper.style.width = "140px";

            wrapper.innerHTML = `
                <img src="${e.target.result}" class="img-thumbnail" style="height: 120px; object-fit: cover; border-radius: 10px;">
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle remove-preview"
                    data-index="${index}" style="transform: translate(40%, -40%);">
                    &times;
                </button>
            `;

            previewContainer.appendChild(wrapper);
        };

        reader.readAsDataURL(file);
    });

    // HAPUS PREVIEW (Tanpa hapus file input)
    setTimeout(() => {
        document.querySelectorAll(".remove-preview").forEach(btn => {
            btn.onclick = function() {
                this.parentElement.remove();

                // Buat ulang FileList tanpa file tersebut
                const dt = new DataTransfer();
                const input = document.getElementById('media_files');

                [...input.files].forEach((f, i) => {
                    if (i != this.dataset.index) dt.items.add(f);
                });

                input.files = dt.files;
            };
        });
    }, 300);

});
</script>

@endpush
