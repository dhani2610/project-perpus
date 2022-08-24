@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 mb-3">
                        <h1>Data Denda</h1>
                    </div>

                    <div class="container mt-3 mb-2">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
                            <i class="fas fa-plus">Tambah Denda</i>
                        </button>
                    </div>
                    <form action="{{ route('datadenda.pdf') }}" method="POST">
                        @csrf
                        <select name="bulan" class="form-select form-select-sm-btn btn-secondary"
                            aria-label=".form-select-sm example">
                            <option selected>Pilih Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <button type="submit" class="btn btn-success">
                            Export PDF</button>
                    </form>



                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Denda</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ '/tambahdenda' }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" name="nama_denda" id="nama_denda" class="form-control"
                                                placeholder="Masukan Nama denda">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="jumlah_denda" id="jumlah_denda" class="form-control"
                                                placeholder="Masukan Jumlah denda">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Tambah Denda</button>
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
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabel Konfigurasi Denda</h3>
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
                                            <th>Nama Denda</th>
                                            <th>Jumlah Denda</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->nama_denda }}</td>
                                                <td>{{ $item->jumlah_denda }}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success btn-xs"
                                                        data-toggle="modal" data-target="#editModal">
                                                        <i class="fa fa-sticky-note" aria-hidden="true"></i> Edit
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                                        aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Denda</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ '/editdenda' }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id"
                                                                            id="id" value="{{ $item->id }}">
                                                                        <div class="mb-3">
                                                                            <input type="text" name="nama_denda"
                                                                                id="nama_denda" class="form-control"
                                                                                placeholder="Masukan Nama Denda"
                                                                                value="{{ $item->nama_denda }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <input type="text" name="jumlah_denda"
                                                                                id="jumlah_denda" class="form-control"
                                                                                placeholder="Masukan Jumlah Denda"
                                                                                value="{{ $item->jumlah_denda }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Edit
                                                                                Denda</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Button trigger modal -->
                                                    <form action="{{ url('/hapusdenda', $item->id) }}" method="GET">
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
                    </div>
                    <div class="col-md-8 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabel Data Denda</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama Peminjam</th>
                                            <th>Jumlah Denda</th>
                                            <th>Tanggal Pengembalian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datadenda as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->nama_anggota }}</td>
                                                <td>{{ $item->jumlah_denda }}</td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
