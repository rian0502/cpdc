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
                                <label class="col-md-3 bold mt-2"><b>Dosen Pembimbing</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->dosen->nama_dosen }}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"><b>Nama Mahasiswa</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->mahasiswa->nama_mahasiswa }}
                                </div>
                                <label class="col-md-3 bold"> <strong>NI Pembimbing Lapangan</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->ni_pemlap }}
                                </div>
                            </div>

                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Tahun Akademik</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->tahun_akademik }}
                                </div>
                                <label class="col-md-3 bold mt-2"> <strong>Pembimbing Lapangan</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->pembimbing_lapangan }}
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-1"> <strong>Semester</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->mahasiswa->semester }}
                                </div>
                                <label class="col-md-3 bold mt-2"> <strong>SKS</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->sks }}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-1"> <strong>Mitra</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->mitra }}
                                </div>
                                <label class="col-md-3 bold mt-2"> <strong>Lokasi</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->region }}
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
                                        href="{{ Str::contains($seminar->berkas_seminar_pkl, 'drive.google.com')
                                            ? $seminar->berkas_seminar_pkl
                                            : '/uploads/syarat_seminar_kp/' . $seminar->berkas_seminar_pkl }}">Lihat</a>
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-2"> <strong>TOEFL</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->toefl }}
                                </div>

                                <label class="col-md-3 bold"> <strong>Rencana Seminar</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->rencana_seminar }}
                                </div>
                            </div>

                            <div class="row border-bottom mt-3">
                                <label class="col-md-12 bold"><b>Judul atau Topik Tugas Akhir</b></label>
                                <div class="col-md-12 mb-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->judul_kp }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($seminar->jadwal)
                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix" style="margin-bottom: 50px; margin-top: 10px;">
                            <div class="pull-left">
                                <h4 class="text-dark h4" style="margin-left: 10px">Jadwal Seminar PKL</h4>
                            </div>
                        </div>
                        <div class="">
                            <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                                <div class="row border-bottom">
                                    <label class="col-md-3 bold mt-2"> <strong>Tanggal Seminar</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->jadwal->tanggal_skp }}
                                    </div>
                                    <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->jadwal->jam_mulai_skp }}
                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"><b>Jam Selesai</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->jadwal->jam_selesai_skp }}
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
                @if ($seminar->berita_acara)
                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix" style="margin-bottom: 50px; margin-top: 10px;">
                            <div class="pull-left">
                                <h4 class="text-dark h4" style="margin-left: 10px">Berita Acara Seminar PKL</h4>
                            </div>
                        </div>
                        <div class="">
                            <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                                <div class="row border-bottom">
                                    <label class="col-md-3 bold mt-2"> <strong>No. Berita Acara</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->berita_acara->no_ba_seminar_kp }}
                                    </div>
                                    <label class="col-md-3 bold mt-2"><b>Nilai Lapangan</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->berita_acara->nilai_lapangan }}
                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"><b>Nilai Akademik</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->berita_acara->nilai_akd }}
                                    </div>
                                    <label class="col-md-3 bold mt-1"><strong>Nilai Akhir</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->berita_acara->nilai_akhir }}
                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"><b>Huruf Mutu</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->berita_acara->nilai_mutu }}
                                    </div>
                                    <label class="col-md-3 bold mt-1"><strong>Berita Acara</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        <a target="_blank"
                                            href="{{ Str::contains($seminar->berita_acara->berkas_ba_seminar_kp, 'drive.google.com')
                                                ? $seminar->berita_acara->berkas_ba_seminar_kp
                                                : '/uploads/berita_acara_seminar_kp/' . $seminar->berita_acara->berkas_ba_seminar_kp }}">Lihat</a>
                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold mt-1"><strong>Laporan</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        <a target="_blank"
                                            href="{{ Str::contains($seminar->berita_acara->laporan_kp, 'drive.google.com')
                                                ? $seminar->berita_acara->laporan_kp
                                                : '/uploads/laporan_kp/' . $seminar->berita_acara->laporan_kp }}">Lihat</a>
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
