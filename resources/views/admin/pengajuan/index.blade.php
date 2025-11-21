@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4>Daftar Pengajuan</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>NIM</th>
                        <th>Tgl</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->user->name }}</td>
                            <td>{{ $p->nim }}</td>
                            <td>{{ $p->created_at->format('Y-m-d') }}</td>
                            <td>{{ ucfirst($p->status) }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.pengajuan.show', $p) }}">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $list->links() }}
        </div>
    </div>
@endsection
