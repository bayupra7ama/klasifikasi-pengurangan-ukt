<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/Logo-Polbeng.png') }}" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />

    @stack('styles')
</head>

<body>

    {{-- ====================================================
         MODE NORMAL (Dengan Sidebar + Header)
    ==================================================== --}}
    @if (!($fullpage ?? false))
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">

            {{-- SIDEBAR --}}
            @include('partials.sidebar')

            {{-- BODY WRAPPER --}}
            <div class="body-wrapper">

                {{-- HEADER --}}
                @include('partials.header')

                {{-- PAGE CONTENT --}}
                <div class="container-fluid">
                    @yield('content')
                </div>

                {{-- FOOTER --}}
                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">
                        Design and Developed by
                        <a href="#" target="_blank" class="pe-1 text-primary text-decoration-underline">
                            Maysaroh
                        </a>
                    </p>
                </div>
            </div>

        </div>
    @else
        {{-- NAVBAR PUBLIC --}}
        {{-- NAVBAR PUBLIC --}}
        {{-- NAVBAR PUBLIC (UNTUK HALAMAN TANPA LOGIN / FULLPAGE) --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 py-3 mb-4">
            <div class="container-fluid">

                {{-- LOGO --}}
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/images/logos/Logo-Polbeng.png') }}" alt="Logo"
                        style="height: 40px; width: auto;">
                    <h4 class="fw-bold mb-0">POLITEKNIK NEGERI BENGKALIS</h4>
                </div>

                {{-- TOGGLER RESPONSIVE --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar"
                    aria-controls="publicNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- MENU RIGHT --}}
                <div class="collapse navbar-collapse justify-content-end" id="publicNavbar">

                    @auth
                        {{-- =======================================================
                     USER SUDAH LOGIN → TAMPILKAN DROPDOWN USER
                ======================================================= --}}
                        <div class="dropdown">
                            <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#"
                                role="button" id="publicUserMenu" data-bs-toggle="dropdown" aria-expanded="false">

                                <img src="{{ asset('assets/images/profile/user-1.jpg') }}" width="40" height="40"
                                    class="rounded-circle me-2">

                                <span class="fw-semibold">{{ Auth::user()->name }}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="publicUserMenu">

                                {{-- ===============================================
                             DASHBOARD SESUAI ROLE USER
                        =============================================== --}}
                                @if (Auth::user()->role === 'admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            Dashboard Admin
                                        </a>
                                    </li>
                                @elseif (Auth::user()->role === 'user')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                            Dashboard Saya
                                        </a>
                                    </li>
                                @endif

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                {{-- ===============================================
                                LOGOUT
                        =============================================== --}}
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item text-danger fw-semibold" type="submit">
                                            Logout
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </div>
                    @else
                        {{-- =======================================================
                        USER BELUM LOGIN → TAMPILKAN MASUK & DAFTAR
                ======================================================= --}}
                        <a href="{{ route('login') }}" class="btn btn-primary me-2">
                            Masuk
                        </a>

                        <a href="{{ route('register') }}" class="btn btn-outline-primary">
                            Daftar
                        </a>
                    @endauth

                </div>
            </div>
        </nav>



        <div class="container-fluid pb-4">
            @yield('content')
        </div>
    @endif

    {{-- ====================================================
                        SCRIPTS
    ==================================================== --}}
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>

    {{-- dashboard.js hanya untuk halaman admin, tidak akan mengganggu fullpage --}}
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    @stack('scripts')

</body>

</html>
