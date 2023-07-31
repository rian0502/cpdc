@extends('layouts.datatable')
@section('datatable')
    <style>
        .right-button {
            float: right;
            margin-top: -25px;
        }
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Detail Publikasi Dosen</h4>
                        <a href="{{ route('dosen.publikasi.index') }}">
                            <button class="btn btn-primary right-button">Kembali</button>
                        </a>
                    </div>
                    <div class="pb-20 m-3">
                        <table id="data-npm" class="table data-table-responsive stripe data-table-noexport">
                            <thead>
                                <tr>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Volume</th>
                                    <th scope="col">Halaman</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Scala</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Kategori LITABMAS</th>
                                    <th scope="col">Link</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td scope="col">{{ $publikasi->judul }}</td>
                                    <td scope="col">{{ $publikasi->vol }}</td>
                                    <td scope="col">{{ $publikasi->halaman }}</td>
                                    <td scope="col">{{ $publikasi->tahun }}</td>
                                    <td scope="col">{{ $publikasi->scala }}</td>
                                    <td scope="col">{{ $publikasi->kategori }}</td>
                                    <td scope="col">{{ $publikasi->kategori_litabmas }}</td>
                                    <td scope="col"><a href="{{ $publikasi->url }}" class="text-primary">Klik</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="pd-ltr-20 xs-pd-20-10">

            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="table-responsive mb-2">
                        <h4 class="text-blue h4 mb-2">
                            Anggota Internal
                        </h4>
                        <div class="pb-20 m-3">
                            <table id="data-npm" class="table data-table-responsive stripe data-table-noexport">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Posisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggota as $item)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td scope="row">{{ $item->dosen->nama_dosen }}</td>
                                            <td scope="row">{{ $item->posisi }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px" >
                <div class="card-box mb-30" style="height:400px">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Anggota Lainnya</h4>
                    </div>
                    <div class="d-flex justify-content-around ">
                        {{-- @if ($publikasi->anggota_dosen != null) --}}
                        <div class="pr-5">
                            <h4 class="text-dark h4 mb-2">
                                Dosen Lainnya Yang Berkolaborasi
                            </h4>
                            <textarea name="form-control" disabled readonly rows="10" cols="50">{{ $publikasi->anggota_dosen }}</textarea>
                        </div>

                        {{-- @endif --}}
                        {{-- @if ($publikasi->anggota_mahasiswa != null) --}}
                        <div class="mb-5">
                            <h4 class="text-dark h4 mb-2">
                                Mahasiswa Lainnya Yang Berkolaborasi
                            </h4>
                            <textarea name="form-control" disabled readonly rows="10" cols="50">{{ $publikasi->anggota_mahasiswa }}</textarea>
                        </div>
                        {{-- @endif --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
