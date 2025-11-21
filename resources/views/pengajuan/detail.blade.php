@extends('layouts.admin')

@section('title', 'Detail Pengajuan')

@section('content')

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white fw-bold">
            Detail Pengajuan Mahasiswa
        </div>

        <div class="card-body">

            {{-- STATUS --}}
            <div class="mb-4">
                <h5>Status Pengajuan:</h5>

                @if ($pengajuan->status == 'Terkirim')
                    <span class="badge bg-primary">Terkirim</span>
                @elseif($pengajuan->status == 'ditinjau')
                    <span class="badge bg-warning text-dark">Ditinjau</span>
                @elseif($pengajuan->status == 'wawancara')
                    <span class="badge bg-info text-dark">Tahap Wawancara</span>
                @elseif($pengajuan->status == 'disetujui')
                    <span class="badge bg-success">Disetujui</span>
                @endif
            </div>

            {{-- ============================
                SECTION I – DATA DIRI
        ============================= --}}
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white fw-bold">
                    I. Data Diri
                </div>
                <div class="card-body">
                    <p><b>Nama:</b> {{ $pengajuan->nama }}</p>
                    <p><b>NIM:</b> {{ $pengajuan->nim }}</p>
                    <p><b>Prodi:</b> {{ $pengajuan->prodi }}</p>
                    <p><b>Jurusan:</b> {{ $pengajuan->jurusan }}</p>
                    <p><b>No HP:</b> {{ $pengajuan->hp }}</p>
                    <p><b>Email:</b> {{ $pengajuan->email }}</p>
                </div>
            </div>

            {{-- ============================
            SECTION II – KELUARGA
        ============================= --}}
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white fw-bold">
                    II. Data Keluarga
                </div>
                <div class="card-body">
                    <p><b>Nama Ayah:</b> {{ $pengajuan->nama_ayah }}</p>
                    <p><b>Pekerjaan Ayah:</b> {{ $pengajuan->pekerjaan_ayah }}</p>
                    <p><b>Bekerja Sebagai:</b> {{ $pengajuan->bekerja_ayah }}</p>

                    <p><b>Nama Ibu:</b> {{ $pengajuan->nama_ibu }}</p>
                    <p><b>Pekerjaan Ibu:</b> {{ $pengajuan->pekerjaan_ibu }}</p>
                    <p><b>Bekerja Sebagai:</b> {{ $pengajuan->bekerja_ibu }}</p>

                    <p><b>Jumlah Tanggungan:</b> {{ $pengajuan->jumlah_tanggungan }}</p>
                    <p><b>No HP Orang Tua:</b> {{ $pengajuan->hp_ortu }}</p>
                    <p><b>Status Orang Tua:</b> {{ $pengajuan->status_orangtua }}</p>
                    <p><b>Pendidikan Orang Tua:</b> {{ $pengajuan->pendidikan_orangtua }}</p>
                    <p><b>Kondisi Orang Tua Kandung:</b> {{ $pengajuan->kondisi_orangtua }}</p>
                </div>
            </div>

            {{-- ============================
            SECTION III – RUMAH TINGGAL
        ============================= --}}
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white fw-bold">
                    III. Rumah Tinggal Keluarga
                </div>
                <div class="card-body">
                    <p><b>Kepemilikan Rumah:</b> {{ $pengajuan->kepemilikan_rumah }}</p>
                    <p><b>Tahun Perolehan:</b> {{ $pengajuan->tahun_perolehan }}</p>
                    <p><b>Sumber Listrik:</b> {{ $pengajuan->sumber_listrik }}</p>
                    <p><b>Luas Tanah:</b> {{ $pengajuan->luas_tanah }}</p>
                    <p><b>Luas Bangunan:</b> {{ $pengajuan->luas_bangunan }}</p>
                    <p><b>Mandi Cuci Kakus:</b> {{ $pengajuan->mandi_cuci_kakus }}</p>
                    <p><b>Sumber Air:</b> {{ $pengajuan->sumber_air }}</p>
                    <p><b>Jarak ke Pusat Kota:</b> {{ $pengajuan->jarak_pusat_kota }} km</p>
                    <p><b>Jumlah Orang Tinggal:</b> {{ $pengajuan->jumlah_orang_tinggal }}</p>
                </div>
            </div>

            {{-- ============================
            SECTION IV – EKONOMI
        ============================= --}}
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white fw-bold">
                    IV. Ekonomi Keluarga
                </div>
                <div class="card-body">
                    <p><b>Penghasilan Ayah:</b> Rp {{ number_format($pengajuan->penghasilan_ayah) }}</p>
                    <p><b>Penghasilan Ibu:</b> Rp {{ number_format($pengajuan->penghasilan_ibu) }}</p>
                    <p><b>Hutang:</b> Rp {{ number_format($pengajuan->hutang) }}</p>
                    <p><b>Cicilan Per Bulan:</b> Rp {{ number_format($pengajuan->cicilan) }}</p>
                    <p><b>Piutang:</b> Rp {{ number_format($pengajuan->piutang) }}</p>
                    <p><b>Tabungan:</b> Rp {{ number_format($pengajuan->tabungan) }}</p>
                </div>
            </div>

            {{-- ============================
            SECTION V – KEKAYAAN LAIN
        ============================= --}}
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white fw-bold">
                    V. Kekayaan Lain
                </div>
                <div class="card-body">
                    <p><b>Sepeda Motor:</b> {{ $pengajuan->motor }} unit</p>
                    <p><b>Mobil:</b> {{ $pengajuan->mobil }} unit</p>
                    <p><b>Kebun:</b> {{ $pengajuan->kebun }} ha</p>
                </div>
            </div>

            <a href="{{ route('user.pengajuan.riwayat') }}" class="btn btn-secondary mt-3">
                Kembali
            </a>

        </div>
    </div>

@endsection
