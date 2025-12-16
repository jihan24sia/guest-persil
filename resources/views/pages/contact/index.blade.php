@extends('layouts.guest.app')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Kontak</h1>
            <p>Hubungi tim Bina Desa untuk bantuan pengelolaan persil, konsultasi tanah, atau informasi proyek desa.
                Kami siap mendampingi warga dan instansi terkait administrasi pertanahan secara profesional dan transparan.
            </p>
            <nav class="breadcrumbs">
                <ol>
                    <li> <a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="current">Kontak</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="contact-main-wrapper">
                <div class="map-wrapper">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3610.3984932995663!2d101.42352197447418!3d0.5709805635852542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ab67086f2e89%3A0x65a24264fec306bb!2sPoliteknik%20Caltex%20Riau!5e1!3m2!1sen!2sid!4v1765789138746!5m2!1sen!2sid"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="contact-content">
                    <div class="contact-cards-container" data-aos="fade-up" data-aos-delay="300">
                        <div class="contact-card">
                            <div class="icon-box">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Lokasi</h4>
                                <p>Jl. Umban Sari No.1, Umban Sari, Kec. Rumbai, Kota Pekanbaru, Riau 28265</p>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="icon-box">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Email</h4>
                                <p>layanan.persil@binadesa.id</p>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="icon-box">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Telepon</h4>
                                <p>(021) 7788-9900</p>
                            </div>
                        </div>

                        <div class="contact-card">
                            <div class="icon-box">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Jam Operasional</h4>
                                <p>Senin - Jum'at : 7AM - 4PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-form-container" data-aos="fade-up" data-aos-delay="400">
                        <h3>Get in Touch</h3>
                        <p>Silakan isi form berikut, pesan akan langsung terkirim ke WhatsApp kami.</p>

                        <form id="whatsappForm" class="php-email-form">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Nama" required="">
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Email" required="">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Subjek" required="">
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" id="message" rows="5" placeholder="Pesan" required=""></textarea>
                            </div>

                            <div class="form-submit mt-3">
                                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                                <div class="social-links mt-3">
                                    <a href="https://facebook.com/binadesa.persil" aria-label="Facebook"><i
                                            class="bi bi-facebook"></i></a>
                                    <a href="https://instagram.com/persildesa" aria-label="Instagram"><i
                                            class="bi bi-instagram"></i></a>
                                    <a href="https://linkedin.com/company/bina-desa-persil"><i
                                            class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Contact Section -->
@endsection
@push('scripts')
    <script>
        document.getElementById('whatsappForm').addEventListener('submit', function(e) {
            e.preventDefault(); // mencegah form submit default

            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var subject = document.getElementById('subject').value;
            var message = document.getElementById('message').value;

            // Nomor WhatsApp tujuan (format internasional tanpa tanda + atau 0 di depan)
            var phoneNumber = '6285159941023'; // ganti dengan nomor WhatsApp kamu

            // Membuat pesan otomatis
            var text = `Nama: ${name}%0AEmail: ${email}%0ASubjek: ${subject}%0APesan: ${message}`;

            // Membuka WhatsApp Web / Mobile
            window.open(`https://wa.me/${phoneNumber}?text=${text}`, '_blank');
        });
    </script>
@endpush
