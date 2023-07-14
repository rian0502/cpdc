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

                <!-- Validasi Pendataan Alumni Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix" style="margin-bottom: 50px; margin-top: 10px;">
                        <div class="pull-left">
                            <h4 class="text-dark h4" style="margin-left: 10px">Data Validasi</h4>
                        </div>
                    </div>
                    <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                        <div class="row border-bottom">
                            <label class="col-md-3 bold mt-2"> <strong>Nomor Pokok Mahasiswa</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                {{ $mahasiswa->npm }}
                            </div>
                            <label class="col-md-3 bold mt-2"><b>IPK</b></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->ipk }}
                            </div>
                        </div>

                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold"><b>Nama Mahasiswa</b></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                {{ $mahasiswa->nama_mahasiswa }}
                            </div>
                            <label class="col-md-3 bold mt-1"><strong>Sks</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->sks }}
                            </div>
                        </div>

                        <div class="row border-bottom">
                            <label class="col-md-3 bold mt-2"> <strong>Tahun Akademik</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->tahun_akademik }}
                            </div>
                            <label class="col-md-3 bold mt-1"> <strong>Nomor Telepon</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{ $mahasiswa->no_hp }}
                            </div>
                        </div>

                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold mt-1"> <strong>Semester</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{ $mahasiswa->semester }}
                            </div>
                            <label class="col-md-3 bold mt-2"> <strong>TOEFL</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->toefl }}
                            </div>
                        </div>

                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold mt-1"> <strong>Masa Studi</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->masa_studi }}
                            </div>

                            <label class="col-md-3 bold"> <strong>Berkas TOEFL</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                <a target="_blank" href="/uploads/berkas_toefl/{{ $pendataan->berkas_toefl }}">Lihat</a>
                            </div>

                        </div>

                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold mt-1"> <strong>Tanggal Selesai Kompre</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->tgl_lulus }}
                            </div>
                            <label class="col-md-3 bold"> <strong>Berkas Pengesahan</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                <a target="_blank"
                                    href="/uploads/berkas_pengesahan/{{ $pendataan->berkas_pengesahan }}">Lihat</a>
                            </div>
                        </div>

                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold mt-2"> <strong>Rencana Periode Wisuda</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{ $pendataan->periode_wisuda }}
                            </div>
                            <label class="col-md-3 bold"> <strong>Transkrip</strong></label>
                            <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                <a target="_blank" href="/uploads/transkrip/{{ $pendataan->transkrip }}">Lihat</a>
                            </div>
                        </div>

                        <form action="{{ route('berkas.validasi.pendataan_alumni.update', $pendataan->encrypted_id) }}"
                            method="post" id="formStatus">
                            @method('put')
                            @csrf
                            <div class="form-group" style="margin-top: 20px">
                                <label><b>Status</b></label>
                                <select onchange="toggleCatatan()" name="status" id="status"
                                    class="selectpicker form-control" data-size="5">
                                    <option value="Valid" {{ $pendataan->status == 'Valid' ? 'selected' : '' }}>
                                        Valid</option>
                                    <option value="Invalid" {{ $pendataan->status == 'Invalid' ? 'selected' : '' }}>
                                        Invalid</option>
                                </select>
                                @error('status')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row border-bottom mt-3">
                                <label class="col-md-12 bold"><b>Catatan</b></label>
                                <textarea id="catatan" name="keterangan" class="form-control m-3" style="height: 100px;">{{ $pendataan->keterangan }}</textarea>
                                @error('keterangan')
                                    <div class="form-control-feedback has-danger col-md-12 mb-3">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="submit btn btn-primary" value="submit" id="submitButton">Submit</button>
                            </div>
                        </form>
                        <a href="{{ route('berkas.validasi.pendataan_alumni.index') }}">
                            <button class="batal btn btn-secondary">Batal</button>
                        </a>

                    </div>
                </div>
                <!-- Data Registrasi End -->
            </div>
        </div>
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
