@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Validasi Berita Acara Seminar Tesis 2</h4>
                    </div>
                    <div class="pb-20 m-3">

                        <table class="table data-table-responsive stripe data-table-export">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Judul</th>
                                    <th>Tanggal Seminar</th>
                                    <th>No Surat</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($berkas as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $item->mahasiswa->nama_mahasiswa }}
                                        </td>
                                        <td>
                                            {{ $item->mahasiswa->npm }}
                                        </td>
                                        <td>
                                            {{ $item->judul_ta }}
                                        </td>
                                        <td>
                                            {{ $item->jadwal->tanggal }}
                                        </td>
                                        <td>
                                            {{ $item->beritaAcara->no_ba }}
                                        </td>
                                        <td>
                                            <a class="btn btn-warning"
                                                href="
                                                        {{ route('koor.ValidasiBaTa2S2.edit', $item->encrypt_id) }}
                                                        "><i
                                                    class="bi bi-pencil-square"></i>
                                                Validasi</a>
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
