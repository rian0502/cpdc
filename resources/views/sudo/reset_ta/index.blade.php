@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Data Tugas Akhir</h4>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="pd-20 m-1 table-responsive">
                            <table id="data-ta" class="data-ta table table-hover data-table-responsive stripe wrap ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>NPM</th>
                                        <th>Angkatan</th>
                                        <th>Judul Tugas Akhir</th>
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
                var dataNpm = $('.data-ta').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: '{{ route('sudo.reset.seminar.index') }}',

                    columns: [
                        {
                            data: null,
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
                            orderable: true
                        },
                        {
                            data: 'mahasiswa.angkatan',
                            name: 'mahasiswa.angkatan',
                            orderable: true
                        },
                        {
                            data: 'judul_ta',
                            name: 'judul_ta'
                        },
                        {
                            data: null,
                            name: 'aksi',
                            orderable: false,
                            searchable: false,
                            exportable: false,
                            render: function(data, type, row) {
                                var hapus = "{{ route('sudo.reset.seminar.destroy', ':id') }}".replace(':id', row.mahasiswa.npm);
                                return `
                                    <form  class="deleteForm2" action="${hapus}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-primary deleteBtn2" onclick="showDeleteConfirmation(event)" type="button">
                                            <i class="fa-solid fa-rotate-left"></i> Reset
                                        </button>
                                    </form>
                                `;
                            }
                        }
                    ]
                });
            });
        </script>


        <!-- Input Validation End -->
    @endsection
