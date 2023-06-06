@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Activity Lab</h4>
                        <a href="{{ route('lab.ruang.create') }}">
                            <button class="btn btn-success mt-3">
                                <i class="icon-copy fi-page-add"></i>
                                Tambah Data
                            </button>
                        </a>
                    </div>
                    <div class="pb-20 m-3">

                        <table class="table data-table-responsive stripe data-table-export nowrap ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Lokasi</th>
                                    <th>Tanggal Pakai</th>
                                    <th>Keperluan</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->lokasi->nama_lokasi }}</td>
                                        <td>{{ $carbon::parse($item->updated_at)->format('d F Y') }}</td>
                                        <td>{{ $item->keperluan }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-outline-primary dropdown-toggle" href="#"
                                                    role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('lab.ruang.show', $item->encrypted_id) }}"><i
                                                            class="fal fa-eye"></i> Detail</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('lab.ruang.edit', $item->encrypted_id) }}"><i
                                                            class="fa fa-pencil"></i> Edit</a>

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
