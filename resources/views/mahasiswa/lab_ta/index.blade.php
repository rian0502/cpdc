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
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jquery-dateFormat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">


                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix mb-30">
                            <div class="pull-left">
                                <h4 class="text-dark h4">Presensi Lab</h4>
                                <div>Anda sudah melakukan presensi lab pada hari ini</div>
                            </div>
                        </div>

                        <div class="jadwal_seminar">
                            <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                                <div class="row border-bottom">
                                    <label class="col-md-3 bold mt-2"> <strong>Tanggal Presensi</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">

                                    </div>
                                    <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">

                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"> <strong>Lokasi Penelitian</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        <div>

                                        </div>
                                    </div>
                                    <label class="col-md-3 bold mt-1"><strong>Jam Selesai</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">

                                    </div>
                                </div>
                                <div class="row border-bottom mt-2">
                                    <label class="col-md-3 bold"> <strong>Keterangan</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        <div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>


            </div>
        </div>
        <!-- Input Validation End -->
    </div>
@endsection