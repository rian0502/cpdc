@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Data Mahasiswa S1</h4>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="pd-20">
                            <form action="{{ route('jurusan.unduh.mahasiswa.seminar') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="status_seminar">Status PKL:</label>
                                            <select class="form-control selectpicker" id="status_kp" name="status_kp">
                                                <option value="1">Pilih Status</option>
                                                <option value="Selesai">Selesai</option>
                                                <option value="Belum Selesai">Belum Selesai</option>
                                                <option value="Perbaikan">Perbaikan</option>
                                                <option value="Tidak Lulus">Tidak Lulus</option>
                                                <option value="null">Belum Daftar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="status_ta1">Status TA1:</label>
                                            <select class="form-control selectpicker" id="status_ta1" name="status_ta1">
                                                <option value="1">Pilih Status</option>
                                                <option value="Selesai">Selesai</option>
                                                <option value="Belum Selesai">Belum Selesai</option>
                                                <option value="Perbaikan">Perbaikan</option>
                                                <option value="Perbaikan">Perbaikan</option>
                                                <option value="Tidak Lulus">Tidak Lulus</option>
                                                <option value="null">Belum Daftar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="status_ta2">Status TA2:</label>
                                            <select class="form-control selectpicker" id="status_ta2" name="status_ta2">
                                                <option value="1">Pilih Status</option>
                                                <option value="Selesai">Selesai</option>
                                                <option value="Belum Selesai">Belum Selesai</option>
                                                <option value="Perbaikan">Perbaikan</option>
                                                <option value="Perbaikan">Perbaikan</option>
                                                <option value="Tidak Lulus">Tidak Lulus</option>
                                                <option value="null">Belum Daftar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="status_kompre">Status KOMPRE:</label>
                                            <select class="form-control selectpicker" id="status_kompre"
                                                name="status_kompre">
                                                <option value="1">Pilih Status</option>
                                                <option value="Selesai">Selesai</option>
                                                <option value="Belum Selesai">Belum Selesai</option>
                                                <option value="Perbaikan">Perbaikan</option>
                                                <option value="Perbaikan">Perbaikan</option>
                                                <option value="Tidak Lulus">Tidak Lulus</option>
                                                <option value="null">Belum Daftar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="angkatan">Angkatan</label>
                                            <select class="form-control selectpicker" name="angkatan" id="angkatan">
                                                <option value="1">Pilih Angkatan</option>
                                                @foreach ($mahasiswa as $item)
                                                    <option value="{{ $item->angkatan }}">{{ $item->angkatan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="weight-500 col-md-3">
                                        <div class="form-group">
                                            <div class="cta  d-flex align-items-center justify-content-start"
                                                style="margin-top: 34px">
                                                <button class="btn btn-sm btn-success"><i class="fa fa-download"></i>
                                                    Unduh</button>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>
                        <div class="pd-20 table-responsive">
                            <table id="data-akun" class="data-akun table table-hover data-table-responsive stripe wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>NPM</th>
                                        <th>Angkatan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status</th>
                                        <th>PKL</th>
                                        <th>TA 1</th>
                                        <th>TA 2</th>
                                        <th>Kompre</th>
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
                    ajax: {
                        url: '{{ route('jurusan.mahasiswa.index') }}',
                        type: 'GET',
                        data: function(data) {
                            data.status_kp = $('#status_kp').val();
                            data.status_ta1 = $('#status_ta1').val();
                            data.status_ta2 = $('#status_ta2').val();
                            data.status_kompre = $('#status_kompre').val();
                            data.angkatan = $('#angkatan').val();
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'mahasiswa.nama_mahasiswa',
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                        },
                        {
                            data: 'mahasiswa.nama_mahasiswa',
                            name: 'mahasiswa.nama_mahasiswa',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'mahasiswa.npm',
                            name: 'mahasiswa.npm',
                            orderable: true
                        },
                        {
                            data: 'mahasiswa.angkatan',
                            name: 'mahasiswa.angkatan',
                            orderable: true
                        },
                        {
                            data: 'mahasiswa.jenis_kelamin',
                            name: 'mahasiswa.jenis_kelamin'
                        },
                        {
                            data: 'mahasiswa.status',
                            name: 'mahasiswa.status'
                        },
                        {
                            data: 'mahasiswa.seminar_kp.status_seminar',
                            name: 'mahasiswa.seminar_kp.status_seminar',
                            orderable: true,

                        },
                        {
                            data: 'mahasiswa.ta_satu.status_koor',
                            name: 'mahasiswa.ta_satu.status_koor',
                            orderable: true,
                        },
                        {
                            data: 'mahasiswa.ta_dua.status_koor',
                            name: 'mahasiswa.ta_dua.status_koor',
                            orderable: true,
                        },
                        {
                            data: 'mahasiswa.komprehensif.status_koor',
                            name: 'mahasiswa.komprehensif.status_koor',
                            orderable: true
                        },
                        {
                            data: 'mahasiswa.tanggal_masuk',
                            name: 'mahasiswa.tanggal_masuk',
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
                $('#status_kp, #status_ta1, #status_ta2, #status_kompre, #angkatan  ').on('change', function() {
                    dataNpm.draw();
                });
            });
        </script>

        <!-- Input Validation End -->
    @endsection
