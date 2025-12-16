@extends('layouts.guest.app')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Edit User</h1>
            <p>Perbarui informasi user sesuai kebutuhan.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('user.index') }}">Data User</a></li>
                    <li class="current">Edit User</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="container">

            <div class="card shadow-lg border-0 p-4" data-aos="fade-up" style="border-radius: 20px;">
                <h4 class="mb-4 fw-bold">
                    <i class="bi bi-pencil-square me-2"></i> Form Edit User
                </h4>

                <form method="POST" action="{{ route('user.update', $dataUser->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        {{-- Name --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $dataUser->name) }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $dataUser->email) }}" required>
                        </div>

                        {{-- Password --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password Baru</label>
                            <input type="password" name="password" class="form-control">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        {{-- Role --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="Admin" {{ $dataUser->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="User" {{ $dataUser->role == 'User' ? 'selected' : '' }}>User
                                </option>

                            </select>
                        </div>


                    </div>

                    {{-- Buttons --}}
                    <div class="mt-4">
                        <button type="submit" class="btn btn-orange">
                            <i class="bi bi-save me-1"></i> Update
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
