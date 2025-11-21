@extends('layouts.admin')

@section('title', 'Detail Pengajuan')

@section('content')
    <div class="container-fluid">

        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0">Detail Pengajuan Mahasiswa</h4>

                <span
                    class="badge 
                @if ($pengajuan->status == 'Terkirim') bg-primary
                @elseif ($pengajuan->status == 'Ditinjau') bg-warning
                @elseif ($pengajuan->status == 'Tahap Wawancara') bg-info
                @elseif ($pengajuan->status == 'Disetujui') bg-success
                @else bg-danger @endif">
                    {{ $pengajuan->status }}
                </span>
            </div>

            <div class="card-body">

                {{-- DATA MAHASISWA --}}
                <h5 class="fw-bold mb-3">I. Data Mahasiswa</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $pengajuan->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $pengajuan->user->email }}</td>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <td>{{ $pengajuan->nim }}</td>
                    </tr>
                    <tr>
                        <th>Program Studi</th>
                        <td>{{ $pengajuan->prodi }}</td>
                    </tr>
                    <tr>
                        <th>Jurusan</th>
                        <td>{{ $pengajuan->jurusan }}</td>
                    </tr>
                </table>

                {{-- DATA KELUARGA --}}
                <h5 class="fw-bold mt-4 mb-3">II. Data Keluarga</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Ayah</th>
                        <td>{{ $pengajuan->nama_ayah }}</td>
                    </tr>
                    <tr>
                        <th>Pekerjaan Ayah</th>
                        <td>{{ $pengajuan->pekerjaan_ayah }}</td>
                    </tr>
                    <tr>
                        <th>Nama Ibu</th>
                        <td>{{ $pengajuan->nama_ibu }}</td>
                    </tr>
                    <tr>
                        <th>Pekerjaan Ibu</th>
                        <td>{{ $pengajuan->pekerjaan_ibu }}</td>
                    </tr>
                    <tr>
                        <th>Tanggungan</th>
                        <td>{{ $pengajuan->tanggungan }}</td>
                    </tr>
                </table>

                {{-- RUMAH TINGGAL --}}
                <h5 class="fw-bold mt-4 mb-3">III. Rumah Tinggal</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Kepemilikan Rumah</th>
                        <td>{{ $pengajuan->kepemilikan_rumah }}</td>
                    </tr>
                    <tr>
                        <th>Tahun Perolehan</th>
                        <td>{{ $pengajuan->tahun_perolehan }}</td>
                    </tr>
                    <tr>
                        <th>Sumber Listrik</th>
                        <td>{{ $pengajuan->sumber_listrik }}</td>
                    </tr>
                    <tr>
                        <th>Luas Tanah</th>
                        <td>{{ $pengajuan->luas_tanah }}</td>
                    </tr>
                    <tr>
                        <th>Luas Bangunan</th>
                        <td>{{ $pengajuan->luas_bangunan }}</td>
                    </tr>
                </table>

                {{-- EKONOMI --}}
                <h5 class="fw-bold mt-4 mb-3">IV. Ekonomi Keluarga</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Penghasilan Ayah</th>
                        <td>{{ $pengajuan->penghasilan_ayah }}</td>
                    </tr>
                    <tr>
                        <th>Penghasilan Ibu</th>
                        <td>{{ $pengajuan->penghasilan_ibu }}</td>
                    </tr>
                    <tr>
                        <th>Hutang</th>
                        <td>{{ $pengajuan->hutang }}</td>
                    </tr>
                    <tr>
                        <th>Cicilan Per Bulan</th>
                        <td>{{ $pengajuan->cicilan }}</td>
                    </tr>
                    <tr>
                        <th>Tabungan</th>
                        <td>{{ $pengajuan->tabungan }}</td>
                    </tr>
                </table>

                {{-- BUTTON UPDATE STATUS --}}
                <h5 class="fw-bold mt-4 mb-3">Update Status Pengajuan</h5>
                <form method="POST" action="{{ route('admin.pengajuan.updateStatus', $pengajuan->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <select name="status" class="form-select">
                                <option>Terkirim</option>
                                <option>Ditinjau</option>
                                <option>Tahap Wawancara</option>
                                <option>Disetujui</option>
                                <option>Ditolak</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary">Update Status</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
