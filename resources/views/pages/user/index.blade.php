@extends('layouts.guest.app')
@section('content')
        <!-- Page Title -->
        <div class="page-title dark-background" data-aos="fade"
            style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
            <div class="container position-relative">
                <h1>Data User</h1>
                <p>Daftar user lengkap dengan filter role dan pencarian nama.</p>

                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li class="current">Data User</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section class="section pt-4 pb-5">
            <div class="container">

                {{-- FLASH MESSAGE --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold"><i class="bi bi-person-lines-fill me-2"></i> Data User</h4>
                    <a href="{{ route('user.create') }}" class="btn btn-orange btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Tambah User
                    </a>
                </div>

                {{-- FILTER + SEARCH --}}
                <form method="GET" action="{{ route('user.index') }}" class="mb-4">
                    <div class="row gy-2">

                        <div class="col-md-4">
                            <select name="role" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Role</option>
                                <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="User" {{ request('role') == 'User' ? 'selected' : '' }}>User</option>

                            </select>
                        </div>

                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control" placeholder="Cari nama user...">
                                <button class="btn btn-outline-secondary">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                        @if (request('role') || request('search'))
                            <div class="col-md-3">
                                <a href="{{ route('user.index') }}" class="btn btn-outline-danger w-100">Clear
                                    Filter</a>
                            </div>
                        @endif

                    </div>
                </form>

                {{-- USER CARD LIST --}}
                <div class="row gy-4">

                    @forelse ($dataUser as $u)

                        <div class="col-lg-4 col-md-6">
                            <div class="warga-card" data-aos="fade-up">

                                <div class="text-center">
                                    <div class="card-name mt-2">{{ $u->name }}</div>
                                    <div class="card-job">{{ $u->role ?? '-' }}</div>
                                </div>

                                <div class="warga-info mt-3">
                                    <p><strong>Email:</strong> {{ $u->email }}</p>
                                    <p><strong>Password (hash):</strong> {{ $u->password }}</p>
                                </div>

                                <div class="d-flex justify-content-center gap-2 mt-3">

                                    <a href="{{ route('user.edit', $u->id) }}" class="btn btn-edit btn-sm px-3">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <form action="{{ route('user.destroy', $u->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-hapus btn-sm px-3">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>

                                </div>

                            </div>
                        </div>

                    @empty
                        <p class="text-center text-muted">Belum ada user.</p>
                    @endforelse

                </div>

                {{-- PAGINATION --}}
                <div class="mt-4">
                    {{ $dataUser->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </section>

@endsection
