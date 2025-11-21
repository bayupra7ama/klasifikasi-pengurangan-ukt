{{-- resources/views/user/dashboard.blade.php --}}
@extends('layouts.admin') {{-- pakai layout admin (sidebar/header) --}}

@section('title', 'Dashboard Saya')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h3>Halo, {{ auth()->user()->name }}</h3>
                <p>Selamat datang Mahasiswa Hebat!.</p>

                <p><b>Email:</b> {{ auth()->user()->email }}</p>
                

                {{-- contoh link cepat --}}
                <a href="{{ route('pengajuan.create') }}" class="btn btn-primary">Buat Pengajuan</a>
            </div>
        </div>
    </div>
@endsection
