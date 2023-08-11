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
                            <h4 class="text-dark h4">Data Registrasi</h4>
                        </div>
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
                                <label class="col-md-3 bold mt-2"> <strong>Pembahas 1</strong></label>
                                <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
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
                                        href="/uploads/syarat_seminar_ta_satu_s2/{{ $seminar->berkas_ta_satu }}">Lihat
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

                            <div class="row border-bottom mt-3">
                                <label class="col-md-12 bold"><b>Judul atau Topik Tugas Akhir</b></label>
                                <div class="col-md-12 mb-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->judul_ta }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix" style="margin-bottom: 50px; margin-top: 10px;">
                        <div class="pull-left">
                            <h4 class="text-dark h4" style="margin-left: 10px">Jadwalkan Seminar Tugas Akhir 1</h4>
                        </div>
                    </div>
                    <div class="pl-3 pr-3 pb-0 mb-2">
                        <form id="formJadwal" action="{{ route('koor.jadwalTA1S2.store', $seminar->encrypt_id ) }}" method="POST">
                            @csrf
                            <div class="profile-edit-list row">
                                <div class="weight-500 col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Seminar</label>
                                        <input value="{{ old('tanggal_skp') }}" autofocus name="tanggal_skp"
                                            id="tanggal_skp"
                                            class="form-control @error('tanggal_skp') form-control-danger @enderror"
                                            type="date" placeholder="Tanggal Pelaksanaan Seminar">
                                        @error('tanggal_skp')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasi</label>
                                        <select class="custom-select2 form-control" style="width: 100%; height: 38px"
                                            name="id_lokasi" required>
                                            @foreach ($locations as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_lokasi') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_lokasi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- form untuk sebelah kanan --}}
                                <div class="kanan weight-500 col-md-6">
                                    <div class="form-group">
                                        <label>Jam Mulai</label>
                                        <input type="time" value="{{ old('jam_mulai_skp') }}" name="jam_mulai_skp"
                                            class="form-control @error('jam_mulai_skp') form-control-danger @enderror">
                                        @error('jam_mulai_skp')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Jam Selesai</label>
                                        <input type="time" name="jam_selesai_skp" value="{{ old('jam_selesai_skp') }}"
                                            class="form-control @error('jam_selesai_skp') form-control-danger @enderror">
                                        @error('jam_selesai_skp')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="submit btn btn-primary">Kirim</button>
                            </div>
                            <a href="{{ route('koor.jadwalTA1S2.index') }}">

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
