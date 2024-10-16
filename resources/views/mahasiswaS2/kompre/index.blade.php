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
                @if ($seminar->komentar)
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
                                        {{ $seminar->komentar }}
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                @endif
                <!-- PESAN -->

                <!-- Data Registrasi Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Data Registrasi</h4>
                            <small>
                                <b>
                                    <p
                                        class="mb-30 text-center
                                        {{ $seminar->status_admin == 'Valid' ? 'Valid' : ($seminar->status_admin == 'Process' ? 'Proses' : 'Invalid') }}">
                                        {{ $seminar->status_admin }} </p>
                                </b>
                            </small>

                        </div>
                        @if ($seminar->status_admin != 'Valid')
                            <a href="{{ route('mahasiswa.sidang.kompres2.edit', $seminar->encrypt_id) }}">
                                <button class="btn btn-primary right">Edit Data</button>
                            </a>
                        @endif

                    </div>
                    <div class="">
                        <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Nomor Pokok Mahasiswa</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $mahasiswa->npm }}
                                </div>
                                <label class="col-md-3 bold mt-2"><b>Pembimbing 1</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->pembimbingSatu->nama_dosen }}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"><b>Nama Mahasiswa</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $mahasiswa->nama_mahasiswa }}
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Pembimbing 2</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    @if ($seminar->id_pembimbing_2)
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
                                <label class="col-md-3 bold mt-1"><strong>Pembahas 1</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    @if ($seminar->id_pembahas_1)
                                        {{ $seminar->pembahasSatu->nama_dosen }}
                                    @else
                                        {{ $seminar->pembahas_external_1 }}
                                    @endif
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-1"> <strong>Semester</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{ $mahasiswa->semester }}
                                </div>
                                <label class="col-md-3 bold"> <strong>Pembahas 2</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    @if ($seminar->id_pembahas_2)
                                        {{ $seminar->pembahasDua->nama_dosen }}
                                    @else
                                        {{ $seminar->pembahas_external_2 }}
                                    @endif
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-2"> <strong>SKS</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->sks }}
                                </div>
                                <label class="col-md-3 bold"> <strong>Pembahas 3</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    @if ($seminar->id_pembahas_3)
                                        {{ $seminar->pembahasTiga->nama_dosen }}
                                    @else
                                        {{ $seminar->pembahas_external_3 }}
                                    @endif
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
                                        href="/uploads/syarat_seminar_sidang_s2/{{ $seminar->berkas_kompre }}">Lihat
                                        Berkas</a>
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-2"> <strong>TOEFL</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->toefl }}
                                </div>

                                <label class="col-md-3 bold"> <strong>Rencana Seminar</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->periode_seminar }}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
    
                            </div>
                            <div class="row border-bottom mt-3">
                                <label class="col-md-12 bold"><b>Judul Tesis</b></label>
                                <div class="col-md-12 mb-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->judul_ta }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Data Registrasi End -->

                <!-- Jadwal Seminar Start -->
                @if ($seminar->status_admin == 'Valid')
                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <div class="pull-left mb-4">
                                <h4 class="text-dark h4">Jadwal Seminar</h4>

                            </div>
                        </div>

                        <div class="jadwal_seminar">
                            <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                                <div class="row border-bottom">
                                    <label class="col-md-3 bold mt-2"> <strong>Tanggal Seminar</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        @if ($seminar->jadwal)
                                            {{ $seminar->jadwal->tanggal }}
                                        @else
                                            <div>Belum terjadwal</div>
                                        @endif

                                    </div>
                                    <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">

                                        @if ($seminar->jadwal)
                                            {{ $seminar->jadwal->jam_mulai }} WIB
                                        @else
                                            <div>Belum terjadwal</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"> <strong>Lokasi Seminar</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        @if ($seminar->jadwal)
                                            {{ $seminar->jadwal->lokasi->nama_lokasi }}
                                        @else
                                            <div>Belum terjadwal</div>
                                        @endif
                                    </div>
                                    <label class="col-md-3 bold mt-1"><strong>Jam Selesai</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        @if ($seminar->jadwal)
                                            {{ $seminar->jadwal->jam_selesai }} WIB
                                        @else
                                            <div>Belum terjadwal</div>
                                        @endif

                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"> <strong>Informasi Berkas</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
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
                @endif

            </div>
            <!-- Jadwal Seminar End -->

            <!-- Bukti Seminar Start -->
            @if ($seminar->jadwal != null)
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Berita Acara Seminar</h4>
                            <small>
                                <b>
                                    <p
                                        class="mb-30 text-center
                                @if ($seminar->status_koor == 'Selesai') {{ 'Valid' }}
                                            @elseif($seminar->status_koor == 'Belum Selesai') {{ 'Proses' }}
                                            @elseif($seminar->status_koor == 'Perbaikan') {{ 'Invalid' }}
                                            @else {{ 'Failed' }} @endif">
                                        {{ $seminar->status_koor == 'Selesai' ? 'Valid' : 'Proses' }} </p>
                                </b>
                            </small>
                        </div>
                        @if ($seminar->status_koor != 'Selesai')
                            @if ($seminar->beritaAcara)
                                <a href="{{ route('mahasiswa.bakompres2.edit', $seminar->beritaAcara->encrypt_id) }}">
                                    <button class="btn btn-primary right">Edit</button>
                                </a>
                            @else
                                <a href="{{ route('mahasiswa.bakompres2.create') }}">
                                    <button class="btn btn-primary right">Unggah</button>
                                </a>
                            @endif
                        @endif
                        {{-- jika sudah diupload end --}}
                    </div>
                    @if ($seminar->beritaAcara)
                        <div class="bukti_seminar">
                            <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                                <div class="row border-bottom">
                                    <label class="col-md-3 bold"> <strong>Berita Seminar</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        <a target="_blank"
                                            href="/uploads/ba_sidang_tesis/{{ $seminar->beritaAcara->file_ba }}">Lihat</a>
                                    </div>
                                    <label class="col-md-3 bold mt-2"><b>Nomor Berita Seminar</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->beritaAcara->no_ba }}
                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"> <strong>Bukti Nilai Seminar</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        <a target="_blank"
                                            href="/uploads/nilai_sidang_tesis/{{ $seminar->beritaAcara->file_nilai }}">Lihat</a>
                                    </div>
                                    <label class="col-md-3 bold"> <strong>Huruf Mutu</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->beritaAcara->nilai_mutu }}
                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"> <strong>Lembar Pengesahan</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        <a target="_blank"
                                            href="{{ $seminar->beritaAcara->pengesahan }}">Lihat</a>
                                    </div>
                                    <label class="col-md-3 bold"> <strong>Nilai</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $seminar->beritaAcara->nilai }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bukti_seminar">
                            <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                                <div class="row border-bottom">
                                    <label class="col-md-3 bold"> <strong>Berita Acara Seminar</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        Belum Unggah
                                    </div>
                                    <label class="col-md-3 bold mt-2"><b>Nomor Berita Acara Seminar</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        Belum Unggah
                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"> <strong>Bukti Nilai Seminar</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        Belum Unggah
                                    </div>
                                    <label class="col-md-3 bold"> <strong>Huruf Mutu</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        Belum Unggah
                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"> <strong>PowerPoint</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        Belum Unggah
                                    </div>
                                    <label class="col-md-3 bold"> <strong>Nilai</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        Belum Unggah
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
            @endif
        </div>

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
