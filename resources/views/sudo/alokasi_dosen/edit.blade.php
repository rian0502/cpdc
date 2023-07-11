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
                            <h4 class="text-dark h4" style="margin-left: 10px">Data Pengalokasian Dosen</h4>
                        </div>
                        {{-- <a href="/mahasiswa/seminar/kp/create">
                            <button class="btn btn-primary right">Edit Data</button>
                        </a> --}}

                    </div>
                    <div class="">
                        <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Nomor Induk Dosen Nasional</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $mahasiswa->npm }} --}}
                                </div>
                                <label class="col-md-3 bold mt-2"><b>Email</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $seminar->pembimbing_satu->nama_dosen }} --}}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"><b>Nama Dosen</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $mahasiswa->nama_mahasiswa }} --}}
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Status</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                            
                                </div>
                            </div>

                            <form action="{{-- route('berkas.validasi.seminar.ta1.update',$seminar->encrypt_id) --}}" method="post" id="formStatus">
                                @method('put')
                                @csrf
                                <div class="form-group" style="margin-top: 20px">
                                    <label><b>Lokasi</b></label>
                                    <select onchange="toggleCatatan()" name="status_admin" id="status"
                                        class="selectpicker form-control" data-size="5">
                                        <option value="Process"
                                            {{-- $seminar->status_admin=='Process'?'selected':'' --}}>
                                            Diproses</option>
                                        <option value="Valid" {{-- $seminar->status_admin=='Valid'?'selected':'' --}}>
                                            Valid</option>
                                        <option value="Invalid"
                                            {{-- $seminar->status_admin=='Invalid'?'selected':'' --}}>Invalid</option>
                                    </select>
                                    @error('proses_admin')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row border-bottom mt-3">
                                    <label class="col-md-12 bold"><b>Catatan</b></label>
                                    <textarea id="catatan" name="komentar" class="form-control m-3" style="height: 100px;"></textarea>
                                    @error('komentar')
                                        <div class="form-control-feedback has-danger col-md-12 mb-3">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class="submit btn btn-primary" value="submit" id="submitButton">Submit</button>
                                </div>
                            </form>
                            <a href="{{ route('berkas.validasi.seminar.kp.index') }}">
                                <button class="batal btn btn-secondary">Batal</button>
                            </a>
                        </div>
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
