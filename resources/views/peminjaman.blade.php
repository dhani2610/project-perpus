@extends('layout.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Peminjaman</h1>
                    </div>
                    <div class="container mt-4">
                        <!-- Button trigger modal -->
                        @if (Auth::user()->role == 'admin') 
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
                                <i class="fas fa-plus">Tambah Peminjaman</i>
                            </button>
                        @endif
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Peminjaman</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('tambahpeminjaman') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label>Kode Pinjam</label>
                                            <input readonly type="text" name="kode_pinjam" id="kode_pinjam"
                                                class="form-control" value="{{ rand(10000, 99999) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Pilih Buku</label>
                                            <select id="inputStatus" name="id_buku" class="form-control custom-select">
                                                <option selected disabled>Select one</option>
                                                @foreach ($buku as $item)
                                                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" value="Pending" name="approval_peminjaman">
                                        <div class="mb-3">
                                            <label>Pilih Peminjam</label>
                                            <select id="inputStatus" name="id_peminjam" class="form-control custom-select">
                                                <option selected disabled>Select one</option>
                                                @foreach ($users as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Jumlah</label>
                                            <input type="number" min="0" name="jumlah_pinjaman" class="form-control" placeholder="Masukan Jumlah Pinjaman">
                                        </div>
                                        <div class="mb-3">
                                            <label>Tanggal Pinjam</label>
                                            <input type="date" name="tanggal_pinjam" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Tanggal Kembali</label>
                                            <input type="date" name="tanggal_kembali" class="form-control" readonly>
                                        </div>
                                        <script>
                                            let tanggalPinjamEl = document.querySelector('[name="tanggal_pinjam"]')
                                            tanggalPinjamEl.addEventListener('change', () => {
                                                let tanggalPinjam = new Date(tanggalPinjamEl.value)
                                                let tanggalKembali = new Date(tanggalPinjamEl.value)
                                                tanggalKembali.setDate(tanggalPinjam.getDate() + 7)
                                                document.querySelector('[name="tanggal_kembali"]').value = tanggalKembali.toISOString().slice(0, 10)
                                            })
                                        </script>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Tambah</button>
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
                    @if (Auth::user()->role == 'admin') 
                        <form action="{{ route('peminjaman.pdf') }}" method="POST">
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
                    @endif
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title">Tabel Peminjaman</h3>

                            </div>
                            <!-- /.card-header -->
                            {{-- Tabel Peminjaman --}}
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
                                                <th>Jumlah</th>
                                                <th>Tanggal Pinjam</th>
                                                <th>Tanggal Kembali</th>
                                                <th>Tanggal Pengembalian</th>
                                                <th>Status Persetujuan</th>
                                                <th>Status</th>
                                                <th>Pesan</th>
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
                                                    <td>{{ $item->jumlah_pinjaman }}</td>
                                                    <td>{{ $item->tanggal_pinjam }}</td>
                                                    <td>{{ $item->tanggal_kembali }}</td>
                                                    <td>
                                                        @if ($item->tanggal_pengembalian != null)
                                                            {{ $item->tanggal_pengembalian }}
                                                        @else
                                                        N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->approval_peminjaman == 'Pending')
                                                            <small class="badge text-white badge-warning">Dalam Proses
                                                                Persetujuan</small>
                                                        @elseif ($item->approval_peminjaman == 'Approve')
                                                            <small class="badge text-white badge-success">Sudah
                                                                Disetujui</small>
                                                        @elseif ($item->approval_peminjaman == 'Not Approve')
                                                            <small class="badge text-white badge-danger">Tidak 
                                                                Disetujui</small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->approval_peminjaman == 'Approve')
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
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->pesan != null)
                                                        <button class="btn btn-success btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalPersetujuan{{ $item->p_id }}">Pesan</button>
                                                        <div class="modal fade" id="exampleModalPersetujuan{{ $item->p_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>{{ $item->pesan }}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @else
                                                            <small class="badge text-white badge-warning">Belum Ada Pesan</small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('/peminjaman', $item->p_id) }}"
                                                            class="btn btn-success btn-xs">
                                                            <i class="fa fa-sticky-note" aria-hidden="true"></i> Cek
                                                        </a>
                                                        <!-- Button trigger modal -->
                                                        <form action="{{ url('/hapuspeminjaman', $item->p_id) }}"
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
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

                    @endsection
