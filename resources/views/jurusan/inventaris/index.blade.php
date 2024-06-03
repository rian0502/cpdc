@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <div class="row align-items-center justify-content-center">
                            <div class="col">
                                <div class="form-group">
                                    <label for="tanggal-akhir">Laboratorium</label>
                                    <select name="id_lab" id="id_lab" class="selectpicker form-control"
                                        data-size="5" name="semester">
                                        <option value="new">All</option>
                                        @foreach ($lab as $item)
                                            <option value="{{ $item->encrypt_id }}">{{ $item->nama_lokasi }}</option>
                                        @endforeach
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

            <div class="min-height-200px">
                <div class="card-box mb-30 ">
                    <div class="pd-20">
                        <h4 class="text-blue h4 text-center">Inventaris Laboratorium</h4>
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
                                    <th>Jumlah</th>
                                    <th>Merk</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
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
            function loadData(id_lab = null) {
                if (dataKinerja) {
                    dataKinerja.destroy();
                }
                dataKinerja = $('#data-npm').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: {
                        url: '{{ route('jurusan.inventaris.index') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: function(d) {
                            d.id_lab = $('#id_lab').val();
                        }
                    },
                    columns: [{
                            data: null,
                            name: 'jumlah_akhir',
                            render: function(data, type, row, meta) {
                                var index = meta.row + meta.settings._iDisplayStart + 1;
                                return index;
                            }
                        },
                        {
                            data: 'modelBarang.nama_model',
                            name: 'modelBarang.nama_model',
                            orderable: true
                        },
                        {
                            name: 'jumlah_akhir',
                            data: 'jumlah_akhir',
                            orderable: true
                        },
                        {
                            data: 'modelBarang.merk',
                            name: 'modelBarang.merk',
                            orderable: true
                        },
                        {
                            data: 'modelBarang.kategori.nama_kategori',
                            name: 'modelBarang.kategori.nama_kategori'
                        },
                        {
                            data: 'lokasi.nama_lokasi',
                            name: 'lokasi.nama_lokasi'
                        },

                    ]
                });


            }
            // Fungsi untuk menangani klik tombol filter
            $('#filter').on('click', function() {
                var id_lab = $('#id_lab').val();
                loadData(id_lab);
            });
        });
    </script>
@endsection
