@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
<<<<<<< HEAD
<<<<<<< HEAD
                        <h4 class="text-blue h4">Validasi Berita Acara Seminar Tugas Akhir 1 S2</h4>
=======
                        <h4 class="text-blue h4">Validasi Berita Acara Seminar Tesis 1</h4>
>>>>>>> a47b569c98fe0f348dde85a77f67ecd20d911834
=======

                        <h4 class="text-blue h4">Validasi Berita Acara Seminar Tesis 1</h4>

>>>>>>> 7f72bce0c799fb9c87df96121dacce867c3fa446
                    </div>
                    <div class="pb-20 m-3">

                        <table class="table data-table-responsive stripe data-table-export">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPM</th>
                                    <th>Judul</th>
                                    <th>Nomor Surat</th>
                                    <th>Status</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($seminar as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->mahasiswa->npm }}</td>
                                        <td>{{ $item->judul_ta }}</td>
                                        <td>{{ $item->beritaAcara->no_ba }}</td>
                                        <td>{{ $item->status_koor }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-outline-primary dropdown-toggle" href="#"
                                                    role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <a class="dropdown-item"
                                                        href="{{ route('koor.ValidasiBaTa1S2.edit', $item->encrypt_id) }}"><i
                                                            class="fa fa-pencil"></i> Validasi</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
