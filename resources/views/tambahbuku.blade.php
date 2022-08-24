@extends('layout.admin')

@section('content')
    <div class="content-wrapper">

        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content mt-5 pt-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <form action="/insertbuku" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputStatus">Kategori</label>
                                    <select id="kategori" name="kategori" class="form-control custom-select">
                                        <option selected disabled>Pilih Kategori</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Rak</label>
                                    <select id="rak" name="rak" class="form-control custom-select">
                                        <option selected disabled>Pilih Rak</option>
                                        @foreach ($rak as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_rak }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputEstimatedBudget">ISBN</label>
                                    <input type="number" name="isbn" id="inputEstimatedBudget" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Judul Buku</label>
                                    <input type="text" name="judul" id="inputName" class="form-control">
                                </div>
                                {{-- <div class="form-group">
                                <label for="inputName">Nama Pengarang</label>
                                <input type="text" id="inputName" class="form-control">
                            </div> --}}
                                <div class="form-group">
                                    <label for="inputName">Penerbit</label>
                                    <input type="text" name="penerbit" id="inputName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputEstimatedBudget">Tahun Buku</label>
                                    <input type="number" name="tahunbuku" id="inputEstimatedBudget" class="form-control">
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
                                <input type="number" name="stokbuku" id="inputEstimatedBudget" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Masukan Sampul Buku </label>
                                <input type="file" name="sampul" class="form-control">
                            </div>
                            <div class="mb-3">
                                <a href="/buku" class="btn btn-secondary">Cancel</a>
                                <input type="submit" value="Submit" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    @endsection
