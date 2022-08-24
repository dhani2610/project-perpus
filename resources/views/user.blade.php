@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data User</h1>
                    </div>

                    <div class="container mt-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId">
                            <i class="fas fa-plus">Tambah User</i>
                        </button>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ '/tambahuser' }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="">Nama</label>
                                            <input type="text" name="name" id="name" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Alamat</label>
                                            <input type="text" name="alamat" id="alamat" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Email</label>
                                            <input type="email" name="email" id="email" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Password</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                        <input type="hidden" value="Approve" name="approval">
                                        <div class="mb-3">
                                            <label for="">Role</label>
                                            <select class="form-control" name="role">
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Foto Profile</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Tambah User</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-13">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabel Pengguna</h3>
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
                                                    <a href="{{ url('/cetakuser', $item->id) }}" target="_blank"
                                                        class="btn btn-success btn-xs"><i class="fa fa-sticky-note"
                                                            aria-hidden="true"></i> Cetak Kartu
                                                        Anggota</a>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success btn-xs"
                                                        data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                                        <i class="fa fa-sticky-note" aria-hidden="true"></i> Edit
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editModal{{ $item->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit User</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ '/edituser' }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id"
                                                                            id="id" value="{{ $item->id }}">
                                                                        <div class="mb-3">
                                                                            <label for="">Nama</label>
                                                                            <input type="text" name="name"
                                                                                id="name" class="form-control"
                                                                                placeholder="Masukan Nama Kategori"
                                                                                value="{{ $item->name }}">
                                                                        </div>
                                                                        <input type="hidden" value="{{ $item->approval }}" name="approval">
                                                                        <div class="mb-3">
                                                                            <label for="">Tempat Lahir</label>
                                                                            <input type="text" name="tempat_lahir"
                                                                                id="tempat_lahir" class="form-control"
                                                                                value="{{ $item->tempat_lahir }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="">Tanggal Lahir</label>
                                                                            <input type="date" name="tanggal_lahir"
                                                                                id="tanggal_lahir" class="form-control"
                                                                                value="{{ $item->tanggal_lahir }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="">Alamat</label>
                                                                            <input type="text" name="alamat"
                                                                                id="alamat" class="form-control"
                                                                                value="{{ $item->alamat }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="">Email</label>
                                                                            <input type="text" name="email"
                                                                                id="email" class="form-control"
                                                                                placeholder="Masukan Nama Kategori"
                                                                                value="{{ $item->email }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="">Role</label>
                                                                            <select class="form-control" name="role">
                                                                                <option value="{{ $item->role }}"
                                                                                    selected>
                                                                                    {{ $item->role }}</option>
                                                                                <option value="admin">Admin</option>
                                                                                <option value="user">User</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Edit
                                                                                User</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Button trigger modal -->
                                                    <form action="{{ url('/hapususer', $item->id) }}" method="GET">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-xs">
                                                            <i class="fa fa-trash" aria-hidden="true"></i> Hapus
                                                        </button>
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
