@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Berkas Persyaratan</h4>
                    </div>
                    <div class="pb-20 m-3">

                        <table class="table data-table-responsive stripe data-table-noexport nowrap ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama File</th>
                                    <th>Link File</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $item)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $item->nama_file}}</td>
                                    <td>
                                        <a href="/uploads/syarat_seminar/{{$item->path_file}}">Lihat</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                                data-toggle="dropdown">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item"
                                                    href="{{ route('berkas.berkas_persyaratan.edit', $item->encrypt_id) }}"><i class="fa fa-pencil"></i> Edit</a>

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
