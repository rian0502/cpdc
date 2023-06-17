@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Penjadwalan Seminar PKL</h4>
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
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $item->mahasiswa->npm }}
                                        </td>
                                        <td>
                                            {{ \Illuminate\Support\Str::limit($item->judul_kp, $limit = 40, $end = '...') }}
                                        </td>
                                        <td>
                                            {{ $item->rencana_seminar }}
                                        </td>
                                        @if ($item->jadwal)
                                            <td>
                                                {{ $item->jadwal->lokasi->nama_lokasi }}
                                            </td>
                                            <td>
                                                {{ $carbon::parse($item->jadwal->tanggal_skp)->format('d F Y') }}
                                            </td>
                                            <td>
                                                {{ $item->jadwal->jam_mulai_skp . ' - ' . $item->jadwal->jam_selesai_skp }}
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
                                                            href="{{ route('koor.jadwalPKL.edit', $item->encrypt_id) }}"><i
                                                                class="fa fa-pencil"></i>
                                                            Ubah Jadwal</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('koor.jadwalPKL.resend', $item->encrypt_id) }}"><i
                                                                class="fa fa-share"></i>
                                                            Kirim Kembali</a>
                                                    @else
                                                        <a class="dropdown-item"
                                                            href="{{ route('koor.jadwalPKL.create', $item->encrypt_id) }}"><i
                                                                class="bi bi-calendar-plus-fill"></i>
                                                            Jadwalkan</a>
                                                    @endif


                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
