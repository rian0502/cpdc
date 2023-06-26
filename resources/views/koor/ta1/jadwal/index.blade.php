@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Penjadwalan Seminar Tugas Akhir 1</h4>
                    </div>
                    <div class="pb-20 m-3">

                        <table class="table data-table-responsive stripe data-table-export">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPM</th>
                                    <th>Judul</th>
                                    <th>Pengajuan</th>
                                    <th>Lokasi</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($seminar as $item)
                                    {{-- LOKASI TANGGAL JAM MULAI SELESAI MISAL BLM TERJADWAL MAKA OUTPUTIN KONDISIIN TULUSANNYA BLM TERJADWAL --}}
                                    @if ($item->ba_seminar == null)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->mahasiswa->npm }}
                                            </td>
                                            <td>
                                                {{ \Illuminate\Support\Str::limit($item->judul_ta, $limit = 40, $end = '...') }}
                                            </td>
                                            <td>
                                                {{ $item->periode_seminar }}
                                            </td>
                                            @if ($item->jadwal)
                                                <td>
                                                    {{ $item->jadwal->lokasi->nama_lokasi }}
                                                </td>
                                                <td>
                                                    {{ $carbon::parse($item->jadwal->tanggal_seminar_ta_satu)->format('d F Y') }}
                                                </td>
                                                <td>
                                                    {{ $item->jadwal->jam_mulai_seminar_ta_satu . ' - ' . $item->jadwal->jam_selesai_seminar_ta_satu }}
                                                </td>
                                            @else
                                                <td>
                                                    <span class="badge bg-warning">Belum Terjadwal</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning">Belum Terjadwal</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning">Belum Terjadwal</span>
                                                </td>
                                            @endif

                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-outline-primary dropdown-toggle" href="#"
                                                        role="button" data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </a>

                                                    {{-- DI KASIH KONDISI KLK UDAH TERJADWAL BAKAL MUNCUL EDIT JADWALKANNYA ILANG BEGITU JG SEBALIKNYA --}}


                                                    {{-- NANTI FITUR EDIT KLK MAU EDIT BERARTI DOKUMEN YANG TERGENERATE AKAN TERPEBAHARUI JUGA --}}
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @if ($item->jadwal)
                                                            <a class="dropdown-item"
                                                                href="{{ route('koor.jadwalTA1.edit', $item->encrypt_id) }}"><i
                                                                    class="fa fa-pencil"></i>
                                                                Edit</a>
                                                        @else
                                                            <a class="dropdown-item"
                                                                href="{{ route('koor.jadwalTA1.create', $item->encrypt_id) }}"><i
                                                                    class="bi bi-calendar-plus-fill"></i>
                                                                Jadwalkan</a>
                                                        @endif


                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
