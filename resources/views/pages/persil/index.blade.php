@extends('layouts.guest.app')
@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Data Persil</h1>
            <p>Daftar persil lengkap dengan filter, pencarian, dan aksi edit / hapus.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Data Persil</li>
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
                <h4 class="fw-bold">
                    <i class="bi bi-house-fill me-2"></i> Data Persil
                </h4>

                <a href="{{ route('persil.create') }}" class="btn btn-orange btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Persil
                </a>
            </div>

            {{-- Filter + Search --}}
            <form method="GET" action="{{ route('persil.index') }}" class="mb-4">
                <div class="row gy-2">

                    <div class="col-md-3">
                        <select name="rt" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua RT</option>
                            @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ sprintf('%02d', $i) }}"
                                    {{ request('rt') == sprintf('%02d', $i) ? 'selected' : '' }}>
                                    RT {{ sprintf('%02d', $i) }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="rw" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua RW</option>
                            @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ sprintf('%02d', $i) }}"
                                    {{ request('rw') == sprintf('%02d', $i) ? 'selected' : '' }}>
                                    RW {{ sprintf('%02d', $i) }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                placeholder="Search...">

                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                    @if (request('search'))
                        <div class="col-md-2">
                            <a href="{{ route('persil.index') }}" class="btn btn-outline-danger w-100">
                                Clear Search
                            </a>
                        </div>
                    @endif
                </div>
            </form>

            {{-- Kartu Persil --}}
            <div class="row gy-4">
                @forelse ($persil as $p)
                    <div class="col-lg-4 col-md-6">
                        <div class="warga-card card-orange shadow-lg p-3" data-aos="fade-up">

                            {{-- Awal: Swiper untuk Multiple Media --}}
                            <div class="swiper persil-swiper" style="height:180px; width:100%;">
                                <div class="swiper-wrapper">
                                    @php
                                        $media_exists = $p->media->isNotEmpty();
                                    @endphp

                                    @forelse($p->media as $media)
                                        @php
                                            $image_url = asset('storage/uploads/persil/' . $media->file_name);
                                        @endphp
                                        <div class="swiper-slide">
                                            <img src="{{ $image_url }}" class="img-fluid"
                                                style="height:100%; width:100%; object-fit:cover; border-radius:12px;">
                                        </div>
                                    @empty
                                        @php
                                            // Ambil penggunaan & normalkan
                                            $penggunaan = strtolower($p->penggunaan);

                                            // Tentukan gambar default
                                            if (
                                                str_contains($penggunaan, 'tanah') ||
                                                str_contains($penggunaan, 'lahan')
                                            ) {
                                                $defaultImage = 'lahan.jpg';
                                            } elseif (str_contains($penggunaan, 'rumah')) {
                                                $defaultImage = 'rumah.jpg';
                                            } elseif (str_contains($penggunaan, 'toko')) {
                                                $defaultImage = 'toko.jpg';
                                            } elseif (str_contains($penggunaan, 'gudang')) {
                                                $defaultImage = 'gudang.jpg';
                                            } elseif (str_contains($penggunaan, 'kantor')) {
                                                $defaultImage = 'kantor.jpg';
                                            } elseif (str_contains($penggunaan, 'kebun')) {
                                                $defaultImage = 'kebun.jpg';
                                            } else {
                                                // fallback terakhir
                                                $defaultImage = 'tanah.jpg';
                                            }
                                        @endphp

                                        <div class="swiper-slide">
                                            <img src="{{ asset('images/persil-default/' . $defaultImage) }}"
                                                class="img-fluid"
                                                style="height:100%; width:100%; object-fit:cover; border-radius:12px;">
                                        </div>
                                    @endforelse

                                </div>

                                {{-- Tambahkan navigasi dan paginasi jika ada media --}}
                                @if ($media_exists)
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                @endif
                            </div>
                            {{-- Akhir: Swiper untuk Multiple Media --}}

                            <div class="text-center mt-3">
                                <div class="card-name">{{ $p->kode_persil }}</div>
                                <div class="card-job">Penggunaan:</strong> {{ $p->penggunaan }}</div>
                            </div>

                            <div class="warga-info mt-3">
                                <p><strong>Pemilik:</strong> {{ $p->warga->nama }}</p>
                                <p><strong>Luas:</strong> {{ $p->luas_m2 }} m²</p>
                                <p><strong>Alamat:</strong> {{ $p->alamat_lahan . ' RT.' . $p->rt . ' RW.' . $p->rw }}</p>
                            </div>

                            <div class="d-flex justify-content-center gap-2 mt-3">
                                {{-- Button Detail: Trigger Modal --}}
                                <button type="button" class="btn btn-info btn-sm px-3" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $p->persil_id }}">
                                    <i class="bi bi-eye"></i> Detail
                                </button>

                                @if ($p->persil_id)
                                    <a href="{{ route('persil.edit', $p->persil_id) }}" class="btn btn-edit btn-sm px-3">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <form action="{{ route('persil.destroy', $p->persil_id) }}" method="POST"
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
                    <p class="text-center text-muted">Belum ada data persil.</p>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $persil->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </section>

    {{-- MODAL DETAIL PERSIL (Looping untuk setiap persil) --}}
    @foreach ($persil as $p)
        <div class="modal fade" id="detailModal{{ $p->persil_id }}" tabindex="-1"
            aria-labelledby="detailModalLabel{{ $p->persil_id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel{{ $p->persil_id }}">
                            Detail Persil: **{{ $p->kode_persil }}**
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-1"></i> Data Umum</h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th>Kode Persil</th>
                                        <td>: {{ $p->kode_persil }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pemilik (ID)</th>
                                        <td>: {{ $p->pemilik_warga_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Luas</th>
                                        <td>: **{{ $p->luas_m2 }} m²**</td>
                                    </tr>
                                    <tr>
                                        <th>Penggunaan</th>
                                        <td>: {{ $p->penggunaan }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3"><i class="bi bi-geo-alt-fill me-1"></i> Lokasi & Keterangan</h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <th style="width: 30%;">Alamat</th>
                                        <td>: {{ $p->alamat_lahan }}</td>
                                    </tr>
                                    <tr>
                                        <th>RT/RW</th>
                                        <td>: {{ $p->rt }}/{{ $p->rw }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-12 mt-3">
                                <h6 class="fw-bold mb-3"><i class="bi bi-images me-1"></i> Media Persil</h6>
                                @if ($p->media->isNotEmpty())
                                    <div class="row g-2">
                                        @foreach ($p->media as $media)
                                            <div class="col-4">
                                                {{-- Tautan gambar diubah menjadi hanya link biasa --}}
                                                <a href="{{ asset('storage/uploads/persil/' . $media->file_name) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/uploads/persil/' . $media->file_name) }}"
                                                        class="img-fluid rounded shadow-sm"
                                                        style="object-fit: cover; height: 100px; width: 100%;">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small class="text-muted mt-2 d-block">Klik gambar untuk membuka di tab baru.</small>
                                @else
                                    <p class="text-muted fst-italic">Tidak ada media/foto yang terlampir.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- END MODAL DETAIL PERSIL --}}

@endsection

@push('scripts')
    {{-- **REFERENSI GLIGHTBOX DIHAPUS** --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi setiap Swiper secara terpisah
            document.querySelectorAll('.persil-swiper').forEach(function(swiperElement) {
                new Swiper(swiperElement, {
                    // Konfigurasi Swiper
                    slidesPerView: 1,
                    spaceBetween: 0,
                    loop: true,
                    pagination: {
                        el: swiperElement.querySelector('.swiper-pagination'),
                        clickable: true,
                    },
                    navigation: {
                        nextEl: swiperElement.querySelector('.swiper-button-next'),
                        prevEl: swiperElement.querySelector('.swiper-button-prev'),
                    },
                    // Pastikan navigasi dan paginasi hanya tampil jika ada lebih dari 1 slide
                    on: {
                        init: function() {
                            // Cek jumlah slide untuk menyembunyikan/menampilkan navigasi
                            if (this.slides.length <= 1) {
                                this.params.navigation.enabled = false;
                                this.params.pagination.enabled = false;
                                const nextBtn = swiperElement.querySelector(
                                    '.swiper-button-next');
                                const prevBtn = swiperElement.querySelector(
                                    '.swiper-button-prev');
                                if (nextBtn) nextBtn.style.display = 'none';
                                if (prevBtn) prevBtn.style.display = 'none';
                            }
                        },
                    }
                });
            });

            // Inisialisasi GLightbox DIHAPUS
        });
    </script>
@endpush
