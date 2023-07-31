@extends('layouts.table')
@section('table')
    <style>
        .center-align {
            text-align: center;
        }
    </style>

    <!-- Features Start -->
    <div class="container-xxl py-5">
        <div class="container">

            <h2>Data Seminar Kerja Praktik</h2>

            <div class="pb-20 m-3 mt-5">

                <table class="table data-table-responsive stripe data-table-noexport nowrap">
                    <thead>
                        <tr>
                            <th class="center-align">No</th>
                            <th class="center-align">NPM</th>
                            <th class="center-align">Nama</th>
                            <th class="center-align">Tanggal</th>
                            <th class="center-align">Waktu</th>
                            <th class="center-align">Ruangan</th>
                            <th class="center-align">Judul</th>
                            <th class="center-align">Pembimbing</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal_kp as $item)
                            <tr>
                                <td class="center-align">{{ $loop->iteration }}</td>
                                <td class="center-align">{{ $item->skp->mahasiswa->npm }}</td>
                                <td>{{ $item->skp->mahasiswa->nama_mahasiswa }}</td>
                                <td class="center-align">{{ $carbon::parse($item->tanggal_skp)->format('d F Y') }}</td>
                                <td>{{ $item->jam_mulai_skp . ' - ' . $item->jam_selesai_skp }} WIB</td>
                                <td>{{ $item->lokasi->nama_lokasi }}</td>
                                <td class="center-align"> : {{ $item->skp->judul_kp }}</td>
                                <td class="center-align"> : {{ $item->skp->dosen->nama_dosen }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- Features End -->
@endsection
