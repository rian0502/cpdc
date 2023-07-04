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
                                        <div class="weight-700 font-24 text-dark">75</div>
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
                                        <div class="weight-700 font-24 text-dark">75</div>
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
                                        <div class="weight-700 font-24 text-dark">75</div>
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
                        <a href="{{ route('berkas.validasi.seminar.kp.index') }}">
                            <div class="card-box height-100-p widget-style3 ">
                                <div class="d-flex flex-wrap">
                                    <div class="widget-data">
                                        <div class="weight-700 font-24 text-dark">75</div>
                                        <div class="font-14 text-secondary weight-500">
                                            Belum Terjadwal
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
                                        <div class="weight-700 font-24 text-dark">75</div>
                                        <div class="font-14 text-secondary weight-500">
                                            Belum Tervalidasi
                                        </div>
                                    </div>
                                    <div class="widgets">
                                        <div class="icon" data-color="#00eccf">
                                            <STRong>KP</STRong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endrole
            @role('jurusan')
                <div class="row">

                    <div class="col-lg-4 col-md-6 mb-20">
                        <div class="card-box height-100-p pd-20 min-height-200px">
                            <div class="d-flex justify-content-center mb-2">
                                <h5 class="mb-0">Data Seminar</h5>
                            </div>
                            <div class="d-flex justify-content-between">


                            </div>

                            <div id="chart_seminar"></div>
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
            @endrole


            {{-- BUAT UNTUK PEMBERITAHUAN SEMINAR H-1 UNTUK ROLE DOSEN --}}
            @role('dosen')
                <div class="card-box pb-10" style="margin-bottom: 30px">
                    <div class="h5 pd-20 mb-0">Data Pelaksanaan Seminar Kerja Praktik</div>

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
                            <tr>
                                <td>1</td>
                                <td>2017031016
                                </td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, tenetur.</td>
                                <td>10-10-2023</td>
                                <td>10.10</td>
                                <td>Ruangan Seminar</td>
                            </tr>
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
                            <tr>
                                <td>1</td>
                                <td>2017031016
                                </td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, tenetur.</td>
                                <td>10-10-2023</td>
                                <td>10.10</td>
                                <td>Ruangan Seminar</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-box pb-10" style="margin-bottom: 30px">
                    <div class="h5 pd-20 mb-0">Data Pelaksanaan Sidang Komprehensif</div>
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
                            <tr>
                                <td>1</td>
                                <td>2017031016
                                </td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, tenetur.</td>
                                <td>10-10-2023</td>
                                <td>10.10</td>
                                <td>Ruangan Seminar</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endrole
        </div>


        {{-- <div class="card-box pb-10">
                <div class="h5 pd-20 mb-0">Data Pelaksanaan Seminar Kerja Praktik</div>
                @role('mahasiswa')
                    <a href="/seminar/create" style="margin-left:15px;">
                        <button class="btn btn-success ">
                            <i class="icon-copy fi-page-add"></i>
                            Daftar Seminar
                        </button>
                    </a>
                @endrole
                <table class="table data-table-responsive stripe data-table-export ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM / Nama</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Ruangan</th>
                            <th>Prodi</th>
                            <th>Jenis Seminar</th>
                            @role('mahasiswa')
                                <th class="table-plus datatable-nosort">Aksi</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2017031016 <br>
                                Putu Putra Eka Persada
                            </td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, tenetur.</td>
                            <td>10-10-2023</td>
                            <td>10.10</td>
                            <td>Ruangan Seminar</td>
                            <td>S1 Kimia</td>
                            <td>Kerja Praktik</td>
                            @role('mahasiswa')
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fa fa-pencil"></i> Edit</a>
                                            <form action="#" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"><i
                                                        class="fa fa-trash"></i>
                                                    Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            @endrole
                        </tr>
                    </tbody>
                </table>
            </div> --}}

        {{-- <div class="card-box pb-10">
                <div class="h5 pd-20 mb-0">Data Pelaksanaan Seminar Skripsi</div>
                @role('mahasiswa')
                    <a href="/seminar/create" style="margin-left:15px;">
                        <button class="btn btn-success ">
                            <i class="icon-copy fi-page-add"></i>
                            Daftar Seminar
                        </button>
                    </a>
                @endrole
                <table class="table data-table-responsive stripe data-table-export ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM / Nama</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Ruangan</th>
                            <th>Prodi</th>
                            <th>Jenis Seminar</th>
                            @role('mahasiswa')
                                <th class="table-plus datatable-nosort">Aksi</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2017031016 <br>
                                Putu Putra Eka Persada
                            </td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, tenetur.</td>
                            <td>10-10-2023</td>
                            <td>10.10</td>
                            <td>Ruangan Seminar</td>
                            <td>S1 Kimia</td>
                            <td>Kerja Praktik</td>
                            @role('mahasiswa')
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fa fa-pencil"></i> Edit</a>
                                            <form action="#" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"><i
                                                        class="fa fa-trash"></i>
                                                    Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            @endrole
                        </tr>
                    </tbody>
                </table>
            </div> --}}

        {{-- <div class="card-box pb-10">
                <div class="h5 pd-20 mb-0">Data Pelaksanaan Sidang Komprehensif</div>
                @role('mahasiswa')
                    <a href="/seminar/create" style="margin-left:15px;">
                        <button class="btn btn-success ">
                            <i class="icon-copy fi-page-add"></i>
                            Daftar Seminar
                        </button>
                    </a>
                @endrole
                <table class="table data-table-responsive stripe data-table-export ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NPM / Nama</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Ruangan</th>
                            <th>Prodi</th>
                            <th>Jenis Seminar</th>
                            @role('mahasiswa')
                                <th class="table-plus datatable-nosort">Aksi</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2017031016 <br>
                                Putu Putra Eka Persada
                            </td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, tenetur.</td>
                            <td>10-10-2023</td>
                            <td>10.10</td>
                            <td>Ruangan Seminar</td>
                            <td>S1 Kimia</td>
                            <td>Kerja Praktik</td>
                            @role('mahasiswa')
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fa fa-pencil"></i> Edit</a>
                                            <form action="#" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"><i
                                                        class="fa fa-trash"></i>
                                                    Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            @endrole
                        </tr>
                    </tbody>
                </table>
            </div> --}}








        {{-- <div class="row pb-10 mt-5">
                <div class="col-md-8 mb-20">
                    <div class="card-box height-100-p pd-20">
                        <div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
                            <div class="h5 mb-md-0">Presentase Umur Dosen dan Pegawai</div>
                        </div>
                        <div id="chart"></div>
                    </div>
                </div>
            </div> --}}



        {{-- <div class="row pb-10 mt-5 cha">
                <div class="col-md-8 mb-20">
                    <div class="card-box height-100-p pd-20">
                        <div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
                            <div class="h5 mb-md-0">Presentase Umur Dosen dan Pegawai</div>
                        </div>
                        <div id="chart"></div>
                    </div>
                </div>
                <div class="col-md-4 mb-20">
                    <div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#455a64">
                        <div class="d-flex justify-content-between pb-20 text-white">
                            <div class="icon h1 text-white">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <!-- <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i> -->
                            </div>
                            <div class="font-14 text-right">
                                <div><i class="icon-copy ion-arrow-up-c"></i> 2.69%</div>
                                <div class="font-12">Since last month</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="text-white">
                                <div class="font-14">Appointment</div>
                                <div class="font-24 weight-500">1865</div>
                            </div>
                            <div class="max-width-150">
                                <div id="appointment-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
                        <div class="d-flex justify-content-between pb-20 text-white">
                            <div class="icon h1 text-white">
                                <i class="fa fa-stethoscope" aria-hidden="true"></i>
                            </div>
                            <div class="font-14 text-right">
                                <div><i class="icon-copy ion-arrow-down-c"></i> 3.69%</div>
                                <div class="font-12">Since last month</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="text-white">
                                <div class="font-14">Surgery</div>
                                <div class="font-24 weight-500">250</div>
                            </div>
                            <div class="max-width-150">
                                <div id="surgery-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        {{-- <div class="title pb-20 pt-20">
                <h2 class="h3 mb-0">Quick Start</h2>
            </div>

            <div class="row">
                <div class="col-md-4 mb-20">
                    <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
                        <div class="img pb-30">
                            <img src="Assets/admin/src/images/medicine-bro.svg" alt="" />
                        </div>
                        <div class="content">
                            <h3 class="h4">Services</h3>
                            <p class="max-width-200">
                                We provide superior health care in a compassionate maner
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-20">
                    <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
                        <div class="img pb-30">
                            <img src="Assets/admin/src/images/remedy-amico.svg" alt="" />
                        </div>
                        <div class="content">
                            <h3 class="h4">Medications</h3>
                            <p class="max-width-200">
                                Look for prescription and over-the-counter drug information.
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-20">
                    <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
                        <div class="img pb-30">
                            <img src="Assets/admin/src/images/paper-map-cuate.svg" alt="" />
                        </div>
                        <div class="content">
                            <h3 class="h4">Locations</h3>
                            <p class="max-width-200">
                                Convenient locations when and where you need them.
                            </p>
                        </div>
                    </a>
                </div> --}}
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

    {{-- <div class="footer-wrap pd-20 mb-20 card-box">
            &copy;
            <a class="fw-medium" style="text-decoration: none;" target="_blank" href="https://kimia.fmipa.unila.ac.id/">
                Jurusan KIMIA FMIPA UNILA</a>
            <script>
                document.write(new Date().getFullYear())
            </script>,
            dirancang oleh <a class="fw-medium" target="_blank" style="text-decoration: none;" href="/team">Bayanaka
                Team</a>
        </div> --}}

    {{-- <div class="footer-wrap pd-20 mb-20 card-box" style="display: flex; flex-direction: column; ">
            <div class="copyright">
                &copy;
                <a class="fw-medium" style="text-decoration: none;" target="_blank" href="https://kimia.fmipa.unila.ac.id/">
                    Jurusan KIMIA FMIPA UNILA
                </a>
                <script>
                    document.write(new Date().getFullYear());
                </script>
            </div>
            <div class="designed-by">
                Dirancang oleh
                <a class="fw-medium" target="_blank" style="text-decoration: none;" href="/team">Bayanaka Team</a>
            </div>
        </div> --}}


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
    @endrole
    @role('admin lab|jurusan')
        <script>
            // Data dummy untuk aktivitas penggunaan laboratorium
            function lineChartAktivitasLab(startDate = null, endDate = null, lokasi = null) {
                // Mengambil nilai tanggal awal dan akhir dari input
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();
                @role('admin lab')
                    var lokasi = 'all';
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

                        console.log(data);
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
