@extends('layouts.admin')

@section('last', 'Dashboard')

@push('styles')
    <style>
        /* pastikan chart container punya width 100% */
        #chart_bulanan,
        #chart_layak {
            width: 100%;
        }

        /* beri sedikit spacing agar pengukuran lebih akurat */
        #left-stacked .card {
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="row mb-4">
        <div id="left-stacked" class="col-lg-4">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Total Pengajuan</h5>
                    <h2 class="fw-bold">{{ $totalPengajuan }}</h2>
                    <a href="{{ route('admin.pengajuan.riwayat') }}" class="mt-3 d-inline-block">Selengkapnya →</a>
                </div>
            </div>

        </div>

        {{-- Line Chart Kecil --}}
        <div class="col-lg-8">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Tren Pengajuan Bulanan</h5>
                    <div id="chart_bulanan"></div>

                    <a href="{{ route('admin.pengajuan.statistik') }}" class="mt-3 d-inline-block items-center">
                        Selengkapnya →
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // data dari controller
        const dataLayak = @json($layak);
        const dataTidakLayak = @json($tidakLayak);

        const bulan = @json($bulan);
        const totalBulanan = @json($totalBulanan);
    </script>

    <script src="{{ asset('assets/js/dashboard_charts.js') }}"></script>
@endpush
