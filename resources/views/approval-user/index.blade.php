@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Proses Persetujuan Registrasi</h1>
                    </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-13">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabel Pengguna Yang Perlu di Setujui</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-primary" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama User</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $item)
                                            <tr>
                                                <td>{{ $index + $datas->firstItem() }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->role }}</td>
                                                <td>
                                                    <form action="{{ route('approval-user',$item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-xs">Setuju</button>
                                                    </form>
                                                    <form action="{{ route('not-approve-user', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-xs">Tidak</button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $datas->links() }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
