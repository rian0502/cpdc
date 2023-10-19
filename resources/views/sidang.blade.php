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
            <h2>Data Sidang Tesis</h2>
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
                            <th class="center-align">Pembahas 1</th>
                            <th class="center-align">Pembahas 2</th>
                            <th class="center-align">Pembahas 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sidang as $item)
                            <tr class="center">
                                <td class="center-align">{{ $loop->iteration }}</td>
                                <td class="center-align">{{ $item->seminar->mahasiswa->npm }}</td>
                                <td>{{ $item->seminar->mahasiswa->nama_mahasiswa }}</td>
                                <td class="center-align">
                                    {{ $carbon::parse($item->tanggal)->format('d F Y') }}</td>
                                <td class="center-align">{{ $item->jam_mulai }} -
                                    {{ $item->jam_selesai }} WIB</td>
                                <td>{{ $item->lokasi->nama_lokasi }}</td>
                                <td class="center-align"> : {{ $item->seminar->judul_ta }}</td>
                                <td class="center-align"> : {{ $item->seminar->pembimbingSatu->nama_dosen }}</td>
                                @if ($item->seminar->id_pembimbing_2)
                                    <td class="center-align"> : {{ $item->seminar->pembimbingDua->nama_dosen }}</td>
                                @else
                                    <td class="center-align"> : {{ $item->seminar->pbl2_nama }}</td>
                                @endif
                                @if ($item->seminar->id_pembahas_1)
                                    <td class="center-align"> : {{ $item->seminar->pembahasSatu->nama_dosen }}</td>
                                @else
                                    <td class="center-align"> : {{ $item->seminar->pembahas_external_1 }}</td>
                                @endif
                                @if ($item->seminar->id_pembahas_2)
                                    <td class="center-align"> : {{ $item->seminar->pembahasDua->nama_dosen }}</td>
                                @else
                                    <td class="center-align"> : {{ $item->seminar->pembahas_external_2 }}</td>
                                @endif
                                @if ($item->seminar->id_pembahas_3)
                                    <td class="center-align"> : {{ $item->seminar->pembahasTiga->nama_dosen }}</td>
                                @else
                                    <td class="center-align"> : {{ $item->seminar->pembahas_external_3 }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Kompre End -->
@endsection
