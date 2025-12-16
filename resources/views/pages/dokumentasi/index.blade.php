@extends('layouts.guest.app')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Dokumentasi</h1>
            <p>Pendataan dan arsip lengkap setiap persil dan lahan desa,
                termasuk foto lokasi, surat kepemilikan, dan catatan administrasi
                untuk memudahkan pengelolaan dan pengawasan.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li> <a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="current">Dokumentasi</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <section id="projects" class="projects section">



        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="{{ asset('assets-guest/img/ye/tokoo.jpg') }}" alt="Project" class="img-fluid">
                            <div class="project-overlay">
                                <div class="project-status completed">Completed</div>
                                <div class="project-actions">

                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <div class="project-category">Toko</div>
                            <h4 class="project-title">Pendataan Lahan Komersial Warga</h4>
                            <p class="project-description">Pendataan dan pengurusan lahan yang digunakan untuk
                                usaha kecil dan toko warga desa, termasuk sertifikasi dan pemetaan lokasi.</p>
                            <div class="project-meta">
                                <span class="location"><i class="bi bi-geo-alt"></i> Desa Sukamaju</span>
                                <span class="timeline"><i class="bi bi-calendar"></i> 4 Bulan</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Project Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="{{ asset('assets-guest/img/ye/rumahh.jpg') }}" alt="Project" class="img-fluid">
                            <div class="project-overlay">
                                <div class="project-status in-progress">In Progress</div>
                                <div class="project-actions">

                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <div class="project-category">Rumah</div>
                            <h4 class="project-title">Pemetaan & Sertifikasi Lahan Hunian</h4>
                            <p class="project-description">Pendataan persil rumah warga desa untuk kepemilikan legal,
                                renovasi,
                                dan perencanaan tata ruang hunian.</p>
                            <div class="project-meta">
                                <span class="location"><i class="bi bi-geo-alt"></i> Desa Mandiri</span>
                                <span class="timeline"><i class="bi bi-calendar"></i> 6 Bulan</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Project Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="{{ asset('assets-guest/img/ye/kebunn.jpg') }}" alt="Project" class="img-fluid">
                            <div class="project-overlay">
                                <div class="project-status completed">Completed</div>
                                <div class="project-actions">

                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <div class="project-category">Kebun</div>
                            <h4 class="project-title">Optimalisasi Lahan Pertanian Desa</h4>
                            <p class="project-description">Pendataan, pembagian, dan pendampingan penggunaan kebun atau
                                lahan pertanian agar produktif dan sesuai regulasi.</p>
                            <div class="project-meta">
                                <span class="location"><i class="bi bi-geo-alt"></i> Desa Tani Makmur</span>
                                <span class="timeline"><i class="bi bi-calendar"></i> 8 Bulan</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Project Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="{{ asset('assets-guest/img/ye/lahann.jpg') }}" alt="Project" class="img-fluid">
                            <div class="project-overlay">
                                <div class="project-status completed">Completed</div>
                                <div class="project-actions">

                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <div class="project-category">Tanah Kosong</div>
                            <h4 class="project-title">Pendataan & Perencanaan Pemanfaatan Lahan</h4>
                            <p class="project-description">Pendataan tanah kosong dan penyusunan rencana pemanfaatan untuk
                                pembangunan desa, fasilitas umum, atau proyek warga.</p>
                            <div class="project-meta">
                                <span class="location"><i class="bi bi-geo-alt"></i> Desa Sejahtera</span>
                                <span class="timeline"><i class="bi bi-calendar"></i> 5 Bulan</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Project Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="{{ asset('assets-guest/img/ye/kantorr.jpg') }}" alt="Project" class="img-fluid">
                            <div class="project-overlay">
                                <div class="project-status planning">Planning</div>
                                <div class="project-actions">

                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <div class="project-category">Kantor</div>
                            <h4 class="project-title">Pembangunan & Pengelolaan Fasilitas Desa</h4>
                            <p class="project-description">Pendampingan pembangunan kantor desa, balai, dan fasilitas
                                administrasi warga untuk mendukung pelayanan publik.</p>
                            <div class="project-meta">
                                <span class="location"><i class="bi bi-geo-alt"></i> Desa Makmur</span>
                                <span class="timeline"><i class="bi bi-calendar"></i> 7 Bulan</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Project Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="{{ asset('assets-guest/img/ye/gudangg.jpg') }}" alt="Project" class="img-fluid">
                            <div class="project-overlay">
                                <div class="project-status completed">Completed</div>
                                <div class="project-actions">

                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <div class="project-category">Gudang</div>
                            <h4 class="project-title">Pengelolaan Lahan Gudang & Penyimpanan</h4>
                            <p class="project-description">Pendataan dan pengelolaan gudang desa untuk penyimpanan hasil
                                pertanian, alat desa, atau fasilitas logistik.</p>
                            <div class="project-meta">
                                <span class="location"><i class="bi bi-geo-alt"></i> Desa Cerdas</span>
                                <span class="timeline"><i class="bi bi-calendar"></i> 6 Bulan</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Project Item -->

            </div>

        </div>

    </section><!-- /Projects Section -->
@endsection
