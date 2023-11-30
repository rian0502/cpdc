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

    <!-- Seminar Tugas Akhir 2 Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h2>Data Seminar Tugas Akhir 2</h2>
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
                        @foreach ($ta2 as $item)
                            <tr class="center">
                                <td class="center-align">{{ $loop->iteration }}</td>
                                <td class="center-align">{{ $item->seminar->mahasiswa->npm }}</td>
                                <td>{{ $item->seminar->mahasiswa->nama_mahasiswa }}</td>
                                <td class="center-align">
                                    {{ $carbon::parse($item->tanggal_seminar_ta_dua)->format('d F Y') }}</td>
                                <td class="center-align">{{ $item->jam_mulai_seminar_ta_dua }} -
                                    {{ $item->jam_selesai_seminar_ta_dua }} WIB</td>
                                <td>{{ $item->lokasi->nama_lokasi }}</td>
                                <td class="center-align"> : {{ $item->seminar->judul_ta }}</td>
                                <td class="center-align"> : {{ $item->seminar->pembimbing_satu->nama_dosen }}</td>
                                @if ($item->seminar->pembimbing_dua)
                                    <td class="center-align"> : {{ $item->seminar->pembimbing_dua->nama_dosen }}</td>
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
    <!-- Seminar Tugas Akhir 2 End -->
@endsection
