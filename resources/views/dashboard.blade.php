@extends('layouts.datatable')
@section('datatable')
    <style>
        .hover:hover {
            tercolor: #1818d7;

        }

        .widget-style3 .widgets {
            width: 300px;
        }

        .apexcharts-pie-series path {
            cursor: pointer;
        }

        .highcharts-data-table-3 table {
            min-width: 310px;
            max-width: 800px;
            margin: 5;
        }


        @media (max-width: 375.98px) {
            #chart {
                scale: 0.5 !important;
                margin-left: -80px;
            }
        }

        @media (max-width: 575.98px) {
            #chart {
                scale: 0.8 !important;
                margin-left: -80px;
            }
        }

        @media (max-width: 576.98px) {
            #chart {
                scale: 0.1 !important;
                margin-left: -70px;
            }
        }

        @media (max-width: 767.98px) {
            #chart {
                scale: 0.8 !important;
                margin-left: -70px;
            }
        }

        @media (min-width: 991.98px) {
            #chart {
                scale: 0.8 !important;
                margin-left: -20px;
            }
        }

        @media (min-width: 0px) and (max-width: 767px) {
            .chart {
                display: none;
            }
        }
    </style>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="title pb-20">
                <h2 class="h2 mb-0">Dashboard</h2>
            </div>
            @role('sudo')
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap" style="width: -300px">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $npm }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        NPM
                                    </div>
                                </div>
                                <div class="widget-icon">
                                    <div class="icon" data-color="#fff">
                                        <i class="fas fa-id-card-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $profile }}

                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Profile
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon">
                                        <i class="icon-copy fa-solid fa-user" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $noVertif }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Belum Aktivasi
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <i class="far fa-paper-plane"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $acc }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">Jumlah Akun</div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap" style="width: -300px">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $actNpm }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        NPM Aktif
                                    </div>
                                </div>
                                <div class="widget-icon">
                                    <div class="icon" data-color="#fff">
                                        <i class="far fa-check-square"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $noNpm }}

                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        NPM Nonaktif
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $nonAcc }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Akun Nonaktif
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <i class="far fa-times-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $role }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">Jumlah Role</div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <i class="fas fa-user-tag"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole

            @role('admin berkas')
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <a href="{{ route('berkas.validasi.seminar.kp.index') }}">
                            <div class="card-box height-100-p widget-style3 ">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">{{ $kp }}</div>
                                        <div class="font-14 text-secondary weight-500">
                                            Belum Tervalidasi
                                        </div>
                                    </div>
                                    <div class="widgets">
                                        <div class="icon" data-color="#00eccf">
                                            <STROng>KP</STROng>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <a href="link validasi berkas ta 1">
                            <div class="card-box height-100-p widget-style3 ">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">{{ $ta1 }}</div>
                                        <div class="font-14 text-secondary weight-500">
                                            Belum Tervalidasi
                                        </div>
                                    </div>
                                    <div class="widgets">
                                        <div class="icon" data-color="#00eccf">
                                            <STRong>TA 1</STRong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <a href="link validasi berkas ta 2">
                            <div class="card-box height-100-p widget-style3 ">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">{{ $ta2 }}</div>
                                        <div class="font-14 text-secondary weight-500">
                                            Belum Tervalidasi
                                        </div>
                                    </div>
                                    <div class="widgets">
                                        <div class="icon" data-color="#00eccf">
                                            <STRong>TA 2</STRong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <a href="link validasi berkas kompre">
                            <div class="card-box height-100-p widget-style3 ">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">{{ $kompre }}</div>
                                        <div class="font-14 text-secondary weight-500">
                                            Belum Tervalidasi
                                        </div>
                                    </div>
                                    <div class="widgets">
                                        <div class="icon" data-color="#00eccf">
                                            <STROng>KOMPRE</STROng>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endrole
            @role('pkl')
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap" style="width: -300px">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        0
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Total Berkas
                                    </div>
                                </div>
                                <div class="widget-icon">
                                    <div class="icon" data-color="#fff">
                                        <i class="far fa-folder-open"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $unvalid_kp }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Belum Valid
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">10
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Total Seminar
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $jadwal_seminar }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">Belum Terjadwal</div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <i class="far fa-calendar-times"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
            @role('ta1')
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap" style="width: -300px">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $total_berkas }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Total Berkas
                                    </div>
                                </div>
                                <div class="widget-icon">
                                    <div class="icon" data-color="#fff">
                                        <i class="far fa-folder-open"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $invalid_berkas }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Belum Sah
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $jumlah_ta1 }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Total Seminar
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $invalid_jadwal }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">Belum Terjadwal</div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <i class="far fa-calendar-times"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
            @role('ta2')
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap" style="width: -300px">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $total_berkas }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Total Berkas
                                    </div>
                                </div>
                                <div class="widget-icon">
                                    <div class="icon" data-color="#fff">
                                        <i class="far fa-folder-open"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $invalid_berkas }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Belum Valid
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $jumlah_ta2 }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Total Seminar
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $invalid_jadwal }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">Belum Terjadwal</div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <i class="far fa-calendar-times"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
            @role('kompre')
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap" style="width: -300px">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $total_berkas }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Total Berkas
                                    </div>
                                </div>
                                <div class="widget-icon">
                                    <div class="icon" data-color="#fff">
                                        <i class="far fa-folder-open"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $invalid_berkas }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Belum Valid
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $jumlah_kompre }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Total Seminar
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $invalid_jadwal }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">Belum Terjadwal</div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <i class="far fa-calendar-times"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
            @role('jurusan')
                <div class="row">

                    <div class="col-lg-4 col-md-6 mb-20">
                        <div class="card-box height-100-p pd-20 min-height-200px">

                            <div class="d-flex justify-content-between">


                            </div>

                            <div id="chart_aktivitas_alumni"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-20">
                        <div class="card-box height-100-p pd-20 min-height-200px">
                            <div class="d-flex justify-content-between">
                            </div>
                            <div id="umur_chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-20">
                        <div class="card-box height-100-p pd-20 min-height-200px">
                            <div class="d-flex justify-content-between">
                            </div>
                            <div id="jabatan_chart"></div>
                        </div>
                    </div>
                </div>
            @endrole
            @role('admin lab|jurusan')
                <div class="card-box height-100-p pd-20 min-height-200px mb-20">
                    <div class="row align-items-center justify-content-center mb-3">
                        <h2>Aktivitas Laboratorium</h2>
                    </div>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="startDate">Tanggal Awal</label>
                                <input type="date" name="startDate" class="form-control" placeholder="Tanggal Awal"
                                    id="startDate" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="endDate">Tanggal Akhir</label>
                                <input type="date" class="form-control" name="endDate" placeholder="Tanggal Akhir"
                                    id="endDate" autocomplete="off">
                            </div>
                        </div>
                        @role('jurusan')
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="endDate">Lokasi</label>
                                    <select name="lokasi" id="lokasi" class="form-control">
                                        <option value="all">Semua</option>
                                        <option value="1">Lab Biokimia A</option>
                                        <option value="2">Lab Biokimia B</option>
                                        <option value="3">Lab Biokimia C</option>

                                    </select>
                                </div>
                            </div>
                        @endrole
                    </div>
                    <div id="chart_lab"></div>
                </div>
            @endrole
            @role('mahasiswa')
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap" style="width: -300px">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $jumlah_prestasi }}</div>
                                    <div class="font-14 text-secondary weight-500">
                                        Prestasi
                                    </div>
                                </div>
                                <div class="widget-icon">
                                    <div class="icon" data-color="#fff">
                                        <i class="icon-copy dw dw-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $jumlah_aktivitas }}</div>
                                    <div class="font-14 text-secondary weight-500">
                                        Kegiatan Tambahan
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon">
                                        <i class="icon-copy ion ion-ribbon-b" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ Auth::user()->mahasiswa->semester }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">
                                        Semester
                                    </div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <span class="icon-copy fa-solid fa-bookmark"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ Auth::user()->mahasiswa->status }}
                                    </div>
                                    <div class="font-14 text-secondary weight-500">Status</div>
                                </div>
                                <div class="widget-icon ">
                                    <div class="icon" data-color="#fffff">
                                        <i class="icon-copy fa-solid fa-user" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-box pb-10" style="margin-bottom: 30px">
                    <div class="h5 pd-20 mb-0">SOP Laboratorium Kimia Dasar</div>
                    <table class="table data-table-responsive warp stripe data-table-noexport p-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama SOP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a target="_blank" href="">Lihat</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-box pb-10" style="margin-bottom: 30px">
                    <div class="h5 pd-20 mb-0">SOP Laboratorium Kimia Organik</div>
                    <table class="table data-table-responsive warp stripe data-table-noexport p-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama SOP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a target="_blank" href="">Lihat</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-box pb-10" style="margin-bottom: 30px">
                    <div class="h5 pd-20 mb-0">SOP Laboratorium Kimia Anrganik atau Fisik</div>
                    <table class="table data-table-responsive warp stripe data-table-noexport p-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama SOP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a target="_blank" href="">Lihat</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-box pb-10" style="margin-bottom: 30px">
                    <div class="h5 pd-20 mb-0">SOP Laboratorium Biokimia</div>
                    <table class="table data-table-responsive warp stripe data-table-noexport p-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama SOP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a target="_blank" href="">Lihat</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-box pb-10" style="margin-bottom: 30px">
                    <div class="h5 pd-20 mb-0">SOP Laboratorium Kimia Analitik</div>
                    <table class="table data-table-responsive warp stripe data-table-noexport p-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama SOP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <a target="_blank" href="">Lihat</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endrole


            {{-- BUAT UNTUK PEMBERITAHUAN SEMINAR H-1 UNTUK ROLE DOSEN --}}
            @role('dosen')
                <div class="card-box pb-10" style="margin-bottom: 30px">
                    <div class="h5 pd-20 mb-0">Data Pelaksanaan Seminar Kerja Praktik</div>

                    <table class="table data-table-responsive warp stripe data-table-noexport p-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalskp as $item)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td>{{ $item->mahasiswa->npm }}</td>
                                    <td>{{ $item->judul_kp }}</td>
                                    <td>{{ $item->jadwal->tanggal_skp }}</td>
                                    <td>{{ $item->jadwal->jam_mulai_skp . ' - ' . $item->jadwal->jam_selesai_skp }}
                                    </td>
                                    <td>{{ $item->jadwal->lokasi->nama_lokasi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-box pb-10" style="margin-bottom: 30px">
                    <div class="h5 pd-20 mb-0">Data Pelaksanaan Seminar Tugas Akhir 1</div>
                    <table class="table data-table-responsive stripe data-table-noexport p-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalta1 as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mahasiswa->npm }}</td>
                                    <td>{{ $item->judul_ta }}</td>
                                    <td>{{ $item->jadwal->tanggal_seminar_ta_satu }}</td>
                                    <td>{{ $item->jadwal->jam_mulai_seminar_ta_satu }} -
                                        {{ $item->jadwal->jam_selesai_seminar_ta_satu }} WIB</td>
                                    <td>{{ $item->jadwal->lokasi->nama_lokasi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-box pb-10" style="margin-bottom: 30px">
                    <div class="h5 pd-20 mb-0">Data Pelaksanaan Seminar Tugas Akhir 2</div>
                    <table class="table data-table-responsive stripe data-table-noexport p-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalta2 as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mahasiswa->npm }}</td>
                                    <td>{{ $item->judul_ta }}</td>
                                    <td>{{ $item->jadwal->tanggal_seminar_ta_dua }}</td>
                                    <td>{{ $item->jadwal->jam_mulai_seminar_ta_dua }} -
                                        {{ $item->jadwal->jam_selesai_seminar_ta_dua }} WIB</td>
                                    <td>{{ $item->jadwal->lokasi->nama_lokasi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-box pb-10" style="margin-bottom: 30px">
                    <div class="h5 pd-20 mb-0">Data Pelaksanaan Sidang Komprehensif</div>
                    <table class="table data-table-responsive stripe data-table-noexport p-2 nowarp">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalkompre as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mahasiswa->npm }}</td>
                                    <td>{{ $item->judul_ta }}</td>
                                    <td>{{ $item->jadwal->tanggal_komprehensif }}</td>
                                    <td>{{ $item->jadwal->jam_mulai_komprehensif }} -
                                        {{ $item->jadwal->jam_selesai_komprehensif }} WIB</td>
                                    <td>{{ $item->jadwal->lokasi->nama_lokasi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endrole
        </div>
    </div>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Pie Chart with Links</title>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.3/dist/apexcharts.min.js"></script>
    </head>

    <body>

    </body>

    </html>




    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @role('jurusan')
        <script>
            // Data chart
            $.ajax({
                url: '{{ route('chart.usia.dosen') }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var chartData =
                        data; // Tambahkan variabel chartData untuk menyimpan data yang diterima dari respons

                    var options = {
                        chart: {
                            type: 'pie',
                        },
                        title: {
                            text: 'Usia Dosen'
                        },
                        series: [{
                            name: 'Data',
                            data: chartData.map(data => ({
                                name: data.usia_group,
                                y: data.total
                            }))
                        }],
                        plotOptions: {
                            pie: {
                                cursor: 'pointer',
                                allowPointSelect: true,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.name}: {point.percentage:.1f}%',
                                    style: {
                                        textOutline: 'none'
                                    }
                                }
                            }
                        },
                        tooltip: {
                            pointFormat: '<b>Jumlah: {point.y}</b>'
                        },
                        legend: {
                            labelFormatter: function() {
                                const pointIndex = this.index;
                                const pointName = chartData[pointIndex].usia_group;
                                return `${pointName}`;
                            }
                        }
                    };

                    Highcharts.chart('umur_chart', options);
                }
            });
        </script>


        <script>
            // Data dummy
            function createPerangkatanDropdown() {


                var data = [{
                        name: 'SEMINAR',
                        kp: 10,
                        ta1: 8,
                        ta2: 9,
                        kompre: 7,
                        belum_seminar: 5,
                        perangkatan: '2023'
                    },
                    {
                        name: 'SEMINAR',
                        kp: 7,
                        ta1: 6,
                        ta2: 8,
                        kompre: 7,
                        belum_seminar: 4,
                        perangkatan: '2022'
                    },
                    {
                        name: 'SEMINAR',
                        kp: 9,
                        ta1: 8,
                        ta2: 7,
                        kompre: 6,
                        belum_seminar: 6,
                        perangkatan: '2023'
                    },
                    {
                        name: 'SEMINAR',
                        kp: 8,
                        ta1: 7,
                        ta2: 9,
                        kompre: 8,
                        belum_seminar: 3,
                        perangkatan: '2021'
                    },
                    {
                        name: 'SEMINAR',
                        kp: 6,
                        ta1: 9,
                        ta2: 7,
                        kompre: 6,
                        belum_seminar: 7,
                        perangkatan: '2022'
                    },
                    {
                        name: 'SEMINAR',
                        kp: 8,
                        ta1: 7,
                        ta2: 6,
                        kompre: 7,
                        belum_seminar: 4,
                        perangkatan: '2020'
                    },
                    {
                        name: 'SEMINAR',
                        kp: 8,
                        ta1: 7,
                        ta2: 6,
                        kompre: 7,
                        belum_seminar: 2,
                        perangkatan: '2020'
                    },
                    {
                        name: 'SEMINAR',
                        kp: 7,
                        ta1: 8,
                        ta2: 9,
                        kompre: 8,
                        belum_seminar: 5,
                        perangkatan: '2023'
                    },
                    {
                        name: 'SEMINAR',
                        kp: 9,
                        ta1: 6,
                        ta2: 7,
                        kompre: 9,
                        belum_seminar: 3,
                        perangkatan: '2021'
                    },
                    {
                        name: 'SEMINAR',
                        kp: 6,
                        ta1: 7,
                        ta2: 6,
                        kompre: 8,
                        belum_seminar: 6,
                        perangkatan: '2022'
                    },
                    {
                        name: 'SEMINAR',
                        kp: 8,
                        ta1: 8,
                        ta2: 7,
                        kompre: 7,
                        belum_seminar: 4,
                        perangkatan: '2023'
                    }
                ];

                // Filter perangkatan
                var perangkatanOptions = ['2020', '2021', '2022', '2023'];
                var selectedPerangkatan = perangkatanOptions[0];




                // Membuat series data berdasarkan filter perangkatan
                function updateChart() {
                    var filteredData = data.filter(function(item) {
                        return item.perangkatan === selectedPerangkatan;
                    });

                    var kpData = filteredData.reduce(function(total, item) {
                        return total + item.kp;
                    }, 0);

                    var ta1Data = filteredData.reduce(function(total, item) {
                        return total + item.ta1;
                    }, 0);

                    var ta2Data = filteredData.reduce(function(total, item) {
                        return total + item.ta2;
                    }, 0);

                    var kompreData = filteredData.reduce(function(total, item) {
                        return total + item.kompre;
                    }, 0);

                    var belumSeminarData = filteredData.reduce(function(total, item) {
                        return total + item.belum_seminar;
                    }, 0);

                    // Membuat chart Highcharts
                    Highcharts.chart('chart_seminar', {
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        plotOptions: {
                            pie: {
                                cursor: 'pointer',
                                allowPointSelect: true,
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        textOutline: 'none'
                                    }
                                }
                            }
                        },
                        tooltip: {
                            pointFormat: '<b>Jumlah: {point.y}</b>'
                        },
                        legend: {
                            labelFormatter: function() {
                                const pointIndex = this.index;
                                const pointName = chartData[pointIndex].usia_group;
                                return `${pointName}`;
                            }
                        },
                        series: [{
                            name: 'Jumlah',
                            data: [{
                                    name: 'KP',
                                    y: kpData
                                },
                                {
                                    name: 'TA 1',
                                    y: ta1Data
                                },
                                {
                                    name: 'TA 2',
                                    y: ta2Data
                                },
                                {
                                    name: 'Kompre',
                                    y: kompreData
                                },
                                {
                                    name: 'Belum Seminar',
                                    y: belumSeminarData
                                }
                            ]
                        }]
                    });

                }
                var dropdown = document.createElement('select');
                dropdown.setAttribute('class', 'form-control form-control-sm selectpicker text-center');
                dropdown.setAttribute('style', 'text-align: center');

                perangkatanOptions.forEach(function(perangkatan) {
                    var option = document.createElement('option');
                    option.text = perangkatan;
                    dropdown.add(option);
                });

                var chart_seminar = document.getElementById('chart_seminar');
                chart_seminar.parentNode.insertBefore(dropdown, chart_seminar);

                $(dropdown).selectpicker();

                dropdown.addEventListener('change', function() {
                    selectedPerangkatan = dropdown.value;
                    updateChart();
                });

                updateChart();
            }

            document.addEventListener('DOMContentLoaded', function() {
                createPerangkatanDropdown();
            });
        </script>
        <script>
            function jabatanDosen() {
                // Data dummy
                $.ajax({
                    url: "{{ route('chart.jabatan.dosen') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var options = {
                            chart: {
                                type: 'pie',
                            },
                            title: {
                                text: 'Jabatan Dosen'
                            },
                            plotOptions: {
                                pie: {
                                    cursor: 'pointer',
                                    allowPointSelect: true,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.percentage:.1f} %',
                                        style: {
                                            textOutline: 'none'
                                        }
                                    }
                                }
                            },
                            tooltip: {
                                pointFormat: '<b>Jumlah: {point.y}</b>'
                            },
                            series: [{
                                name: 'Jumlah',
                                data: data.map(item => ({
                                    name: item.jabatan,
                                    y: item.jumlah_dosen
                                }))
                            }]
                        };

                        // Membuat chart Highcharts
                        Highcharts.chart('jabatan_chart', options);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });

                // Konfigurasi chart Highcharts

            }

            // Panggil fungsi untuk membuat pie chart
            jabatanDosen();
        </script>
        <script>
            function aktivitasAlumni() {
                // Data dummy
                $.ajax({
                    url: "{{ route('chart.aktivitas.alumni') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var options = {
                            chart: {
                                type: 'pie',
                            },
                            title: {
                                text: 'Aktivitas Alumni'
                            },
                            plotOptions: {
                                pie: {
                                    cursor: 'pointer',
                                    allowPointSelect: true,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.percentage:.1f} %',
                                        style: {
                                            textOutline: 'none'
                                        }
                                    }
                                }
                            },
                            tooltip: {
                                pointFormat: '<b>Jumlah: {point.y}</b>'
                            },
                            series: [{
                                name: 'Jumlah',
                                data: data.map(item => ({
                                    name: item.status,
                                    y: item.jumlah_alumni
                                }))
                            }]
                        };

                        // Membuat chart Highcharts
                        Highcharts.chart('chart_aktivitas_alumni', options);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });

                // Konfigurasi chart Highcharts

            }

            // Panggil fungsi untuk membuat pie chart
            aktivitasAlumni();
        </script>
    @endrole
    @role('admin lab|jurusan')
        <script>
            // Data dummy untuk aktivitas penggunaan laboratorium
            function lineChartAktivitasLab(startDate = null, endDate = null, lokasi = null) {
                // Mengambil nilai tanggal awal dan akhir dari input
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                @role('admin lab')
                    var lokasi = '{{Auth::user()->lokasi_id}}';
                @endrole
                @role('jurusan')
                    var lokasi = $('#lokasi').val();
                @endrole
                // Mengirim permintaan Ajax ke server untuk mendapatkan data
                $.ajax({
                    url: '{{ route('chart.aktivitas.lab') }}',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        startDate: startDate, // Menggunakan nilai tanggal awal yang diambil dari input
                        endDate: endDate, // Menggunakan nilai tanggal akhir yang diambil dari input
                        lokasi: lokasi
                    },
                    success: function(response) {
                        // Menangani respons data dari server
                        var data = response;


                        // Mengubah format data menjadi format yang dapat digunakan oleh Highcharts

                        // console.log(data);
                        var options = {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Statistik Aktivitas Lab'
                            },
                            xAxis: {
                                categories: data.categories,
                                crosshair: true
                            },
                            yAxis: {
                                title: {
                                    text: 'Jumlah'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormatter: function() {
                                    return '<tr><td style="text-align: left; padding:0; color:' + this
                                        .series.color + '">' +
                                        this.series.name + ': </td>' +
                                        '<td style="text-align: right; padding:0"><b>' + Highcharts
                                        .numberFormat(this.y, 0, ".", ",") +
                                        '</b></td></tr>';
                                },
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },


                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0,

                                }
                            },



                            series: [{
                                    name: 'Jumlah Jam Aktivitas',
                                    data: data.jumlah_jam_aktivitas
                                },
                                {
                                    name: 'Jumlah Mahasiswa',
                                    data: data.jumlah_mahasiswa
                                },
                                {
                                    name: 'Jumlah Praktikum',
                                    data: data.jumlah_praktikum
                                },
                                {
                                    name: 'Jumlah Seminar',
                                    data: data.jumlah_seminar
                                },
                                {
                                    name: 'Jumlah Ujian',
                                    data: data.jumlah_ujian
                                },
                                {
                                    name: 'Jumlah Penelitian',
                                    data: data.jumlah_penelitian
                                },
                                {
                                    name: 'Jumlah Kegiatan Lainnya',
                                    data: data.jumlah_kegiatan_lainnya
                                }
                            ]
                        };


                        // Membuat line chart menggunakan Highcharts
                        Highcharts.chart('chart_lab', options);
                    },
                    error: function(xhr, status, error) {
                        // Menangani kesalahan dalam permintaan Ajax
                        console.error(error);
                    }
                });
            }


            // Panggil fungsi untuk membuat line chart
            // Panggil fungsi lineChartAktivitasLab dengan nilai awal tanggal
            lineChartAktivitasLab();

            // Atur event listener untuk mengaktifkan pemfilteran berdasarkan tanggal saat nilai tanggal berubah
            $('#startDate, #endDate, #lokasi').change(function() {

                lineChartAktivitasLab();
            });

            //dengan filter berdasarkan
        </script>
    @endrole
@endsection
