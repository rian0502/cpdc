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

                <table class="table data-table-responsive stripe data-table-noexport">
                    <thead>
                        <tr>
                            <th class="center-align">No</th>
                            <th class="center-align">NPM</th>
                            <th class="center-align">Nama</th>
                            <th class="center-align">Judul</th>
                            <th class="center-align">Tanggal</th>
                            <th class="center-align">Pembimbing</th>
                            <th class="center-align">Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal_kp as $item)
                            <tr>
                                <td class="center-align">{{ $loop->iteration }}</td>
                                <td class="center-align">{{ $item->skp->mahasiswa->npm }}</td>
                                <td class="center-align">{{ $item->skp->mahasiswa->nama_mahasiswa }}</td>
                                <td class="center-align">
                                    <textarea style="text-align: center;" disabled cols="25" rows="4">{{ $item->skp->judul_kp }}</textarea>
                                </td>
                                <td class="center-align">{{ $carbon::parse($item->tanggal_skp)->format('d F Y') }} <br>
                                    {{ $item->jam_mulai_skp . ' - ' . $item->jam_selesai_skp }} </td>
                                <td class="center-align">{{ $item->skp->dosen->nama_dosen }}</td>
                                <td class="center-align">{{ $item->lokasi->nama_lokasi }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- Features End -->
@endsection
