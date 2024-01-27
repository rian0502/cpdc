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
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Data Mahasiswa</h4>
                        </div>
                    </div>
                    <div class="">
                        <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Nomor Pokok Mahasiswa</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->mahasiswa->npm }}
                                </div>
                                <label class="col-md-3 bold mt-2"><b>Pembimbing 1</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->pembimbingSatu->nama_dosen }}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"><b>Nama Mahasiswa</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->mahasiswa->nama_mahasiswa }}
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Pembimbing 2</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    @if ($seminar->pembimbingDua)
                                        {{ $seminar->pembimbingDua->nama_dosen }}
                                    @else
                                        {{ $seminar->pbl2_nama }}
                                    @endif
                                </div>
                            </div>

                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Tahun Akademik</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->tahun_akademik }}
                                </div>
                                <label class="col-md-3 bold mt-2"> <strong>NI Pembimbing Eksternal</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    @if ($seminar->pbl2_nip)
                                        {{ $seminar->pbl2_nip }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-1"> <strong>Semester</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->semester }}
                                </div>
                                <label class="col-md-3 bold"> <strong>Pembahas</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->pembahas->nama_dosen }}
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-2"> <strong>SKS</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->sks }}
                                </div>
                                <label class="col-md-3 bold"> <strong>Rencana Seminar</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->periode_seminar }}
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-2"> <strong>IPK</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->ipk }}
                                </div>
                                <label class="col-md-3 bold"> <strong>Berkas Kelengkapan</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a target="_blank"
                                        href="/uploads/syarat_seminar_ta2/{{ $seminar->berkas_ta_dua }}">Lihat
                                        Berkas</a>
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-2"> <strong>TOEFL</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->toefl }}
                                </div>

                                <label class="col-md-3 bold"> <strong></strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->status_seminar }}
                                </div>
                            </div>

                            <div class="row border-bottom mt-3">
                                <label class="col-md-12 bold"><b>Judul atau Topik Tugas Akhir</b></label>
                                <div class="col-md-12 mb-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->judul_ta }}
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                @if ($seminar->jadwal)
                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix" style="margin-bottom: 50px; margin-top: 10px;">
                            <div class="pull-left">
                                <h4 class="text-dark h4" style="margin-left: 10px">Jadwal Sidang TA</h4>
                            </div>
                        </div>
                        <div class="">
                            <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                                <div class="row border-bottom">
                                    <label class="col-md-3 bold mt-2"> <strong>Tanggal Seminar</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->jadwal->tanggal_komprehensif }}
                                    </div>
                                    <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->jadwal->jam_mulai_komprehensif }}
                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"><b>Jam Selesai</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->jadwal->jam_selesai_komprehensif }}
                                    </div>
                                    <label class="col-md-3 bold mt-1"><strong>Lokasi</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->jadwal->lokasi->nama_lokasi }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($seminar->beritaAcara)
                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix" style="margin-bottom: 50px; margin-top: 10px;">
                            <div class="pull-left">
                                <h4 class="text-dark h4" style="margin-left: 10px">Berita Acara Sidang TA</h4>
                            </div>
                        </div>
                        <div class="">
                            <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                                <div class="row border-bottom">
                                    <label class="col-md-3 bold mt-2"> <strong>No. Berita Acara</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->beritaAcara->no_ba_berkas }}
                                    </div>
                                    <label class="col-md-3 bold mt-2"><b>Nilai</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->beritaAcara->nilai }}
                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"><b>Huruf Mutu</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->beritaAcara->huruf_mutu }}
                                    </div>
                                    <label class="col-md-3 bold mt-1"><strong>Laporan</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        <a target="_blank" href="{{ $seminar->beritaAcara->laporan_ta }}">Lihat</a>
                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"><b>Berkas Nilai</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        <a target="_blank"
                                            href="{{ Str::contains($seminar->beritaAcara->berkas_nilai_kompre, 'drive.google.com')
                                                ? $seminar->beritaAcara->berkas_nilai_kompre
                                                : '/uploads/nilai_sidang_kompre/' . $seminar->beritaAcara->berkas_nilai_kompre }}">Lihat</a>
                                    </div>
                                    <label class="col-md-3 bold mt-1"><strong>Berita Acara</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        <a target="_blank"
                                            href="{{ Str::contains($seminar->beritaAcara->ba_seminar_komprehensif, 'drive.google.com')
                                                ? $seminar->beritaAcara->ba_seminar_komprehensif
                                                : '/uploads/ba_sidang_kompre/' . $seminar->beritaAcara->ba_seminar_komprehensif }}">Lihat</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
