@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Data Mahasiswa</h4>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="pd-20 m-1 table-responsive">
                            <table id="data-akun" class="data-akun table table-hover data-table-responsive stripe wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>NPM</th>
                                        <th>Angkatan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status</th>
                                        <th>Tanggal Masuk</th>
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
        <script>
            $(function() {
                var dataNpm = $('.data-akun').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: '{{ route('jurusan.mahasiswa.index') }}',
                    columns: [{
                            data: 'id',
                            name: 'nama_mahasiswa',
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                        },
                        {
                            data: 'nama_mahasiswa',
                            name: 'nama_mahasiswa',
                            orderable: true
                        },
                        {
                            data: 'npm',
                            name: 'npm',
                            orderable: true
                        },
                        {
                            data: 'angkatan',
                            name: 'angkatan',
                            orderable: true
                        },
                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'tanggal_masuk',
                            name: 'tanggal_masuk',
                        },
                        {
                            data: 'aksi',
                            name: 'aksi',
                            orderable: false,
                            searchable: false,
                            exportable: false,
                            render: function(data, type, row) {

                                var editUrl = "{{ route('jurusan.mahasiswa.show', ':id') }}".replace(
                                    ':id', row.npm);
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
            });
        </script>

        <!-- Input Validation End -->
    @endsection
