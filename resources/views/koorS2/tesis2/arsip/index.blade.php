@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Arsip Seminar Tesis 2 S2</h4>
                    </div>
                    <div class="pb-20 m-3">

                        <table id="data-tesis2" class="data-tesis2 table table-hover data-table-responsive stripe wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Angkatan</th>
                                    <th>Judul</th>
                                    <th>Status Admin</th>
                                    <th>Status Seminar</th>
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
        $(function() {
            var dataNpm = $('.data-tesis2').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('koor.arsip.tesis2.index') }}',
                    type: 'GET',
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
                        data: 'judul_ta',
                        name: 'judul_ta',
                        orderable: true
                    },
                    {
                        data: 'status_admin',
                        name: 'status_admin',
                        orderable: true
                    },
                    {
                        data: 'status_koor',
                        name: 'status_koor',
                        orderable: true
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        exportable: false,
                        render: function(data, type, row) {
                            var showUrl = "{{ route('koor.arsip.tesis2.show', ':id') }}".replace(
                                ':id', row.encrypt_id);
                            var editUrl = "{{ route('koor.arsip.tesis2.edit', ':id') }}".replace(
                                ':id', row.encrypt_id);
                            //make aksi dropdown show and edit 
                            return `
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="${showUrl}"><i class="dw dw-eye"></i> Detail</a>
                                    <a class="dropdown-item" href="${editUrl}"><i class="dw dw-edit2"></i> Edit</a>
                                </div>
                            </div>
                            `;
                        }
                    }
                ]
            });
        });
    </script>
@endsection
