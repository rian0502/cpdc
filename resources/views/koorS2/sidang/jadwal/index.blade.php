@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Penjadwalan Sidang Tesis</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <div class="ml-3">
                            <form action="{{ route('koor.pra.jadwalKompreS2.download') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="cta d-flex align-items-center justify-content-start"
                                                style="margin-top: 34px">
                                                <button class="btn btn-sm btn-success"><i class="fa fa-download"></i>
                                                    Pra Penjadwalan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('koor.pasca.jadwalKompreS2.download') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="cta d-flex align-items-center justify-content-start">
                                                <button class="btn btn-sm btn-primary"><i class="fa fa-download"></i>
                                                    Pasca Penjadwalan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table data-table-responsive stripe data-table-noexport">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
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
                                            {{ $item->mahasiswa->nama_mahasiswa }}
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
                                                {{ $carbon::parse($item->jadwal->tanggal)->format('d F Y') }}
                                            </td>
                                            <td>
                                                {{ $item->jadwal->jam_mulai . ' - ' . $item->jadwal->jam_selesai }}
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
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    data-color="#1b3133" href="#" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    @if ($item->jadwal)
                                                        <a class="dropdown-item"
                                                            href="{{ route('koor.jadwalKompreS2.edit', $item->encrypt_id) }}"><i
                                                                class="dw dw-edit2"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('koor.jadwalSidangS2.resend', $item->encrypt_id) }}"><i
                                                                class="dw dw-share"></i>
                                                            Kirim Kembali</a>
                                                    @else
                                                        <a class="dropdown-item"
                                                            href="{{ route('koor.jadwalKompreS2.create', $item->encrypt_id) }}"><i
                                                                class="dw dw-calendar-1"></i> Jadwalkan</a>
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
