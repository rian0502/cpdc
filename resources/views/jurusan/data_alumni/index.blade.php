@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Data Alumni</h4>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="pd-20 table-responsive">
                            <table id="data-akun" class="data-akun table table-hover data-table-responsive stripe wrap ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>NPM</th>
                                        <th>Masa Studi</th>
                                        <th>Pekerjaan</th>
                                        <th>Mitra</th>
                                        <th>Status</th>
                                        <th>Tahun Masuk</th>
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
        <script>
            $(document).ready(function() {
                var max_fields = 20; // maximum input fields allowed
                var wrapper = $("#input_fields"); // input fields wrapper
                var add_button = $(".add_field_button"); // add field button

                var x = 1; // initial input field count
                $(add_button).click(function(e) { // add field button on click
                    e.preventDefault();
                    if (x < max_fields) { // check maximum input fields allowed
                        x++; // increment input field count
                        $(wrapper).append(
                            '<div class="input-group mb-3"><input type="text" class="form-control" name="npm[]" placeholder="NPM"><div class="input-group-append"><button class="btn btn-danger remove_field_button" type="button">-</button></div></div>'
                        ); // add input field
                    } else if (x == max_fields) {
                        alert('Maksimal 20 NPM')
                    }
                });

                $(wrapper).on("click", ".remove_field_button", function(e) { // remove field button on click
                    e.preventDefault();
                    $(this).parent().parent().remove(); // remove input field
                    x--; // decrement input field count
                });
            });
        </script>
        @if (Request::is('jurusan/alumni'))
            <script>
                $(function() {
                    var dataNpm = $('.data-akun').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        autoWidth: false,
                        ajax: '{{ route('jurusan.alumni.index') }}',
                        columns: [{
                                data: 'mahasiswa.nama_mahasiswa',
                                name: 'mahasiswa.nama_mahasiswa',
                                render: function(data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
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
                            },
                            {
                                data: 'mahasiswa.pendataanAlumni.masa_studi',
                                name: 'mahasiswa.pendataanAlumni.masa_studi',
                                orderable : true,
                            },
                            {
                                data: 'mahasiswa.kegiatanTerakhir.jabatan',
                                name: 'mahasiswa.kegiatanTerakhir.jabatan',
                                orderable: true,
                            },
                            {
                                data: 'mahasiswa.kegiatanTerakhir.tempat',
                                name: 'mahasiswa.kegiatanTerakhir.tempat',
                                orderable: true,
                            },
                            {
                                data: 'mahasiswa.kegiatanTerakhir.status',
                                name: 'mahasiswa.kegiatanTerakhir.status',
                                orderable: true,
                            },
                            {
                                data: 'mahasiswa.kegiatanTerakhir.tahun_masuk',
                                name: 'mahasiswa.kegiatanTerakhir.tahun_masuk',
                                orderable: true,
                                render: function(data) {
                                    var date = new Date(data);
                                    var formattedDate = date.toISOString().slice(0, 10);
                                    return formattedDate;
                                }
                            },
                            {
                                data: 'aksi',
                                name: 'aksi',
                                orderable: false,
                                searchable: false,
                                exportable: false,
                                render: function(data, type, row) {

                                    var editUrl = "{{ route('jurusan.mahasiswa.show', ':id') }}".replace(
                                        ':id', row.mahasiswa.npm);
                                    return `
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#"
                                    role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="${editUrl}"><i class="dw dw-eye"></i> Lihat</a>
                                    </div>
                            </div>`;
                                }
                            }
                        ]
                    });
                    var searchTimeout;

                    // Event handler saat melakukan pencarian di kolom pencarian
                    $('#data-akun_filter input').on('keyup', function() {
                        var searchText = $(this).val();

                        // Hapus timeout sebelumnya (jika ada)
                        clearTimeout(searchTimeout);

                        // Buat timeout baru untuk menjalankan pencarian setelah 500ms
                        searchTimeout = setTimeout(function() {
                            dataTable.search(searchText).draw();
                        }, 1000); // Ganti 500 dengan waktu debounce yang Anda inginkan (dalam milidetik)
                    });
                });
            </script>
        @elseif (Request::is('jurusan/alumniS2'))
            <script>
                $(function() {
                    var dataNpm = $('.data-akun').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        autoWidth: false,
                        ajax: '{{ route('jurusan.alumniS2.index') }}',
                        columns: [{
                                data: 'name',
                                name: 'name',
                                render: function(data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            },
                            {
                                data: 'name',
                                name: 'name',
                                orderable: true
                            },
                            {
                                data: 'mahasiswa.npm',
                                name: 'mahasiswa.npm',
                            },
                            {
                                data: 'mahasiswa.pendataanAlumni.masa_studi',
                                name: 'mahasiswa.pendataanAlumni.masa_studi',
                            },
                            {
                                data: 'mahasiswa.kegiatan_terakhir.jabatan',
                                name: 'mahasiswa.kegiatanTerakhir.jabatan',
                                orderable: false,
                            },
                            {
                                data: 'mahasiswa.kegiatan_terakhir.tempat',
                                name: 'mahasiswa.kegiatanTerakhir.tempat',
                                orderable: false,
                            },
                            {
                                data: 'mahasiswa.kegiatan_terakhir.status',
                                name: 'mahasiswa.kegiatanTerakhir.status',
                                orderable: false,
                            },
                            {
                                data: 'mahasiswa.kegiatan_terakhir.tahun_masuk',
                                name: 'mahasiswa.kegiatanTerakhir.tahun_masuk',
                                orderable: false,
                                render: function(data) {
                                    var date = new Date(data);
                                    var formattedDate = date.toISOString().slice(0, 10);
                                    return formattedDate;
                                }
                            },
                            {
                                data: 'aksi',
                                name: 'aksi',
                                orderable: false,
                                searchable: false,
                                exportable: false,
                                render: function(data, type, row) {

                                    var editUrl = "{{ route('jurusan.mahasiswa.show', ':id') }}".replace(
                                        ':id', row.mahasiswa.npm);
                                    return `
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#"
                                    role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="${editUrl}"><i class="dw dw-eye"></i> Lihat</a>
                                    </div>
                            </div>`;
                                }
                            }
                        ]
                    });
                    var searchTimeout;

                    // Event handler saat melakukan pencarian di kolom pencarian
                    $('#data-akun_filter input').on('keyup', function() {
                        var searchText = $(this).val();

                        // Hapus timeout sebelumnya (jika ada)
                        clearTimeout(searchTimeout);

                        // Buat timeout baru untuk menjalankan pencarian setelah 500ms
                        searchTimeout = setTimeout(function() {
                            dataTable.search(searchText).draw();
                        }, 1000); // Ganti 500 dengan waktu debounce yang Anda inginkan (dalam milidetik)
                    });
                });
            </script>
        @endif
        <!-- Input Validation End -->
    @endsection
