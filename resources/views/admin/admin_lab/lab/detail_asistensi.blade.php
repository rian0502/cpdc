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
                        <h4 class="text-blue h4">Detail Presensi Asistensi</h4>
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
                                <label class="col-md-3 bold"> <strong>Nama</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $mahasiswa->nama_mahasiswa }}
                                </div>
                                <label class="col-md-3 bold"><b>NPM</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $mahasiswa->npm }}
                                </div>
                            </div>
                            <div class="row border-bottom">
                                <label class="col-md-3 bold"><b>No Telphone</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $mahasiswa->no_hp }}
                                </div>
                                <label class="col-md-3 bold"><strong> Email </strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $mahasiswa->user->email }}
                                </div>
                            </div>
                        </div>
                        @if ($asistensi)
                            <h4 class="mt-5">
                                Data Presensi
                            </h4>
                            <table class="table data-table table-striped mt-2">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">Jumlah Peserta</th>
                                        <th scope="col">Tanggal Kegiatan</th>
                                        <th scope="col">Waktu</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asistensi as $item)
                                        <tr>
                                            <th scope="col">{{ $loop->iteration }}</th>
                                            <th scope="col">{{ $item->nama_kegiatan }}</th>
                                            <th scope="col">{{ $item->lokasi->nama_lokasi }}</th>
                                            <th scope="col">{{ $item->jumlah_mahasiswa }}</th>
                                            <th scope="col">{{ $carbon::parse($item->tanggal_kegiatan)->format('d F Y') }}</th>
                                            <th scope="col">{{ $carbon::parse($item->jam_mulai)->format('h:i') }} - {{ $carbon::parse($item->jam_selesai)->format('h:i') }}</th>
                                            <th scope="col">{{ $item->keterangan }}</th>
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
