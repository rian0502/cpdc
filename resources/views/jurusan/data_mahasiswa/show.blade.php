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
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Detail Mahasiswa</h4>
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
                    </div>


                    <div class="p-md-4">

                        <div class="p-3 mb-2 bg-light text-dark rounded-div">
                            <div class="row">
                                <label class="col-md-3 bold"> <strong>Nama</strong></label>
                                <div class="col-md-3">
                                    {{ $mahasiswa->nama_mahasiswa }}
                                </div>
                                <label class="col-md-3 bold"><b>Tanggal Lahir</b></label>
                                <div class="col-md-3" id="tanggal-lahir">
                                    {{ $carbon::parse($mahasiswa->tanggal_lahir)->format('d F Y') }}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><b>NPM</b></label>
                                <div class="col-md-3">
                                    {{ $mahasiswa->npm }}
                                </div>
                                <label class="col-md-3 bold"><strong>Alamat</strong></label>
                                <div class="col-md-3">
                                    {{ $mahasiswa->alamat }}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><b>Tanggal Masuk</b></label>
                                <div class="col-md-3">
                                    {{ $mahasiswa->tanggal_masuk }}
                                </div>
                                <label class="col-md-3 bold"><strong>Tempat Lahir</strong></label>
                                <div class="col-md-3">
                                    {{ $mahasiswa->alamat }}
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
                                <label class="col-md-3 bold"><b>Jenis Kelamin</b></label>
                                <div class="col-md-3">
                                    {{ $mahasiswa->jenis_kelamin }}

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
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#skp" role="tab"
                                        aria-selected="true">Seminar Kerja Praktik</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#ta1" role="tab"
                                        aria-selected="false">Tugas Akhir Satu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#ta2" role="tab"
                                        aria-selected="false">Tugas Akhir Dua</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#kompre" role="tab"
                                        aria-selected="false">Komprehensif</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#prestasi" role="tab"
                                        aria-selected="false">Prestasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#extra_activity" role="tab"
                                        aria-selected="false">Kegiatan Lainnya</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="skp" role="tabpanel">
                                    <div class="pd-20">
                                        <div class="p-md-4">
                                            <h5 class="h4 text-blue mb-20">Data Seminar Kerja Praktik</h5>

                                            @if ($kp != null)
                                                <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                    <div class="row border-bottom mt-3">
                                                        <label class="col-md-12 bold"><b>Judul atau Topik</b></label>
                                                        <div class="col-md-12 mb-3"
                                                            style="display:block;word-wrap:break-word;">
                                                            {{ $kp->judul_kp }}
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom">

                                                        <label class="col-md-3 bold mt-2"><b>Dosen Pembimbing</b></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $kp->dosen->nama_dosen }}
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"><strong>Domisili
                                                                PKL/KP</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $kp->region }}
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom">
                                                        <label class="col-md-3 bold mt-2"> <strong>Tahun
                                                                Akademik</strong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            {{ $kp->tahun_akademik }}
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"> <strong>Nama Mitra
                                                                PKL/KP</strong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            {{ $kp->mitra }}
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold mt-2"> <strong>TOEFL</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $kp->toefl }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Pembimbing
                                                                Lapangan</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $kp->pembimbing_lapangan }}
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold mt-2"> <strong>SKS</strong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            {{ $kp->sks }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Nomor Karyawan / NIP
                                                                Pembimbing
                                                                Lapangan</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $kp->ni_pemlap }}
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold mt-2"> <strong>IPK</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $kp->ipk }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Rencana
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $kp->rencana_seminar }}
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">

                                                        <label class="col-md-3 bold"> <strong>Berkas
                                                                Kelengkapan</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <a target="_blank"
                                                                href="/uploads/syarat_seminar_kp/{{ $kp->berkas_seminar_pkl }}">Unduh
                                                                Berkas</a>
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
                                            @if ($kp)
                                                <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                    {{-- BUAT KONDISI DISINI --}}
                                                    <div class="row border-bottom">
                                                        <label class="col-md-3 bold mt-2"> <strong>Tanggal
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($kp->jadwal)
                                                                {{ $kp->jadwal->tanggal_skp }}
                                                            @else
                                                                <div>Belum terjadwal</div>
                                                            @endif
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($kp->jadwal)
                                                                {{ $kp->jadwal->jam_mulai_skp }} WIB
                                                            @else
                                                                <div>Belum terjadwal</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <label class="col-md-3 bold"> <strong>Lokasi
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <div>
                                                                @if ($kp->jadwal)
                                                                    {{ $kp->jadwal->lokasi->nama_lokasi }}
                                                                @else
                                                                    <div>Belum terjadwal</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"><strong>Jam
                                                                Selesai</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($kp->jadwal)
                                                                {{ $kp->jadwal->jam_selesai_skp }} WIB
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
                                            @if ($kp && $kp->berita_acara)
                                                <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                    {{-- BUAT KONDISI DISINI --}}
                                                    <div class="row border-bottom">
                                                        <label class="col-md-3 bold"> <strong>Bukti
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <a target="_blank"
                                                                href="/uploads/berita_acara_seminar_kp/{{ $kp->berita_acara->berkas_ba_seminar_kp }}">Lihat</a>
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"><b>Nomor Bukti
                                                                Seminar</b></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $kp->berita_acara->no_ba_seminar_kp }}
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold"> <strong>Laporan Final
                                                                PKL/KP</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <a target="_blank"
                                                                href="/uploads/laporan_kp/{{ $kp->berita_acara->laporan_kp }}">Lihat</a>
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"><strong>Status
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $kp->status_seminar }}
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <label class="col-md-3 bold"> <strong>Nilai Total</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $kp->berita_acara->nilai_akhir }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Huruf Mutu</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <b> {{ $kp->berita_acara->nilai_mutu }} </b>
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
                                <div class="tab-pane fade" id="ta1" role="tabpanel">
                                    <div class="pd-20">
                                        <div class="p-md-4">
                                            <h5 class="h4 text-blue mb-20">Data Seminar Tugas Akhir Satu</h5>
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
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa1->pembimbing_satu->nama_dosen }}
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"><strong>Pembimbing
                                                                2</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($seminarTa1->pembimbing_dua)
                                                                {{ $seminarTa1->pembimbing_dua->nama_dosen }}
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
                                                        <label class="col-md-3 bold mt-2"> <strong>NIP Dosen
                                                                External</strong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            @if ($seminarTa1->pbl2_nip)
                                                                {{ $seminarTa1->pbl2_nip }}
                                                            @else
                                                                -
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold mt-2">
                                                            <strong>Semester</strong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            {{ $mahasiswa->semester }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Pembahas</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa1->pembahas->nama_dosen }}
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold mt-2"> <strong>SKS</strong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa1->sks }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Rencana
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa1->periode_seminar }}
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold mt-2"> <strong>IPK</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa1->ipk }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Berkas
                                                                Kelengkapan</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <a target="_blank"
                                                                href="/uploads/syarat_seminar_ta1/{{ $seminarTa1->berkas_ta_satu }}">Lihat
                                                                Berkas</a>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <label class="col-md-3 bold mt-2"> <strong>TOEFL</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa1->toefl }}
                                                        </div>

                                                        <label class="col-md-3 bold"> <strong>Status
                                                                Berkas</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa1->status_admin }}
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
                                            @if ($seminarTa1)
                                                <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                    <div class="row border-bottom">
                                                        <label class="col-md-3 bold mt-2"> <strong>Tanggal
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($seminarTa1->jadwal)
                                                                {{ $seminarTa1->jadwal->tanggal_seminar_ta_satu }}
                                                            @else
                                                                <div>Belum terjadwal</div>
                                                            @endif
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($seminarTa1->jadwal)
                                                                {{ $seminarTa1->jadwal->jam_mulai_seminar_ta_satu }} WIB
                                                            @else
                                                                <div>Belum terjadwal</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <label class="col-md-3 bold"> <strong>Lokasi
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <div>
                                                                @if ($seminarTa1->jadwal)
                                                                    {{ $seminarTa1->jadwal->lokasi->nama_lokasi }}
                                                                @else
                                                                    <div>Belum terjadwal</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"><strong>Jam
                                                                Selesai</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($seminarTa1->jadwal)
                                                                {{ $seminarTa1->jadwal->jam_selesai_seminar_ta_satu }} WIB
                                                            @else
                                                                <div>Belum terjadwal</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($seminarTa1->ba_seminar)
                                                <div class="p-md-4">
                                                    <h5 class="h4 text-blue mb-20">Berita Acara</h5>
                                                    <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                        <div class="row border-bottom">
                                                            <label class="col-md-3 bold"> <strong>Berita Acara</strong></label>
                                                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                                <a target="_blank"
                                                                    href="/uploads/ba_seminar_ta_satu/{{ $ba_ta1->berkas_ba_seminar_ta_satu }}">Lihat</a>
                                                            </div>
                                                            <label class="col-md-3 bold mt-2"><b>Nomor Bukti Seminar</b></label>
                                                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                                {{ $ba_ta1->no_berkas_ba_seminar_ta_satu }}
                                                            </div>
                                                        </div>
                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold"> <strong>PPT</strong></label>
                                                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                                <a target="_blank"
                                                                    href="/uploads/ta_satu/{{ $ba_ta1->ta_satu }}">Lihat</a>
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Berkas Nilai</strong></label>
                                                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                                <a target="_blank"
                                                                    href="/uploads/ta_satu/{{ $ba_ta1->ta_satu }}">Lihat</a>
                                                            </div>
        
                                                        </div>
                                                        <div class="row border-bottom mt-2">
                                                            <label class="col-md-3 bold"> <strong>Nilai Total</strong></label>
                                                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                                {{ $ba_ta1->nilai }}
                                                            </div>
                                                            <label class="col-md-3 bold"> <strong>Huruf Mutu</strong></label>
                                                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                                <b> {{ $ba_ta1->huruf_mutu }} </b>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <label class="col-md-3 bold mt-2"><strong>Status
                                                                    Seminar</strong></label>
                                                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                                {{ $seminarTa1->status_koor }}
                                                            </div>
                                                        </div>
        
                                                    </div>
        
                                                </div>
                                                @endif
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
                                            <h5 class="h4 text-blue mb-20">Data Seminar Tugas Akhir Dua</h5>
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
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa2->pembimbing_satu->nama_dosen }}
                                                        </div>
                                                        <label class="col-md-3 bold mt-1"><strong>Pembimbing
                                                                2</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($seminarTa2->pembimbing_dua)
                                                                {{ $seminarTa2->pembimbing_dua->nama_dosen }}
                                                            @else
                                                                {{ $seminarTa2->pbl2_nama }}
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom">
                                                        <label class="col-md-3 bold mt-2"> <strong>Tahun
                                                                Akademik</strong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa2->tahun_akademik }}
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"> <strong>NIP Dosen
                                                                External</strong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            @if ($seminarTa2->pbl2_nip)
                                                                {{ $seminarTa2->pbl2_nip }}
                                                            @else
                                                                -
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold mt-1">
                                                            <strong>Semester</strong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            {{ $mahasiswa->semester }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Pembahas</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa2->pembahas->nama_dosen }}
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold mt-2"> <strong>SKS</strong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa2->sks }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Rencana
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa2->periode_seminar }}
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold mt-2"> <strong>IPK</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa2->ipk }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Berkas
                                                                Kelengkapan</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <a target="_blank"
                                                                href="/uploads/syarat_seminar_ta2/{{ $seminarTa2->berkas_ta_dua }}">Lihat
                                                                Berkas</a>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <label class="col-md-3 bold mt-2"> <strong>TOEFL</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa2->toefl }}
                                                        </div>

                                                        <label class="col-md-3 bold"> <strong>Status
                                                                Berkas</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $seminarTa2->status_admin }}
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
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($seminarTa2->jadwal)
                                                                {{ $seminarTa2->jadwal->tanggal_seminar_ta_dua }}
                                                            @else
                                                                <div>Belum terjadwal</div>
                                                            @endif
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($seminarTa2->jadwal)
                                                                {{ $seminarTa2->jadwal->jam_mulai_seminar_ta_dua }} WIB
                                                            @else
                                                                <div>Belum terjadwal</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <label class="col-md-3 bold"> <strong>Lokasi
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
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
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($seminarTa2->jadwal)
                                                                {{ $seminarTa2->jadwal->jam_selesai_seminar_ta_dua }} WIB
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
                                                        <label class="col-md-3 bold"> <strong>Berita Acara</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <a target="_blank"
                                                                href="/uploads/ba_seminar_ta_dua/{{ $ba_ta2->berkas_ba_seminar_ta_dua }}">Lihat</a>
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"><b>Nomor Bukti
                                                                Seminar</b></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $ba_ta2->no_berkas_ba_seminar_ta_dua }}
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold"> <strong>PPT</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <a target="_blank"
                                                                href="/uploads/ta_dua/{{ $ba_ta2->berkas_ppt_seminar_ta_dua }}">Lihat</a>
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Berkas Nilai</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <a target="_blank"
                                                                href="/uploads/ta_dua/{{ $ba_ta2->berkas_nilai_seminar_ta_dua }}">Lihat</a>
                                                        </div>

                                                    </div>
                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold"> <strong>Nilai
                                                                Total</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $ba_ta2->nilai }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Huruf
                                                                Mutu</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <b> {{ $ba_ta2->nilai_mutu }} </b>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <label class="col-md-3 bold mt-1"><strong>Status
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
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
                                            <h5 class="h4 text-blue mb-20">Data Seminar Komprehensif</h5>
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
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $sidangKompre->pembimbingSatu->nama_dosen }}
                                                        </div>
                                                        <label class="col-md-3 bold mt-1"><strong>Pembimbing
                                                                2</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($sidangKompre->pembimbingDua)
                                                                {{ $sidangKompre->pembimbingDua->nama_dosen }}
                                                            @else
                                                                {{ $sidangKompre->pbl2_nama }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom">
                                                        <label class="col-md-3 bold mt-2"> <strong>Tahun
                                                                Akademik</strong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            {{ $sidangKompre->tahun_akademik }}
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"> <strong>NIP Dosen
                                                                External</strong trong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            @if ($sidangKompre->pbl2_nip)
                                                                {{ $sidangKompre->pbl2_nip }}
                                                            @else
                                                                -
                                                            @endif
                                                        </div>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            {{ $sidangKompre->mitra }}
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold mt-1">
                                                            <strong>Semester</strong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            {{ $mahasiswa->semester }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Pembahas</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $sidangKompre->pembahas->nama_dosen }}
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold mt-2"> <strong>SKS</strong></label>
                                                        <div class="col-md-3 mt-2"
                                                            style="display:block;word-wrap:break-word;">
                                                            {{ $sidangKompre->sks }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Rencana
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $sidangKompre->periode_seminar }}
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold mt-2"> <strong>IPK</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $sidangKompre->ipk }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Berkas
                                                                Kelengkapan</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <a target="_blank"
                                                                href="/uploads/syarat_sidang_kompre/{{ $sidangKompre->berkas_kompre }}">Unduh
                                                                Berkas</a>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <label class="col-md-3 bold mt-2">
                                                            <strong>TOEFL</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $sidangKompre->toefl }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Status
                                                                Berkas</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $sidangKompre->status_admin }}
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
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($sidangKompre->jadwal)
                                                                {{ $sidangKompre->jadwal->tanggal_komprehensif }}
                                                            @else
                                                                <div>Belum terjadwal</div>
                                                            @endif
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($sidangKompre->jadwal)
                                                                {{ $sidangKompre->jadwal->jam_mulai_komprehensif }} WIB
                                                            @else
                                                                <div>Belum terjadwal</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <label class="col-md-3 bold"> <strong>Lokasi
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
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
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            @if ($sidangKompre->jadwal)
                                                                {{ $sidangKompre->jadwal->jam_selesai_komprehensif }} WIB
                                                            @else
                                                                <div>Belum terjadwal</div>
                                                            @endif
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
                                            @if ($ba_kompre)
                                                <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                    <div class="row border-bottom">
                                                        <label class="col-md-3 bold"> <strong>Berita
                                                                Acara</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <a target="_blank"
                                                                href="/uploads/berita_acara_seminar_kp/{{ $ba_kompre->ba_seminar_komprehensif }}">Lihat</a>
                                                        </div>
                                                        <label class="col-md-3 bold mt-2"><b>Nomor Bukti
                                                                Seminar</b></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $ba_kompre->no_ba_berkas }}
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold"> <strong>Laporan
                                                                Akhir</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <a target="_blank"
                                                                href="{{ $ba_kompre->laporan_ta }}">Lihat</a>
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Berkas
                                                                Nilai</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <a target="_blank"
                                                                href="/uploads/nilai_sidang_kompre/{{ $ba_kompre->berkas_nilai_kompre }}">Lihat</a>
                                                        </div>

                                                    </div>
                                                    <div class="row border-bottom mt-2">
                                                        <label class="col-md-3 bold"> <strong>Nilai
                                                                Total</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            {{ $ba_kompre->nilai }}
                                                        </div>
                                                        <label class="col-md-3 bold"> <strong>Huruf
                                                                Mutu</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                            <b> {{ $ba_kompre->huruf_mutu }} </b>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <label class="col-md-3 bold mt-1"><strong>Status
                                                                Seminar</strong></label>
                                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
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
                                                    <th>Tanggal</th>
                                                    <th>SKS Konversi</th>
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
                                                        <td>
                                                            {{ $item->tanggal }}
                                                        </td>
                                                        <td>
                                                            {{ $item->sks_konversi }}
                                                            SKS</td>
    
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
