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
                            <h4 class="text-dark h4">Data Pendaftaran Mahasiswa</h4>
                        </div>
                    </div>
                    <div class="">
                        <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Nomor Pokok Mahasiswa</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $mahasiswa->npm }}
                                </div>

                                <label class="col-md-3 bold mt-2"><b>Nama Mahasiswa</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $mahasiswa->nama_mahasiswa }}
                                </div>
                            </div>
                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Email</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $mahasiswa->user->email }}
                                </div>

                                <label class="col-md-3 bold mt-2"><b>Angkatan</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $mahasiswa->angkatan }}
                                </div>
                            </div>
                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Berkas Pendaftaran</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a href="{{ asset('uploads/syarat/' . $mahasiswa->berkas_upload) }}" target="_blank">
                                        Lihat
                                    </a>
                                </div>

                                <label class="col-md-3 bold mt-2"><b>Vertifikasi</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $mahasiswa->user->email_verified_at ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix" style="margin-bottom: 50px; margin-top: 10px;">
                        <div class="pull-left">
                            <h4 class="text-dark h4" style="margin-left: 10px">Validasi Pendaftaran Mahasiswa</h4>
                        </div>
                    </div>
                    <div class="pl-3 pr-3 pb-0 mb-2">
                        <form id="formJadwalUpdate" action="{{ route('sudo.validasi.mahasiswa.update', $mahasiswa->id) }}"
                            method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group" style="margin-top: 20px">
                                <label><b>Status</b></label>
                                <select onchange="toggleCatatan()" name="status" id="status"
                                    class="selectpicker form-control" data-size="5">
                                    <option value="1">Diterima</option>
                                    <option value="0">Ditolak</option>
                                </select>
                                @error('status')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="submit btn btn-primary">Kirim</button>
                            </div>
                        </form>
                        <a href="{{ route('koor.jadwalTA1.index') }}">

                            <button class="batal btn btn-secondary">Batal</button>
                        </a>
                    </div>
                </div>
                <!-- Data Registrasi End -->

            </div>
        </div>
        <!-- Input Validation End -->
    </div>
@endsection
