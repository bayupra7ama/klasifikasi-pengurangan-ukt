<!-- resources/views/pengajuan/success.blade.php -->
@extends('layouts.admin', ['fullpage' => true])

@section('title', 'Pengajuan Berhasil Dikirim')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm p-4 text-center">
                    <h2 class="fw-bold text-success mb-3">Pengajuan Berhasil Dikirim!</h2>
                    <p class="text-muted mb-4">Terima kasih. Pengajuan kamu sudah masuk ke sistem dan sedang diproses oleh
                        pihak kampus.</p>

                    <div class="alert alert-info text-start">
                        <b>Status Awal Pengajuan:</b> <span class="badge bg-primary">Terkirim</span>
                        <br>
                        <small>Status bisa berubah menjadi: <b>Ditinjau</b>, <b>Tahap Wawancara</b>, atau
                            <b>Disetujui</b>.</small>
                    </div>

                    <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>
@endsection
