@extends('layouts.datatable')
@section('datatable')
    <style>
        .rounded-div {
            border-radius: 10px;
            border: 1px solid #e5e5e5;
            padding: 10px;
            margin-bottom: 10px;
        }

        .rounded-circle {
            border-radius: 50%;
        }

        .circle-wrapper {
            width: 150px;
            /* Sesuaikan dengan ukuran yang diinginkan */
            height: 150px;
            /* Sesuaikan dengan ukuran yang diinginkan */
            border-radius: 50%;
            overflow: hidden;
        }

        .foto {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        a:hover {
            cursor: pointer;
        }

        .right-button {
            float: right;
            margin-top: -25px;
        }
    </style>
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Detail Mahasiswa S2</h4>
                        <a href="{{ route('dosen.mahasiswa.bimbingan.tesis.index') }}">
                            <button class="btn btn-primary right-button">Kembali</button>
                        </a>
                    </div>
                    <div class="mb-3 pb-2">
                        <div class="form-group">
                            <div class="profile-photo">
                                <div class="circle-wrapper">
                                    <img id="preview-image" src="/uploads/profile/{{ $mahasiswa->user->profile_picture }}"
                                        alt="Foto Profile" onerror="this.src='/uploads/profile/default.png'" class="foto">
                                </div>

                            </div>
                        </div>
                        <div class="p-md-4">

                            <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                <div class="row">
                                    <label class="col-md-3 bold"> <strong>Nama</strong></label>
                                    <div class="col-md-3">
                                        {{ $mahasiswa->nama_mahasiswa }}
                                    </div>
                                    <label class="col-md-3 bold"><strong>Tempat Lahir</strong></label>
                                    <div class="col-md-3">
                                        {{ $mahasiswa->tempat_lahir }}
                                    </div>

                                </div>
                                <div class="row">
                                    <label class="col-md-3 bold"><b>NPM</b></label>
                                    <div class="col-md-3">
                                        {{ $mahasiswa->npm }}
                                    </div>

                                    <label class="col-md-3 bold"><b>Tanggal Lahir</b></label>
                                    <div class="col-md-3" id="tanggal-lahir">
                                        {{ $carbon::parse($mahasiswa->tanggal_lahir)->format('d F Y') }}
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 bold"><b>Tanggal Masuk</b></label>
                                    <div class="col-md-3">
                                        {{ $mahasiswa->tanggal_masuk }}
                                    </div>

                                    <label class="col-md-3 bold"><b>Jenis Kelamin</b></label>
                                    <div class="col-md-3">
                                        {{ $mahasiswa->jenis_kelamin }}
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 bold"><b>Angkatan</b></label>
                                    <div class="col-md-3">
                                        {{ $mahasiswa->angkatan }}
                                    </div>
                                    <label class="col-md-3 bold"> <strong> Status</strong></label>
                                    <div class="col-md-3">
                                        {{ $mahasiswa->status }}
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 bold"><b>Nomor Telepon</b></label>
                                    <div class="col-md-3">
                                        {{ $mahasiswa->no_hp }}
                                    </div>

                                    <label class="col-md-3 bold"> <strong> Email </strong></label>
                                    <div class="col-md-3">
                                        {{ $mahasiswa->user->email }}

                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 bold"><b>Semester</b></label>
                                    <div class="col-md-3">
                                        {{ $mahasiswa->semester }}

                                    </div>
                                    <label class="col-md-3 bold"><strong>Alamat</strong></label>
                                    <div class="col-md-3">
                                        {{ $mahasiswa->alamat }}
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3 bold"><b>Pembimbing Akademik</b></label>
                                    <div class="col-md-3">
                                        {{ $mahasiswa->dosen->nama_dosen }}

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box mb-30">
                        <div class="pd-20 card-box">
                            <h5 class="h4 text-blue mb-20">Kegiatan</h5>
                            <div class="tab">
                                <ul class="nav nav-tabs" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active text-blue" data-toggle="tab" href="#ta1" role="tab"
                                            aria-selected="false">Tesis 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-blue" data-toggle="tab" href="#ta2" role="tab"
                                            aria-selected="false">Tesis 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-blue" data-toggle="tab" href="#kompre" role="tab"
                                            aria-selected="false">Sidang Tesis</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-blue" data-toggle="tab" href="#prestasi" role="tab"
                                            aria-selected="false">Prestasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-blue" data-toggle="tab" href="#extra_activity"
                                            role="tab" aria-selected="false">Aktivitas</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="ta1" role="tabpanel">
                                        <div class="pd-20">
                                            <div class="p-md-4">
                                                <h5 class="h4 text-blue mb-20">Data Seminar Tesis 1</h5>
                                                @if ($seminarTa1 != null)
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="row border-bottom mt-3">
                                                            <label class="col-md-12 bold"><b>Judul atau Topik Tugas
                                                                    Akhir</b></label>
                                                            <div class="col-md-12 mb-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->judul_ta }}
                                                            </div>
                                                        </div>
                                                        <div class="row border-bottom">
                                                            <label class="col-md-3 bold mt-2"><b>Pembimbing 1</b></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->pembimbingSatu->nama_dosen }}
                                                            </div>
                                                            <label class="col-md-3 bold mt-1"><strong>Pembimbing
                                                                    2</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                @if ($seminarTa1->pembimbingDua)
                                                                    {{ $seminarTa1->pembimbingDua->nama_dosen }}
                                                                @else
                                                                    {{ $seminarTa1->pbl2_nama }}
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom">
                                                            <label class="col-md-3 bold mt-2"> <strong>Tahun
                                                                    Akademik</strong></label>
                                                            <div class="col-md-3 mt-2"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->tahun_akademik }}
                                                            </div>
                                                            <label class="col-md-3 bold mt-2"> <strong>Pemabahas
                                                                    1</strong></label>
                                                            <div class="col-md-3 mt-2"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->id_pembahas_1 ? $seminarTa1->pembahasSatu->nama_dosen : $seminarTa1->pembahas_external_1 }}
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold mt-1">
                                                                <strong>Semester</strong></label>
                                                            <div class="col-md-3 mt-2"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $mahasiswa->semester }}
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Pembahas
                                                                    2</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->id_pembahas_2 ? $seminarTa1->pembahasDua->nama_dosen : $seminarTa1->pembahas_external_2 }}
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold mt-2"> <strong>SKS</strong></label>
                                                            <div class="col-md-3 mt-2"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->sks }}
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Pembahas
                                                                    3</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->id_pembahas_3 ? $seminarTa1->pembahasTiga->nama_dosen : $seminarTa1->pembahas_external_3 }}
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold mt-2"> <strong>IPK</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->ipk }}
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Berkas
                                                                    Kelengkapan</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a target="_blank"
                                                                    href="/uploads/syarat_seminar_ta_satu_s2/{{ $seminarTa1->berkas_ta_satu }}">Lihat
                                                                    Berkas</a>
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold mt-2">
                                                                <strong>TOEFL</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->toefl }}
                                                            </div>

                                                            <label class="col-md-3 bold"> <strong>Status
                                                                    Berkas</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->status_admin }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <label class="col-md-3 bold mt-2"> <strong>Payung
                                                                    Penlitian</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->sumber_penelitian }}
                                                            </div>

                                                            <label class="col-md-3 bold"> <strong>Rencana
                                                                    Seminar</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->periode_seminar }}
                                                            </div>
                                                        </div>



                                                    </div>
                                                @else
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="d-flex justify-content-center align-items-center mt-2">
                                                            <div>
                                                                <h3 class="h3 text-blue mb-20">Data Belum Tersedia</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="p-md-4">
                                                <h5 class="h4 text-blue mb-20">Jadwal</h5>
                                                @if ($seminarTa1)
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="row border-bottom">
                                                            <label class="col-md-3 bold mt-2"> <strong>Tanggal
                                                                    Seminar</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                @if ($seminarTa1->jadwal)
                                                                    {{ $seminarTa1->jadwal->tanggal }}
                                                                @else
                                                                    <div>Belum terjadwal</div>
                                                                @endif
                                                            </div>
                                                            <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                @if ($seminarTa1->jadwal)
                                                                    {{ $seminarTa1->jadwal->jam_mulai }} WIB
                                                                @else
                                                                    <div>Belum terjadwal</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <label class="col-md-3 bold"> <strong>Lokasi
                                                                    Seminar</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <div>
                                                                    @if ($seminarTa1->jadwal)
                                                                        {{ $seminarTa1->jadwal->lokasi->nama_lokasi }}
                                                                    @else
                                                                        <div>Belum terjadwal</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <label class="col-md-3 bold mt-1"><strong>Jam
                                                                    Selesai</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                @if ($seminarTa1->jadwal)
                                                                    {{ $seminarTa1->jadwal->jam_selesai }} WIB
                                                                @else
                                                                    <div>Belum terjadwal</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="d-flex justify-content-center align-items-center mt-2">
                                                            <div>
                                                                <h3 class="h3 text-blue mb-20">Data Belum Tersedia</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="p-md-4">
                                                <h5 class="h4 text-blue mb-20">Berita Acara</h5>
                                                @if ($ba_ta1 != null)
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="row border-bottom">
                                                            <label class="col-md-3 bold"> <strong>Berita
                                                                    Acara</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a target="_blank"
                                                                    href="/uploads/ba_seminar_tesis_1/{{ $ba_ta1->file_ba }}">Lihat</a>
                                                            </div>
                                                            <label class="col-md-3 bold mt-2"><b>Nomor Bukti
                                                                    Seminar</b></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $ba_ta1->no_ba }}
                                                            </div>
                                                        </div>
                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold"> <strong>PPT</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a target="_blank" href="{{ $ba_ta1->ppt }}">Lihat</a>
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Berkas
                                                                    Nilai</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a target="_blank"
                                                                    href="/uploads/nilai_seminar_tesis_1/{{ $ba_ta1->file_nilai }}">Lihat</a>
                                                            </div>

                                                        </div>
                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold"> <strong>Nilai
                                                                    Total</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $ba_ta1->nilai }}
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Huruf
                                                                    Mutu</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <b> {{ $ba_ta1->nilai_mutu }} </b>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <label class="col-md-3 bold mt-1"><strong>Status
                                                                    Seminar</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->status_koor }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                @else
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="d-flex justify-content-center align-items-center mt-2">
                                                            <div>
                                                                <h3 class="h3 text-blue mb-20">Data Belum Tersedia</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="ta2" role="tabpanel">
                                        <div class="pd-20">
                                            <div class="p-md-4">
                                                <h5 class="h4 text-blue mb-20">Data Seminar Tesis 2</h5>
                                                @if ($seminarTa2 != null)
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="row border-bottom mt-3">
                                                            <label class="col-md-12 bold"><b>Judul atau Topik Tugas
                                                                    Akhir</b></label>
                                                            <div class="col-md-12 mb-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa2->judul_ta }}
                                                            </div>
                                                        </div>
                                                        <div class="row border-bottom">
                                                            <label class="col-md-3 bold mt-2"><b>Pembimbing 1</b></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa2->pembimbingSatu->nama_dosen }}
                                                            </div>
                                                            <label class="col-md-3 bold mt-1"><strong>Pembimbing
                                                                    2</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa2->id_pembimbing_2 ? $seminarTa2->pembimbingDua->nama_dosen : $seminarTa2->pbl2_nama }}
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom">
                                                            <label class="col-md-3 bold mt-2"> <strong>Tahun
                                                                    Akademik</strong></label>
                                                            <div class="col-md-3 mt-2"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa2->tahun_akademik }}
                                                            </div>
                                                            <label class="col-md-3 bold mt-2"> <strong>Pembahas
                                                                    1</strong></label>
                                                            <div class="col-md-3 mt-2"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa2->id_pembahas_1 ? $seminarTa2->pembahasSatu->nama_dosen : $seminarTa2->pembahas_external_1 }}
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold mt-1">
                                                                <strong>Semester</strong></label>
                                                            <div class="col-md-3 mt-2"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $mahasiswa->semester }}
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Pembahas
                                                                    2</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa2->id_pembahas_2 ? $seminarTa1->pembahasDua->nama_dosen : $seminarTa2->pembahas_external_2 }}
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold mt-2"> <strong>SKS</strong></label>
                                                            <div class="col-md-3 mt-2"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa2->sks }}
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Pembahas
                                                                    3</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa2->id_pembahas_3 ? $seminarTa2->pembahasTiga->nama_dosen : $seminarTa2->pembahas_external_3 }}
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold mt-2"> <strong>IPK</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa2->ipk }}
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Berkas
                                                                    Kelengkapan</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a target="_blank"
                                                                    href="/uploads/syarat_seminar_ta_dua_s2/{{ $seminarTa2->berkas_ta_dua }}">Lihat
                                                                    Berkas</a>
                                                            </div>
                                                        </div>

                                                        <div class="row  border-bottom mt-2">
                                                            <label class="col-md-3 bold mt-2">
                                                                <strong>TOEFL</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa2->toefl }}
                                                            </div>

                                                            <label class="col-md-3 bold"> <strong>Status
                                                                    Berkas</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa2->status_admin }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <label class="col-md-3 bold"> <strong>Rencana
                                                                    Seminar</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa2->periode_seminar }}
                                                            </div>
                                                        </div>


                                                    </div>
                                                @else
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="d-flex justify-content-center align-items-center mt-2">
                                                            <div>
                                                                <h3 class="h3 text-blue mb-20">Data Belum Tersedia</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- BUAT KONDISI DISINI --}}
                                            <div class="p-md-4">
                                                <h5 class="h4 text-blue mb-20">Jadwal</h5>
                                                @if ($seminarTa2)
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="row border-bottom">
                                                            <label class="col-md-3 bold mt-2"> <strong>Tanggal
                                                                    Seminar</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                @if ($seminarTa2->jadwal)
                                                                    {{ $seminarTa2->jadwal->tanggal }}
                                                                @else
                                                                    <div>Belum terjadwal</div>
                                                                @endif
                                                            </div>
                                                            <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                @if ($seminarTa2->jadwal)
                                                                    {{ $seminarTa2->jadwal->jam_mulai }} WIB
                                                                @else
                                                                    <div>Belum terjadwal</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <label class="col-md-3 bold"> <strong>Lokasi
                                                                    Seminar</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <div>
                                                                    @if ($seminarTa2->jadwal)
                                                                        {{ $seminarTa2->jadwal->lokasi->nama_lokasi }}
                                                                    @else
                                                                        <div>Belum terjadwal</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <label class="col-md-3 bold mt-1"><strong>Jam
                                                                    Selesai</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                @if ($seminarTa2->jadwal)
                                                                    {{ $seminarTa2->jadwal->jam_selesai }} WIB
                                                                @else
                                                                    <div>Belum terjadwal</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="d-flex justify-content-center align-items-center mt-2">
                                                            <div>
                                                                <h3 class="h3 text-blue mb-20">Data Belum Tersedia</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="p-md-4">
                                                <h5 class="h4 text-blue mb-20">Berita Acara</h5>
                                                @if ($ba_ta2 != null)
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="row border-bottom">
                                                            <label class="col-md-3 bold"> <strong>Berita
                                                                    Acara</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a target="_blank"
                                                                    href="/uploads/ba_seminar_tesis_2/{{ $ba_ta2->file_ba }}">Lihat</a>
                                                            </div>
                                                            <label class="col-md-3 bold mt-2"><b>Nomor Bukti
                                                                    Seminar</b></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $ba_ta2->no_ba }}
                                                            </div>
                                                        </div>
                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold"> <strong>PPT</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a target="_blank" href="{{ $ba_ta2->ppt }}">Lihat</a>
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Berkas
                                                                    Nilai</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a target="_blank"
                                                                    href="/uploads/nilai_seminar_tesis_2/{{ $ba_ta2->file_nilai }}">Lihat</a>
                                                            </div>
                                                        </div>
                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold"> <strong>Nilai
                                                                    Total</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $ba_ta2->nilai }}
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Huruf
                                                                    Mutu</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <b> {{ $ba_ta2->nilai_mutu }} </b>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <label class="col-md-3 bold mt-1"><strong>Status
                                                                    Seminar</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa2->status_koor }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="d-flex justify-content-center align-items-center mt-2">
                                                            <div>
                                                                <h3 class="h3 text-blue mb-20">Data Belum Tersedia</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="kompre" role="tabpanel">
                                        <div class="pd-20">
                                            <div class="p-md-4">
                                                <h5 class="h4 text-blue mb-20">Data Sidang Tesis</h5>
                                                @if ($sidangKompre != null)
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="row border-bottom mt-3">
                                                            <label class="col-md-12 bold"><b>Judul atau Topik Tugas
                                                                    Akhir</b></label>
                                                            <div class="col-md-12 mb-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $sidangKompre->judul_ta }}
                                                            </div>
                                                        </div>
                                                        <div class="row border-bottom">
                                                            <label class="col-md-3 bold mt-2"><b>Pembimbing 1</b></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $sidangKompre->pembimbingSatu->nama_dosen }}
                                                            </div>
                                                            <label class="col-md-3 bold mt-1"><strong>Pembimbing
                                                                    2</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $sidangKompre->id_pembimbing_2 ? $sidangKompre->pembimbingDua->nama_dosen : $sidangKompre->pbl2_nama }}
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom">
                                                            <label class="col-md-3 bold mt-2"> <strong>Tahun
                                                                    Akademik</strong></label>
                                                            <div class="col-md-3 mt-2"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $sidangKompre->tahun_akademik }}
                                                            </div>
                                                            <label class="col-md-3 bold mt-2"> <strong>Pembahas
                                                                    1</strong></label>
                                                            <div class="col-md-3 mt-2"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $sidangKompre->id_pembahas_1 ? $sidangKompre->pembahasSatu->nama_dosen : $sidangKompre->pembahas_external_1 }}
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold mt-1">
                                                                <strong>Semester</strong></label>
                                                            <div class="col-md-3 mt-2"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $mahasiswa->semester }}
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Pembahas
                                                                    2</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $sidangKompre->id_pembahas_2 ? $seminarTa1->pembahasDua->nama_dosen : $sidangKompre->pembahas_external_2 }}
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold mt-2"> <strong>SKS</strong></label>
                                                            <div class="col-md-3 mt-2"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $sidangKompre->sks }}
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Pembahas
                                                                    3</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $sidangKompre->id_pembahas_3 ? $sidangKompre->pembahasTiga->nama_dosen : $sidangKompre->pembahas_external_3 }}
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold mt-2"> <strong>IPK</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $sidangKompre->ipk }}
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Berkas
                                                                    Kelengkapan</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a target="_blank"
                                                                    href="/uploads/syarat_seminar_ta_dua_s2/{{ $sidangKompre->berkas_ta_dua }}">Lihat
                                                                    Berkas</a>
                                                            </div>
                                                        </div>

                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold mt-2">
                                                                <strong>TOEFL</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $sidangKompre->toefl }}
                                                            </div>

                                                            <label class="col-md-3 bold"> <strong>Status
                                                                    Berkas</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $sidangKompre->status_admin }}
                                                            </div>
                                                        </div>
                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold mt-2"> <strong>Link
                                                                    Artikel</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a href="{{ $sidangKompre->url_draft_artikel }}">Lihat</a>
                                                            </div>

                                                            <label class="col-md-3 bold"> <strong>Draft
                                                                    Artikel</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a
                                                                    href="uploads/draft_artikel/{{ $sidangKompre->draft_artikel }}">Lihat</a>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <label class="col-md-3 bold"> <strong>Rencana
                                                                    Seminar</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a
                                                                    href="uploads/draft_artikel{{ $sidangKompre->url_draft_artikel }}"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="d-flex justify-content-center align-items-center mt-2">
                                                            <div>
                                                                <h3 class="h3 text-blue mb-20">Data Belum Tersedia</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- BUAT KONDISI DISINI --}}
                                            <div class="p-md-4">
                                                <h5 class="h4 text-blue mb-20">Jadwal</h5>
                                                @if ($sidangKompre)
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="row border-bottom">
                                                            <label class="col-md-3 bold mt-2"> <strong>Tanggal
                                                                    Seminar</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                @if ($sidangKompre->jadwal)
                                                                    {{ $sidangKompre->jadwal->tanggal }}
                                                                @else
                                                                    <div>Belum terjadwal</div>
                                                                @endif
                                                            </div>
                                                            <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                @if ($sidangKompre->jadwal)
                                                                    {{ $sidangKompre->jadwal->jam_mulai }} WIB
                                                                @else
                                                                    <div>Belum terjadwal</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <label class="col-md-3 bold"> <strong>Lokasi
                                                                    Seminar</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <div>
                                                                    @if ($sidangKompre->jadwal)
                                                                        {{ $sidangKompre->jadwal->lokasi->nama_lokasi }}
                                                                    @else
                                                                        <div>Belum terjadwal</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <label class="col-md-3 bold mt-1"><strong>Jam
                                                                    Selesai</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                @if ($sidangKompre->jadwal)
                                                                    {{ $sidangKompre->jadwal->jam_selesai }} WIB
                                                                @else
                                                                    <div>Belum terjadwal</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="d-flex justify-content-center align-items-center mt-2">
                                                            <div>
                                                                <h3 class="h3 text-blue mb-20">Data Belum Tersedia</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="p-md-4">
                                                <h5 class="h4 text-blue mb-20">Berita Acara</h5>
                                                @if ($ba_kompre != null)
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="row border-bottom">
                                                            <label class="col-md-3 bold"> <strong>Berita
                                                                    Acara</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a target="_blank"
                                                                    href="/uploads/ba_sidang_tesis/{{ $ba_kompre->file_ba }}">Lihat</a>
                                                            </div>
                                                            <label class="col-md-3 bold mt-2"><b>Nomor Bukti
                                                                    Seminar</b></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $ba_kompre->no_ba }}
                                                            </div>
                                                        </div>
                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold"> <strong>Laporan
                                                                    Pengesahan</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a target="_blank"
                                                                    href="{{ $ba_kompre->pengesahan }}">Lihat</a>
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Berkas
                                                                    Nilai</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <a target="_blank"
                                                                    href="/uploads/nilai_sidang_tesis/{{ $ba_kompre->file_nilai }}">Lihat</a>
                                                            </div>

                                                        </div>
                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold"> <strong>Nilai
                                                                    Total</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $ba_kompre->nilai }}
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Huruf
                                                                    Mutu</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                <b> {{ $ba_kompre->nilai_mutu }} </b>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <label class="col-md-3 bold mt-1"><strong>Status
                                                                    Seminar</strong></label>
                                                            <div class="col-md-3"
                                                                style="display:block;word-wrap:break-word;">
                                                                {{ $sidangKompre->status_koor }}
                                                            </div>
                                                        </div>

                                                    </div>
                                                @else
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="d-flex justify-content-center align-items-center mt-2">
                                                            <div>
                                                                <h3 class="h3 text-blue mb-20">Data Belum Tersedia</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="prestasi" role="tabpanel">
                                        <div class="pd-20">
                                            <table class="table data-table-responsive stripe data-table-noexport wrap ">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Prestasi</th>
                                                        <th>Scala</th>
                                                        <th>Tanggal</th>
                                                        <th>Capaian</th>
                                                        <th>Jenis</th>
                                                        <th>Pembimbing</th>
                                                        <th>File</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($prestasi as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->nama_prestasi }}</td>
                                                            <td>{{ $item->scala }}</td>
                                                            <td>{{ $item->tanggal }}</td>
                                                            <td>{{ $item->capaian }}</td>
                                                            <td>{{ $item->jenis }}</td>
                                                            <td>{{ $item->dosen->nama_dosen ?? $item->nama_pembimbing }}
                                                            </td>
                                                            <td>
                                                                <a target="_blank"
                                                                    href="/uploads/file_prestasi/{{ $item->file_prestasi }}">Lihat</a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="extra_activity" role="tabpanel">
                                        <div class="pd-20">
                                            <table class="table data-table-responsive stripe data-table-noexport wrap ">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Judul Kegiatan</th>
                                                        <th>Peran</th>
                                                        <th>Tingkatan</th>
                                                        <th>Jenis</th>
                                                        <th>Kategori</th>
                                                        <th>Pembimbing</th>
                                                        <th>Tanggal</th>
                                                        <th>SKS Konversi</th>
                                                        <th>Dokumen</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($aktivitas as $item)
                                                        <tr>
                                                            <td>
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td>
                                                                {{ $item->nama_aktivitas }}
                                                            </td>
                                                            <td>
                                                                {{ $item->peran }}
                                                            </td>
                                                            <td>{{ $item->skala }}</td>
                                                            <td>{{ $item->jenis }}</td>
                                                            <td>{{ $item->kategori }}</td>
                                                            <td>{{ $item->dosen->nama_dosen ?? $item->nama_pembimbing }}
                                                            </td>
                                                            <td>
                                                                {{ $item->tanggal }}
                                                            </td>
                                                            <td>
                                                                {{ $item->sks_konversi }}
                                                                SKS</td>
                                                            <td>
                                                                <a target="_blank"
                                                                    href="/uploads/file_act_mhs/{{ $item->file_aktivitas }}">Lihat</a>

                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        {{-- kegiatan lainnya end --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script>
        // Ambil elemen tanggal lahir dan umur dari HTML
        const tanggalLahir = document.getElementById('tanggal-lahir').textContent;
        const umur = document.getElementById('umur');

        // Hitung umur
        const tahunLahir = new Date(tanggalLahir).getFullYear();
        const tahunSekarang = new Date().getFullYear();
        const selisihTahun = tahunSekarang - tahunLahir;

        // Tentukan warna berdasarkan umur
        let warna;
        if (selisihTahun < 30) {
            warna =
                `rgb(${212-selisihTahun-50}, ${217-selisihTahun-50}, ${37-selisihTahun})`; // warna hijau akan semakin kuat saat umur semakin muda
        } else if (selisihTahun >= 30 && selisihTahun < 50) {
            warna =
                `rgb(${255-selisihTahun}, ${238-selisihTahun}, ${99-selisihTahun})`; // warna kuning akan semakin kuat saat umur mendekati 50 tahun
        } else {
            warna = `rgb(${255-selisihTahun}, 0, 0)`; // warna merah akan semakin kuat saat umur mendekati 70 tahun
        }

        // Update teks dan latar belakang pada elemen HTML
        umur.textContent = `${selisihTahun} Tahun`;
        umur.style.background = warna;
        umur.style.color = 'white';
        umur.style.fontWeight = 'bold';
        umur.style.borderRadius = '10px';
        umur.style.textAlign = 'center';
    </script>
    <!-- Input Validation End -->
@endsection
