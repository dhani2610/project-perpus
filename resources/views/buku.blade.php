@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataBuku</h1>
                    </div>

                    <div class="container mt-4">
                        <a href="/tambahbuku" class="btn btn-primary">
                            <i class="fa fa-plus">Tambah Buku</i>
                        </a>
                    </div>
                </div>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header">

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-primary" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif
                                <table id="tabel-buku" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Sampul</th>
                                            <th>ISBN</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Rak</th>
                                            <th>Stok Buku</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($data as $buku => $row)
                                            <tr>
                                                <th scope="row">{{ $no++ }}</th>
                                                <td>
                                                    <img src="{{ asset('fotosampul/' . $row->sampul) }}" alt=""
                                                        style="width: 40px;">
                                                </td>
                                                <td>{{ $row->isbn }}</td>
                                                <td>{{ $row->judul }}</td>
                                                <td>{{ $row->nama_kategori }}</td>
                                                <td>{{ $row->nama_rak }}</td>
                                                <td>{{ $row->stokbuku - $row->totalBuku() }}</td>
                                                <td>{{ $row->created_at }}</td>
                                                <td>
                                                    <a href="/tampilkanbuku/{{ $row->b_id }}"
                                                        class="btn btn-info btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="/deletebuku/{{ $row->b_id }}"
                                                        class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $data->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <script>
        $(function() {
            $('#tabel-buku').DataTable({
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
            });
        });
    </script>
@endsection
