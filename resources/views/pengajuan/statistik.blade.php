@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
@endpush

@section('content')

    {{-- =======================
        ROW 1 — LAYAK vs TIDAK & PENGAJUAN BULANAN
    ======================= --}}
    <div class="row">

        {{-- Pie Chart Layak vs Tidak Layak --}}
        <div class="col-lg-4">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Status Kelayakan</h5>
                    <div id="chart_layak"></div>
                </div>
            </div>
        </div>

        {{-- Line Chart Pengajuan Bulanan --}}
        <div class="col-lg-8">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Tren Pengajuan Bulanan</h5>
                    <div id="chart_bulanan"></div>
                </div>
            </div>
        </div>

    </div>



    {{-- =======================
        ROW 2 — PENGHASILAN & PEKERJAAN
    ======================= --}}
    <div class="row">

        {{-- Bar Chart Penghasilan --}}
        <div class="col-lg-6">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Kategori Penghasilan Orang Tua</h5>
                    <div id="chart_penghasilan"></div>
                </div>
            </div>
        </div>

        {{-- Horizontal Bar Chart Pekerjaan --}}
        <div class="col-lg-6">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Pekerjaan Orang Tua</h5>
                    <div id="chart_pekerjaan"></div>
                </div>
            </div>
        </div>

    </div>



    {{-- =======================
        ROW 3 — TEMPAT TINGGAL & STATUS ANAK
    ======================= --}}
    <div class="row">

        {{-- Pie Chart Kondisi Rumah --}}
        <div class="col-lg-6">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Kondisi Tempat Tinggal</h5>
                    <div id="chart_rumah"></div>
                </div>
            </div>
        </div>

        {{-- Pie Chart Status Anak --}}
        <div class="col-lg-6">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Status Perkawinan</h5>
                    <div id="chart_anak"></div>
                </div>
            </div>
        </div>

    </div>




    {{-- =======================
        ROW 4 — PRODI & DTKS/SKTM
    ======================= --}}
    <div class="row">

        {{-- Bar Chart PRODI --}}
        <div class="col-lg-6">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Pengajuan Berdasarkan Prodi</h5>
                    <div id="chart_prodi"></div>
                </div>
            </div>
        </div>

        {{-- Bar Chart DTKS & SKTM --}}
        <div class="col-lg-6">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">DTKS & SKTM</h5>
                    <div id="chart_dtks_sktm"></div>
                </div>
            </div>
        </div>

    </div>

@endsection



{{-- =======================
    JS UNTUK SEMUA GRAFIK
======================= --}}
@push('scripts')
    <script>
        // DATA DARI CONTROLLER (Laravel → JS)
        const dataLayak = @json($layak);
        const dataTidakLayak = @json($tidakLayak);

        const bulan = @json($bulan);
        const totalBulanan = @json($totalBulanan);

        const penghasilanKategori = @json($kategoriPenghasilan);

        const pekerjaanLabel = @json($pekerjaanLabel);
        const pekerjaanTotal = @json($pekerjaanTotal);

        const kondisiRumah = @json($kondisiRumah);
        const statusAnak = @json($statusAnak);

        const prodiLabel = @json($prodiLabel);
        const prodiTotal = @json($prodiTotal);

        const dtks = @json($dtks);
        const non_dtks = @json($non_dtks);
        const sktm = @json($sktm);
        const non_sktm = @json($non_sktm);
    </script>

    <script src="{{ asset('assets/js/dashboard_charts.js') }}"></script>
@endpush
