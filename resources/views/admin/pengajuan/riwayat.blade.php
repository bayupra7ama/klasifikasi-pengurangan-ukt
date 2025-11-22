@extends('layouts.admin')

@section('title', 'Riwayat Pengajuan')

@section('content')

    <div class="container-fluid">

        <div class="card shadow-sm">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0">Riwayat Semua Pengajuan Mahasiswa</h4>

                {{-- Filter Status --}}
                <form method="GET" class="d-flex gap-2">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="Terkirim" {{ request('status') == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                        <option value="Ditinjau" {{ request('status') == 'Ditinjau' ? 'selected' : '' }}>Ditinjau</option>
                        <option value="Tahap Wawancara" {{ request('status') == 'Tahap Wawancara' ? 'selected' : '' }}>Tahap
                            Wawancara</option>
                        <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui
                        </option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>

                    <input type="text" name="q" class="form-control" placeholder="Cari nama/NIM..."
                        value="{{ request('q') }}">

                    <button class="btn btn-primary">Filter</button>
                </form>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Prodi</th>
                                <th>Status</th>
                                <th>Tgl Pengajuan</th>
                                <th>Pesan Admin</th>
                                <th>Aksi</th>


                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pengajuan as $i => $p)
                                <tr>
                                    <td>{{ $pengajuan->firstItem() + $i }}</td>
                                    <td>{{ $p->user->name }}</td>
                                    <td>{{ $p->nim }}</td>
                                    <td>{{ $p->prodi }}</td>

                                    <td>
                                        <span
                                            class="badge 
                                        @if ($p->status == 'Terkirim') bg-primary
                                        @elseif($p->status == 'Ditinjau') bg-warning
                                        @elseif($p->status == 'Tahap Wawancara') bg-info
                                        @elseif($p->status == 'Disetujui') bg-success
                                        @else bg-danger @endif">
                                            {{ $p->status }}
                                        </span>
                                    </td>

                                    <td>{{ $p->created_at->format('d M Y') }}</td>



                                    <td>
                                        @if ($p->pesan)
                                            <span class="text-muted" style="font-size: 12px;">
                                                {{ Str::limit($p->pesan, 25) }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.pengajuan.show', $p->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            Detail
                                        </a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        Belum ada pengajuan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="pagination-wrapper mt-3">
                    {{ $pengajuan->links() }}
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
