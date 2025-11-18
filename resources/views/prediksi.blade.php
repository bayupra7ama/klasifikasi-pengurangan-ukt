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

       

                <h3 class="card-title fw-semibold mb-4 text-center ">Prediksi Kelayakan Pengrangan UKT Mahasiswa Polbeng</h3>

                {{-- CARD FORM --}}
                <div class="card">
                    <div class="card-body">

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('predict') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIM</label>
                                    <input type="text" class="form-control" name="nim" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Prodi</label>
                                    <input type="text" class="form-control" name="prodi" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jurusan</label>
                                    <input type="text" class="form-control" name="jurusan" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Penghasilan (Rp)</label>
                                    <input type="number" class="form-control" name="penghasilan" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jumlah Tanggungan</label>
                                    <input type="number" class="form-control" name="tanggungan" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pekerjaan Orang Tua</label>
                                    <select class="form-select" name="pekerjaan" required>
                                        <option value="">Pilih</option>
                                        @foreach (['buruh', 'buruh harian lepas', 'guru', 'irt', 'karyawan', 'karyawan swasta', 'ketua rw', 'kuli bangunan', 'mekanik', 'nelayan', 'petani', 'asn', 'pns', 'tni/polri', 'pegawai swasta', 'wiraswasta', 'ojek'] as $p)
                                            <option>{{ $p }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Anak</label>
                                    <select class="form-select" name="status_anak" required>
                                        <option value="">Pilih</option>
                                        @foreach (['lengkap', 'cerai', 'yatim', 'piatu', 'yatim piatu'] as $s)
                                            <option>{{ $s }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kondisi Tempat Tinggal</label>
                                    <select class="form-select" name="tempat_tinggal" required>
                                        <option>layak</option>
                                        <option>kurang layak</option>
                                        <option>tidak layak</option>
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">DTKS</label>
                                    <select class="form-select" name="dtks" required>
                                        <option value="0">Tidak punya</option>
                                        <option value="1">Punya</option>
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">SKTM</label>
                                    <select class="form-select" name="sktm" required>
                                        <option value="0">Tidak punya</option>
                                        <option value="1">Punya</option>
                                    </select>
                                </div>
                            </div>

                            <button class="btn btn-primary w-100">🔮 Prediksi</button>
                        </form>

                    </div>
                </div>

                {{-- ------- HASIL PREDIKSI -------- --}}
                @if (isset($result))
                    <div class="card mt-4">
                        <div class="card-body">

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

     

    @endsection
