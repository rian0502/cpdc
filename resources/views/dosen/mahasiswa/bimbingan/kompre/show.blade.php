@extends('layouts.datatable')
@section('datatable')
    <style>
        .rounded-div {
            border-radius: 10px;
            border: 1px solid #e5e5e5;
            padding: 10px;
            margin-bottom: 10px;
        }

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
                                <img id="preview-image" src="/uploads/profile/{{-- $mahasiswa->profile_picture --}}" alt="Foto Profile"
                                    onerror="this.src='/uploads/profile/default.png'" class="foto">

                            </div>

                        </div>
                    </div>
                    <div class="p-md-4">

                        <div class="p-3 mb-2 bg-light text-dark rounded-div">
                            <div class="row">
                                <label class="col-md-3 bold"> <strong>Nama</strong></label>
                                <div class="col-md-3">
                                    {{-- {{ $mahasiswa->nama }} --}}
                                </div>
                                <label class="col-md-3 bold"><b>Tanggal Lahir</b></label>
                                <div class="col-md-4" id="tanggal-lahir">
                                    {{-- {{ $carbon::parse($mahasiswa->tanggal_lahir)->format('d F Y') }} --}}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><b>NPM</b></label>
                                <div class="col-md-3">
                                    {{-- {{ $mahasiswa->npm }} --}}
                                </div>
                                <label class="col-md-3 bold"><strong>Alamat</strong></label>
                                <div class="col-md-3">
                                    {{-- {{ $mahasiswa->alamat }} --}}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><b>Tanggal Masuk</b></label>
                                <div class="col-md-3">
                                    {{-- {{ $mahasiswa->tanggal_masuk }} --}}
                                </div>
                                <label class="col-md-3 bold"><strong>Tempat Lahir</strong></label>
                                <div class="col-md-3">
                                    {{-- {{ $mahasiswa->alamat }} --}}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><b>Angkatan</b></label>
                                <div class="col-md-3">
                                    {{-- {{ $account->angkatan}} --}}
                                </div>
                                <label class="col-md-3 bold"> <strong> Status</strong></label>
                                <div class="col-md-3">
                                    {{-- {{ $mahasiswa->status }} --}}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><b>No Telphone</b></label>
                                <div class="col-md-3">
                                    {{-- {{ $mahasiswa->no_hp }} --}}
                                </div>

                                <label class="col-md-3 bold"> <strong> Email </strong></label>
                                <div class="col-md-3">
                                    {{-- {{ $mahasiswa->email }} --}}

                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><b>Semester</b></label>
                                <div class="col-md-3">
                                    {{-- {{ $mahasiswa->semester }} --}}

                                </div>
                                <label class="col-md-3 bold"><b>Jenis Kelamin</b></label>
                                <div class="col-md-3">
                                    {{-- {{ $mahasiswa->jenis_kelamin }} --}}

                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><b>Pembimbing Akademik</b></label>
                                <div class="col-md-3">
                                    {{-- {{ $mahasiswa->nama_dosen }} --}}

                                </div>

                            </div>
                        </div>
                        <style type="text/css">
                            a:hover {
                                cursor: pointer;
                            }
                        </style>
                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20 card-box">
                        <h5 class="h4 text-blue mb-20">Kegiatan</h5>
                        <div class="tab">
                            <ul class="nav nav-tabs" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#kompre" role="tab"
                                        aria-selected="false">Komprehensif</a>
                                </li>
                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane fade show active" id="kompre" role="tabpanel">
                                    <div class="pd-20">
                                        <div class="p-md-4">
                                            <h5 class="h4 text-blue mb-20">Data Seminar Komprehensif</h5>

                                            <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                <div class="row border-bottom mt-3">
                                                    <label class="col-md-12 bold"><b>Judul atau Topik Tugas Akhir</b></label>
                                                    <div class="col-md-12 mb-3" style="display:block;word-wrap:break-word;">
                                                        {{-- {{ $seminar->judul_kp }} --}}
                                                    </div>
                                                </div>
                                                <div class="row border-bottom">
                                                    <label class="col-md-3 bold mt-2"><b>Pembimbing 1</b></label>
                                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                        {{-- {{ $seminar->dosen->nama_dosen }} --}}
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
                                                    <label class="col-md-3 bold mt-2"> <strong>NIP Dosen External</strong trong></label>
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

                                                <div class="row mt-2">
                                                    <label class="col-md-3 bold mt-2"> <strong>TOEFL</strong></label>
                                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                        {{-- {{ $seminar->toefl }} --}}
                                                    </div>

                                                    <label class="col-md-3 bold"> <strong></strong></label>
                                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                        {{-- Kosongkan --}}
                                                    </div>
                                                </div>

                                            </div>
                                            <style type="text/css">
                                                a:hover {
                                                    cursor: pointer;
                                                }
                                            </style>
                                        </div>

                                        {{-- BUAT KONDISI DISINI --}}
                                        <div class="p-md-4">
                                            <h5 class="h4 text-blue mb-20">Jadwal</h5>
                                            <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                <div class="row border-bottom">
                                                    <label class="col-md-3 bold mt-2"> <strong>Tanggal
                                                            Seminar</strong></label>
                                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                        {{-- @if ($seminar->jadwal) --}}
                                                        {{-- {{ $seminar->jadwal->tanggal_skp }} --}}
                                                        {{-- @else --}}
                                                        <div>Belum terjadwal</div>
                                                        {{-- @endif --}}
                                                    </div>
                                                    <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                        {{-- @if ($seminar->jadwal) --}}
                                                        {{-- {{ $seminar->jadwal->jam_mulai_skp }} WIB --}}
                                                        {{-- @else --}}
                                                        <div>Belum terjadwal</div>
                                                        {{-- @endif --}}
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <label class="col-md-3 bold"> <strong>Lokasi Seminar</strong></label>
                                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                        <div>
                                                            {{-- @if ($seminar->jadwal) --}}
                                                            {{-- {{ $seminar->jadwal->lokasi->nama_lokasi }} --}}
                                                            {{-- @else --}}
                                                            <div>Belum terjadwal</div>
                                                            {{-- @endif --}}
                                                        </div>
                                                    </div>
                                                    <label class="col-md-3 bold mt-1"><strong>Jam Selesai</strong></label>
                                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                        {{-- @if ($seminar->jadwal) --}}
                                                        {{-- {{ $seminar->jadwal->jam_selesai_skp }} WIB --}}
                                                        {{-- @else --}}
                                                        <div>Belum terjadwal</div>
                                                        {{-- @endif --}}
                                                    </div>
                                                </div>

                                            </div>
                                            <style type="text/css">
                                                a:hover {
                                                    cursor: pointer;
                                                }
                                            </style>
                                        </div>
                                        <div class="p-md-4">
                                            <h5 class="h4 text-blue mb-20">Bukti Acara</h5>
                                            <div class="p-3 mb-2 bg-light text-dark rounded-div">
                                                <div class="row border-bottom">
                                                    <label class="col-md-3 bold"> <strong>Bukti Acara</strong></label>
                                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                        <a target="_blank"
                                                            href="/uploads/berita_acara_seminar_kp/{{-- $berita_acara->berkas_ba_seminar_kp --}}">Lihat</a>
                                                    </div>
                                                    <label class="col-md-3 bold mt-2"><b>No. Bukti Seminar</b></label>
                                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                        {{-- {{ $berita_acara->no_ba_seminar_kp }} --}}
                                                    </div>
                                                </div>
                                                <div class="row border-bottom mt-2">
                                                    <label class="col-md-3 bold"> <strong>PPT</strong></label>
                                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                        <a target="_blank"
                                                            href="/uploads/ta_satu/{{-- $berita_acara->ta_satu --}}">Lihat</a>
                                                    </div>
                                                    <label class="col-md-3 bold"> <strong>Berkas Nilai</strong></label>
                                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                        <a target="_blank"
                                                            href="/uploads/ta_satu/{{-- $berita_acara->ta_satu --}}">Lihat</a>
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
                                                <div class="row mt-2">
                                                    <label class="col-md-3 bold mt-1"><strong>Status Seminar</strong></label>
                                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                                        {{-- {{ $seminar->status_seminar }} --}}
                                                    </div>
                                                </div>

                                            </div>
                                            <style type="text/css">
                                                a:hover {
                                                    cursor: pointer;
                                                }
                                            </style>
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