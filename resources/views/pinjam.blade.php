@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h1>DataBuku</h1>
                    </div>
                    <div class="col-md-5">
                        <form action="{{ url('/buku/search') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cari Buku"
                                    aria-label="Example text with button addon" aria-describedby="button-addon1"
                                    name="search">
                            </div>
                        </form>
                    </div>
                    <!-- Modal -->
                </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if ($message = Session::get('success'))
                    <div class="alert alert-primary" role="alert">
                        {{ $message }}
                    </div>
                @endif
                <div class="row">
                    {{-- {{ dd($buku,$data) }} --}}
                    @foreach ($data as $item)
                        {{-- <div class="col-md-3" style="height: 200px"> --}}
                        <div class="card mx-2" style="max-width: 200px">
                            <img class="card-img-top" src="{{ asset('fotosampul/' . $item->sampul) }}" width="100%"
                                alt="">

                            <div class="card-header">
                                <h3 class="card-title">{{ $item->judul }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card-text">Kategori : {{ $item->nama_kategori }}</div>
                                <div class="card-text">Rak : {{ $item->nama_rak }}</div>
                                <div class="card-text">ISBN : {{ $item->isbn }}</div>
                                <div class="card-text">Penerbit : {{ $item->penerbit }}</div>
                                <div class="card-text">Tahun : {{ $item->tahunbuku }}</div>
                                <div class="card-text">Jumlah : {{ $item->stokbuku - $item->totalBuku() }}</div>
                                <div class="card-text text-center mt-2">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelPINJAMAN{{ $item->isbn }}">
                                        Pinjam
                                    </button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="modelPINJAMAN{{ $item->isbn }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
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
                                                <form action="{{ '/tambahpeminjaman' }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label>Kode Pinjam</label>
                                                        <input readonly type="text" name="kode_pinjam" id="kode_pinjam"
                                                            class="form-control" value="{{ rand(10000, 99999) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Buku</label>
                                                        <select id="inputStatus" name="id_buku" class="form-control custom-select">
                                                            <option selected disabled>Select one</option>
                                                            @foreach ($buku->where('id',$item->b_id) as $itemBuku)
                                                                <option selected value="{{ $itemBuku->id}}">{{ $itemBuku->judul }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <input type="hidden" value="Pending" name="approval_peminjaman">
                                                    <div class="mb-3">
                                                        <label>Peminjam</label>
                                                        <select id="inputStatus" name="id_peminjam" class="form-control custom-select">
                                                            <option selected disabled>Select one</option>
                                                            @foreach ($users->where('id',Auth()->user()->id) as $item)
                                                                <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Jumlah</label>
                                                        <input type="number" min="0" name="jumlah_pinjaman" class="form-control" placeholder="Masukan Jumlah Pinjaman">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Tanggal Pinjam</label>
                                                        <input type="date" name="tanggal_pinjam" class="form-control tanggal_pinjam">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Tanggal Kembali</label>
                                                        <input type="date" name="tanggal_kembali" class="form-control tanggal_kembali" readonly>
                                                    </div>
                                                  
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <script>
                $('.tanggal_pinjam').on('change', function() { 
                    let tanggalPinjam = new Date(this.value)
                    let tanggalKembali = new Date(this.value)
                    tanggalKembali.setDate(tanggalPinjam.getDate() + 7)
                    let tanggallast = tanggalKembali.toISOString().slice(0, 10)
                    $('.tanggal_kembali').val(tanggallast);
                });
              
            </script>
    @endsection
