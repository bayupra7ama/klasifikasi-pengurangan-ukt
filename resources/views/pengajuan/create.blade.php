<!-- Blade: resources/views/pengajuan/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Pengajuan Keringanan UKT - Mahasiswa')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h3 class="fw-bold mb-3">Form Pengajuan Resmi Keringanan UKT</h3>
                <p class="text-muted">Silakan isi data lengkap sesuai formulir resmi kampus.</p>
            </div>
        </div>

        <form action="{{ route('pengajuan.store') }}" method="POST">
            @csrf

            <!-- ========================= I. DATA DIRI ========================= -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white fw-bold">I. Data Diri</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Mahasiswa</label>
                            <input type="text" class="form-control" name="nama_mahasiswa"
                                value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>NIM</label>
                            <input type="text" class="form-control" name="nim" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-select" required>
                                <option value="">Pilih Jurusan</option>

                                <option value="Teknik Perkapalan">Teknik Perkapalan</option>
                                <option value="Teknik Mesin">Teknik Mesin</option>
                                <option value="Teknik Elektro">Teknik Elektro</option>
                                <option value="Teknik Sipil">Teknik Sipil</option>
                                <option value="Administrasi Niaga">Administrasi Niaga</option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Bahasa">Bahasa</option>
                                <option value="Kemaritiman">Kemaritiman</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Program Studi</label>
                            <select name="prodi" id="prodi" class="form-select" required>
                                <option value="">-- Pilih Prodi --</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================= II. KELUARGA ========================= -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white fw-bold">II. Data Keluarga</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Ayah/Wali</label>
                            <input type="text" class="form-control" name="nama_ayah" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Pekerjaan Ayah/Wali</label>
                            <select class="form-select" name="pekerjaan_ayah" required>
                                <option value="">Pilih</option>
                                @foreach (['Buruh', 'Buruh Harian Lepas', 'Guru', 'IRT', 'Karyawan', 'Karyawan Swasta', 'Ketua RW', 'Kuli Bangunan', 'Mekanik', 'Nelayan', 'Petani', 'ASN', 'PNS', 'TNI/POLRI', 'Pegawai Swasta', 'Wiraswasta', 'Ojek', 'Lainnya'] as $p)
                                    <option>{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Bekerja Sebagai Ayah</label>
                            <input class="form-control" name="bekerja_sebagai_ayah">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Pekerjaan Ibu</label>
                            <select class="form-select" name="pekerjaan_ibu" required>
                                <option value="">Pilih</option>
                                @foreach (['Buruh', 'Buruh Harian Lepas', 'Guru', 'IRT', 'Karyawan', 'Karyawan Swasta', 'Ketua RW', 'Kuli Bangunan', 'Mekanik', 'Nelayan', 'Petani', 'ASN', 'PNS', 'TNI/POLRI', 'Pegawai Swasta', 'Wiraswasta', 'Ojek', 'Lainnya'] as $p)
                                    <option>{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Bekerja Sebagai Ibu</label>
                            <input class="form-control" name="bekerja_sebagai_ibu">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Jumlah Tanggungan</label>
                            <input type="number" class="form-control" name="jumlah_tanggungan" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>HP Orang Tua</label>
                            <input type="text" class="form-control" name="hp_orangtua" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Status Orang Tua</label>
                            <select class="form-select" name="status_orangtua" required>
                                <option value="">Pilih</option>
                                <option>Kandung</option>
                                <option>Tiri</option>
                                <option>Angkat</option>
                                <option>Lainnya</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Pendidikan Orang Tua</label>
                            <select class="form-select" name="pendidikan_orangtua" required>
                                <option value="">Pilih</option>
                                <option>Tidak Sekolah</option>
                                <option>SD/MI</option>
                                <option>SMP/MTS</option>
                                <option>SMA/MA</option>
                                <option>D1</option>
                                <option>D2/D3</option>
                                <option>D4/S1</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Orang Tua Kandung (Ayah & Ibu)</label>
                            <select class="form-select" name="orangtua_kandung" required>
                                <option value="">Pilih</option>
                                <option>Masih Hidup</option>
                                <option>Sudah Wafat</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================= III. RUMAH TINGGAL ========================= -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white fw-bold">III. Rumah Tinggal Keluarga</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Kepemilikan Rumah</label>
                            <select class="form-select" name="kepemilikan_rumah" required>
                                <option value="">Pilih</option>
                                <option>Sendiri</option>
                                <option>Sewa Tahunan</option>
                                <option>Sewa Bulanan</option>
                                <option>Menumpang</option>
                                <option>Tidak Memiliki</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Tahun Perolehan</label>
                            <input type="text" class="form-control" name="tahun_perolehan" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Sumber Listrik</label>
                            <select class="form-select" name="sumber_listrik" required>
                                <option value="">Pilih</option>
                                <option>PLN</option>
                                <option>Genset</option>
                                <option>Tenaga Surya</option>
                                <option>PLN & Genset</option>
                                <option>Tidak Ada</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Luas Tanah</label>
                            <select class="form-select" name="luas_tanah" required>
                                <option value="">Pilih</option>
                                <option>>200 m2</option>
                                <option>100-200 m2</option>
                                <option>50-99 m2</option>
                                <option>25-50 m2</option>
                                <option>
                                    25 m2</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Luas Bangunan</label>
                            <select class="form-select" name="luas_bangunan" required>
                                <option value="">Pilih</option>
                                <option>>200 m2</option>
                                <option>100-200 m2</option>
                                <option>50-99 m2</option>
                                <option>25-50 m2</option>
                                <option>
                                    25 m2</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Mandi Cuci Kakus</label>
                            <select class="form-select" name="mandi_cuci_kakus" required>
                                <option value="">Pilih</option>
                                <option>Kepemilikan Sendiri di Dalam</option>
                                <option>Kepemilikan Sendiri di Luar</option>
                                <option>Berbagi Pakai</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Sumber Air</label>
                            <select class="form-select" name="sumber_air" required>
                                <option value="">Pilih</option>
                                <option>Air Kemasan</option>
                                <option>PDAM</option>
                                <option>Sumur/Perigi</option>
                                <option>Sungai/Lainnya</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Jarak dari Pusat Kabupaten/Kota (Km)</label>
                            <input type="number" class="form-control" name="jarak_pusat_kota">
                        </div>


                        <div class="col-md-6 mb-3">
                            <label>Jumlah Orang Tinggal</label>
                            <input type="number" class="form-control" name="jumlah_orang_tinggal" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================= IV. EKONOMI KELUARGA ========================= -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white fw-bold">IV. Ekonomi Keluarga</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Penghasilan Ayah/Wali (Rp)</label>
                            <input type="text" id="penghasilan" class="form-control rupiah" name="penghasilan_ayah"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Penghasilan Ibu (Rp)</label>
                            <input type="text" id="penghasilan" class="form-control rupiah" name="penghasilan_ibu"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Hutang kepada Pihak Lain (Rp)</label>
                            <input type="text" id="penghasilan" class="form-control rupiah" name="hutang" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Cicilan Hutang per Bulan (Rp)</label>
                            <input type="text" id="penghasilan" class="form-control rupiah" name="cicilan_perbulan"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Piutang kepada Pihak Lain (Rp)</label>
                            <input type="text" id="penghasilan" class="form-control rupiah" name="piutang" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tabungan Keluarga (Rp)</label>
                            <input type="text" id="penghasilan" class="form-control rupiah" name="tabungan" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================= V. KEKAYAAN LAIN ========================= -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white fw-bold">V. Kekayaan Lain yang Dimiliki</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Jumlah Sepeda Motor (Unit)</label>
                            <input type="number" class="form-control" name="motor" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Jumlah Mobil (Unit)</label>
                            <input type="number" class="form-control" name="mobil" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Luas Kebun (Hektar)</label>
                            <input type="number" step="0.01" class="form-control" name="kebun" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================= SUBMIT ========================= -->
            <div class="text-end mb-5">
                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">Kirim Pengajuan</button>
            </div>
        </form> <!-- <<< HARUS ADA -->

    @endsection
