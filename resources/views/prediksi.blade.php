@extends('layouts.admin', ['fullpage' => true])

@section('title', 'Prediksi Kelayakan UKT')

@push('styles')
    <style>
        body {
            background: #f5f8fc !important;
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid mt-4">

        <h3 class="card-title fw-semibold mb-4 text-center">Prediksi Kelayakan Pengurangan UKT Mahasiswa Polbeng</h3>

        {{-- FORM --}}
        <div class="card">
            <div class="card-body">

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('predict') }}">
                    @csrf

                    <div class="row">

                        {{-- NAMA --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>

                        {{-- NIM --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" class="form-control" name="nim" required>
                        </div>

                        {{-- JURUSAN --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jurusan</label>
                            <select class="form-select" id="jurusan" name="jurusan" required>
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

                        {{-- PRODI --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Program Studi</label>
                            <select class="form-select" id="prodi" name="prodi" required>
                                <option value="">Pilih Prodi</option>
                            </select>
                        </div>

                        {{-- PENGHASILAN --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penghasilan (Rp)</label>
                            <input type="text" class="form-control" id="penghasilan" name="penghasilan" required>
                        </div>

                        {{-- TANGGUNGAN --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah Tanggungan</label>
                            <input type="number" class="form-control" name="tanggungan" required>
                        </div>

                        {{-- PEKERJAAN --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pekerjaan Orang Tua</label>
                            <select class="form-select" name="pekerjaan" required>
                                <option value="">Pilih Pekerjaan</option>
                                @foreach (['Buruh', 'Buruh Harian Lepas', 'Guru', 'IRT', 'Karyawan', 'Karyawan Swasta', 'Ketua RW', 'Kuli Bangunan', 'Mekanik', 'Nelayan', 'Petani', 'ASN', 'PNS', 'TNI/POLRI', 'Pegawai Swasta', 'Wiraswasta', 'Ojek', 'Lainnya'] as $p)
                                    <option>{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- STATUS ANAK --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status Orang Tua</label>
                            <select class="form-select" name="status_anak" required>
                                <option value="">Pilih</option>
                                @foreach (['Lengkap', 'Cerai', 'Yatim', 'Piatu', 'Yatim Piatu'] as $s)
                                    <option>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- TEMPAT TINGGAL --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kondisi Tempat Tinggal</label>
                            <select class="form-select" name="tempat_tinggal" required>
                                <option value="">Pilih</option>
                                <option>Layak</option>
                                <option>Kurang Layak</option>
                                <option>Tidak Layak</option>
                            </select>
                        </div>

                        {{-- DTKS --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">DTKS (Data Terpadu Kesejahteraan Sosial)</label>
                            <select class="form-select" name="dtks" required>
                                <option value="0">Tidak Punya</option>
                                <option value="1">Punya</option>
                            </select>
                        </div>

                        {{-- SKTM --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">SKTM (Surat Keterangan Tidak Mampu)</label>
                            <select class="form-select" name="sktm" required>
                                <option value="0">Tidak Punya</option>
                                <option value="1">Punya</option>
                            </select>
                        </div>

                    </div>

                    <button class="btn btn-primary w-100">🔮 Prediksi</button>
                </form>

            </div>
        </div>

        {{-- HASIL PREDIKSI --}}
        @if (isset($result))
            <div class="card mt-4">
                <div class="card-body">
                    {{-- TAMPILKAN ULANG INPUT --}}

                    <h5 class="fw-bold mt-3">📄 Data Yang Dimasukkan</h5>

                    <ul>
                        <li><b>Nama:</b> {{ $input['nama'] }}</li>
                        <li><b>NIM:</b> {{ $input['nim'] }}</li>
                        <li><b>Jurusan:</b> {{ $input['jurusan'] }}</li>
                        <li><b>Prodi:</b> {{ $input['prodi'] }}</li>
                        <li><b>Penghasilan:</b> Rp {{ number_format($input['penghasilan'], 0, ',', '.') }}</li>
                        <li><b>Tanggungan:</b> {{ $input['tanggungan'] }} orang</li>
                        <li><b>Pekerjaan:</b> {{ $input['pekerjaan'] }}</li>
                        <li><b>Status Anak:</b> {{ $input['status_anak'] }}</li>
                        <li><b>Kondisi Tempat Tinggal:</b> {{ $input['tempat_tinggal'] }}</li>
                        <li><b>DTKS:</b> {{ $input['dtks'] == 1 ? 'Punya' : 'Tidak Punya' }}</li>
                        <li><b>SKTM:</b> {{ $input['sktm'] == 1 ? 'Punya' : 'Tidak Punya' }}</li>
                    </ul>

                    <hr>
                    <h5 class="fw-bold mb-3">📊 Hasil Prediksi</h5>

                    <p><b>Status:</b>
                        @if ($result['predicted'][0] == '1')
                            <span class="badge bg-success">LAYAK</span>
                        @else
                            <span class="badge bg-danger">TIDAK LAYAK</span>
                        @endif
                    </p>

                    @php
                        $prob = $result['probabilities'];
                        $layak = round($prob['1'][0] * 100, 2);
                        $tidakLayak = round($prob['0'][0] * 100, 2);
                    @endphp

                    <label>Layak ({{ $layak }}%)</label>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success" style="width: {{ $layak }}%"></div>
                    </div>

                    <label>Tidak Layak ({{ $tidakLayak }}%)</label>
                    <div class="progress">
                        <div class="progress-bar bg-danger" style="width: {{ $tidakLayak }}%"></div>
                    </div>


                </div>
            </div>
        @endif

    </div>

  

@endsection
