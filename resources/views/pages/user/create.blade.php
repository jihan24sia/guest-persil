@extends('layouts.guest.app')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Tambah User</h1>
            <p>Masukkan data user untuk akses sistem.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('user.index') }}">Data User</a></li>
                    <li class="current">Tambah User</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="container">

            <div class="card shadow-lg border-0 p-4" data-aos="fade-up"
                 style="border-radius: 20px;">
                <h4 class="mb-4 fw-bold">
                    <i class="bi bi-plus-circle me-2"></i> Form Tambah User
                </h4>

                <form method="POST" action="{{ route('user.store') }}">
                    @csrf

                    <div class="row g-3">

                        {{-- NAMA --}}
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ROLE --}}
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror">
                                <option value="">-- Pilih Role --</option>
                                <option value="Admin" {{ old('role')=='Admin'?'selected':'' }}>Admin</option>
                                <option value="Petugas" {{ old('role')=='Petugas'?'selected':'' }}>Petugas</option>
                                <option value="Pelanggan" {{ old('role')=='Pelanggan'?'selected':'' }}>Pelanggan</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-orange">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>

                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary ms-2">
                            Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </section>

@endsection
