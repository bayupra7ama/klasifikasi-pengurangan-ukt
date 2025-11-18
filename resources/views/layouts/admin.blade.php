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
        <nav class="navbar navbar-light bg-white shadow-sm px-4 py-3 mb-4">
            <div class="d-flex align-items-center gap-3">

                <img src="{{ asset('assets/images/logos/Logo-Polbeng.png') }}" alt="Logo"
                    style="height: 40px; width: auto;">

                <h4 class="fw-bold mb-0">POLITEKNIK NEGERI BENGKALIS</h4>

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
