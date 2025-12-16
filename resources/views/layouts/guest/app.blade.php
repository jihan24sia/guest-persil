<!DOCTYPE html>
<html lang="en">
<head>

    {{-- header --}}
    @include('layouts.guest.header')

    {{-- css --}}
    @include('layouts.guest.css')

</head>

<body class="index-page">

    {{-- navbar --}}
    @include('layouts.guest.navbar')

    <main class="main">
        @yield('content')
    </main>

    {{-- footer --}}
    @include('layouts.guest.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader"></div>

    {{-- js --}}
    @include('layouts.guest.js')
    @stack('scripts')

</body>
</html>
