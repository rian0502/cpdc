@extends('layouts.admin')
@section('admin')
    <style>
        .left {
            text-align: left;
        }

        .center {
            text-align: center;
        }

        .centered-text {
            text-align: left;
            display: inline-block;
        }

        a:hover {
            cursor: pointer;
        }

        .right {
            float: right;
        }

        .Valid {
            background-color: #198754;
            color: white;
        }

        .Proses {
            background-color: #0dcaf0;
            color: white;
        }

        .Invalid {
            background-color: #dc3545;
            color: white
        }

        .Failed {
            background-color: black;
            color: white
        }
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jquery-dateFormat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- PESAN -->
                @if ($pendataan->komentar)
                    <div class="pd-20 card-box mb-30 bg-warning">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-dark h4">Pesan</h4>
                                <small>

                                    <p class="mb-30"></p>
                                </small>
                            </div>
                        </div>

                        <div class="jadwal_seminar">
                            <div class="pl-3 pr-3 pb-0 mb-2 text-dark rounded-div">
                                <div class="row mt-3">
                                    {{-- <label class="col-md-12 bold"><b>Pesan</b></label> --}}
                                    <div class="col-md-12 mb-3"
                                        style="display:block;word-wrap:break-word; text-align: justify;">
                                        {{ $pendataan->komentar }}
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                @endif
                <!-- PESAN -->

                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4" style="margin-bottom: 50px">Pendataan Alumni</h4>
                            <small>
                                <b>
                                    <p
                                        class="mb-30 text-center
                                        {{ $pendataan->status == 'Valid' ? 'Valid' : ($pendataan->status == 'Pending' ? 'Proses' : 'Invalid') }}">
                                        {{ $pendataan->status }} </p>
                                </b>
                            </small>
                        </div>
                        @if ($pendataan->status != 'Valid')
                            <a href="{{ route('mahasiswa.pendataan_alumni.edit', $pendataan->encrypted_id) }}">
                                <button class="btn btn-primary right">Edit Data</button>
                            </a>
                        @endif
                    </div>

                    <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                        <div class="row border-bottom">
                            <label class="col-md-3 bold mt-2"> <strong>Tahun Akademik</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->tahun_akademik }}
                            </div>
                            <label class="col-md-3 bold mt-2"><b>SKS</b></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->sks }}
                            </div>
                        </div>
                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold"><b>IPK</b></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->ipk }}
                            </div>
                            <label class="col-md-3 bold mt-1"><strong>Tanggal Lulus</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->tgl_lulus }}
                            </div>
                        </div>

                        <div class="row border-bottom">
                            <label class="col-md-3 bold mt-2"> <strong>Masa Studi</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->masa_studi }}
                            </div>
                            <label class="col-md-3 bold mt-2"> <strong>Waktu Wisuda</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->periode_wisuda }}
                            </div>
                        </div>

                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold mt-1"> <strong>TOEFL</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->toefl }}
                            </div>
                            <label class="col-md-3 bold"> <strong>Berkas TOEFL</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                <a target="_blank" href="/uploads/berkas_toefl/{{ $pendataan->berkas_toefl }}">Lihat</a>
                            </div>
                        </div>

                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold mt-1"> <strong>Berkas Transkrip</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                <a target="_blank" href="/uploads/transkrip/{{ $pendataan->transkrip }}">Lihat</a>
                            </div>
                            <label class="col-md-3 bold mt-1"> <strong>Lembar Pengesahan</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                <a target="_blank"
                                    href="/uploads/berkas_pengesahan/{{ $pendataan->berkas_pengesahan }}">Lihat</a>
                            </div>
                        </div>

                    </div>


                </div>

            </div>

        </div>


    </div>
    </div>
    <!-- Input Validation End -->
    </div>

    <script>
        // Mendapatkan elemen select
        var select = document.getElementById("tahunAkademik");

        // Mendapatkan tahun saat ini
        var tahunSekarang = new Date().getFullYear();

        // Loop untuk menghasilkan 5 tahun ke belakang
        for (var i = 0; i < 5; i++) {
            var tahun = tahunSekarang - i;
            var option = document.createElement("option");
            option.value = tahun + "/" + (tahun + 1);
            option.text = tahun + "/" + (tahun + 1);
            select.add(option);
        }
    </script>
@endsection
