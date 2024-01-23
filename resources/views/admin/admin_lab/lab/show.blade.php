@extends('layouts.datatable')
@section('datatable')
    <style>
        .rounded-div {
            border-radius: 10px;
            border: 1px solid #e5e5e5;
            padding: 10px;
            margin-bottom: 10px;
        }

        a:hover {
            cursor: pointer;
        }

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
                        <h4 class="text-blue h4">Detail Kegiatan</h4>
                        <button class="btn btn-primary right-button" onclick="goBack()">Kembali</button>
                        <script>
                            function goBack() {
                                window.history.back();
                            }
                        </script>
                    </div>
                    <div class="p-md-4">
                        <div class="pl-3 pr-3 pt-2 pb-0 mb-2 bg-light text-dark rounded-div">
                            <div class="row border-bottom">
                                <label class="col-md-3 bold"> <strong>Nama kegiatan</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $lab->nama_kegiatan }}
                                </div>
                                <label class="col-md-3 bold"><b>Tanggal Kegiatan</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $carbon::parse($lab->tanggal_kegiatan)->translatedFormat('d F Y') }}
                                </div>
                            </div>
                            <div class="row border-bottom">
                                <label class="col-md-3 bold"><b>Keperluan</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $lab->keperluan }}
                                </div>
                                <label class="col-md-3 bold"><strong> Jam Mulai</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $carbon::createFromFormat('H:i:s', $lab->jam_mulai)->format('h:i A') }}
                                </div>
                            </div>
                            <div class="row border-bottom">
                                <label class="col-md-3 bold"> <strong>Lokasi</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $lab->lokasi->nama_lokasi }}
                                </div>
                                <label class="col-md-3 bold"> <strong>Jam Selesai</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $carbon::createFromFormat('H:i:s', $lab->jam_selesai)->format('h:i A') }}
                                </div>
                            </div>
                            <div class="row border-bottom">
                                <label class="col-md-3 bold"> <strong>Jumlah Peserta</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $lab->jumlah_mahasiswa }}
                                </div>
                                <label class="col-md-3 bold"> <strong>Keterangan</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $lab->keterangan }}
                                </div>
                            </div>
                            @if ($lab->keperluan == 'Penelitian')
                                <div class="row border-bottom">
                                    <label class="col-md-3 bold"> <strong>Nama Mahasiswa</strong></label>
                                    <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                        {{ $lab->user->name }}
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if ($anggota)
                            <h4 class="mt-5">
                                Anggota Asistensi
                            </h4>
                            <table class="table table-striped mt-2">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">NPM</th>
                                        <th scope="col">No Telphone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggota as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <th scope="row">{{ $item->mahasiswa->nama_mahasiswa }}</th>
                                            <th scope="row">{{ $item->mahasiswa->npm }}</th>
                                            <th scope="row">{{ $item->mahasiswa->no_hp }}</th>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
