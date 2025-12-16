@extends('layouts.guest.app')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Tambah Jenis Penggunaan</h1>
            <p>Masukkan informasi jenis penggunaan lahan persil.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('jenis.index') }}">Jenis Penggunaan</a></li>
                    <li class="current">Tambah Data</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="container py-4">

            {{-- FLASH MESSAGE --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-lg border-0 p-4" style="border-radius: 20px;">
                <h4 class="mb-4 fw-bold">
                    <i class="bi bi-plus-circle me-2"></i> Form Tambah Jenis Penggunaan
                </h4>

                <form method="POST" action="{{ route('jenis.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">

                        {{-- Nama Penggunaan --}}
                        <div class="col-md-6">
                            <label class="form-label">Nama Penggunaan</label>
                            <input type="text" name="nama_penggunaan" value="{{ old('nama_penggunaan') }}"
                                class="form-control @error('nama_penggunaan') is-invalid @enderror">
                            @error('nama_penggunaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Keterangan --}}
                        <div class="col-md-12">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
                        </div>


                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('jenis.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                        </div>

                </form>
            </div>

        </div>
    </section>
@endsection
