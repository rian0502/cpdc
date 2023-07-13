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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jquery-dateFormat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- penguji 1 start --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4" style="margin-bottom: 20px">Penguji 1</h4>
                        </div>
                    </div>
                    <div class="mb-3 pb-2">
                        <div class="form-group">
                            <div class="profile-photo">
                                <div class="circle-wrapper">
                                    <img id="preview-image" src="/uploads/profile/dwi.jpg" alt="Foto Profile"
                                        onerror="this.src='/uploads/profile/default.png'" class="foto">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                        <div class="row border-bottom">
                            <label class="col-md-3 bold mt-2"> <strong>Nomor Induk Dosen Nasional</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">

                            </div>
                            <label class="col-md-3 bold mt-2"><b>Email</b></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $seminar->pembimbing_satu->nama_dosen }} --}}
                            </div>
                        </div>
                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold"><b>Nama Dosen</b></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $mahasiswa->nama_mahasiswa }} --}}
                            </div>
                            <label class="col-md-3 bold mt-1"><strong>Nomor Telepon</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">

                            </div>
                        </div>
                    </div>
                </div>
                {{-- penguji 1 End --}}

                {{-- penguji 2 start --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4" style="margin-bottom: 20px">Penguji 2</h4>
                        </div>
                    </div>
                    <div class="mb-3 pb-2">
                        <div class="form-group">
                            <div class="profile-photo">
                                <div class="circle-wrapper">
                                    <img id="preview-image" src="/uploads/profile/dwi.jpg" alt="Foto Profile"
                                        onerror="this.src='/uploads/profile/default.png'" class="foto">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                        <div class="row border-bottom">
                            <label class="col-md-3 bold mt-2"> <strong>Nomor Induk Dosen Nasional</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $mahasiswa->npm }} --}}
                            </div>
                            <label class="col-md-3 bold mt-2"><b>Email</b></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $seminar->pembimbing_satu->nama_dosen }} --}}
                            </div>
                        </div>
                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold"><b>Nama Dosen</b></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $mahasiswa->nama_mahasiswa }} --}}
                            </div>
                            <label class="col-md-3 bold mt-1"><strong>Nomor Telepon</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">

                            </div>
                        </div>
                    </div>
                </div>
                {{-- penguji 2 End --}}

                {{-- penguji 3 start --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4" style="margin-bottom: 20px">Penguji 3</h4>
                        </div>
                    </div>
                    <div class="mb-3 pb-2">
                        <div class="form-group">
                            <div class="profile-photo">
                                <div class="circle-wrapper">
                                    <img id="preview-image" src="/uploads/profile/dwi.jpg" alt="Foto Profile"
                                        onerror="this.src='/uploads/profile/default.png'" class="foto">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                        <div class="row border-bottom">
                            <label class="col-md-3 bold mt-2"> <strong>Nomor Induk Dosen Nasional</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $mahasiswa->npm }} --}}
                            </div>
                            <label class="col-md-3 bold mt-2"><b>Email</b></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $seminar->pembimbing_satu->nama_dosen }} --}}
                            </div>
                        </div>
                        <div class="row border-bottom mt-2">
                            <label class="col-md-3 bold"><b>Nama Dosen</b></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">
                                {{-- {{ $mahasiswa->nama_mahasiswa }} --}}
                            </div>
                            <label class="col-md-3 bold mt-1"><strong>Nomor Telepon</strong></label>
                            <div class="col-md-3 mt-2" style="display:block;word-wrap:break-word;">

                            </div>
                        </div>
                    </div>

                </div>
                {{-- penguji 3 End --}}

            </div>
        </div>
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
