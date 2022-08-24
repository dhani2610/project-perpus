@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Pengunjung</h1>
                    </div>

                    <div class="container mt-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId">
                            <i class="fas fa-plus">Tambah Pengunjung</i>
                        </button>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Pengunjung</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ '/tambahpengunjung' }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="">Nama</label>
                                            <input type="text" name="nama_pengunjung" id="nama_pengunjung"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Tanggal Kunjungan</label>
                                            <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Keterangan</label>
                                            <input type="text" name="keterangan" id="keterangan" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Tambah Pengunjung</button>
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
                                <h3 class="card-title">Tabel Pengunjung</h3>
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
                                            <th>Nama Pengunjung</th>
                                            <th>Tanggal Kunjungan</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->nama_pengunjung }}</td>
                                                <td>{{ $item->tanggal_kunjungan }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success btn-xs"
                                                        data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                                        <i class="fa fa-sticky-note" aria-hidden="true"></i> Edit
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                                                                    <form action="{{ '/editpengunjung' }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id" id="id"
                                                                            value="{{ $item->id }}">
                                                                        <div class="mb-3">
                                                                            <label for="">Nama Pengunjung</label>
                                                                            <input type="text" name="nama_pengunjung"
                                                                                id="nama_pengunjung" class="form-control"
                                                                                placeholder="Masukan Nama Kategori"
                                                                                value="{{ $item->nama_pengunjung }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="">Tanggal Kunjungan</label>
                                                                            <input type="date" name="tanggal_kunjungan"
                                                                                id="tanggal_kunjungan"
                                                                                class="form-control"
                                                                                value="{{ $item->tanggal_kunjungan }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="">Keterangan</label>
                                                                            <input type="text" name="keterangan"
                                                                                id="keterangan" class="form-control"
                                                                                value="{{ $item->keterangan }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Edit
                                                                                Pengunjung</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Button trigger modal -->
                                                    <form action="{{ url('/hapuspengunjung', $item->id) }}"
                                                        method="GET">
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
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
