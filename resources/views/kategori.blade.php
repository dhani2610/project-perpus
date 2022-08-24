@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Kategori</h1>
                    </div>

                    <div class="container mt-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
                            Tambah Kategori
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ '/tambahkategori' }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" name="nama_kategori" id="nama_kategori"
                                                class="form-control" placeholder="Masukan Nama Kategori">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Tambah Kategori</button>
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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabel Kategori</h3>
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
                                            <th>Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->nama_kategori }}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success btn-xs edit-modal"
                                                        data-toggle="modal" data-target="#editModal"
                                                        onclick="showEditModal({{ $item }})">
                                                        <i class="fa fa-sticky-note" aria-hidden="true"></i> Edit
                                                    </button>
                                                    <!-- Button trigger modal -->

                                                    <form action="{{ url('/hapuskategori', $item->id) }}" method="GET">
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
                                                <h5 class="modal-title">Edit Kategori</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ '/editkategori' }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" id="id_kategori" value="">
                                                    <div class="mb-3">
                                                        <input type="text" name="nama_kategori" id="categoryName"
                                                            class="form-control" placeholder="Masukan Nama Kategori"
                                                            value="">
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">Edit
                                                            Kategori</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function showEditModal(item) {
                                        document.getElementById('id_kategori').value = item.id
                                        document.getElementById('categoryName').value = item.nama_kategori
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
