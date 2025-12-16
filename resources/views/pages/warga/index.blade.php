@extends('layouts.guest.app')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Data Warga</h1>
            <p>Daftar penduduk lengkap dengan filter, pencarian, dan aksi edit / hapus.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="current">Data Warga</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

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
                <h4 class="fw-bold">
                    <i class="bi bi-people-fill me-2"></i> Data Warga
                </h4>
                <a href="{{ route('warga.create') }}" class="btn btn-orange btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Warga
                </a>

            </div>

            {{-- Filter + Search --}}
            <form method="GET" action="{{ route('warga.index') }}" class="mb-4">
                <div class="row gy-2">
                    <div class="col-md-5">
                        <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Jenis Kelamin</option>
                            <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="Search...">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                    @if (request('search'))
                        <div class="col-md-3">
                            <a href="{{ route('warga.index') }}" class="btn btn-outline-danger w-100">Clear
                                Search</a>
                        </div>
                    @endif
                </div>
            </form>

            {{-- Data Warga Card --}}
            <div class="row gy-4">
                @forelse ($warga as $w)
                    @php
                        $foto =
                            $w->jenis_kelamin === 'Laki-laki'
                                ? 'https://cdn-icons-png.flaticon.com/512/4140/4140037.png'
                                : ($w->jenis_kelamin === 'Perempuan'
                                    ? 'https://cdn-icons-png.flaticon.com/512/4140/4140047.png
'
                                    : 'https://cdn-icons-png.flaticon.com/512/149/149071.png');
                    @endphp

                    <div class="col-lg-4 col-md-6">
                        <div class="warga-card" data-aos="fade-up">

                            <div class="text-center">
                                <img src="{{ $foto }}" class="warga-photo" alt="Foto">

                                <div class="card-name">{{ $w->nama }}</div>
                                <div class="card-job">{{ $w->pekerjaan }}</div>
                            </div>

                            <div class="warga-info mt-3">
                                <p><strong>No KTP:</strong> {{ $w->no_ktp }}</p>
                                <p><strong>Jenis Kelamin:</strong> {{ $w->jenis_kelamin }}</p>
                                <p><strong>Agama:</strong> {{ $w->agama }}</p>
                                <p><strong>Telepon:</strong> {{ $w->telp }}</p>
                                <p><strong>Email:</strong> {{ $w->email }}</p>
                            </div>

                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <a href="{{ route('warga.edit', $w->warga_id) }}" class="btn btn-edit btn-sm px-3">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form action="{{ route('warga.destroy', $w->warga_id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus data ini?')">
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
                    <p class="text-center text-muted">Belum ada data warga.</p>
                @endforelse
            </div>


            <div class="mt-4">
                {{ $warga->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </section>
@endsection
