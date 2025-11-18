@extends('layouts.admin')

@section('title', 'Daftar Pengajuan')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Daftar Pengajuan</h5>

                    <!-- optional search -->
                    <form class="mb-3" method="GET" action="{{ route('admin.pengajuan.list') }}">
                        <div class="input-group">
                            <input name="q" value="{{ request('q') }}" class="form-control"
                                placeholder="Cari nama / nim / prodi">
                            <button class="btn btn-outline-secondary">Cari</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Jurusan</th>
                                    <th>Penghasilan</th>
                                    <th>Hasil</th>
                                    <th>Tanggal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengajuans as $index => $p)
                                    <tr>
                                        <td>{{ $pengajuans->firstItem() + $index }}</td>
                                        <td>{{ $p->nim }}</td>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->prodi }}</td>
                                        <td>{{ $p->jurusan }}</td>
                                        <td>Rp {{ number_format($p->penghasilan, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($p->hasil_prediksi === 'layak')
                                                <span class="badge bg-success">LAYAK</span>
                                            @else
                                                <span class="badge bg-danger">TIDAK LAYAK</span>
                                            @endif
                                        </td>
                                        <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-primary">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Belum ada data pengajuan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>


                    </div>
                    <div class="pagination-wrapper mt-3">
                        {{ $pengajuans->links() }}
                    </div>






                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <style>
            /* container pagination */
            nav[role="navigation"]>div:first-child,
            nav[role="navigation"]>div:nth-child(2) {
                font-size: 10px !important;
            }

            /* tombol prev/next */
            nav[role="navigation"] button,
            nav[role="navigation"] a,
            nav[role="navigation"] span {
                font-size: 10px !important;
                padding: 3px 6px !important;
                min-width: 24px !important;
                height: 24px !important;
                line-height: 1 !important;

                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;

                border-radius: 4px !important;
            }

            /* hilangkan gap besar default tailwind */
            nav[role="navigation"] .flex {
                gap: 2px !important;
            }
        </style>
    @endpush

@endsection
