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

        .containerr {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
            margin-bottom: -30px;
        }

        .move {
            margin-left: -15px;
        }


        @media screen and (max-width: 767px) {
            .containerr {
                grid-template-columns: 1fr;
                margin-bottom: -50px;

            }
        }
    </style>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Mahasiswa Bimbingan @if(Request::is('dosen/mahasiswa/bimbingan/tesis'))Tesis @else Tugas Akhir @endif</h4>
                        <div class="containerr">
                            <div class="move">
                                <form action="{{ Request::is('dosen/mahasiswa/bimbingan/tesis')?route('dosen.mahasiswa.bimbingan.tesis.export') : route('dosen.mahasiswa.bimbingan.ta.export') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                                        <div class="weight-500 col-md-9" style="margin-left: 5px">
                                            <div class="form-group">
                                                <label>Pilih Angkatan</label>
                                                <select class="custom-select2 form-control" name="ta_unduh" id="ta_unduh"
                                                    style="width: 100%; height: 38px">
                                                    <optgroup label="Angkatan">
                                                        @foreach ($mahasiswa as $item)
                                                            <option value="{{ $item->angkatan }}">{{ $item->angkatan }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                                @error('ta_unduh')
                                                    <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                                @enderror
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
                        </div>

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
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    data-color="#1b3133" href="#" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route(Request::is('dosen/mahasiswa/bimbingan/tesis')?'dosen.mahasiswa.bimbingan.tesis.show':'dosen.mahasiswa.bimbingan.kompre.show', $item->mahasiswa->npm) }}"><i
                                                            class="dw dw-eye"></i>
                                                        View</a>
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
