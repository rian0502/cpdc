@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Validasi Seminar Tugas Akhir 2</h4>
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

                                
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            {{-- @if ($item->proses_admin == 'Proses')
                                                <span class="badge badge-warning">Belum Divalidasi</span>
                                            @elseif ($item->proses_admin == 'Invalid')
                                                <span class="badge badge-danger">Invalid</span>
                                            @endif</td> --}}
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-outline-primary dropdown-toggle" href="#"
                                                    role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    {{-- <a class="dropdown-item" href="{{ route('berkas.validasi.seminar.ta2.edit', $item->encrypt_id) }}"><i class="fa fa-pencil"></i> --}}
                                                    <a class="dropdown-item" href=""><i class="fa fa-pencil"></i>
                                                        Edit</a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
