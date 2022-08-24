@extends('layout.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Prosess Peminjaman Anggota</h1>
                    </div>
                </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title">Tabel Prosess Peminjaman Anggota</h3>
                            </div>
                            <!-- /.card-header -->
                            {{-- Tabel Peminjaman --}}
                            <div class="card-body">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-primary" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif
                                @if ($message = Session::get('failed'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Kode Pinjam</th>
                                                <th>Peminjam</th>
                                                <th>Buku</th>
                                                <th>Tanggal Pinjam</th>
                                                <th>Tanggal Kembali</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas->where('approval_peminjaman','Pending') as $item)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->kode_pinjam }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->judul }}</td>
                                                    <td>{{ $item->tanggal_pinjam }}</td>
                                                    <td>{{ $item->tanggal_kembali }}</td>
                                                    <td>
                                                        @if (Auth::user()->role == 'admin')
                                                                <button class="btn btn-success btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalPersetujuan">Setuju</button>
                                                                <button class="btn btn-danger btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalPenolakan">Tidak</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalPersetujuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Masukan Pesan Persetujuan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('approve-peminjaman') }}" method="post">
                                                            @csrf
                                                                <div class="modal-body">
                                                                        <input type="hidden" value="{{ $item->p_id }}" name="idPeminjam">
                                                                        <textarea name="pesan" class="form-control" id="" cols="30" rows="10"></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="exampleModalPenolakan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Masukan Pesan Penolakan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('not-approve-peminjaman') }}" method="post">
                                                            @csrf
                                                                <div class="modal-body">
                                                                        <input type="hidden" value="{{ $item->p_id }}" name="idPeminjam">
                                                                        <textarea name="pesan" class="form-control" id="" cols="30" rows="10"></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                      
                    @endsection
