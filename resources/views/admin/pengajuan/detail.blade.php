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

                {{-- ======================== I. DATA MAHASISWA ======================== --}}
                <h5 class="fw-bold mb-3">I. Data Mahasiswa</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $pengajuan->nama_mahasiswa }}</td>
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

                {{-- ======================== II. DATA KELUARGA ======================== --}}
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
                        <th>Bekerja Sebagai Ayah</th>
                        <td>{{ $pengajuan->bekerja_sebagai_ayah }}</td>
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
                        <th>Bekerja Sebagai Ibu</th>
                        <td>{{ $pengajuan->bekerja_sebagai_ibu }}</td>
                    </tr>

                    <tr>
                        <th>Jumlah Tanggungan</th>
                        <td>{{ $pengajuan->jumlah_tanggungan }} orang</td>
                    </tr>
                    <tr>
                        <th>HP Orang Tua</th>
                        <td>{{ $pengajuan->hp_orangtua }}</td>
                    </tr>
                    <tr>
                        <th>Status Orang Tua</th>
                        <td>{{ $pengajuan->status_orangtua }}</td>
                    </tr>
                    <tr>
                        <th>Pendidikan Orang Tua</th>
                        <td>{{ $pengajuan->pendidikan_orangtua }}</td>
                    </tr>
                    <tr>
                        <th>Orang Tua Kandung</th>
                        <td>{{ $pengajuan->orangtua_kandung }}</td>
                    </tr>
                </table>

                {{-- ======================== III. RUMAH TINGGAL ======================== --}}
                <h5 class="fw-bold mt-4 mb-3">III. Rumah Tinggal Keluarga</h5>
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
                    <tr>
                        <th>MCK</th>
                        <td>{{ $pengajuan->mandi_cuci_kakus }}</td>
                    </tr>
                    <tr>
                        <th>Sumber Air</th>
                        <td>{{ $pengajuan->sumber_air }}</td>
                    </tr>
                    <tr>
                        <th>Jarak Dari Kota</th>
                        <td>{{ $pengajuan->jarak_dari_kota }} km</td>
                    </tr>
                    <tr>
                        <th>Jumlah Orang Tinggal</th>
                        <td>{{ $pengajuan->jumlah_orang_tinggal }} orang</td>
                    </tr>
                </table>

                {{-- ======================== IV. EKONOMI ======================== --}}
                <h5 class="fw-bold mt-4 mb-3">IV. Ekonomi Keluarga</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Penghasilan Ayah</th>
                        <td>Rp {{ number_format($pengajuan->penghasilan_ayah, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Penghasilan Ibu</th>
                        <td>Rp {{ number_format($pengajuan->penghasilan_ibu, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Hutang</th>
                        <td>Rp {{ number_format($pengajuan->hutang, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Cicilan Per Bulan</th>
                        <td>Rp {{ number_format($pengajuan->cicilan_per_bulan, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Piutang</th>
                        <td>Rp {{ number_format($pengajuan->piutang, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Tabungan</th>
                        <td>Rp {{ number_format($pengajuan->tabungan, 0, ',', '.') }}</td>
                    </tr>
                </table>

                {{-- ======================== V. KEKAYAAN ======================== --}}
                <h5 class="fw-bold mt-4 mb-3">V. Kekayaan Lain</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Sepeda Motor</th>
                        <td>{{ $pengajuan->sepeda_motor }} unit</td>
                    </tr>
                    <tr>
                        <th>Mobil</th>
                        <td>{{ $pengajuan->mobil }} unit</td>
                    </tr>
                    <tr>
                        <th>Kebun</th>
                        <td>{{ $pengajuan->kebun_hektar }} hektar</td>
                    </tr>
                </table>

                {{-- =============== UPDATE STATUS & PESAN UNTUK MAHASISWA =============== --}}
                <h5 class="fw-bold mt-4 mb-3">Update Status Pengajuan</h5>

                <form method="POST" action="{{ route('admin.pengajuan.updateStatus', $pengajuan->id) }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Status Pengajuan</label>
                            <select name="status" class="form-select">
                                <option {{ $pengajuan->status == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                                <option {{ $pengajuan->status == 'Ditinjau' ? 'selected' : '' }}>Ditinjau</option>
                                <option {{ $pengajuan->status == 'Tahap Wawancara' ? 'selected' : '' }}>Tahap Wawancara
                                </option>
                                <option {{ $pengajuan->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option {{ $pengajuan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Pesan untuk Mahasiswa</label>
                            <textarea name="pesan" required class="form-control" rows="3" placeholder="Contoh: Berkas sedang diperiksa.">{{ $pengajuan->pesan }} </textarea>
                        </div>

                        <div class="col-md-6">
                            <button class="btn btn-primary">Update Status</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const statusSelect = document.querySelector('select[name="status"]');
            const pesanTextarea = document.querySelector('textarea[name="pesan"]');

            statusSelect.addEventListener("change", function() {
                const status = this.value;

                if (status === "Ditinjau") {
                    // Isi otomatis jika ditinjau
                    pesanTextarea.value = "Berkas sedang ditinjau oleh admin.";
                    pesanTextarea.readOnly = true; // biar ga bisa diganti
                } else {
                    // Status lain wajib isi pesan
                    pesanTextarea.value = "";
                    pesanTextarea.readOnly = false;
                }
            });
        });
    </script>

@endsection
