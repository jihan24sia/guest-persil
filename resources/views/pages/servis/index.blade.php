@extends('layouts.guest.app')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">

        <div class="container position-relative">
            <h1>Servis</h1>
            <p>Kami menyediakan layanan pertanahan yang berfokus pada pengelolaan dan pengurusan persil.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li> <a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="current">Servis</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Services Section -->
    <section id="services" class="services section light-background">
        <!-- Section Title -->


        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="services-grid">

                <div class="service-item" data-aos="fade-up" data-aos-delay="150">
                    <div class="service-number">01</div>
                    <div class="service-icon">
                        <i class="bi bi-buildings"></i>
                    </div>
                    <h3>Pengelolaan Tanah Komersial</h3>
                    <p>Solusi lengkap untuk pengelolaan dan administrasi tanah komersial, termasuk pendataan,
                        sertifikasi, dan pemetaan persil.</p>
                    <a href="{{ route('contact') }}" class="service-cta">
                        <span>Explore Service</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="service-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-number">02</div>
                    <div class="service-icon">
                        <i class="bi bi-house-heart"></i>
                    </div>
                    <h3>Pengurusan Tanah Hunian</h3>
                    <p>Layanan pengurusan tanah untuk hunian, mulai dari pendaftaran
                        kepemilikan hingga pendampingan pembangunan rumah desa.</p>
                    <a href="{{ route('contact') }}" class="service-cta">
                        <span>Explore Service</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="service-item" data-aos="fade-up" data-aos-delay="250">

                    <div class="service-number">03</div>
                    <div class="service-icon">
                        <i class="bi bi-gear-wide-connected"></i>
                    </div>
                    <h3>Pembangunan & Perencanaan Desa</h3>
                    <p>Pendekatan terpadu untuk perencanaan dan pembangunan fasilitas desa agar
                        sesuai dengan kebutuhan masyarakat dan tata ruang yang optimal.</p>
                    <a href="{{ route('contact') }}" class="service-cta">
                        <span>Explore Service</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="service-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-number">04</div>
                    <div class="service-icon">
                        <i class="bi bi-clipboard2-check"></i>
                    </div>
                    <h3>Konsultasi Pertanahan</h3>
                    <p>Bimbingan ahli dalam pengelolaan tanah dan persil, termasuk strategi
                        pemanfaatan lahan dan penyelesaian administrasi hukum.</p>
                    <a href="{{ route('contact') }}" class="service-cta">
                        <span>Explore Service</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="service-item" data-aos="fade-up" data-aos-delay="350">
                    <div class="service-number">05</div>
                    <div class="service-icon">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h3>Peningkatan & Pemugaran Lahan</h3>
                    <p>Transformasi lahan desa dengan perbaikan infrastruktur dan
                        pengelolaan lahan yang lebih produktif dan aman.</p>
                    <a href="{{ route('contact') }}" class="service-cta">
                        <span>Explore Service</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="service-item" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-number">06</div>
                    <div class="service-icon">
                        <i class="bi bi-arrows-fullscreen"></i>
                    </div>
                    <h3>Pengembangan Lahan Desa</h3>
                    <p>CompPersiapan lahan secara menyeluruh, mulai dari pemetaan, pembersihan,
                        hingga pembangunan infrastruktur dasar desa.</p>
                    <a href="{{ route('contact') }}" class="service-cta">
                        <span>Explore Service</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </div>

        </div>

    </section><!-- /Services Section -->

    <!-- Services Alt Section -->
    <section id="services-alt" class="services-alt section light-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-5">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item">
                        <div class="service-visual">
                            <img src="{{ asset('assets-guest/img/tanah.jpg') }}" alt="General Contracting"
                                class="img-fluid">
                        </div>
                        <div class="service-content">
                            <h3>Manajemen Pengelolaan Tanah</h3>
                            <p>Pendampingan menyeluruh dalam pengelolaan persil dan tanah desa, mulai
                                dari pendataan, pemetaan, hingga administrasi resmi. Memastikan
                                semua proses berjalan lancar dan sesuai regulasi.</p>
                            <a href="{{ route('contact') }}" class="service-link">
                                <span>Learn More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item 1 -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                    <div class="service-item">
                        <div class="service-visual">
                            <img src="{{ asset('assets-guest/img/hunian.jpg') }}" alt="Residential Renovation"
                                class="img-fluid">

                        </div>
                        <div class="service-content">
                            <h3>Pengurusan Tanah Hunian</h3>
                            <p>Layanan pengurusan tanah untuk hunian warga desa, termasuk
                                pendaftaran kepemilikan, penyelesaian dokumen legal, dan
                                bantuan renovasi lahan agar siap digunakan.</p>
                            <a href="{{ route('contact') }}" class="service-link">
                                <span>Learn More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item 2 -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item">
                        <div class="service-visual">
                            <img src="{{ asset('assets-guest/img/pembangunan.jpg') }}" alt="Commercial Construction"
                                class="img-fluid">

                        </div>
                        <div class="service-content">
                            <h3>Pembangunan & Fasilitas Desa</h3>
                            <p>Pendampingan pembangunan fasilitas desa seperti balai,
                                pasar desa, dan area publik lain yang mendukung aktivitas
                                warga, dengan pengelolaan lahan yang tepat dan terencana.</p>
                            <a href="{{ route('contact') }}" class="service-link">
                                <span>Learn More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item 3 -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="350">
                    <div class="service-item">
                        <div class="service-visual">
                            <img src="{{ asset('assets-guest/img/konsultasi.jpg') }}" alt="Project Management"
                                class="img-fluid">

                        </div>
                        <div class="service-content">
                            <h3>Konsultasi & Pengawasan Tanah</h3>
                            <p>Bimbingan dan pengawasan profesional untuk seluruh proyek pertanahan desa,
                                memastikan proses legal, teknis, dan administratif sesuai ketentuan dan
                                aman bagi warga.</p>
                            <a href="{{ route('contact') }}" class="service-link">
                                <span>Learn More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item 4 -->

            </div>

            <div class="row mt-5" data-aos="fade-up" data-aos-delay="400">
                <div class="col-lg-12 text-center">
                    <div class="cta-section">
                        <h4>Siap mengurus tanah atau persil Anda?</h4>
                        <p>Hubungi tim kami untuk membahas kebutuhan pengelolaan tanah
                            atau persil desa Anda, dan dapatkan panduan serta layanan
                            yang disesuaikan dengan kondisi lahan dan regulasi yang
                            berlaku.</p>
                        <a href="{{ route('contact') }}" class="btn-primary">
                            <span>Hubungi Kami</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Services Alt Section -->
@endsection
