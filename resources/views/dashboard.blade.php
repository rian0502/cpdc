@extends('layouts.datatable')
@section('datatable')
    <link rel="stylesheet" href="/Assets/css/helps.css">
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
                        <a href="{{ route('berkas.validasi.seminar.ta1.index') }}">
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
                        <a href="{{ route('berkas.validasi.seminar.ta2.index') }}">
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
                        <a href="{{ route('berkas.validasi.sidang.kompre.index') }}">
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
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <a href="{{ route('berkas.validasi.s2.tesis1.index') }}">
                            <div class="card-box height-100-p widget-style3 ">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">{{ $tesis1 }}</div>
                                        <div class="font-14 text-secondary weight-500">
                                            Belum Tervalidasi
                                        </div>
                                    </div>
                                    <div class="widgets">
                                        <div class="icon" data-color="#00eccf">
                                            <STROng>TESIS 1</STROng>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <a href="{{ route('berkas.validasi.s2.tesis2.index') }}">
                            <div class="card-box height-100-p widget-style3 ">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">{{ $tesis2 }}</div>
                                        <div class="font-14 text-secondary weight-500">
                                            Belum Tervalidasi
                                        </div>
                                    </div>
                                    <div class="widgets">
                                        <div class="icon" data-color="#00eccf">
                                            <STRong>TESIS 2</STRong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <a href="{{ route('berkas.validasi.s2.tesis3.index') }}">
                            <div class="card-box height-100-p widget-style3 ">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">{{ $tesis3 }}</div>
                                        <div class="font-14 text-secondary weight-500">
                                            Belum Tervalidasi
                                        </div>
                                    </div>
                                    <div class="widgets">
                                        <div class="icon" data-color="#00eccf">
                                            <STRong>TESIS 3</STRong>
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
                        <a href="{{ route('koor.validasiBaPKL.index') }}">
                            <div class="card-box height-100-p widget-style3 ">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">
                                            {{ $invalid_kp }}
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
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $jumlah_kp }}
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
                        <a href="{{ route('koor.jadwalPKL.index') }}"></a>
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
                        </a>
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
                        <a href="{{ route('koor.validasiBaTA1.index') }}">
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
                        </a>
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
                        <a href="{{ route('koor.jadwalTA1.index') }}"></a>
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
                        </a>
                    </div>
                </div>
            @endrole
            @role('ta2')
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <a href="{{ route('koor.jadwalTA2.index') }}"></a>
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
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <a href="{{ route('koor.validasiBaTA2.index') }}">
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
                        </a>
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
                        <a href="{{ route('koor.jadwalTA2.index') }}"></a>
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
                        </a>
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
                        <a href="{{ route('koor.validasiBaKompre.index') }}"></a>
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
                        </a>
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
                        <a href="{{ route('koor.jadwalKompre.index') }}"></a>
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
            @role('ta1S2')
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap" style="width: -300px">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $total_berkas_s2_ta1 }}
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
                        <a href="{{ route('koor.ValidasiBaTa1S2.index') }}">
                            <div class="card-box height-100-p widget-style3 ">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">
                                            {{ $invalid_berkas_s2_ta1 }}
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
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $jumlah_ta1_s2_ta1 }}
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
                        <a href="{{ route('koor.jadwalTA1S2.index') }}"></a>
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $invalid_jadwal_s2_ta1 }}
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
                        </a>
                    </div>
                </div>
            @endrole
            @role('ta2S2')
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <a href="{{ route('koor.jadwalTA2S2.index') }}"></a>
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap" style="width: -300px">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $total_berkas_s2_ta2 }}
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
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <a href="{{ route('koor.ValidasiBaTa2S2.index') }}">
                            <div class="card-box height-100-p widget-style3 ">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">
                                            {{ $invalid_berkas_s2_ta2 }}
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
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $jumlah_ta2_s2_ta2 }}
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
                        <a href="{{ route('koor.jadwalTA2S2.index') }}"></a>
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $invalid_jadwal_s2_ta2 }}
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
                        </a>
                    </div>
                </div>
            @endrole
            @role('kompreS2')
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap" style="width: -300px">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $total_berkas_s2_kompre }}
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
                        <a href="{{ route('koor.ValidasiBaKompreS2.index') }}"></a>
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">
                                        {{ $invalid_berkas_s2_kompre }}
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
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $jumlah_kompre_s2_kompre }}
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
                        <a href="{{ route('koor.jadwalKompreS2.index') }}"></a>
                        <div class="card-box height-100-p widget-style3 ">
                            <div class="d-flex flex-wrap">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $invalid_jadwal_s2_kompre }}
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
            @role('admin lab|jurusan|kalab')
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
                                    <label for="lokasi">Lokasi</label>
                                    <select name="lokasi" id="lokasi" data-size="7" class="selectpicker form-control"
                                        data-style="btn-outline-primary">
                                        <option value="all">Semua</option>
                                        <option value="1">Lab. Kimia Analitik & Instrumentasi</option>
                                        <option value="2">Lab. Kimia Anorganik-Fisik</option>
                                        <option value="4">Lab. Kimia Organik</option>
                                        <option value="5">Lab. Kimia Dasar</option>
                                        <option value="6">Lab. Biokimia</option>

                                    </select>
                                </div>
                            </div>
                        @endrole
                    </div>
                    <div id="chart_lab"></div>
                </div>
            @endrole

            @role('admin lab|kalab')
                <div class="card-box pb-10" style="margin-bottom: 30px">
                    <div class="h5 pd-20 mb-0">Data Asistensi</div>
                    <table id="data-asisten" class="table warp stripe p-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NPM</th>
                                <th>Kehadiran</th>
                                <th>Total Jam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            @endrole
            @role('jurusan|kaprodiS1|tpmpsS1')
                <div class="card-box height-100-p pd-20 min-height-200px mb-20">
                    <div class="row align-items-center justify-content-center mb-3">
                        <h2>Data Seminar S1</h2>
                    </div>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="startDate2">Tanggal Awal</label>
                                <input type="date" name="startDate2" class="form-control" placeholder="Tanggal Awal"
                                    id="startDate2" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="endDate2">Tanggal Akhir</label>
                                <input type="date" class="form-control" name="endDate2" placeholder="Tanggal Akhir"
                                    id="endDate2" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="angkatan">Angkatan</label>
                                <select class="selectpicker form-control" data-style="btn-outline-primary" data-size="5"
                                    id="angkatan" name="angkatan">
                                    <option value="all" selected>Semua</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="chart_seminar2"></div>
                </div>
            @endrole
            @role('jurusan|kaprodiS2|tpmpsS2')
                <div class="card-box height-100-p pd-20 min-height-200px mb-20">
                    <div class="row align-items-center justify-content-center mb-3">
                        <h2>Data Seminar S2</h2>
                    </div>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="startDate2S2">Tanggal Awal</label>
                                <input type="date" name="startDate2S2" class="form-control" placeholder="Tanggal Awal"
                                    id="startDate2S2" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="endDate2S2">Tanggal Akhir</label>
                                <input type="date" class="form-control" name="endDate2S2" placeholder="Tanggal Akhir"
                                    id="endDate2S2" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="angkatanS2">Angkatan</label>
                                <select class="selectpicker form-control" data-style="btn-outline-primary" data-size="5"
                                    id="angkatanS2" name="angkatanS2">
                                    <option value="all" selected>Semua</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="chart_seminar2S2"></div>
                </div>
            @endrole
            @role(['alumniS2', 'mahasiswaS2'])
                <div class="row pb-10">
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                        <div class="card-box height-100-p widget-style3">
                            <div class="d-flex flex-wrap" style="width: -300px">
                                <div class="widget-data">
                                    <div class="weight-700 font-24 text-dark">{{ $jumlah_prestasi_s2 }}</div>
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
                                    <div class="weight-700 font-24 text-dark">{{ $jumlah_aktivitas_s2 }}</div>
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
            @endrole
            @role(['alumni', 'mahasiswa'])
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
                            @foreach ($sop_kimdas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_sop }}</td>
                                    <td>
                                        <a target="_blank" href="/uploads/sop/{{ $item->file_sop }}">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
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
                            @foreach ($sop_organik as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_sop }}</td>
                                    <td>
                                        <a target="_blank" href="/uploads/sop/{{ $item->file_sop }}">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-box pb-10" style="margin-bottom: 30px">
                    <div class="h5 pd-20 mb-0">SOP Laboratorium Kimia Anorganik atau Fisik</div>
                    <table class="table data-table-responsive warp stripe data-table-noexport p-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama SOP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sop_anorganik as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_sop }}</td>
                                    <td>
                                        <a target="_blank" href="/uploads/sop/{{ $item->file_sop }}">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
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
                            @foreach ($sop_biokimia as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_sop }}</td>
                                    <td>
                                        <a target="_blank" href="/uploads/sop/{{ $item->file_sop }}">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
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
                            @foreach ($sop_analitik as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_sop }}</td>
                                    <td>
                                        <a target="_blank" href="/uploads/sop/{{ $item->file_sop }}">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endrole


            {{-- BUAT UNTUK PEMBERITAHUAN SEMINAR H-1 UNTUK ROLE DOSEN --}}
            @role('dosen')
                <div class="faq-wrap">
                    <div id="accordion1">
                        {{-- s1 --}}
                        <div class="" style="margin-bottom: 20px">
                            <div class="card-header" style="margin-bottom: 20px">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#s1">
                                    Data Pelaksanaan Seminar S1
                                </button>
                            </div>
                            <div id="s1" class="collapse" data-parent="#accordion1">

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
                            </div>
                        </div>
                        {{-- s2 --}}
                        <div class="" style="margin-bottom: 20px">
                            <div class="card-header" style="margin-bottom: 20px">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#s2">
                                    Data Pelaksanaan Seminar S2
                                </button>
                            </div>
                            <div id="s2" class="collapse" data-parent="#accordion1">

                                <div class="card-box pb-10" style="margin-bottom: 30px">
                                    <div class="h5 pd-20 mb-0">Data Pelaksanaan Seminar Tesis 1</div>
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
                                            @foreach ($jadwalTesis1 as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->mahasiswa->npm }}</td>
                                                    <td>{{ $item->judul_ta }}</td>
                                                    <td>{{ $item->jadwal->tanggal }}</td>
                                                    <td>{{ $item->jadwal->jam_mulai }} -
                                                        {{ $item->jadwal->jam_selesai }} WIB</td>
                                                    <td>{{ $item->jadwal->lokasi->nama_lokasi }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-box pb-10" style="margin-bottom: 30px">
                                    <div class="h5 pd-20 mb-0">Data Pelaksanaan Seminar Tesis 2</div>
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
                                            @foreach ($jadwalTesis2 as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->mahasiswa->npm }}</td>
                                                    <td>{{ $item->judul_ta }}</td>
                                                    <td>{{ $item->jadwal->tanggal }}</td>
                                                    <td>{{ $item->jadwal->jam_mulai }} -
                                                        {{ $item->jadwal->jam_selesai }} WIB</td>
                                                    <td>{{ $item->jadwal->lokasi->nama_lokasi }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-box pb-10" style="margin-bottom: 30px">
                                    <div class="h5 pd-20 mb-0">Data Pelaksanaan Sidang Tesis</div>
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
                                            @foreach ($jadwalSidangTesis as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->mahasiswa->npm }}</td>
                                                    <td>{{ $item->judul_ta }}</td>
                                                    <td>{{ $item->jadwal->tanggal }}</td>
                                                    <td>{{ $item->jadwal->jam_mulai }} -
                                                        {{ $item->jadwal->jam_selesai }} WIB</td>
                                                    <td>{{ $item->jadwal->lokasi->nama_lokasi }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        credits: {
                            enabled: false
                        },
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
            function jabatanDosen() {
                // Data dummy
                $.ajax({
                    url: "{{ route('chart.jabatan.dosen') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var options = {
                            credits: {
                                enabled: false
                            },
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
                            credits: {
                                enabled: false
                            },
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
    @role('admin lab|jurusan|kalab')
        <script>
            // Data dummy untuk aktivitas penggunaan laboratorium
            function lineChartAktivitasLab(startDate = null, endDate = null, lokasi = null) {
                // Mengambil nilai tanggal awal dan akhir dari input
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                @role('admin lab|kalab')
                    var lokasi = '{{ Auth::user()->lokasi_id }}';
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
                            credits: {
                                enabled: false
                            },
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: ''
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
                                },
                                {
                                    name: 'Jumlah PKL',
                                    data: data.jumlah_PKL
                                },
                                {
                                    name: 'Jumlah MBKM',
                                    data: data.jumlah_MBKM
                                },
                                {
                                    name: 'Jumlah PKM',
                                    data: data.jumlah_PKM
                                },


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
        <script>
            var dataAsisten;


            $(document).ready(function() {
                tableAsistenSeminar();

                function tableAsistenSeminar(startDate = null, endDate = null) {
                    if (dataAsisten) {
                        dataAsisten.destroy();
                    }

                    dataAsisten = $('#data-asisten').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('lab.asistensi.ajax') }}',
                            dataType: 'json',
                            data: function(d) {
                                d.startDate = startDate;
                                d.endDate = endDate;
                            }
                        },

                        columns: [{
                                data: 'npm',
                                name: 'npm',
                                render: function(data, type, row, meta) {
                                    // Menghasilkan nomor urutan perdata
                                    var index = meta.row + meta.settings._iDisplayStart + 1;
                                    return index;
                                }
                            },
                            {
                                data: 'nama_mahasiswa',
                                name: 'nama_mahasiswa'
                            },
                            {
                                data: 'npm',
                                name: 'npm'
                            },
                            {
                                data: 'kehadiran',
                                name: 'kehadiran'
                            },
                            {
                                data: 'total_durasi',
                                name: 'total_durasi'
                            },
                            {
                                data: null,
                                name: 'aksi',
                                orderable: false,
                                searchable: false,
                                render: function(data, type, row) {
                                    // var downloadUrl = "{{ asset('uploads/file_') }}" + '/' + row
                                    //     .file_litabmas;
                                    var detail =
                                        "{{ route('lab.asistensi.show', ':id') }}"
                                        .replace(
                                            ':id', row.npm);

                                    return `
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#"
                                    role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="${detail}"><i class="dw dw-eye"></i> Lihat</a>
                                </div>
                            </div>
                            `;
                                }
                            }

                        ]
                    });

                }
                $('#startDate, #endDate').change(function() {
                    var startDate = $('#startDate').val();
                    var endDate = $('#endDate').val();
                    tableAsistenSeminar(startDate, endDate);
                });
            });
        </script>
    @endrole

    <script>
        function chartSeminar2S2(startDate2S2, endDate2S2, angkatan) {
            $.ajax({
                url: '{{ route('chart.seminarS2.all') }}',
                method: 'GET',
                dataType: 'json',
                data: {
                    startDate2S2: startDate2S2,
                    endDate2S2: endDate2S2,
                    angkatanS2: angkatanS2
                },
                success: function(response) {
                    var data = response;

                    var categories = data.categories;
                    var seminarData = data.seminar;
                    var nonseminarData = data.nonseminar;

                    var seriesData = [{
                        name: 'False',
                        data: nonseminarData

                    }, {
                        name: 'True',
                        data: seminarData
                    }];

                    var options = {
                        credits: {
                            enabled: false
                        },
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        xAxis: {
                            categories: categories,
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
                                stacking: 'normal',
                                grouping: false,
                                shadow: false,
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        colors: ['#FF1818', '#5463FF'],
                        series: seriesData
                    };

                    Highcharts.chart('chart_seminar2S2', options);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Panggil fungsi chartSeminar2S2 dengan nilai awal tanggal dan angkatanS2
        var startDate2S2 = null;
        var endDate2S2 = null;
        var angkatanS2 = null;
        chartSeminar2S2(startDate2S2, endDate2S2, angkatanS2);

        // Atur event listener untuk mengaktifkan pemfilteran berdasarkan tanggal dan angkatanS2 saat nilai berubah
        $('#startDate2S2, #endDate2S2, #angkatanS2').change(function() {
            startDate2S2 = $('#startDate2S2').val();
            endDate2S2 = $('#endDate2S2').val();
            angkatanS2 = $('#angkatanS2').val();
            console.log(startDate2S2, endDate2S2, angkatanS2);
            chartSeminar2S2(startDate2S2, endDate2S2, angkatanS2);
        });
    </script>
    <script>
        function chartSeminar2(startDate2, endDate2, angkatan) {
            $.ajax({
                url: '{{ route('chart.seminar.all') }}',
                method: 'GET',
                dataType: 'json',
                data: {
                    startDate2: startDate2,
                    endDate2: endDate2,
                    angkatan: angkatan
                },
                success: function(response) {
                    var data = response;

                    var categories = data.categories;
                    var seminarData = data.seminar;
                    var nonseminarData = data.nonseminar;

                    var seriesData = [{
                        name: 'False',
                        data: nonseminarData

                    }, {
                        name: 'True',
                        data: seminarData
                    }];

                    var options = {
                        credits: {
                            enabled: false
                        },
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        xAxis: {
                            categories: categories,
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
                                stacking: 'normal',
                                grouping: false,
                                shadow: false,
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        colors: ['#FF1818', '#5463FF'],
                        series: seriesData
                    };

                    Highcharts.chart('chart_seminar2', options);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Panggil fungsi chartSeminar2 dengan nilai awal tanggal dan angkatan
        var startDate2 = null;
        var endDate2 = null;
        var angkatan = null;
        chartSeminar2(startDate2, endDate2, angkatan);

        // Atur event listener untuk mengaktifkan pemfilteran berdasarkan tanggal dan angkatan saat nilai berubah
        $('#startDate2, #endDate2, #angkatan').change(function() {
            startDate2 = $('#startDate2').val();
            endDate2 = $('#endDate2').val();
            angkatan = $('#angkatan').val();
            console.log(startDate2, endDate2, angkatan);
            chartSeminar2(startDate2, endDate2, angkatan);
        });
    </script>

    <script>
        function addYearOptionsToSelectElement(selectElement) {
            // Mendapatkan tahun saat ini
            var currentYear = new Date().getFullYear();

            // Membuat array opsi tahun dari tahun terbaru ke tahun 1950
            var options = [];
            for (var year = 2000; year <= currentYear; year++) {
                options.push(year);
            }
            options.reverse(); // Membalik urutan elemen array

            // Menambahkan opsi tahun ke elemen select
            for (var i = 0; i < options.length; i++) {
                var optionElement = document.createElement("option");
                optionElement.value = options[i];
                optionElement.text = options[i];
                selectElement.appendChild(optionElement);
            }
        }

        var selectElement = document.getElementById("angkatan");
        var selectElement2 = document.getElementById("angkatanS2");
        addYearOptionsToSelectElement(selectElement);
        addYearOptionsToSelectElement(selectElement2);
    </script>
@endsection
