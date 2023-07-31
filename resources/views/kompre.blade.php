@extends('layouts.table')
@section('table')
    <style>
        .center-align {
            text-align: center;
        }

        .center {
            align-content: center;
            justify-content: center;

        }
    </style>

    <!-- Kompre Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h2>Data Sidang Komprehensif</h2>
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
                            <th class="center-align">Pembimbing 1</th>
                            <th class="center-align">Pembimbing 2</th>
                            <th class="center-align">Pembahas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kompre as $item)
                            <tr class="center">
                                <td class="center-align">{{ $loop->iteration }}</td>
                                <td class="center-align">{{ $item->seminar->mahasiswa->npm }}</td>
                                <td>{{ $item->seminar->mahasiswa->nama_mahasiswa }}</td>
                                <td class="center-align">
                                    {{ $carbon::parse($item->tanggal_komprehensif)->format('d F Y') }}</td>
                                <td class="center-align">{{ $item->jam_mulai_komprehensif }} -
                                    {{ $item->jam_selesai_komprehensif }} WIB</td>
                                <td>{{ $item->lokasi->nama_lokasi }}</td>
                                <td class="center-align"> : {{ $item->seminar->judul_ta }}</td>
                                <td class="center-align"> : {{ $item->seminar->pembimbingSatu->nama_dosen }}</td>
                                @if ($item->seminar->id_pembimbing_dua)
                                    <td class="center-align"> : {{ $item->seminar->pembimbingDua->nama_dosen }}</td>
                                @else
                                    <td class="center-align"> : {{ $item->seminar->pbl2_nama }}</td>
                                @endif
                                <td class="center-align"> : {{ $item->seminar->pembahas->nama_dosen }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Kompre End -->
@endsection
