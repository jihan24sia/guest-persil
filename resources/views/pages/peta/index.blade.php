@extends('layouts.guest.app')
@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Data Peta Persil</h1>
            <p>Daftar peta persil lengkap dengan ukuran, geojson, dan aksi edit / hapus.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Data Peta Persil</li>
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
                    <i class="bi bi-map-fill me-2"></i> Data Peta Persil
                </h4>

                <a href="{{ route('peta.create') }}" class="btn btn-orange btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Peta
                </a>
            </div>

            {{-- Filter + Search --}}
            <form method="GET" action="{{ route('peta.index') }}" class="mb-4">
                <div class="row gy-2">
                    <div class="col-md-3">
                        <select name="panjang_m" class="form-select" onchange="this.form.submit()">
                            <option value="">Panjang(m)</option>
                            @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ sprintf('%02d', $i) }}"
                                    {{ request('panjang_m') == sprintf('%02d', $i) ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }} m
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
                            <a href="{{ route('peta.index') }}" class="btn btn-outline-danger w-100">
                                Clear Search
                            </a>
                        </div>
                    @endif
                </div>
            </form>

            {{-- Kartu Peta (dengan Swiper) --}}
            <div class="row gy-4">
                @forelse ($peta as $p)
                    <div class="col-lg-4 col-md-6">
                        <div class="warga-card card-orange shadow-lg p-3" data-aos="fade-up">

                            {{-- Awal: Swiper untuk Multiple Media Peta --}}
                            <div class="swiper peta-swiper" style="height:180px; width:100%;">
                                <div class="swiper-wrapper">
                                    @php
                                        $media_exists = $p->media->isNotEmpty();
                                    @endphp

                                    @forelse($p->media as $media)
                                        @php
                                            // Asumsi folder media untuk peta adalah 'uploads/peta'
                                            $image_url = asset('storage/uploads/peta/' . $media->file_name);
                                        @endphp
                                        <div class="swiper-slide">
                                            <img src="{{ $image_url }}" class="img-fluid"
                                                style="height:100%; width:100%; object-fit:cover; border-radius:12px;"
                                                alt="Media Peta">
                                        </div>
                                    @empty
                                        {{-- Default image jika tidak ada media --}}
                                        <div class="swiper-slide">
                                            <img src="{{ asset('assets-guest/img/peta.jpg') }}" class="img-fluid"
                                                style="height:100%; width:100%; object-fit:cover; border-radius:12px;"
                                                alt="Tidak Ada Gambar Peta">
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
                            {{-- Akhir: Swiper untuk Multiple Media Peta --}}

                            <div class="text-center mt-3">
                                <div class="card-name">Peta: {{ $p->persil->kode_persil ?? '-' }}</div>
                                <div class="card-job">Peta Persil</div>
                            </div>

                            <div class="warga-info mt-3">
                                <p><strong>Panjang:</strong> {{ $p->panjang_m }} m</p>
                                <p><strong>Lebar:</strong> {{ $p->lebar_m }} m</p>
                            </div>

                            <div class="d-flex justify-content-center gap-2 mt-3">
                                {{-- TOMBOL DETAIL BARU --}}
                                <button type="button" class="btn btn-info btn-sm px-3 btn-detail-peta"
                                    data-bs-toggle="modal" data-bs-target="#detailModal"
                                    data-peta-id="{{ $p->peta_id }}">
                                    <i class="bi bi-eye"></i> Detail
                                </button>

                                {{-- AKHIR TOMBOL DETAIL BARU --}}

                                <a href="{{ route('peta.edit', $p->peta_id) }}" class="btn btn-edit btn-sm px-3">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form action="{{ route('peta.destroy', $p->peta_id) }}" method="POST"
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
                    <p class="text-center text-muted">Belum ada data peta persil.</p>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $peta->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </section>

    {{-- MODAL DETAIL PETA BARU --}}
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel"><i class="bi bi-info-circle me-2"></i> Detail Peta Persil
                        - ID: <span id="modal-peta-id"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6 class="fw-bold text-orange">Informasi Detail</h6>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th>Kode Persil</th>
                                    <td>: <span id="modal-kode-persil"></span></td>
                                </tr>
                                <tr>
                                    <th>RT/RW</th>
                                    <td>: <span id="modal-rtrw"></span></td>
                                </tr>
                                <tr>
                                    <th>Panjang</th>
                                    <td>: <span id="modal-panjang"></span> m</td>
                                </tr>
                                <tr>
                                    <th>Lebar</th>
                                    <td>: <span id="modal-lebar"></span> m</td>
                                </tr>
                                <tr>
                                    <th>GeoJSON</th>
                                    <td>:
                                        <textarea id="modal-geojson" class="form-control" rows="4" readonly></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Titik Tengah (Lat, Lng)</th>
                                    <td>: <span id="modal-center-coords"></span></td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>: <span id="modal-keterangan"></span></td>
                                </tr>
                                <tr>
                                    <th>Dibuat Tanggal</th>
                                    <td>: <span id="modal-created-at"></span></td>
                                </tr>
                            </table>

                            <h6 class="fw-bold text-orange mt-4">Media/Gambar Peta</h6>
                            {{-- Area untuk Media Swiper di Modal --}}
                            <div class="swiper modal-media-swiper" style="height:250px; width:100%;">
                                <div class="swiper-wrapper" id="modal-media-container">
                                    {{-- Media akan dimuat di sini oleh JavaScript --}}
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <h6 class="fw-bold text-orange">Tampilan Peta (Flat Map)</h6>
                            {{-- Container Peta Leaflet --}}
                            <div id="modalMap"
                                style="height: 500px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- AKHIR MODAL DETAIL PETA BARU --}}

@endsection

{{-- Script untuk inisialisasi Swiper Peta dan Peta Detail --}}
@push('scripts')
    {{-- Membutuhkan Leaflet CSS & JS. Pastikan sudah di-link di layout Anda! --}}
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="..." crossorigin="" /> --}}
    {{-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="..." crossorigin=""></script> --}}

    <script>
        let detailMap = null; // Variabel global untuk instance peta Leaflet

        document.addEventListener('DOMContentLoaded', function() {
            // --- 1. Inisialisasi Swiper Kartu Peta ---
            document.querySelectorAll('.peta-swiper').forEach(function(swiperElement) {
                new Swiper(swiperElement, {
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
                    on: {
                        init: function() {
                            // Menghilangkan navigasi/paginasi jika hanya 1 slide (atau kurang)
                            if (this.slides.length <= 1) {
                                const nextBtn = swiperElement.querySelector(
                                    '.swiper-button-next');
                                const prevBtn = swiperElement.querySelector(
                                    '.swiper-button-prev');
                                const pagin = swiperElement.querySelector('.swiper-pagination');
                                if (nextBtn) nextBtn.style.display = 'none';
                                if (prevBtn) prevBtn.style.display = 'none';
                                if (pagin) pagin.style.display = 'none';
                            }
                        },
                    }
                });
            });

            // --- 2. Logika Modal Detail dan Peta ---
            const detailModal = document.getElementById('detailModal');
            const modalMediaContainer = document.getElementById('modal-media-container');

            detailModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const petaId = button.getAttribute('data-peta-id');

                // Hapus instance peta lama sebelum memuat yang baru
                if (detailMap) {
                    detailMap.remove();
                    detailMap = null;
                }

                // Panggil AJAX untuk mengambil data detail
                fetch(
                    `{{ url('peta') }}/${petaId}/detail`) // ASUMSI: Anda perlu membuat route dan controller method ini!
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Update Konten Modal
                        document.getElementById('modal-peta-id').textContent = data.peta_id;
                        document.getElementById('modal-kode-persil').textContent = data.persil ? data
                            .persil.kode_persil : '-';
                        document.getElementById('modal-rtrw').textContent = (data.rt ? 'RT ' + data.rt :
                            '-') + '/' + (data.rw ? 'RW ' + data.rw : '-');
                        document.getElementById('modal-panjang').textContent = data.panjang_m || '-';
                        document.getElementById('modal-lebar').textContent = data.lebar_m || '-';
                        document.getElementById('modal-geojson').value = data.geojson ||
                            'Tidak ada data GeoJSON';
                        document.getElementById('modal-keterangan').textContent = data.keterangan ||
                        '-';
                        document.getElementById('modal-created-at').textContent = new Date(data
                            .created_at).toLocaleDateString();

                        // --- Logika Media Swiper di Modal ---
                        modalMediaContainer.innerHTML = ''; // Kosongkan container
                        const media = data.media || [];
                        let hasMedia = media.length > 0;

                        if (hasMedia) {
                            media.forEach(m => {
                                const imageUrl =
                                    `{{ asset('storage/uploads/peta') }}/${m.file_name}`;
                                modalMediaContainer.innerHTML += `
                                <div class="swiper-slide">
                                    <img src="${imageUrl}" class="img-fluid" style="height:100%; width:100%; object-fit:cover; border-radius:8px;" alt="Media Peta">
                                </div>
                            `;
                            });
                        } else {
                            // Default image jika tidak ada media
                            modalMediaContainer.innerHTML = `
                            <div class="swiper-slide">
                                <img src="{{ asset('images/peta-sample.jpg') }}" class="img-fluid" style="height:100%; width:100%; object-fit:cover; border-radius:8px;" alt="Tidak Ada Gambar Peta">
                            </div>
                        `;
                        }

                        // Inisialisasi Swiper Media di Modal
                        const modalSwiperElement = detailModal.querySelector('.modal-media-swiper');
                        // Hancurkan Swiper lama jika ada (penting untuk modal)
                        if (modalSwiperElement.swiper) {
                            modalSwiperElement.swiper.destroy(true, true);
                        }

                        const modalSwiper = new Swiper(modalSwiperElement, {
                            slidesPerView: 1,
                            loop: hasMedia && media.length > 1, // Loop hanya jika ada > 1 media
                            pagination: {
                                el: modalSwiperElement.querySelector('.swiper-pagination'),
                                clickable: true,
                            },
                            navigation: {
                                nextEl: modalSwiperElement.querySelector('.swiper-button-next'),
                                prevEl: modalSwiperElement.querySelector('.swiper-button-prev'),
                            },
                        });

                        // Sembunyikan navigasi jika hanya 1 media
                        if (!hasMedia || media.length <= 1) {
                            modalSwiperElement.querySelector('.swiper-button-next').style.display =
                                'none';
                            modalSwiperElement.querySelector('.swiper-button-prev').style.display =
                                'none';
                            modalSwiperElement.querySelector('.swiper-pagination').style.display =
                                'none';
                        } else {
                            modalSwiperElement.querySelector('.swiper-button-next').style.display = '';
                            modalSwiperElement.querySelector('.swiper-button-prev').style.display = '';
                            modalSwiperElement.querySelector('.swiper-pagination').style.display = '';
                        }


                        // --- Logika Peta Leaflet ---
                        const geojsonString = data.geojson;
                        let initialLat = data.lat || -6.2088; // Default Jakarta
                        let initialLng = data.lng || 106.8456;

                        // Inisialisasi Peta
                        detailMap = L.map('modalMap', {
                            center: [initialLat, initialLng],
                            zoom: 15,
                            scrollWheelZoom: false // Opsional: nonaktifkan zoom dengan scroll
                        });

                        // Tambahkan Tile Layer (Peta Dasar)
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(detailMap);

                        let layerGroup = L.layerGroup().addTo(
                        detailMap); // Group untuk menampung marker/geojson

                        if (geojsonString) {
                            try {
                                const geojson = JSON.parse(geojsonString);
                                const geojsonLayer = L.geoJSON(geojson, {
                                    style: function(feature) {
                                        return {
                                            color: '#ff7800',
                                            weight: 5,
                                            opacity: 0.65,
                                            fillColor: '#ffa500',
                                            fillOpacity: 0.2
                                        };
                                    }
                                }).addTo(layerGroup);

                                // Posisikan peta agar pas mencakup seluruh GeoJSON
                                if (geojsonLayer.getBounds().isValid()) {
                                    detailMap.fitBounds(geojsonLayer.getBounds());
                                } else {
                                    // Jika tidak valid (misalnya hanya 1 titik), gunakan titik tengah
                                    L.marker([initialLat, initialLng]).addTo(layerGroup)
                                        .bindPopup(`ID Peta: ${data.peta_id}`).openPopup();
                                    detailMap.setView([initialLat, initialLng], 15);
                                }

                                // Coba hitung titik tengah GeoJSON
                                const bounds = geojsonLayer.getBounds();
                                const center = bounds.getCenter();
                                document.getElementById('modal-center-coords').textContent =
                                    `${center.lat.toFixed(6)}, ${center.lng.toFixed(6)}`;

                            } catch (e) {
                                console.error("Error parsing GeoJSON:", e);
                                document.getElementById('modal-geojson').value =
                                    'Error: Data GeoJSON tidak valid.';

                                // Tambahkan marker titik tengah saja jika GeoJSON gagal
                                L.marker([initialLat, initialLng]).addTo(layerGroup)
                                    .bindPopup(`ID Peta: ${data.peta_id} (Titik Default)`).openPopup();
                                document.getElementById('modal-center-coords').textContent =
                                    `${initialLat}, ${initialLng} (Default)`;
                            }
                        } else {
                            // Jika tidak ada GeoJSON, tampilkan titik tengah (lat/lng) jika ada
                            if (initialLat && initialLng) {
                                L.marker([initialLat, initialLng]).addTo(layerGroup)
                                    .bindPopup(`ID Peta: ${data.peta_id} (Titik Tengah)`).openPopup();
                                detailMap.setView([initialLat, initialLng], 15);
                                document.getElementById('modal-center-coords').textContent =
                                    `${initialLat}, ${initialLng} (Tengah)`;
                            } else {
                                // Tampilkan pesan jika tidak ada data peta sama sekali
                                document.getElementById('modal-center-coords').textContent =
                                    'Tidak Ada Data Koordinat';
                                detailMap.setView([-6.2088, 106.8456], 12); // View default
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        alert('Gagal mengambil data detail peta.');
                    });
            });

            // Event listener untuk menghancurkan peta saat modal ditutup
            detailModal.addEventListener('hidden.bs.modal', function() {
                if (detailMap) {
                    detailMap.remove();
                    detailMap = null;
                }
            });

            // FIX: Penting untuk memastikan peta dirender ulang saat modal ditampilkan
            detailModal.addEventListener('shown.bs.modal', function() {
                if (detailMap) {
                    detailMap.invalidateSize();
                }
            });
        });
    </script>
@endpush
