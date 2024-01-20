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
                                    <label for="tanggal-awal">Tahun Ajaran</label>
                                    <select id="tanggal-awal" class="custom-select2 form-control" data-size="5"
                                        name="tahun_akademik">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanggal-akhir">Semester</label>
                                    <select name="semester" id="tanggal-akhir" class="selectpicker form-control"
                                        data-size="5" name="semester">
                                        <option value="Ganjil">Ganjil
                                        </option>
                                        <option value="Genap">Genap
                                        </option>
                                    </select>
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
                <div class="col-xl-6 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <div id="pieChart"></div>
                    </div>
                </div>
            </div>

            <div class="min-height-200px">
                <div class="card-box mb-30 ">
                    <div class="pd-20">
                        <h4 class="text-blue h4 text-center">Rekap Kinerja Dosen</h4>
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
                                    <th>Nama</th>
                                    <th>SKS Pendidikan</th>
                                    <th>SKS Penelitian</th>
                                    <th>SKS Pengabdian</th>
                                    <th>SKS Penunjang</th>
                                    <th>Tahun Akademik</th>
                                    <th>Semester</th>
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

    <script>
        var PieChart1;
        var PieChart2;
        var BarChart;
        var dataKinerja;

        $(document).ready(function() {
            // Function untuk memanggil data awal
            loadData();

            // Fungsi untuk memuat data menggunakan filter
            function loadData(startDate = null, endDate = null) {
                if (dataKinerja) {
                    dataKinerja.destroy();
                }
                dataKinerja = $('#data-npm').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: {
                        url: '{{ route('jurusan.kinerjaDosen.index') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: function(d) {
                            d.startDate = startDate;
                            d.endDate = endDate;
                        }
                    },
                    columns: [{
                            data: null,
                            name: 'tahun_akademik',
                            render: function(data, type, row, meta) {
                                var index = meta.row + meta.settings._iDisplayStart + 1;
                                return index;
                            }
                        },
                        {
                            data: 'dosen.nama_dosen',
                            name: 'dosen.nama_dosen',
                            orderable: true
                        },
                        {
                            name: 'sks_pendidikan',
                            data: 'sks_pendidikan',
                            orderable: true
                        },
                        {
                            data: 'sks_penelitian',
                            name: 'sks_penelitian',
                            orderable: true
                        },
                        {
                            data: 'sks_pengabdian',
                            name: 'sks_pengabdian'
                        },
                        {
                            data: 'sks_penunjang',
                            name: 'sks_penunjang'
                        },
                        {
                            data: 'tahun_akademik',
                            name: 'tahun_akademik'
                        },
                        {
                            data: 'semester',
                            name: 'semester'
                        },

                    ]
                });
                $.ajax({
                    url: '{{ route('jurusan.kinerjaDosen.chartAvarageKinerja') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        startDate: startDate,
                        endDate: endDate
                    },
                    success: function(data) {
                        const chartData = {
                            categories: [
                                'SKS PENDIDIKAN',
                                'SKS PENELITIAN',
                                'SKS PENGABDIAN',
                                'SKS PENUNJANG'
                            ],
                            series: [{
                                    name: 'TERTINGGI',
                                    data: [data.sks_pendidikan_max, data.sks_penelitian_max,
                                        data.sks_pengabdian_max, data.sks_penunjang_max
                                    ]
                                },
                                {
                                    name: 'TERENDAH',
                                    data: [data.sks_pendidikan_min, data.sks_penelitian_min,
                                        data.sks_pengabdian_min, data.sks_penunjang_min
                                    ]
                                },
                                {
                                    name: 'MEAN',
                                    data: [data.sks_pendidikan_avg, data.sks_penelitian_avg,
                                        data.sks_pengabdian_avg, data.sks_penunjang_avg
                                    ]
                                },
                                {
                                    name: 'MEDIAN',
                                    data: [data.sks_pendidikan_median, data
                                        .sks_penelitian_median, data.sks_pengabdian_median,
                                        data.sks_penunjang_median
                                    ]
                                },

                            ]
                        };
                        console.log(chartData);

                        // Membangun chart menggunakan data yang diterima dari server
                        buildChart3(chartData);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
                $.ajax({
                    url: '{{ route('jurusan.kinerjaDosen.chartTotalKinerja') }}',
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
            }

            // Fungsi untuk membangun chart Peran
            function buildChart(chartData) {
                // Mengonversi data JSON ke format yang digunakan oleh Highcharts dengan persentase dan jumlah
                var category = ['Mean Total', 'Median Total', 'Total Tertinggi', 'Total Terendah'];
                var seriesData = Object.values(chartData);


                // Membangun chart
                barChart = Highcharts.chart('barChart', {
                    credits: {
                        enabled: false
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Total Kinerja Dosen'
                    },
                    xAxis: {
                        type: 'category',
                        categories: category,
                        crosshair: true,
                        labels: {
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Popins, sans-serif'
                            }
                        }
                    },

                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Poin Kinerja Dosen'
                        }
                    },
                    legend: {
                        enabled: true
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormatter: function() {
                            return '<tr><td style="text-align: left; padding:0; color:' + this
                                .series.color + '">' +
                                this.category + ': </td>' +
                                '<td style="text-align: right; padding:0"><b>' + Highcharts
                                .numberFormat(this.y, 0, ".", ",") +
                                '</b></td></tr>';
                        },
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    series: [{
                        name: 'Kinerja Dosen',
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

            function buildChart3(chartData) {

                // Membangun chart
                Highcharts.chart('pieChart', {
                    credits: {
                        enabled: false
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'SKS Kinerja Dosen'
                    },
                    xAxis: {
                        categories: chartData.categories,
                        crosshair: true,
                        accessibility: {
                            description: 'Countries'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Poin Kinerja Dosen'
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
                    legend: {
                        enabled: true
                    },
                    series: chartData.series
                });
            }

            // Fungsi untuk menangani klik tombol filter
            $('#filter').on('click', function() {
                var startDate = $('#tanggal-awal').val();
                var endDate = $('#tanggal-akhir').val();
                loadData(startDate, endDate);
            });
        });
    </script>
    <script>
        // Mendapatkan elemen select
        var select = document.getElementById("tanggal-awal");

        // Mendapatkan tahun saat ini
        var tahunSekarang = new Date().getFullYear();

        // Loop untuk menghasilkan 5 tahun ke belakang
        for (var i = 0; i < 50; i++) {
            var tahun = tahunSekarang - i;
            var option = document.createElement("option");
            option.value = tahun + "/" + (tahun + 1);
            option.text = tahun + "/" + (tahun + 1);
            select.add(option);
        }


        var myButton = document.getElementById("submitButton");

        myButton.addEventListener("click", function() {
            myButton.classList.add("btn-pulse");

            setTimeout(function() {
                myButton.classList.remove("btn-pulse");
            }, 500);
        });
    </script>
@endsection
