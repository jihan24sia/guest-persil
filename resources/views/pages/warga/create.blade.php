@extends('layouts.guest.app')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Tambah Data Warga</h1>
            <p>Masukkan informasi warga sesuai data penduduk.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('warga.index') }}">Data Warga</a></li>
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
                    <i class="bi bi-plus-circle me-2"></i> Form Tambah Warga
                </h4>

                <form method="POST" action="{{ route('warga.store') }}">
                    @csrf

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">No KTP</label>
                            <input type="text" name="no_ktp" value="{{ old('no_ktp') }}"
                                class="form-control @error('no_ktp') is-invalid @enderror">
                            @error('no_ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan'?'selected':'' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Agama</label>
                            <input type="text" name="agama" value="{{ old('agama') }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">No Telepon</label>
                            <input type="text" name="telp" value="{{ old('telp') }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                        </div>

                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>

                        <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary ms-2">
                            Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </section>

@endsection
