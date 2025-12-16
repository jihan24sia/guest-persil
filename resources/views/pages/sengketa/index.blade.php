@extends('layouts.guest.app')
@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Data Sengketa Persil</h1>
            <p>Daftar sengketa persil lengkap dengan kronologi, status, dan aksi edit / hapus.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Data Sengketa Persil</li>
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
                    <i class="bi bi-gavel me-2"></i> Data Sengketa Persil
                </h4>
                <a href="{{ route('sengketa.create') }}" class="btn btn-orange btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Sengketa
                </a>
            </div>
            {{-- Filter + Search --}}
            <form method="GET" action="{{ route('sengketa.index') }}" class="mb-4">
                <div class="row gy-2">
                    <div class="col-md-3">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">Status</option>

                            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>
                                Proses
                            </option>

                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>

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
                            <a href="{{ route('sengketa.index') }}" class="btn btn-outline-danger w-100">
                                Clear Search
                            </a>
                        </div>
                    @endif
                </div>
            </form>
            {{-- Kartu Sengketa --}}
            <div class="row gy-4">
                @forelse($sengketa as $s)
                    <div class="col-lg-4 col-md-6">
                        <div class="warga-card card-orange shadow-lg p-3" data-aos="fade-up">

                            {{-- Awal: Swiper untuk Multiple Media --}}
                            <div class="swiper sengketa-swiper-{{ $s->sengketa_id }}" style="height:180px; width:100%;">
                                <div class="swiper-wrapper">
                                    @php
                                        $media_exists = $s->media->isNotEmpty();
                                    @endphp

                                    @forelse($s->media as $media)
                                        @php
                                            $image_url = asset('storage/uploads/sengketa/' . $media->file_name);
                                        @endphp
                                        <div class="swiper-slide">
                                            <img src="{{ $image_url }}" class="img-fluid"
                                                style="height:100%; width:100%; object-fit:cover; border-radius:12px;">
                                        </div>
                                    @empty
                                        {{-- Default image jika tidak ada media --}}
                                        <div class="swiper-slide">
                                            <img src="{{ asset('assets-guest/img/sengketa.jpg') }}" class="img-fluid"
                                                style="height:100%; width:100%; object-fit:cover; border-radius:12px;">
                                        </div>
                                    @endforelse
                                </div>

                                {{-- Tambahkan navigasi dan paginasi jika ada media --}}
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                            {{-- Akhir: Swiper untuk Multiple Media --}}

                            <div class="text-center mt-3">
                                <div class="card-name">Persil: {{ $s->persil->kode_persil ?? '-' }}</div>
                                <div class="card-job">Sengketa</div>
                            </div>

                            <div class="warga-info mt-3">
                                <p><strong>Pihak 1:</strong> {{ $s->pihak_1 }}</p>
                                <p><strong>Pihak 2:</strong> {{ $s->pihak_2 }}</p>
                                <p><strong>Status:</strong>
                                    @if (strtolower($s->status) === 'proses')
                                        <span class="badge bg-warning text-dark">Proses</span>
                                    @elseif(strtolower($s->status) === 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $s->status }}</span>
                                    @endif
                                </p>
                            </div>

                            <div class="d-flex justify-content-center gap-2 mt-3">
                                {{-- TOMBOL DETAIL BARU --}}
                                <button type="button" class="btn btn-info btn-sm px-3 btn-detail-sengketa"
                                    data-bs-toggle="modal" data-bs-target="#detailModal"
                                    onclick="showDetailModal('{{ $s->sengketa_id }}')">
                                    <i class="bi bi-eye"></i> Detail
                                </button>


                                <a href="{{ route('sengketa.edit', $s->sengketa_id) }}" class="btn btn-edit btn-sm px-3">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('sengketa.destroy', $s->sengketa_id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus sengketa ini?')">
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
                    <p class="text-center text-muted">Belum ada data sengketa.</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $sengketa->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </section>

    {{-- Modal Detail Sengketa --}}
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-orange text-white">
                    <h5 class="modal-title" id="detailModalLabel"><i class="bi bi-info-circle me-1"></i> Detail Sengketa
                        Persil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modal-content-loader" class="text-center my-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat detail sengketa...</p>
                    </div>

                    <div id="modal-detail-body" style="display: none;">
                        {{-- Media Slider dalam Modal --}}
                        <div class="swiper modal-swiper mb-3" id="media-swiper-modal" style="height:300px; width:100%;">
                            <div class="swiper-wrapper" id="modal-swiper-wrapper">
                                {{-- Slide Media akan diisi oleh JavaScript --}}
                            </div>
                            <div class="swiper-pagination modal-swiper-pagination"></div>
                            <div class="swiper-button-prev modal-swiper-prev"></div>
                            <div class="swiper-button-next modal-swiper-next"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Kode Persil:</strong> <span id="detail-kode_persil"></span></p>
                                <p><strong>Pihak 1:</strong> <span id="detail-pihak_1"></span></p>
                                <p><strong>Pihak 2:</strong> <span id="detail-pihak_2"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Tanggal Sengketa:</strong> <span id="detail-tanggal"></span></p>
                                <p><strong>Status:</strong> <span id="detail-status"></span></p>
                            </div>
                        </div>
                        <hr>
                        <h5>Kronologi</h5>
                        <p id="detail-kronologi" style="white-space: pre-wrap;"></p>
                        <h5>Penyelesaian</h5>
                        <p id="detail-penyelesaian" style="white-space: pre-wrap;">-</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Data sengketa dari Blade ke JavaScript
        const sengketaData = @json($sengketa->items());
        let modalSwiperInstance = null;
        const storagePath = '{{ asset('storage/uploads/sengketa/') }}';
        const defaultImagePath = '{{ asset('images/no-image.jpg') }}';

        document.addEventListener('DOMContentLoaded', function() {

            // 1. Inisialisasi Swiper untuk setiap kartu
            @forelse($sengketa as $s)
                new Swiper('.sengketa-swiper-{{ $s->sengketa_id }}', {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    loop: {{ $s->media->count() > 1 ? 'true' : 'false' }},
                    pagination: {
                        el: '.sengketa-swiper-{{ $s->sengketa_id }} .swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.sengketa-swiper-{{ $s->sengketa_id }} .swiper-button-next',
                        prevEl: '.sengketa-swiper-{{ $s->sengketa_id }} .swiper-button-prev',
                    },
                    on: {
                        init: function() {
                            if (this.slides.length <= 1) {
                                const swiperElement = document.querySelector(
                                    '.sengketa-swiper-{{ $s->sengketa_id }}');
                                const nextBtn = swiperElement.querySelector('.swiper-button-next');
                                const prevBtn = swiperElement.querySelector('.swiper-button-prev');
                                const pagin = swiperElement.querySelector('.swiper-pagination');
                                if (nextBtn) nextBtn.style.display = 'none';
                                if (prevBtn) prevBtn.style.display = 'none';
                                if (pagin) pagin.style.display = 'none';
                            }
                        },
                    }
                });
            @empty
            @endforelse

            // 2. Reset Swiper Modal saat ditutup
            const detailModal = document.getElementById('detailModal');
            detailModal.addEventListener('hidden.bs.modal', function() {
                if (modalSwiperInstance) {
                    modalSwiperInstance.destroy(true, true);
                    modalSwiperInstance = null;
                }
                document.getElementById('modal-detail-body').style.display = 'none';
                document.getElementById('modal-content-loader').style.display = 'block';
                document.getElementById('modal-swiper-wrapper').innerHTML = '';
            });
        });

        // ===============================
        // FUNGSI TAMPILKAN DETAIL MODAL
        // ===============================
        window.showDetailModal = function(sengketaId) {
            const sengketa = sengketaData.find(s => s.sengketa_id == sengketaId);

            if (!sengketa) {
                alert('Data sengketa tidak ditemukan.');
                return;
            }

            document.getElementById('modal-detail-body').style.display = 'none';
            document.getElementById('modal-content-loader').style.display = 'block';

            setTimeout(() => {

                // =====================
                // FORMAT TANGGAL & JAM
                // =====================
                let tanggalFormatted = "-";
                if (sengketa.created_at) {
                    const d = new Date(sengketa.created_at);
                    const bulanIndo = [
                        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                    ];
                    const hari = String(d.getDate()).padStart(2, "0");
                    const bulan = bulanIndo[d.getMonth()];
                    const tahun = d.getFullYear();
                    const jam = String(d.getHours()).padStart(2, "0");
                    const menit = String(d.getMinutes()).padStart(2, "0");
                    tanggalFormatted = `${hari} ${bulan} ${tahun} Jam ${jam}:${menit}`;
                }

                // =====================
                // ISI DETAIL TEKS
                // =====================
                document.getElementById('detail-kode_persil').textContent = sengketa.persil ? sengketa.persil
                    .kode_persil : '-';
                document.getElementById('detail-pihak_1').textContent = sengketa.pihak_1 || '-';
                document.getElementById('detail-pihak_2').textContent = sengketa.pihak_2 || '-';
                document.getElementById('detail-tanggal').textContent = tanggalFormatted;
                document.getElementById('detail-kronologi').textContent = sengketa.kronologi || '-';
                document.getElementById('detail-penyelesaian').textContent = sengketa.penyelesaian || '-';

                // =====================
                // STATUS DENGAN BADGE
                // =====================
                // =====================
                // Tampilkan Status dengan Badge
                // =====================
                const statusElement = document.getElementById('detail-status');
                statusElement.innerHTML = '-'; // default

                if (sengketa.status) {
                    const statusLower = sengketa.status.toLowerCase();
                    let badgeClass = 'bg-secondary';
                    let statusText = sengketa.status;

                    if (statusLower === 'proses') {
                        badgeClass = 'bg-warning text-dark';
                        statusText = 'Proses';
                    } else if (statusLower === 'selesai') {
                        badgeClass = 'bg-success';
                        statusText = 'Selesai';
                    }

                    statusElement.innerHTML = `<span class="badge ${badgeClass}">${statusText}</span>`;
                }


                // ============================
                // ISI MEDIA SWIPER DI MODAL
                // ============================
                const swiperWrapper = document.getElementById('modal-swiper-wrapper');
                swiperWrapper.innerHTML = '';

                if (sengketa.media && sengketa.media.length > 0) {
                    sengketa.media.forEach(media => {
                        const imageUrl = storagePath + '/' + media.file_name;
                        const slide = `
                        <div class="swiper-slide">
                            <img src="${imageUrl}" class="img-fluid"
                                style="height:100%; width:100%; object-fit:contain; border-radius:12px;">
                        </div>`;
                        swiperWrapper.insertAdjacentHTML('beforeend', slide);
                    });
                } else {
                    const slide = `
                    <div class="swiper-slide">
                        <img src="${defaultImagePath}" class="img-fluid"
                            style="height:100%; width:100%; object-fit:contain; border-radius:12px;">
                    </div>`;
                    swiperWrapper.insertAdjacentHTML('beforeend', slide);
                }

                // ============================
                // INIT SWIPER MODAL
                // ============================
                modalSwiperInstance = new Swiper('#media-swiper-modal', {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    loop: sengketa.media && sengketa.media.length > 1,
                    pagination: {
                        el: '.modal-swiper-pagination',
                        clickable: true,
                        hideOnClick: false,
                    },
                    navigation: {
                        nextEl: '.modal-swiper-next',
                        prevEl: '.modal-swiper-prev',
                    },
                    updateOnWindowResize: true,
                });

                if (!sengketa.media || sengketa.media.length <= 1) {
                    document.querySelector('#media-swiper-modal .modal-swiper-pagination').style.display =
                        'none';
                    document.querySelector('#media-swiper-modal .modal-swiper-next').style.display = 'none';
                    document.querySelector('#media-swiper-modal .modal-swiper-prev').style.display = 'none';
                } else {
                    document.querySelector('#media-swiper-modal .modal-swiper-pagination').style.display =
                        'block';
                    document.querySelector('#media-swiper-modal .modal-swiper-next').style.display = 'block';
                    document.querySelector('#media-swiper-modal .modal-swiper-prev').style.display = 'block';
                }

                // Tampilkan Detail
                document.getElementById('modal-content-loader').style.display = 'none';
                document.getElementById('modal-detail-body').style.display = 'block';

                if (modalSwiperInstance) modalSwiperInstance.update();

            }, 500);
        };
    </script>
@endpush
