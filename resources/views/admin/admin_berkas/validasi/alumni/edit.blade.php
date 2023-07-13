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
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jquery-dateFormat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Data Registrasi Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix" style="margin-bottom: 50px; margin-top: 10px;">
                        <div class="pull-left">
                            <h4 class="text-dark h4" style="margin-left: 10px">Data Registrasi</h4>
                        </div>
                        {{-- <a href="/mahasiswa/seminar/kp/create">
                            <button class="btn btn-primary right">Edit Data</button>
                        </a> --}}

                    </div>
                    <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                        <div class="row border-bottom">
                            <label class="col-md-3 bold mt-2"> <strong>Nomor Pokok Mahasiswa</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                {{-- {{ $mahasiswa->npm }} --}}
                            </div>
                            <label class="col-md-3 bold mt-2"><b>IPK</b></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                {{-- {{ $seminar->pembimbing_satu->nama_dosen }} --}}
                            </div>
                        </div>
                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold"><b>Nama Mahasiswa</b></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                {{-- {{ $mahasiswa->nama_mahasiswa }} --}}
                            </div>
                            <label class="col-md-3 bold mt-1"><strong>Nilai</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">

                            </div>
                        </div>

                        <div class="row border-bottom">
                            <label class="col-md-3 bold mt-2"> <strong>Tahun Akademik</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $seminar->tahun_akademik }} --}}
                            </div>
                            <label class="col-md-3 bold mt-2"> <strong>TOEFL</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">

                            </div>
                        </div>

                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold mt-1"> <strong>Semester</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $mahasiswa->semester }} --}}
                            </div>
                            <label class="col-md-3 bold"> <strong>SKS Akhir</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                {{-- {{ $seminar->pembahas->nama_dosen }} --}}
                            </div>
                        </div>

                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold mt-1"> <strong>Masa Studi</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $mahasiswa->semester }} --}}
                            </div>
                            <label class="col-md-3 bold mt-1"> <strong>Nomor Telepon</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $mahasiswa->semester }} --}}
                            </div>
                        </div>
                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold mt-1"> <strong>Rencana Setelah Lulus</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $mahasiswa->semester }} --}}
                            </div>
                            <label class="col-md-3 bold"> <strong>Tim Penguji</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                <a href="/mahasiswa/pendataan_alumni/show">Lihat Penguji</a>
                            </div>
                        </div>

                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold mt-2"> <strong>Rencana Periode Wisuda</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $seminar->sks }} --}}
                            </div>
                            <label class="col-md-3 bold"> <strong>Berkas TOEFL</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                <a target="_blank" href="/uploads/syarat_seminar_ta1/{{-- $seminar->berkas_ta_satu --}}">Lihat
                                    Berkas</a>
                            </div>
                        </div>

                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold mt-2"> <strong>Tanggal Lulus Komprehensif</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                {{-- {{ $seminar->ipk }} --}}
                            </div>
                            <label class="col-md-3 bold"> <strong>Berkas Transkrip</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                <a target="_blank" href="/uploads/syarat_seminar_ta1/{{-- $seminar->berkas_ta_satu --}}">Lihat
                                    Berkas</a>
                            </div>
                        </div>
                        <div class="row border-bottom mt-3">
                            <label class="col-md-12 bold"><b>Judul atau Topik Tugas Akhir</b></label>
                            <div class="col-md-12 mb-3 text-justify" style="display:block;word-wrap:break-word;">
                                {{-- {{ $seminar->judul_ta }} --}}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Data Registrasi End -->

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
