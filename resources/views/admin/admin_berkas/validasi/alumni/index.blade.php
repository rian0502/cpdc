@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Validasi Seminar Kerja Praktik</h4>
                        {{-- <a href="#">
                            <button class="btn btn-success mt-3">
                                <i class="icon-copy fi-page-add"></i>
                                Tambah Data
                            </button>
                        </a> --}}
                    </div>
                    <div class="pb-20 m-3">

                        <table class="table data-table-responsive stripe data-table-noexport">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Status</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                               @foreach ($alumni as $item)
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
                                        {{ $item->status }}
                                    </td>
                                    <td>
                                        <a href="{{ route('berkas.validasi.pendataan_alumni.edit', $item->encrypted_id) }}" class="btn btn-warning">
                                            Validasi
                                        </a>
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
