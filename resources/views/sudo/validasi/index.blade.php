@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Validasi Mahasiswa</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Vertifikasi</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswa as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $item->npm }}
                                        </td>
                                        <td>
                                            {{ $item->nama }}
                                        </td>
                                        <td>
                                            {{ $item->user->email }}
                                        </td>
                                        <td>
                                            @if ($item->user->email_verified_at == null)
                                                <span class="badge badge-danger">Belum Terverifikasi</span>
                                            @else
                                                <span class="badge badge-success">Terverifikasi</span>
                                            @endif
                                        </td>
                                        <td></td>
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
