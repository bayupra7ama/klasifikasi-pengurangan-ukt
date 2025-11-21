<aside class="left-sidebar">
    <div>
        {{-- LOGO --}}
        <div class="brand-logo d-flex align-items-center justify-content-between">

            {{-- LOGO LINK BERBEDA SESUAI ROLE --}}
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img">
                @else
                    <a href="{{ route('user.dashboard') }}" class="text-nowrap logo-img">
            @endif
            <img src="{{ asset('assets/images/logos/Logo-Polbeng.png') }}" width="50" alt="logo" />
            </a>

            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">

                {{-- ======================================================
                      SIDEBAR UNTUK ADMIN
                ====================================================== --}}
                @if (Auth::user()->role === 'admin')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <span><i class="ti ti-layout-dashboard"></i></span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Data</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin/pengajuan/list') ? 'active' : '' }}"
                            href="{{ route('admin.pengajuan.list') }}">
                            <span><i class="ti ti-article"></i></span>
                            <span class="hide-menu">Data Pengajuan</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin/pengajuan/statistik') ? 'active' : '' }}"
                            href="{{ route('admin.pengajuan.statistik') }}">
                            <span><i class="ti ti-chart-bar"></i></span>
                            <span class="hide-menu">Statistik Pengajuan</span>
                        </a>
                    </li>
                @endif


                {{-- ======================================================
                      SIDEBAR UNTUK USER / MAHASISWA
                ====================================================== --}}
                @if (Auth::user()->role === 'user')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Mahasiswa</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
                            href="{{ route('user.dashboard') }}">
                            <span><i class="ti ti-home"></i></span>
                            <span class="hide-menu">Dashboard Saya</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('pengajuan.create') ? 'active' : '' }}"
                            href="{{ route('pengajuan.create') }}">
                            <span><i class="ti ti-plus"></i></span>
                            <span class="hide-menu">Buat Pengajuan</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('user.pengajuan.riwayat') ? 'active' : '' }}"
                            href="{{ route('user.pengajuan.riwayat') }}">
                            <span><i class="ti ti-list"></i></span>
                            <span class="hide-menu">Riwayat Pengajuan</span>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>

    </div>
</aside>
