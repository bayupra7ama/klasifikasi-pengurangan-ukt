@extends('layouts.admin')

@section('title', 'Riwayat Pengajuan')

@section('content')

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">
            Riwayat Pengajuan Saya
        </div>

        <div class="card-body">

            @if ($pengajuan->isEmpty())
                <div class="alert alert-info">
                    Kamu belum pernah mengajukan keringanan UKT.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Prodi</th>
                                <th>Status</th>
                                <th>Pesan Admin</th>

                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pengajuan as $i => $row)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $row->created_at->format('d M Y') }}</td>
                                    <td>{{ $row->prodi }}</td>
                                    <td>
                                        @if ($row->status == 'Terkirim')
                                            <span class="badge bg-primary">Terkirim</span>
                                        @elseif($row->status == 'Ditinjau')
                                            <span class="badge bg-warning text-dark">Ditinjau</span>
                                        @elseif($row->status == 'Tahap Wawancara')
                                            <span class="badge bg-info text-dark">Tahap Wawancara</span>
                                        @elseif($row->status == 'Disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                        @elseif($row->status == 'Ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $row->pesan }}
                                    </td>

                                    <td>
                                        <a href="{{ route('user.pengajuan.detail', $row->id) }}"
                                            class="btn btn-sm btn-primary">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            @endif

        </div>
    </div>

@endsection
