<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Dashboard')</title>

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
    @stack('styles')
</head>

<body>

    {{-- ================================
         MODE NORMAL (sidebar + header)
    ================================= --}}
    @if (!($fullpage ?? false))
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">

            {{-- Sidebar --}}
            @include('layouts.partials.sidebar')

            <div class="body-wrapper">

                {{-- Header --}}
                @include('layouts.partials.header')

                {{-- Page Content --}}
                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>
        </div>

        {{-- ================================
            MODE FULL PAGE (tanpa sidebar)
    ================================= --}}
    @else
        <div class="container-fluid">
            @yield('content')
        </div>
    @endif

    {{-- Scripts --}}
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>

    @stack('scripts')
</body>

</html>
