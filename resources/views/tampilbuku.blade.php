@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Data Buku</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <form action="/updatebuku/{{ $data->b_id }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputStatus">Kategori</label>
                                    <select id="inputStatus" name="kategori" class="form-control custom-select">
                                        <option selected disabled>{{ $data->nama_kategori }}</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Rak</label>
                                    <select id="inputStatus" name="rak" class="form-control custom-select">
                                        <option selected disabled>{{ $data->nama_rak }}</option>
                                        @foreach ($rak as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_rak }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputEstimatedBudget">ISBN</label>
                                    <input type="number" name="isbn" id="inputEstimatedBudget" class="form-control"
                                        value="{{ $data->isbn }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Judul Buku</label>
                                    <input type="text" name="judul" id="inputName" class="form-control"
                                        value="{{ $data->judul }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputName">Penerbit</label>
                                    <input type="text" name="penerbit" id="inputName" class="form-control"
                                        value="{{ $data->penerbit }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputEstimatedBudget">Tahun Buku</label>
                                    <input type="number" name="tahunbuku" id="inputEstimatedBudget" class="form-control"
                                        value="{{ $data->tahunbuku }}">
                                </div>
                            </div>
                            <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">

                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputEstimatedBudget">Jumlah Buku</label>
                                <input type="number" name="stokbuku" id="inputEstimatedBudget" class="form-control"
                                    value="{{ $data->stokbuku }}">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <a href="/buku" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
                </form>
            </div>
        </section>
    </div>
    </body>

    </html>
@endsection
