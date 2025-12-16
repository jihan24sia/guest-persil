@extends('layouts.guest.app')
@section('content')
    <section id="hero" class="hero section dark-background">

        <div class="hero-video-container">
            <video autoplay="" muted="" loop="">
                <source src="{{ asset('assets-guest/img/construction/video-1.mp4') }}" type="video/mp4">

            </video>
            <div class="hero-overlay"></div>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <h1 data-aos="fade-up" data-aos-delay="200">Sistem Pertanahan Persil Warga Bina Desa</h1>
                        <p data-aos="fade-up" data-aos-delay="300">Kami menyediakan layanan pengelolaan data pertanahan dan
                            persil warga dengan akurasi tinggi, transparansi, dan kepatuhan hukum. Percayakan pada tim kami
                            yang berpengalaman untuk memastikan administrasi persil dan hak kepemilikan tanah berjalan
                            lancar
                            dan profesional.</p>

                        <div class="hero-actions" data-aos="fade-up" data-aos-delay="400">
                            <a href="{{ route('contact') }}" class="btn btn-primary">Kontak</a>
                            <a href="{{ route('dokumentasi') }}" class="btn btn-secondary">Lihat Dokumentasi</a>
                        </div>

                        <div class="hero-stats" data-aos="fade-up" data-aos-delay="500">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="stat-item">
                                        <span class="stat-number" data-purecounter-start="0" data-purecounter-end="250"
                                            data-purecounter-duration="2">250</span>
                                        <span class="stat-label">Lahan Terdata</span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="stat-item">
                                        <span class="stat-number" data-purecounter-start="0" data-purecounter-end="15"
                                            data-purecounter-duration="2">7</span>
                                        <span class="stat-label">Tahun Pengalaman</span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="stat-item">
                                        <span class="stat-number" data-purecounter-start="0" data-purecounter-end="98"
                                            data-purecounter-duration="2">86</span>
                                        <span class="stat-label">% Kepuasan Warga</span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="stat-item">
                                        <span class="stat-number" data-purecounter-start="0" data-purecounter-end="50"
                                            data-purecounter-duration="2">50</span>
                                        <span class="stat-label">Desa Terlayani</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row align-items-center">

                <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                    <div class="content">
                        <h2 class="section-heading mb-4">Akurat dalam Pendataan, Jelas dalam Layanan</h2>
                        <p class="lead-text mb-4">Website persil ini menyediakan informasi detail mengenai data tanah,
                            batas
                            wilayah, dan status kepemilikan secara akurat untuk mendukung pengelolaan pertanahan yang
                            lebih
                            transparan dan efisien.Dengan sistem yang terstruktur, pengguna dapat menelusuri setiap
                            persil tanah
                            secara mudah, mulai dari nomor identifikasi, luas, lokasi, hingga riwayat kepemilikannya.
                            Seluruh
                            data disajikan secara jelas untuk mempermudah proses verifikasi, perencanaan, maupun
                            administrasi
                            pertanahan.</p>
                        <p class="description-text mb-5">Kami berkomitmen menghadirkan layanan informasi yang dapat
                            diandalkan dan
                            mudah diakses, sehingga setiap publik, instansi, maupun pemangku kepentingan dapat
                            memperoleh gambaran
                            menyeluruh terkait aset tanah yang terdaftar.</p>

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

    <!-- Services Section -->
    <section id="services" class="services section light-background">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Servis</h2>
            <p>Kami menyediakan layanan pertanahan yang berfokus pada pengelolaan dan pengurusan persil.</p>
        </div><!-- End Section Title -->

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

    <section id="projects" class="projects section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Dokumentasi</h2>
            <p>Pendataan dan arsip lengkap setiap persil dan lahan desa, termasuk foto
                lokasi, surat kepemilikan, dan catatan administrasi untuk memudahkan
                pengelolaan dan pengawasan.</p>
        </div><!-- End Section Title -->

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

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Testimoni Warga</h2>
            <p>Menampilkan cerita, pengalaman, atau masukan dari warga desa yang telah menggunakan layanan pengelolaan
                tanah, pendataan persil, atau fasilitas desa.</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="testimonial-masonry">

                <div class="testimonial-item" data-aos="fade-up">
                    <div class="testimonial-content">
                        <div class="quote-pattern">
                            <i class="bi bi-quote"></i>
                        </div>
                        <p>Pendampingan pengurusan persil dari tim Bina Desa sangat membantu. Semua dokumen kini tertata
                            rapi dan prosesnya jelas.
                        </p>
                        <div class="client-info">
                            <div class="client-image">
                                <img src="{{ asset('assets-guest/img/person/wook.jpg') }}" alt="Client">

                            </div>
                            <div class="client-details">
                                <h3>Bapak Putra</h3>
                                <span class="position">Kepala Dusun</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-content">
                        <div class="quote-pattern">
                            <i class="bi bi-quote"></i>
                        </div>
                        <p>Pelatihan pengelolaan lahan membuat kami lebih paham cara memanfaatkan tanah secara produktif dan
                            sesuai aturan.</p>
                        <div class="client-info">
                            <div class="client-image">
                                <img src="{{ asset('assets-guest/img/person/Jihan.jpg') }}" alt="Client">

                            </div>
                            <div class="client-details">
                                <h3>Ibu Jihan</h3>
                                <span class="position">Warga Desa Sukamaju</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-content">
                        <div class="quote-pattern">
                            <i class="bi bi-quote"></i>
                        </div>
                        <p>Tim Bina Desa cepat tanggap dan profesional dalam membantu sertifikasi tanah. Kini tanah saya
                            aman secara hukum.</p>
                        <div class="client-info">
                            <div class="client-image">
                                <img src="{{ asset('assets-guest/img/person/angga.jpg') }}" alt="Client">

                            </div>
                            <div class="client-details">
                                <h3>Bapak Angga</h3>
                                <span class="position">Warga Desa Mandiri</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-content">
                        <div class="quote-pattern">
                            <i class="bi bi-quote"></i>
                        </div>
                        <p>Pendataan lahan kosong di desa sangat rapi dan membantu perencanaan pembangunan fasilitas publik.
                        </p>
                        <div class="client-info">
                            <div class="client-image">
                                <img src="{{ asset('assets-guest/img/person/zara.jpg') }}" alt="Client">

                            </div>
                            <div class="client-details">
                                <h3>Ibu Zafa</h3>
                                <span class="position">Ketua RT Makmur</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="400">
                    <div class="testimonial-content">
                        <div class="quote-pattern">
                            <i class="bi bi-quote"></i>
                        </div>
                        <p>Proses pemetaan persil untuk rumah warga sangat detail dan jelas, memudahkan kami mengurus
                            dokumen kepemilikan.</p>
                        <div class="client-info">
                            <div class="client-image">
                                <img src="{{ asset('assets-guest/img/person/mark.jpg') }}" alt="Client">

                            </div>
                            <div class="client-details">
                                <h3>Bapak Diyo</h3>
                                <span class="position">Warga Desa Sejahtera</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-item" data-aos="fade-up" data-aos-delay="500">
                    <div class="testimonial-content">
                        <div class="quote-pattern">
                            <i class="bi bi-quote"></i>
                        </div>
                        <p>Pendampingan pembangunan fasilitas desa, seperti balai dan gudang, sangat profesional. Warga kini
                            bisa menggunakan fasilitas dengan aman dan nyaman.</p>
                        <div class="client-info">
                            <div class="client-image">
                                <img src="{{ asset('assets-guest/img/person/san.jpg') }}" alt="Client">

                            </div>
                            <div class="client-details">
                                <h3>Ibu Vanya</h3>
                                <span class="position">Sekretaris Desa Mandiri</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Testimonials Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section light-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row justify-content-center">

                <div class="col-lg-10">
                    <div class="cta-header text-center" data-aos="fade-up" data-aos-delay="200">
                        <h2>Wujudkan Pengelolaan Tanah Desa yang Optimal</h2>
                        <p>Kami mendampingi warga desa dalam pendataan persil, pengurusan dokumen legal, dan perencanaan
                            pemanfaatan lahan. Tim kami berkomitmen memberikan layanan yang profesional, transparan, dan
                            berkualitas tinggi untuk setiap proyek desa.</p>
                    </div>
                </div>

            </div>

            <div class="cta-main" data-aos="fade-up" data-aos-delay="300">
                <div class="row align-items-center g-5">

                    <div class="col-lg-6">
                        <div class="achievements-grid">
                            <div class="achievement-item" data-aos="zoom-in" data-aos-delay="400">
                                <div class="achievement-icon">
                                    <i class="bi bi-tools"></i>
                                </div>
                                <div class="achievement-info">
                                    <h3>2000+</h3>
                                    <span>Proyek Lahan Terdata</span>
                                </div>
                            </div>

                            <div class="achievement-item" data-aos="zoom-in" data-aos-delay="450">
                                <div class="achievement-icon">
                                    <i class="bi bi-clock-history"></i>
                                </div>
                                <div class="achievement-info">
                                    <h3>7+</h3>
                                    <span>Tahun Berdiri</span>
                                </div>
                            </div>

                            <div class="achievement-item" data-aos="zoom-in" data-aos-delay="500">
                                <div class="achievement-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <div class="achievement-info">
                                    <h3>100%</h3>
                                    <span>Keamanan Dokumen</span>
                                </div>
                            </div>

                            <div class="achievement-item" data-aos="zoom-in" data-aos-delay="550">
                                <div class="achievement-icon">
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <div class="achievement-info">
                                    <h3>86%</h3>
                                    <span>Kepuasan Warga</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="action-panel" data-aos="fade-left" data-aos-delay="350">

                            <div class="panel-content">
                                <h3>Siap Mengurus Tanah atau Persil Anda?</h3>
                                <p>Kami siap mendampingi Anda dalam pendataan persil, pengurusan dokumen legal, dan
                                    perencanaan pemanfaatan lahan desa. Hubungi tim kami sekarang untuk konsultasi dan
                                    layanan yang sesuai kebutuhan Anda.</p>

                                <div class="action-buttons">
                                    <a href="{{ route('contact') }}" class="btn-primary">
                                        <span>Get In Touch</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                    <a href="{{ route('dokumentasi') }}" class="btn-secondary">
                                        <span>Lihat Dokumentasi</span>
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="contact-quick">
                                <div class="contact-row">
                                    <i class="bi bi-telephone-fill"></i>
                                    <div class="contact-details">
                                        <span class="contact-label">Direct Line</span>
                                        <span class="contact-value">(021) 7788-9900 </span>
                                    </div>
                                </div>

                                <div class="contact-row">
                                    <i class="bi bi-envelope-fill"></i>
                                    <div class="contact-details">
                                        <span class="contact-label">Email Kami</span>
                                        <span class="contact-value">layanan.persil@binadesa.id</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </section><!-- /Call To Action Section -->
@endsection
