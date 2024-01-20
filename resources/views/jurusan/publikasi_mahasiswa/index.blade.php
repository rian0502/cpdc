@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tahun-awal">Tahun Awal</label>
                                    <input type="number" min="1" class="form-control year-picker" placeholder="Tahun Awal" id="tahun-awal">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tahun-akhir">Tahun Akhir</label>
                                    <input type="number" min="1" class="form-control year-picker" placeholder="Tahun Akhir"
                                        id="tahun-akhir">
                                </div>
                            </div>
                            <div class="col-md-4 mt-1 pt-1">
                                <button class="btn btn-primary btn-block" id="filter">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <div id="barChart"></div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <div id="pieChart"></div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <div id="pieChart2"></div>
                    </div>
                </div>
            </div>

            <div class="min-height-200px">


                <div class="card-box mb-30 ">
                    <div class="pd-20">
                        <h4 class="text-blue h4 text-center">Publikasi Mahasiswa</h4>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                    </div>

                    <div class="pd-20 m-1 table-responsive">
                        <table id="data-npm" class="data-npm table table-hover data-table-responsive stripe wrap ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>Judul</th>
                                    <th>Nama Publikasi</th>
                                    <th>Tingkat</th>
                                    <th>Kategori</th>
                                    <th>tahun</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>

    @if (Request::is('jurusan/publikasiMahasiswa'))
        <script>
            var PieChart1;
            var PieChart2;
            var BarChart;
            var dataNpm;

            $(document).ready(function() {
                // Function untuk memanggil data awal
                loadData();

                // Fungsi untuk memuat data menggunakan filter
                function loadData(startDate = null, endDate = null) {
                    if (dataNpm) {
                        dataNpm.destroy();
                    }
                    dataNpm = $('#data-npm').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        autoWidth: false,
                        ajax: {
                            url: '{{ route('jurusan.publikasiMahasiswa.index') }}',
                            data: function(d) {
                                d.startDate = startDate;
                                d.endDate = endDate;
                            }
                        },
                        columns: [{
                                data: null,
                                name: 'nama_publikasi',
                                render: function(data, type, row, meta) {
                                    var index = meta.row + meta.settings._iDisplayStart + 1;
                                    return index;
                                }
                            },
                            {
                                data: 'mahasiswa.nama_mahasiswa',
                                name: 'mahasiswa.nama_mahasiswa',
                                orderable: true
                            },
                            {
                                data: 'mahasiswa.npm',
                                name: 'mahasiswa.npm',
                                orderable: true
                            },

                            {
                                data: 'judul',
                                name: 'judul'
                            },
                            {
                                data: 'nama_publikasi',
                                name: 'nama_publikasi'
                            },
                            {
                                data: 'scala',
                                name: 'scala'
                            },
                            {
                                data: 'kategori',
                                name: 'kategori'
                            },
                            {
                                data: 'tahun',
                                name: 'tahun'
                            },
                            {
                                data: null,
                                name: 'aksi',
                                orderable: false,
                                searchable: false,
                                render: function(data, type, row) {
                                    var downloadUrl = data.url;
                                    return `
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#"
                                    role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="${downloadUrl}"><i class="dw dw-share"></i> Dokumen</a>
                                </div>
                            </div>`;
                                }
                            }
                        ]
                    });
                    $.ajax({
                        url: '{{ route('jurusan.publikasiMahasiswa.pieChartPublikasi') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            startDate: startDate,
                            endDate: endDate
                        },
                        success: function(data) {
                            // Membangun chart menggunakan data yang diterima dari server
                            buildChart(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                    $.ajax({
                        url: '{{ route('jurusan.publikasiMahasiswa.pieChartScala') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            startDate: startDate,
                            endDate: endDate
                        },
                        success: function(data) {
                            // Membangun chart menggunakan data yang diterima dari server
                            buildChart2(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                    $.ajax({
                        url: '{{ route('jurusan.publikasiMahasiswa.barChartPublikasi') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            startDate: startDate,
                            endDate: endDate
                        },
                        success: function(data) {
                            // Membangun chart menggunakan data yang diterima dari server
                            buildChart3(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }

                // Fungsi untuk membangun chart capaian
                function buildChart(chartData) {
                    // Mengonversi data JSON ke format yang digunakan oleh Highcharts dengan persentase dan jumlah
                    var seriesData = chartData.map(function(item) {
                        return {
                            name: item.kategori,
                            y: item.total,
                            total: item.total
                        };
                    });

                    pieChart1 = Highcharts.chart('pieChart', {
                        credits: {
                            enabled: false
                        },
                        chart: {
                            type: 'pie',
                            alignTicks: false,
                            renderTo: 'pieChart'
                        },
                        title: {
                            text: 'Kategori Publikasi'
                        },
                        tooltip: {
                            pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}</b> ({point.percentage:.1f}%)'
                        },
                        series: [{
                            name: 'Publikasi',
                            colorByPoint: true,
                            data: seriesData,
                            showInLegend: true,
                            allowPointSelect: true,

                        }],

                    });
                }

                function buildChart2(chartData) {
                    // Mengonversi data JSON ke format yang digunakan oleh Highcharts dengan persentase dan jumlah
                    var seriesData = chartData.map(function(item) {
                        return {
                            name: item.scala,
                            y: item.total,
                            total: item.total
                        };
                    });

                    pieChart2 = Highcharts.chart('pieChart2', {
                        credits: {
                            enabled: false
                        },
                        chart: {
                            type: 'pie',
                            alignTicks: false,
                            renderTo: 'pieChart2'
                        },
                        title: {
                            text: 'Scala Publikasi'
                        },
                        tooltip: {
                            pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}</b> ({point.percentage:.1f}%)'
                        },
                        series: [{
                            name: 'Publikasi',
                            colorByPoint: true,
                            data: seriesData,
                            showInLegend: true,
                            allowPointSelect: true,

                        }],

                    });
                }

                function buildChart3(chartData) {
                    // Mengonversi data JSON ke format yang digunakan oleh Highcharts dengan persentase dan jumlah
                    var seriesData = chartData
                        .sort(function(a, b) {
                            return a.year - b.year; // Mengurutkan tahun dari yang terkecil ke terbesar
                        })
                        .map(function(item) {
                            return {
                                name: item.tahun,
                                y: item.total
                            };
                        });


                    // Membangun chart
                    barChart = Highcharts.chart('barChart', {
                        credits: {
                            enabled: false
                        },
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Publikasi Mahasiswa'
                        },
                        subtitle: {
                            text: 'Publikasi Mahasiswa'
                        },
                        xAxis: {
                            type: 'category',
                            scrollbar: {
                                enabled: true
                            },
                            labels: {
                                rotation: -45,
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        },

                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Jumlah Publikasi'
                            }
                        },
                        legend: {
                            enabled: true
                        },
                        tooltip: {
                            pointFormat: 'Jumlah Mahasiswa: <b>{point.y} orang</b>'
                        },
                        series: [{
                            name: 'Publikasi',
                            data: seriesData,
                            dataLabels: {
                                enabled: true,
                                rotation: -90,
                                color: '#FFFFFF',
                                align: 'right',
                                format: '{point.y}', // one decimal
                                y: 10, // 10 pixels down from the top
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        }]
                    });
                    var categoriesLength = seriesData.length;
                    var visibleCategories = 10; // Jumlah kategori yang ingin ditampilkan
                    var minIndex = Math.max(0, categoriesLength - visibleCategories);
                    var maxIndex = categoriesLength - 1;

                    barChart.xAxis[0].setExtremes(minIndex, maxIndex);
                }

                // Fungsi untuk menangani klik tombol filter
                $('#filter').on('click', function() {
                    var startDate = $('#tahun-awal').val();
                    var endDate = $('#tahun-akhir').val();
                    loadData(startDate, endDate);
                });
            });
        </script>
    @elseif (Request::is('jurusan/publikasiMahasiswaS2'))
    <script>
        var PieChart1;
        var PieChart2;
        var BarChart;
        var dataNpm;

        $(document).ready(function() {
            // Function untuk memanggil data awal
            loadData();

            // Fungsi untuk memuat data menggunakan filter
            function loadData(startDate = null, endDate = null) {
                if (dataNpm) {
                    dataNpm.destroy();
                }
                dataNpm = $('#data-npm').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: {
                        url: '{{ route('jurusan.publikasiMahasiswaS2.index') }}',
                        data: function(d) {
                            d.startDate = startDate;
                            d.endDate = endDate;
                        }
                    },
                    columns: [{
                            data: null,
                            name: 'nama_publikasi',
                            render: function(data, type, row, meta) {
                                var index = meta.row + meta.settings._iDisplayStart + 1;
                                return index;
                            }
                        },
                        {
                            data: 'mahasiswa.nama_mahasiswa',
                            name: 'mahasiswa.nama_mahasiswa',
                            orderable: true
                        },
                        {
                            data: 'mahasiswa.npm',
                            name: 'mahasiswa.npm',
                            orderable: true
                        },

                        {
                            data: 'judul',
                            name: 'judul'
                        },
                        {
                            data: 'nama_publikasi',
                            name: 'nama_publikasi'
                        },
                        {
                            data: 'scala',
                            name: 'scala'
                        },
                        {
                            data: 'kategori',
                            name: 'kategori'
                        },
                        {
                            data: 'tahun',
                            name: 'tahun'
                        },
                        {
                            data: null,
                            name: 'aksi',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                var downloadUrl = data.url;
                                return `
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#"
                                role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="${downloadUrl}"><i class="dw dw-share"></i> Dokumen</a>
                            </div>
                        </div>`;
                            }
                        }
                    ]
                });
                $.ajax({
                    url: '{{ route('jurusan.publikasiMahasiswaS2.pieChartPublikasi') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        startDate: startDate,
                        endDate: endDate
                    },
                    success: function(data) {
                        // Membangun chart menggunakan data yang diterima dari server
                        buildChart(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
                $.ajax({
                    url: '{{ route('jurusan.publikasiMahasiswaS2.pieChartScala') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        startDate: startDate,
                        endDate: endDate
                    },
                    success: function(data) {
                        // Membangun chart menggunakan data yang diterima dari server
                        buildChart2(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
                $.ajax({
                    url: '{{ route('jurusan.publikasiMahasiswaS2.barChartPublikasi') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        startDate: startDate,
                        endDate: endDate
                    },
                    success: function(data) {
                        // Membangun chart menggunakan data yang diterima dari server
                        buildChart3(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Fungsi untuk membangun chart capaian
            function buildChart(chartData) {
                // Mengonversi data JSON ke format yang digunakan oleh Highcharts dengan persentase dan jumlah
                var seriesData = chartData.map(function(item) {
                    return {
                        name: item.kategori,
                        y: item.total,
                        total: item.total
                    };
                });

                pieChart1 = Highcharts.chart('pieChart', {
                    credits: {
                        enabled: false
                    },
                    chart: {
                        type: 'pie',
                        alignTicks: false,
                        renderTo: 'pieChart'
                    },
                    title: {
                        text: 'Kategori Publikasi'
                    },
                    tooltip: {
                        pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}</b> ({point.percentage:.1f}%)'
                    },
                    series: [{
                        name: 'Publikasi',
                        colorByPoint: true,
                        data: seriesData,
                        showInLegend: true,
                        allowPointSelect: true,

                    }],

                });
            }

            function buildChart2(chartData) {
                // Mengonversi data JSON ke format yang digunakan oleh Highcharts dengan persentase dan jumlah
                var seriesData = chartData.map(function(item) {
                    return {
                        name: item.scala,
                        y: item.total,
                        total: item.total
                    };
                });

                pieChart2 = Highcharts.chart('pieChart2', {
                    credits: {
                        enabled: false
                    },
                    chart: {
                        type: 'pie',
                        alignTicks: false,
                        renderTo: 'pieChart2'
                    },
                    title: {
                        text: 'Scala Publikasi'
                    },
                    tooltip: {
                        pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}</b> ({point.percentage:.1f}%)'
                    },
                    series: [{
                        name: 'Publikasi',
                        colorByPoint: true,
                        data: seriesData,
                        showInLegend: true,
                        allowPointSelect: true,

                    }],

                });
            }

            function buildChart3(chartData) {
                // Mengonversi data JSON ke format yang digunakan oleh Highcharts dengan persentase dan jumlah
                var seriesData = chartData
                    .sort(function(a, b) {
                        return a.year - b.year; // Mengurutkan tahun dari yang terkecil ke terbesar
                    })
                    .map(function(item) {
                        return {
                            name: item.tahun,
                            y: item.total
                        };
                    });


                // Membangun chart
                barChart = Highcharts.chart('barChart', {
                    credits: {
                        enabled: false
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Publikasi Mahasiswa'
                    },
                    subtitle: {
                        text: 'Publikasi Mahasiswa'
                    },
                    xAxis: {
                        type: 'category',
                        scrollbar: {
                            enabled: true
                        },
                        labels: {
                            rotation: -45,
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    },

                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah Publikasi'
                        }
                    },
                    legend: {
                        enabled: true
                    },
                    tooltip: {
                        pointFormat: 'Jumlah Mahasiswa: <b>{point.y} orang</b>'
                    },
                    series: [{
                        name: 'Publikasi',
                        data: seriesData,
                        dataLabels: {
                            enabled: true,
                            rotation: -90,
                            color: '#FFFFFF',
                            align: 'right',
                            format: '{point.y}', // one decimal
                            y: 10, // 10 pixels down from the top
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    }]
                });
                var categoriesLength = seriesData.length;
                var visibleCategories = 10; // Jumlah kategori yang ingin ditampilkan
                var minIndex = Math.max(0, categoriesLength - visibleCategories);
                var maxIndex = categoriesLength - 1;

                barChart.xAxis[0].setExtremes(minIndex, maxIndex);
            }

            // Fungsi untuk menangani klik tombol filter
            $('#filter').on('click', function() {
                var startDate = $('#tahun-awal').val();
                var endDate = $('#tahun-akhir').val();
                loadData(startDate, endDate);
            });
        });
    </script>
    @endif






    <!-- Input Validation End -->
@endsection
