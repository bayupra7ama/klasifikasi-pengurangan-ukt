<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/Logo-Polbeng.png') }}" width="50" alt="logo" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
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

            </ul>


        </nav>
    </div>
</aside>
