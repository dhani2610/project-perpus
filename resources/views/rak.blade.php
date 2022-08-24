@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Rak</h1>
                    </div>

                    <div class="container mt-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
                            Tambah Rak
                        </button>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Rak</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ '/tambahrak' }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" name="nama_rak" id="nama_rak" class="form-control"
                                                placeholder="Masukan Nama Rak">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Tambah Rak</button>
                                        </div>
                                    </form>
                                </div>
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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabel Rak</h3>
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
                                            <th>Rak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->nama_rak }}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success btn-xs"
                                                        data-toggle="modal" data-target="#editModal"
                                                        onclick="showEditModal({{ $item }})">
                                                        <i class="fa fa-sticky-note" aria-hidden="true"></i> Edit
                                                    </button>



                                                    <!-- Button trigger modal -->
                                                    <form action="{{ url('/hapusrak', $item->id) }}" method="GET">
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
                                <!-- Modal -->
                                <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                    aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Rak</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ '/editrak' }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" id="id_rak" value="">
                                                    <div class="mb-3">
                                                        <input type="text" name="nama_rak" id="rakName"
                                                            class="form-control" placeholder="Masukan Nama Rak"
                                                            value="">
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">Edit
                                                            Rak</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function showEditModal(item) {
                                        document.getElementById('id_rak').value = item.id
                                        document.getElementById('rakName').value = item.nama_rak
                                    }
                                </script>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
