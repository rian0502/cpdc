@extends('layouts.datatable')
@section('datatable')
    <style>
        .right-button {
            float: right;
            margin-top: -25px;
        }

        textarea[readonly] {
            pointer-events: none;
        }
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Detail LITABMAS</h4>
                        <a href="{{ route('dosen.litabmas.index') }}">
                            <button class="btn btn-primary right-button">Kembali</button>
                        </a>
                    </div>
                    <div class="pb-20 m-3">
                        <table id="data-npm" class="table data-table-responsive stripe data-table-noexport">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Sumber Dana</th>
                                    <th scope="col">Jumlah Dana</th>
                                    <th scope="col">Tahun Kegiatan</th>
                                    <th scope="col">Url Dokumentasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">{{ $litabmas->nama_litabmas }}</td>
                                    <td scope="row">{{ $litabmas->kategori }}</td>
                                    <td scope="row">{{ $litabmas->sumber_dana }}</td>
                                    <td scope="row">Rp. {{ number_format($litabmas->jumlah_dana, 0, ',', '.') }}</td>
                                    <td scope="row">{{ $litabmas->tahun_penelitian }}</td>
                                    <td scope="col"><a href="{{ $litabmas->url }}" target="_blank" class="text-primary">Lihat</a></td>
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
                                    @foreach ($dosen as $item)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td scope="row">{{ $item->dosen->nama_dosen }}</td>
                                            <td scope="row">{{ $item->Posisi }}</td>
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
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Anggota Lainnya</h4>
                        <div class="form-group mt-5">
                            <label for="">Dosen</label>
                            <textarea class="form-control" readonly onfocus="this.blur();">{{ $litabmas->anggota_external }}</textarea>
                        </div>
                        <div class="form-group mt-5">
                            <label for="">Mahasiswa</label>
                            <textarea class="form-control" readonly onfocus="this.blur();">{{ $litabmas->anggota_mahasiswa }}</textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
