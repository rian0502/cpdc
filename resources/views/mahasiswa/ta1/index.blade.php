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
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jquery-dateFormat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">


                <!-- PESAN -->
                {{-- @if ($seminar->keterangan) --}}
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
                                    {{-- {{ $seminar->keterangan }} --}}
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                {{-- @endif --}}
                <!-- PESAN -->

                <!-- Data Registrasi Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Data Registrasi</h4>
                            <small>
                                <b>
                                    <p {{-- class="mb-30 text-center {{ $seminar->proses_admin == 'Valid' ? 'Valid' : ($seminar->proses_admin == 'Proses' ? 'Proses' : 'Invalid') }}">
                                        {{ $seminar->proses_admin }} --}} </p>
                                </b>
                            </small>

                        </div>
                        {{-- @if ($seminar->status_seminar == 'Belum Selesai')
                        <a href="/mahasiswa/seminar/kp/{{ $seminar->encrypt_id }}/edit">
                            <button class="btn btn-primary right">Edit Data</button>
                        </a>
                        @endif --}}

                    </div>
                    <div class="">

                        <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Nomor Pokok Mahasiswa</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $mahasiswa->npm }} --}}
                                </div>
                                <label class="col-md-3 bold mt-2"><b>Pembimbing 1</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $seminar->dosen->nama_dosen }} --}}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"><b>Nama Mahasiswa</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $mahasiswa->nama_mahasiswa }} --}}
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Pembimbing 2</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $seminar->region }} --}}
                                </div>
                            </div>

                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Tahun Akademik</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $seminar->tahun_akademik }} --}}
                                </div>
                                <label class="col-md-3 bold mt-2"> <strong>Nomor Karyawan / NIP Pembimbing
                                        2</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $seminar->mitra }} --}}
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-1"> <strong>Semester</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $mahasiswa->semester }} --}}
                                </div>
                                <label class="col-md-3 bold"> <strong>Pembahas</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $seminar->pembimbing_lapangan }} --}}
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-2"> <strong>SKS</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $seminar->sks }} --}}
                                </div>
                                <label class="col-md-3 bold"> <strong>Rencana Seminar</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $seminar->ni_pemlap }} --}}
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-2"> <strong>IPK</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $seminar->ipk }} --}}
                                </div>
                                <label class="col-md-3 bold"> <strong>Berkas Kelengkapan</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a target="_blank" href="/uploads/syarat_seminar_ta1/">Unduh
                                        Berkas</a>
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-2"> <strong>TOEFL</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $seminar->toefl }} --}}
                                </div>

                                <label class="col-md-3 bold"> <strong></strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- Kosongkan --}}
                                </div>
                            </div>

                            <div class="row border-bottom mt-3">
                                <label class="col-md-12 bold"><b>Judul atau Topik Tugas Akhir</b></label>
                                <div class="col-md-12 mb-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $seminar->judul_kp }} --}}
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
                <!-- Data Registrasi End -->

                <!-- Jadwal Seminar Start -->
                {{-- @if ($seminar->proses_admin == 'Valid') --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Jadwal Seminar</h4>

                        </div>
                    </div>

                    <div class="jadwal_seminar">
                        <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Tanggal Seminar</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- @if ($seminar->jadwal)
                                            {{ $seminar->jadwal->tanggal_skp }}
                                        @else
                                            <div>Belum terjadwal</div>
                                        @endif --}}
                                </div>
                                <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- @if ($seminar->jadwal)
                                            {{ $seminar->jadwal->jam_mulai_skp }} WIB
                                        @else
                                            <div>Belum terjadwal</div>
                                        @endif --}}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Berkas Seminar</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a href="">Unduh Berkas</a>
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Jam Selesai</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- @if ($seminar->jadwal)
                                            {{ $seminar->jadwal->jam_selesai_skp }} WIB
                                        @else
                                            <div>Belum terjadwal</div>
                                        @endif --}}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Informasi Berkas</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <div>
                                        @if ($seminar->jadwal)
                                            Silahkan Cek Berkas Keperluan Seminar Di Email Anda
                                            hubungi admin berkas jika dalam 1x24 jam tidak menerima email Berkas
                                        @else
                                            <div>Belum terjadwal</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- Jadwal Seminar End -->

                <!-- Bukti Seminar Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Bukti Seminar</h4>
                            <small>
                                <b>
                                    <p {{-- class="mb-30 text-center {{  $seminar->status_seminar == 'Selesai' ? 'Valid' : ''}} "> --}} {{-- {{  $seminar->status_seminar == 'Selesai' ? 'Valid' : 'Proses'   }} --}} </p>
                                </b>
                            </small>
                        </div>
                        {{-- @if ($seminar->status_seminar != 'Selesai') --}}
                        {{-- @if ($berita_acara) --}}
                        <a href="/mahasiswa/bata1/edit">
                            <button class="btn btn-primary right">Edit</button>
                        </a>
                        {{-- @else --}}
                        <a href="/mahasiswa/bakerjapraktik/create">
                            <button class="btn btn-primary right">Unggah</button>
                        </a>
                        {{-- @endif --}}
                        {{-- @endif --}}
                        {{-- jika sudah diupload end --}}
                    </div>
                    {{-- @if ($berita_acara) --}}
                    <div class="bukti_seminar">
                        <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                            <div class="row border-bottom">
                                <label class="col-md-3 bold"> <strong>Bukti Seminar</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a href="/uploads/berita_acara_seminar_ta1/">Lihat</a>
                                </div>
                                <label class="col-md-3 bold mt-2"><b>No. Bukti Seminar</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $berita_acara->no_ba_seminar_kp }} --}}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Laporan Final TA 1</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a href="/uploads/laporan_kp/">Lihat</a>
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Status Bukti</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $seminar->status_seminar }} --}}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Nilai Lapangan</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $berita_acara->nilai_lapangan }} --}}
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Nilai Akademik</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $berita_acara->nilai_akd }} --}}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Nilai Total</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $berita_acara->nilai_akhir }} --}}
                                </div>
                                <label class="col-md-3 bold"> <strong>Huruf Mutu</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- <b> {{ $berita_acara->nilai_mutu }} </b> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @else --}}
                    <div class="bukti_seminar">
                        <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                            <div class="row border-bottom">
                                <label class="col-md-3 bold"> <strong>Bukti Seminar</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a href="">Belum Upload</a>
                                </div>
                                <label class="col-md-3 bold mt-2"><b>No. Bukti Seminar</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    -
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Laporan Final TA 1</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a href="">-</a>
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Status Bukti</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    -
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Nilai Seminar Angka</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    -
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Nilai TA 1 Angka</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    -
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Nilai Total</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    -
                                </div>
                                <label class="col-md-3 bold"> <strong>Nilai Seminar Huruf</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    -
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @endif --}}


                </div>
                {{-- @endif --}}
                <!-- Bukti Seminar End -->

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
