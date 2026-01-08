<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('assets-guest/img/logo.png') }}" alt="Logo Sistem Persil" class="logo-img">
            <h1 class="sitename ms-2">Sistem Persil</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>

                {{-- ================= MENU UMUM (GUEST & LOGIN) ================= --}}
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Home
                    </a>
                </li>

                <li>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
                        Tentang
                    </a>
                </li>

                <li>
                    <a href="{{ route('servis') }}" class="{{ request()->routeIs('servis') ? 'active' : '' }}">
                        Servis
                    </a>
                </li>

                <li>
                    <a href="{{ route('dokumentasi') }}"
                        class="{{ request()->routeIs('dokumentasi') ? 'active' : '' }}">
                        Dokumentasi
                    </a>
                </li>


                <li>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                        Kontak
                    </a>
                </li>

                <li>
                    <a href="{{ route('developer') }}" class="{{ request()->routeIs('developer') ? 'active' : '' }}">
                        Developer
                    </a>
                </li>

                {{-- ================= MENU KHUSUS LOGIN ================= --}}
                @auth
                    <li>
                        <a href="{{ route('user.index') }}" class="{{ request()->routeIs('user.*') ? 'active' : '' }}">
                            User
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('warga.index') }}" class="{{ request()->routeIs('warga.*') ? 'active' : '' }}">
                            Warga
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('persil.index') }}"
                            class="{{ request()->routeIs('persil.*') ? 'active' : '' }}">
                            Persil
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#">
                            <span>More Persil</span>
                            <i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('dokumen.index') }}"
                                    class="{{ request()->routeIs('dokumen.*') ? 'active' : '' }}">
                                    Dokumen
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('peta.index') }}"
                                    class="{{ request()->routeIs('peta.*') ? 'active' : '' }}">
                                    Peta
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sengketa.index') }}"
                                    class="{{ request()->routeIs('sengketa.*') ? 'active' : '' }}">
                                    Sengketa
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('jenis.index') }}"
                                    class="{{ request()->routeIs('jenis.*') ? 'active' : '' }}">
                                    Jenis Penggunaan
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth

            </ul>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        {{-- ================= BUTTON LOGIN ================= --}}
        @guest
            <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
        @endguest

        {{-- ================= USER DROPDOWN ================= --}}
        @auth
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center gap-2 dropdown-toggle ms-3" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i>
                    <span>{{ auth()->user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-item text-muted d-flex align-items-center gap-2">
                        <i class="bi bi-clock"></i>
                        <span>Login Time: {{ session('login_time') }}</span>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger d-flex align-items-center gap-2">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>

            </div>
        @endauth

    </div>
</header>
