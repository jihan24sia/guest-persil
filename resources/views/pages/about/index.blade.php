@extends('layouts.guest.app')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Tentang</h1>
            <p>Kami berdedikasi untuk mendukung pengelolaan tanah dan pembangunan desa yang transparan dan terstruktur.
                Layanan kami mencakup pendataan persil, pengurusan dokumen legal, serta pendampingan warga dalam pemanfaatan
                lahan secara optimal.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li> <a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="current">Tentang</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row align-items-center">

                <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                    <div class="content">
                        <h2 class="section-heading mb-4">Akurat dalam Pendataan, Jelas dalam Layanan</h2>
                        <p class="lead-text mb-4">Website ini menyediakan informasi detail mengenai data tanah, batas
                            wilayah, dan status kepemilikan secara akurat untuk mendukung pengelolaan pertanahan yang lebih
                            transparan dan efisien. Dengan sistem yang terstruktur, pengguna dapat menelusuri setiap persil
                            tanah secara mudah, mulai dari nomor identifikasi, luas, lokasi, hingga riwayat kepemilikannya.
                            Seluruh data disajikan secara jelas untuk mempermudah proses verifikasi, perencanaan, maupun
                            administrasi pertanahan.</p>
                        <p class="description-text mb-5">Sistem Informasi Data Persil memudahkan pengelolaan dan verifikasi
                            data pertanahan secara akurat dan transparan. Pengguna dapat menelusuri setiap persil mulai dari
                            identifikasi, luas, lokasi, hingga status kepemilikan dan dokumen pendukung. Alurnya dimulai
                            dari pencarian persil, menampilkan detail informasi, melihat posisi di peta interaktif, serta
                            mengakses laporan dan statistik untuk mendukung perencanaan dan administrasi pertanahan secara
                            efisien.</p>

                        <div class="stats-grid">
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="stat-number">7+</div>
                                <div class="stat-label">Tahun Pengalaman</div>
                            </div>
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="350">
                                <div class="stat-number">250+</div>
                                <div class="stat-label">Lahan Terdata</div>
                            </div>
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="stat-number">86%</div>
                                <div class="stat-label">Kepuasan Warga</div>
                            </div>
                        </div>

                        <div class="cta-section" data-aos="fade-up" data-aos-delay="450">
                            <a href="{{ route('servis') }}" class="cta-link">
                                Explore Our Services
                                <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="200">
                    <div class="image-section">
                        <div class="main-image">
                            <img src="{{ asset('assets-guest/img/construction/project-4.jpg') }}"
                                alt="Construction project showcase" class="img-fluid">
                        </div>
                        <div class="floating-badge" data-aos="zoom-in" data-aos-delay="500">
                            <div class="badge-content">
                                <i class="bi bi-award"></i>
                                <div class="badge-text">
                                    <span class="badge-title">Quality Certified</span>
                                    <span class="badge-subtitle">Since 2018</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /About Section -->
@endsection
