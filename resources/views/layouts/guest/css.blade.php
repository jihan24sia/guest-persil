 <!-- Vendor CSS Files -->
 <link href="{{ asset('assets-guest/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
 <link href="{{ asset('assets-guest/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
 <link href="{{ asset('assets-guest/vendor/aos/aos.css') }}" rel="stylesheet">
 <link href="{{ asset('assets-guest/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
 <link href="{{ asset('assets-guest/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

 <link href="{{ asset('assets-guest/css/main.css') }}" rel="stylesheet">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
 <style>
     /* UMUM */
     .btn-info,
     .btn-edit,
     .btn-hapus {
         background-color: #fff !important;
         color: #000 !important;
         border: 1px solid #000 !important;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
         transition: all 0.2s ease-in-out;
     }

     /* Hover */
     .btn-info:hover,
     .btn-edit:hover,
     .btn-hapus:hover {
         background-color: #000 !important;
         color: #fff !important;
         box-shadow: 0 6px 14px rgba(0, 0, 0, 0.3);
     }

     /* Icon ikut warna teks */
     .btn-info i,
     .btn-edit i,
     .btn-hapus i {
         color: inherit;
     }

     /* Fokus / aktif */
     .btn-info:focus,
     .btn-edit:focus,
     .btn-hapus:focus {
         outline: none;
         box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.25);
     }

     .warga-card {
         background: #ff8c00;
         /* warna oranye */
         border-radius: 14px;
         padding: 25px;
         box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
         color: #fff;
         transition: 0.2s ease;
         height: 100%;
     }

     .warga-card:hover {
         transform: translateY(-6px);
         box-shadow: 0 10px 25px rgba(0, 0, 0, 0.22);
     }

     .warga-photo {
         width: 120px;
         height: 120px;
         border-radius: 50%;
         object-fit: cover;
         border: 3px solid #fff;
         margin-bottom: 15px;
     }

     .warga-info p {
         margin: 4px 0;
         font-size: 14px;
     }

     .card-name {
         font-size: 20px;
         font-weight: 700;
         margin-bottom: 3px;
     }

     .card-job {
         font-size: 14px;
         opacity: 0.9;
     }

     .btn-edit {
         background: #fff;
         color: #000;
         border: none;
     }

     .btn-edit:hover {
         background: #eaeaea;
     }

     .btn-hapus {
         background: #dc3545;
         color: #fff;
         border: none;
     }

     .btn-hapus:hover {
         background: #bb2d3b;
     }

     .btn-orange {
         background-color: #ff7f00 !important;
         /* oren */
         border-color: #ff7f00 !important;
         color: #fff !important;
     }

     .btn-orange:hover {
         background-color: #e66f00 !important;
         border-color: #e66f00 !important;
     }

     .swiper {
         width: 100%;
         height: 180px;
     }

     .swiper-slide img.thumb-img {
         width: 100%;
         height: 180px;
         object-fit: cover;
         border-radius: 12px;
     }

     .swiper-button-next,
     .swiper-button-prev {
         color: #ff8c00;
     }

     .swiper-pagination-bullet {
         background: #ff8c00;
     }

     /* === Developer Profile === */
     /* WRAPPER CARD */
     .profile-wrapper {
         display: flex;
         background: #fff;
         border-radius: 18px;
         overflow: hidden;
         transition: all 0.35s ease;
         box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
         cursor: pointer;
     }

     /* HOVER EFFECT (NGAMBANG) */
     .profile-wrapper:hover {
         transform: translateY(-8px);
         box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
     }

     /* EFEK TEKAN */
     .profile-wrapper:active {
         transform: translateY(-3px) scale(0.99);
     }

     /* FOTO */
     .profile-photo {
         width: 45%;
         background-size: cover;
         background-position: center;
         transition: transform 0.4s ease;
     }

     /* FOTO ZOOM SAAT HOVER */
     .profile-wrapper:hover .profile-photo {
         transform: scale(1.08);
     }

     /* INFO */
     .profile-info {
         width: 55%;
         background: #ff7a18;
         color: #fff;
         padding: 40px;
         clip-path: polygon(0 0, 92% 0, 100% 50%, 92% 100%, 0 100%);
         transition: all 0.3s ease;
     }

     /* ICON SOSIAL */
     .profile-social a {
         display: inline-flex;
         align-items: center;
         justify-content: center;
         width: 42px;
         height: 42px;
         margin-right: 8px;
         border-radius: 50%;
         background: rgba(255, 255, 255, 0.2);
         color: #fff;
         transition: all 0.3s ease;
     }

     .profile-social a:hover {
         background: #fff;
         color: #ff7a18;
         transform: translateY(-4px);
     }
 </style>
 <style>
     .footer-bottom {
         background-color: #000;
         /* warna oranye */
         padding: 15px 0;
     }

     .footer-bottom p {
         color: #ff7a18;
         /* teks putih */
         margin: 0;
     }
 </style>



 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
