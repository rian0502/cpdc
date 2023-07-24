@extends('layouts.datatable')
@section('datatable')
    <style>
        .right-button {
            float: right;
            margin-top: -25px;
        }

        /* Gunakan media query untuk mengatur tampilan pada layar berukuran kecil */
        @media screen and (max-width: 600px) {
            .right-button {
                float: none;
                /* Menghapus float pada layar kecil agar tombol muncul di atas konten */
                margin-top: 10px;
                /* Atur margin atas sesuai kebutuhan */
                text-align: center;
                /* Pusatkan tombol pada layar kecil */
            }
        }
    </style>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Mahasiswa Bimbingan Tugas Akhir</h4>
                        <a href="" class="btn btn-success right-button"><i class="fa fa-download"></i> Unduh Data</a>

                    </div>
                    <div class="pb-20 m-3">

                        <table class="table data-table-responsive stripe data-table-noexport">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NPM</th>
                                    <th>Angkatan</th>
                                    <th>Judul</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($seminar as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->mahasiswa->nama_mahasiswa }}</td>
                                        <td>{{ $item->mahasiswa->npm }}</td>
                                        <td>{{ $item->mahasiswa->angkatan }}</td>
                                        <td>{{ $item->judul_ta }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-outline-primary dropdown-toggle" href="#"
                                                    role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('dosen.mahasiswa.bimbingan.kompre.show', $item->mahasiswa->npm) }}"><i
                                                            class="fa fa-eye"></i>
                                                        Lihat</a>

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
