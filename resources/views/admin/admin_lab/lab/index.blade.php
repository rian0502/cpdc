@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Aktivitas Laboratorium</h4>
                        @role('admin lab')
                            <a href="{{ route('lab.ruang.create') }}">
                                <button class="btn btn-success mt-3">
                                    <i class="icon-copy fi-page-add"></i>
                                    Tambah Data
                                </button>
                            </a>
                        @endrole
                    </div>
                    <div class="pb-20 m-3">

                        <table id="data-laboratorium" class="data-laboratorium table table-striped table-hover ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Kegiatan</th>
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
                        orderable: true,
                    },
                    {
                        data: 'tanggal_kegiatan',
                        name: 'tanggal_kegiatan',
                        orderable: true
                    },
                    {
                        data: 'waktu',
                        name: 'waktu',
                        orderable: true
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
                            var deletUrl = "{{ route('lab.ruang.destroy', ':id') }}".replace(':id',
                                row
                                .encrypted_id);

                            return `
                                <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133" href="#"
                                    role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="${showUrl}"><i class="dw dw-eye"></i> View</a>
                                    @role('admin lab')
                                    <a class="dropdown-item" href="${editUrl}"><i class="dw dw-edit2"></i> Edit</a>
                                    <form class="deleteForm2" action="${deletUrl}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="showDeleteConfirmation(event)" class="dropdown-item text-danger deleteBtn2" type="button"><i class="dw dw-delete-3" ></i> Hapus</button>
                                                        </form>
                                    @endrole
                                    </div>
                                </div>`;
                        }
                    }
                ]
            });
        });
    </script>
@endsection
