@extends('layouts.datatable')
@section('datatable')
    <style>
        .rounded-div {
            border-radius: 10px;
            border: 1px solid #e5e5e5;
            padding: 10px;
            margin-bottom: 10px;
        }

        .right-button {
            float: right;
            margin-top: -25px;
        }

        a:hover {
            cursor: pointer;
        }
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Detail Mahasiswa</h4>
                        <a href="{{ route('sudo.akun_mahasiswa.index') }}">
                            <button class="btn btn-primary right-button">Kembali</button>
                        </a>
                    </div>
                    <div class="p-md-4">
                        <div class="p-3 mb-2 bg-light text-dark rounded-div">
                            <div class="row">
                                <label class="col-md-3 bold"> <strong> Nama Mahasiswa</strong></label>
                                <div class="col-md-3">
                                    {{ $student->nama_mahasiswa }}
                                </div>
                                <label class="col-md-3 bold"><b>NPM</b></label>
                                <div class="col-md-3">
                                    {{ $student->npm }}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><b>Tanggal Lahir</b></label>
                                <div class="col-md-3">
                                    {{ $carbon::createFromFormat('Y-m-d', $student->tanggal_lahir)->format('d M Y') }}
                                </div>
                                <label class="col-md-3 bold"> <strong> Jenis Kelamin</strong></label>
                                <div class="col-md-3">
                                    {{ $student->jenis_kelamin }}
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3 bold"><b>Alamat</b></label>
                                <div class="col-md-3">
                                    {{ $student->alamat }}
                                </div>
                                <label class="col-md-3 bold"> <strong> Tanggal Masuk</strong></label>
                                <div class="col-md-3">
                                    {{ $carbon::createFromFormat('Y-m-d', $student->tanggal_masuk)->format('d M Y') }}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"> <strong> Angkatan</strong></label>
                                <div class="col-md-3">
                                    {{ $student->angkatan }}
                                </div>
                                <label class="col-md-3 bold"><b>Semester</b></label>
                                <div class="col-md-3">
                                    {{ $student->semester }}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"> <strong> Pembimbing Akademik </strong></label>
                                <div class="col-md-3">
                                    @if ($student->dosen == null)
                                        <span class="badge badge-danger">Belum Ada</span>
                                    @else
                                        {{ $student->dosen->nama_dosen }}
                                    @endif
                                </div>
                                <label class="col-md-3 bold"><b>Status</b></label>
                                <div class="col-md-3">
                                    {{ $student->status }}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"> <strong> Nomor Telepon </strong></label>
                                <div class="col-md-3">
                                    {{ $student->no_hp }}
                                </div>
                                <label class="col-md-3 bold"><b>Email</b></label>
                                <div class="col-md-3">
                                    {{ $student->user->email }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Kegiatan Tambahan</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export nowrap ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Kegiatan</th>
                                    <th>Peran</th>
                                    <th>Tanggal</th>
                                    <th>SKS Korversi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatan as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $item->nama_aktivitas }}
                                        </td>
                                        <td>
                                            {{ $item->peran }}
                                        </td>
                                        <td>
                                            {{ $carbon::parse($item->tanggal)->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            {{ $item->sks_konversi }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Prestasi</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export nowrap ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Prestasi</th>
                                    <th>Capaian</th>
                                    <th>Skala</th>
                                    <th>Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestasi as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $item->nama_prestasi }}
                                        </td>
                                        <td>
                                            {{ $item->scala }}
                                        </td>
                                        <td>
                                            {{ $item->capaian }}
                                        </td>
                                        <td>
                                            {{ $item->file_prestasi }}
                                            //link href ke file prestasi di folder uploads

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

    <!-- Input Validation End -->
@endsection
