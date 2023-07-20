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
                                <label class="col-md-3 bold mt-1"><strong>Domisili PKL/KP</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->region }}
                                </div>
                            </div>

                            <div class="row border-bottom">
                                <label class="col-md-3 bold"> <strong>Tahun Akademik</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->tahun_akademik }}
                                </div>
                                <label class="col-md-3 bold mt-2"> <strong>Nama Mitra PKL/KP</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->mitra }}
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-2"> <strong>Semester</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->mahasiswa->semester}}
                                </div>
                                <label class="col-md-3 bold"> <strong>Pembimbing Lapangan</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->pembimbing_lapangan }}
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-2"> <strong>SKS</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->sks }}
                                </div>
                                <label class="col-md-3 bold"> <strong>Nomor Karyawan / NIP Pembimbing
                                        Lapangan</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->ni_pemlap }}
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-2"> <strong>IPK</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->ipk }}
                                </div>
                                <label class="col-md-3 bold"> <strong>Rencana Seminar</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->rencana_seminar }}
                                </div>
                            </div>

                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold mt-2"> <strong>TOEFL</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->toefl }}
                                </div>
                                <label class="col-md-3 bold"> <strong>Berkas Kelengkapan</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a href="/uploads/syarat_seminar_kp/{{ $seminar->berkas_seminar_pkl}}" target="_blank">Unduh Berkas</a>
                                </div>
                            </div>

                            <div class="row border-bottom mt-3">
                                <label class="col-md-12 bold"><b>Judul atau Topik PKL/KP</b></label>
                                <div class="col-md-12 mb-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->judul_kp }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix" style="margin-bottom: 50px; margin-top: 10px;">
                        <div class="pull-left">
                            <h4 class="text-dark h4" style="margin-left: 10px">Jadwalkan Seminar PKL/KP</h4>
                        </div>
                    </div>
                    <div class="pl-3 pr-3 pb-0 mb-2">
                    <form id="formJadwalUpdate" action="{{ route('koor.jadwalPKL.update',$jadwal->encrypt_id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Seminar</label>
                                    <input value="{{$jadwal->tanggal_skp}}" autofocus name="tanggal_skp" id="tanggal_skp"
                                        class="form-control @error('tanggal_skp') form-control-danger @enderror"
                                        type="date" placeholder="Nama Barang">
                                    @error('tanggal_skp')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px" name="id_lokasi" required>
                                        @foreach ($locations as $item)
                                            <option value="{{ $item->encrypt_id }}" {{ ($jadwal->id_lokasi == $item->id) ? 'selected' : '' }}>{{ $item->nama_lokasi. ', LT-'. $item->lantai_tingkat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">

                                <div class="form-group">
                                    <label>Jam Mulai</label>
                                    <input type="time" value="{{$jadwal->jam_mulai_skp}}" name="jam_mulai_skp" class="form-control @error('jam_mulai_skp') form-control-danger @enderror">
                                    @error('jam_mulai_skp')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jam Selesai</label>
                                    <input type="time" name="jam_selesai_skp" value="{{$jadwal->jam_selesai_skp}}" class="form-control @error('jam_selesai_skp') form-control-danger @enderror">
                                    @error('jam_selesai_skp')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button id="submitButton" type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                        <a href="{{route('koor.jadwalPKL.index')}}">

                            <button class="batal btn btn-secondary">Batal</button>
                        </a>

                    </form>
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
