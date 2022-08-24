@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Peminjaman Atas Nama - {{ $datas->name }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-primary" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <div class="col-md-4"><b>Nama Peminjam</b></div>
                                    <div class="col-md-6">: {{ $datas->name }}</div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4"><b>Tanggal Peminjaman</b></div>
                                    <div class="col-md-6">: {{ $datas->tanggal_pinjam }}</div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4"><b>Tanggal Pengembalian</b></div>
                                    <div class="col-md-6">: {{ $datas->tanggal_kembali }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><b>Detail Peminjam :</b></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">Nama Peminjam</div>
                                    <div class="col-md-6">: {{ $datas->name }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">Email Peminjam</div>
                                    <div class="col-md-6">: {{ $datas->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><b>Lama Keterlambatan</b></div>
                                    <div class="col-md-6">
                                        : {{ Carbon::parse($diff)->diffInDays(Carbon::parse($datas->tanggal_kembali)) }}
                                        Hari
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><b>Lama Peminjaman</b></div>
                                    <div class="col-md-6">
                                        : {{ $diff }} Hari
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Buku - {{ $datas->judul }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-primary" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <div class="col-md-4"><b>Status</b></div>
                                    <div class="col-md-6">:
                                        @if ($datas->status == 0)
                                            <small class="badge text-white badge-warning">Dalam Peminjaman</small>
                                            @if (now()->toDateString() > $datas->tanggal_kembali)
                                                <small class="badge text-white badge-danger">Terlambat</small>
                                            @endif
                                        @elseif ($datas->status == 1)
                                            <small class="badge text-white badge-success">Sudah Kembali</small>
                                            @if (now()->toDateString() > $datas->tanggal_kembali)
                                                <small class="badge text-white badge-danger">Terlambat</small>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4"><b>Denda:</b></div>
                                    <div class="col-md-6">:
                                        @if (now()->toDateString() > $datas->tanggal_kembali)
                                            <small class="badge text-white badge-danger">{{ $dendanya }} -
                                                {{ $jenisnya }}</small>
                                        @else
                                            <small class="badge text-white badge-success">Tidak Ada Denda</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4"><b>Kode Peminjaman</b></div>
                                    <div class="col-md-6">: {{ $datas->kode_pinjam }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"><b>Detail Buku :</b></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">ISBN</div>
                                    <div class="col-md-6">: {{ $datas->isbn }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">Nama Buku</div>
                                    <div class="col-md-6">: {{ $datas->judul }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">Kategori</div>
                                    <div class="col-md-6">: {{ $datas->kategori }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">Rak Buku</div>
                                    <div class="col-md-6">: {{ $datas->rak }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
