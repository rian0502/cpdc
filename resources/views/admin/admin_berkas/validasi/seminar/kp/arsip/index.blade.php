@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Validasi Seminar Kerja Praktik</h4>
                    </div>
                    <div class="pb-20 m-3">

                        <table id="data-pkl" class="data-pkl table table-hover data-table-responsive stripe wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Judul</th>
                                    <th>Nama Mitra</th>
                                    <th>Status</th>
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
            var dataNpm = $('.data-pkl').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('berkas.arsip_validasi.seminar.kp.index') }}',
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
                        data: 'judul_kp',
                        name: 'judul_kp',
                        orderable: true
                    },
                    {
                        data: 'mitra',
                        name: 'mitra',
                        orderable: true
                    },
                    {
                        data: 'proses_admin',
                        name: 'proses_admin',
                        orderable: true
                    },

                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        exportable: false,
                        render: function(data, type, row) {

                            var editUrl = "{{ route('berkas.arsip_validasi.seminar.kp.edit', ':id') }}".replace(
                                ':id', row.encrypt_id);
                            return `
                        <a class="btn btn-warning "
                        href="${editUrl}"><i class="bi bi-pencil-square"></i>
                                    Edit</a>`;
                        }
                    }
                ]
            });
        });
    </script>
@endsection
