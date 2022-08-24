@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="card mt-5" id="printthis">
                            <div class="card-header d-flex justify-content-center">
                                <h3 class="card-title">Kartu Anggota Perpustakaan SMA NEGERI 2 BANGKO</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-primary" role="alert">
                                        {{ $message }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row d-flex justify-content-center mt-3">
                                            <div class="col-md-3">
                                                Nama
                                            </div>
                                            <div class="col-md-6">
                                                : {{ $user->name }}
                                            </div>
                                        </div>
                                        <hr style="background-color: white" />
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-3">
                                                Email
                                            </div>
                                            <div class="col-md-6">
                                                : {{ $user->email }}
                                            </div>
                                        </div>
                                        <hr style="background-color: white" />
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-3">
                                                TTL
                                            </div>
                                            <div class="col-md-6">
                                                : {{ $user->tempat_lahir }}, {{ $user->tanggal_lahir }}
                                            </div>
                                        </div>
                                        <hr style="background-color: white" />
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-3">
                                                Alamat
                                            </div>
                                            <div class="col-md-6">
                                                : {{ $user->alamat }}
                                            </div>
                                        </div>
                                        <hr style="background-color: white" />

                                    </div>
                                    <div class="col-md-6">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-4">
                                                @if ($user->profile_pict == null)
                                                    <img src="{{ asset('template/dist/img/avatar.png') }}"
                                                        class="elevation-5" alt="User Image">
                                                @else
                                                    <img style="width: 190px"
                                                        src="{{ asset('gambar/' . $user->profile_pict) }}"
                                                        class="elevation-5" alt="User Image">
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-info btn-sm" onclick="printDiv('printthis')">
                                    <i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        function printDiv(printthis) {
            var printContents = document.getElementById(printthis).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
