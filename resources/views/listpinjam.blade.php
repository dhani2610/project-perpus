@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Pengembalian</h1>
                    </div>
                    <!-- Modal -->
                </div>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabel Pengembalian</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-primary" role="alert">
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
                                                <th>Tanggal Pengembalian</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $item)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $item->kode_pinjam }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->judul }}</td>
                                                    <td>{{ $item->tanggal_pinjam }}</td>
                                                    <td>{{ $item->tanggal_kembali }}</td>
                                                    <td>{{ $item->tanggal_pengembalian }}</td>
                                                    <td>
                                                        @if ($item->status == 0)
                                                            <small class="badge text-white badge-warning">Dalam
                                                                Peminjaman</small>
                                                            @if (now()->toDateString() > $item->tanggal_kembali)
                                                                <small
                                                                    class="badge text-white badge-danger">Terlambat</small>
                                                            @endif
                                                        @elseif ($item->status == 1)
                                                            <small class="badge text-white badge-success">Sudah
                                                                Kembali</small>
                                                            @if (now()->toDateString() > $item->tanggal_kembali)
                                                                <small
                                                                    class="badge text-white badge-danger">Terlambat</small>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('/peminjaman', $item->p_id) }}"
                                                            class="btn btn-success btn-xs">
                                                            <i class="fa fa-sticky-note" aria-hidden="true"></i> Cek
                                                        </a>
                                                        <!-- Button trigger modal -->
                                                        {{-- <button type="button" class="btn btn-success btn-xs" data-toggle="modal"
                                                    data-target="#editModal">
                                                    <i class="fa fa-sticky-note" aria-hidden="true"></i> Cek
                                                </button> --}}


                                                        <!-- Modal -->
                                                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                                            aria-labelledby="modelTitleId" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Cek Peminjaman</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ '/editpinjam' }}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="id"
                                                                                id="id" value="{{ $item->p_id }}">
                                                                            <div class="mb-3">
                                                                                <label>Kode Pinjam</label>
                                                                                <input readonly type="text"
                                                                                    name="kode_pinjam" id="kode_pinjam"
                                                                                    class="form-control"
                                                                                    value="{{ $item->kode_pinjam }}">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label>Tanggal Kembali</label>
                                                                                <input type="date"
                                                                                    name="tanggal_pengembalian"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Proses
                                                                                    Pengembalian</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endsection
