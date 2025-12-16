@extends('layouts.guest.app')

@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Developer</h1>
            <p>Halaman ini menampilkan informasi tentang pengembang sistem, termasuk identitas, kontak, dan akun sosial media.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="current">Developer</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section id="developer-profile" class="developer-profile">
        <div class="container">

            <!-- CARD -->
            <div class="profile-wrapper" data-aos="fade-up" data-aos-delay="200">

                <!-- KIRI : INFO -->
                <div class="profile-info">
                    <h2>Jihan Zahra</h2>
                    <h4>Mahasiswa</h4>

                    <ul class="profile-contact">
                        <li><i class="bi bi-envelope-fill"></i> jihan24si@mahasiswa.pcr.ac.id</li>
                        <li><i class="bi bi-mortarboard-fill"></i> Sistem Informasi</li>
                        <li><i class="bi bi-building"></i> Politeknik Caltex Riau</li>
                        <li><i class="bi bi-person-badge-fill"></i> 2457301071</li>
                    </ul>

                    <div class="profile-social">
                        <a href="https://www.linkedin.com/in/jihan-zahra-b22436322?" target="_blank">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="https://github.com/jihan24sia/guest-persil.git" target="_blank">
                            <i class="bi bi-github"></i>
                        </a>
                        <a href="https://instagram.com/jihaaanzr" target="_blank">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=jihan24si@mahasiswa.pcr.ac.id" target="_blank">
                            <i class="bi bi-envelope-fill"></i>
                        </a>
                    </div>
                </div>

                <!-- KANAN : FOTO -->
                <div class="profile-photo"
                    style="background-image: url('{{ asset('assets-guest/img/person/developer.jpeg') }}');">
                </div>

            </div>
            <!-- END CARD -->

        </div>
    </section>
@endsection
