@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Akun Mahasiswa</h4>
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
                                        <th>Email</th>
                                        <th>Aktivasi</th>
                                        <th>Profil</th>
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
        <style>
            .left-align {
                text-align: left;
            }
        </style>
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
                    ajax: '{{ route('sudo.akun_mahasiswa.index') }}',
                    columns: [{
                            data: null,
                            name: 'name',
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'name',
                            name: 'name',
                            orderable: true,
                            render: function(data, type, row, meta) {
                                return '<div class="left-align">' + data + '</div>';
                            }
                        },
                        {
                            data: 'email',
                            name: 'email',
                            render: function(data, type, row, meta) {
                                return '<div class="left-align">' + data + '</div>';
                            }
                        },
                        {
                            data: 'aktivasi',
                            name: 'aktivasi',
                            
                        },
                        {
                            data: null,
                            name: 'profile',
                            render: function(data, type, row) {
                                if (row.profile == 'Sudah') {
                                    return `<span class="badge badge-success">Sudah</span>`;
                                } else {
                                    return `<span class="badge badge-danger">Belum</span>`;
                                }
                            }
                        },
                        {
                            data: null,
                            name: 'aksi',
                            orderable: false,
                            searchable: false,
                            exportable: false,
                            render: function(data, type, row) {
                                var deleteUrl = "{{ route('sudo.akun_mahasiswa.destroy', ':id') }}"
                                    .replace(':id', row.id);
                                var editUrl = "{{ route('sudo.akun_mahasiswa.edit', ':id') }}".replace(
                                    ':id', row.id);
                                return `
                                <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#"
                                            role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="${editUrl}"><i class="dw dw-edit2"></i> Edit</a>
                                            <form action="${deleteUrl}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="deleteBtn" class="dropdown-item text-danger">
                                                    <i class="dw dw-delete-3"></i> Hapus
                                                </button>
                                            </form>
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
