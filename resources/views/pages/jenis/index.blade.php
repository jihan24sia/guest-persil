@extends('layouts.guest.app')
@section('content')
    <!-- Page Title -->
        <div class="page-title dark-background" data-aos="fade"
            style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
            <div class="container position-relative">
                <h1>Jenis Penggunaan</h1>
                <p>Kelola jenis penggunaan lahan persil Anda.</p>

                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li class="current">Jenis Penggunaan</li>
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

                {{-- Header + Tambah --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold text-pink">
                        <i class="bi bi-list-check me-2"></i>Jenis Penggunaan
                    </h4>
                    <a href="{{ route('jenis.create') }}" class="btn btn-orange btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Jenis
                    </a>
                </div>

                {{-- List Jenis Penggunaan --}}
                <div class="row gy-4">
                    @forelse ($jenis as $jp)
                        <div class="col-lg-4 col-md-6">
                            <div class="warga-card card-orange shadow-lg p-3" data-aos="fade-up">

                                <div class="text-center">
                                    <i class="bi bi-tags-fill" style="font-size:70px;"></i>
                                    <h5 class="fw-bold text-white mt-3">{{ $jp->nama_penggunaan }}</h5>
                                </div>

                                <hr class="border-light">

                                <div class="mb-2">
                                    <i class="bi bi-card-text me-2 text-info"></i>
                                    <strong>Nama Penggunaan:</strong> {{ $jp->nama_penggunaan }}
                                </div>

                                <div class="mb-2">
                                    <i class="bi bi-file-earmark-text me-2 text-info"></i>
                                    <strong>Keterangan:</strong>
                                    <br>{{ $jp->keterangan ?? '-' }}
                                </div>

                                <hr class="border-light">

                                <div class="d-flex justify-content-center gap-2 mt-3">
                                    @if ($jp->jenis_id)
                                        <a href="{{ route('jenis.edit', $jp->jenis_id) }}"
                                            class="btn btn-edit btn-sm px-3">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>

                                        <form action="{{ route('jenis.destroy', $jp->jenis_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-hapus btn-sm px-3">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                            </div>

                        </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada data jenis penggunaan.</p>
                @endforelse
            </div>


            </div>
        </section>

   @endsection
