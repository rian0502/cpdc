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
                            <h4 class="text-dark h4" style="margin-left: 10px">Data Admin Jurusan Kimia</h4>
                        </div>
                        {{-- <a href="/mahasiswa/seminar/kp/create">
                            <button class="btn btn-primary right">Edit Data</button>
                        </a> --}}

                    </div>
                    <div class="">
                        <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Nomor Induk Pegawai</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $user->administrasi->nip}}
                                </div>
                                <label class="col-md-3 bold mt-2"><b>Email</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $user->email}}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"><b>Nama Admin</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $user->name }}
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Status</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $user->administrasi->status}}
                                </div>
                            </div>

                            <form action="{{ route('sudo.admin_jurusan.update', $user->id) }}" method="post"
                                id="formStatus">
                                @method('put')
                                @csrf
                                <div class="form-group mt-5">
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

                                <div class="form-group">
                                    <button class="submit btn btn-primary" value="submit" id="submitButton">Kirim</button>
                                </div>
                            </form>
                            <a href="{{ route('sudo.admin_jurusan.index') }}">
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
