@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Aktivitas Laboratorium</h4>
                        <a href="{{ route('lab.ruang.create') }}">
                            <button class="btn btn-success mt-3">
                                <i class="icon-copy fi-page-add"></i>
                                Tambah Data
                            </button>
                        </a>
                    </div>
                    <div class="pb-20 m-3">

                        <table id="data-laboratorium" class="data-laboratorium table table-striped table-hover nowrap ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kegiatan</th>
                                    <th>Tanggal Pakai</th>
                                    <th>Waktu</th>
                                    <th>Keperluan</th>
                                    <th>Peserta</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>

                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            var dataLab = $('.data-laboratorium').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: '{{ route('lab.data.ajax') }}',
                columns: [{
                        data: 'encrypted_id',
                        name: 'encrypted_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_kegiatan',
                        name: 'nama_kegiatan',
                        orderable: true
                    },
                    {
                        data: 'tanggal_kegiatan',
                        name: 'tanggal_kegiatan',
                        orderable: true
                    },
                    {
                        data: 'waktu',
                        name: 'waktu',
                    },
                    {
                        data: 'keperluan',
                        name: 'keperluan',
                        orderable: true
                    },
                    {
                        data: 'jumlah_mahasiswa',
                        name: 'jumlah_mahasiswa',
                        orderable: true
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        exportable: false,
                        render: function(data, type, row) {
                            var showUrl = "{{ route('lab.ruang.show', ':id') }}".replace(':id', row
                                .encrypted_id);
                            var editUrl = "{{ route('lab.ruang.edit', ':id') }}".replace(':id', row
                                .encrypted_id);

                            return `
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="${showUrl}"><i class="fal fa-eye"></i> Detail</a>
                                        <a class="dropdown-item" href="${editUrl}"><i class="fa fa-pencil"></i> Edit</a>
                                    </div>
                                </div>`;
                        }
                    }
                ]
            });
        });
    </script>
@endsection
