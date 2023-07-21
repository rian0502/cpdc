@extends('layouts.datatable')

@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">SOP</h4>
                        @role('admin lab')
                        <a href="{{ route('lab.sop.create') }}">
                            <button class="btn btn-success mt-3">
                                <i class="icon-copy fi-page-add"></i>
                                Tambah SOP
                            </button>
                        </a>
                        @endrole
                    </div>
                    <div class="pb-20 m-3">

                        <table class="table data-table-responsive stripe data-table-export nowrap ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama SOP</th>
                                    <th>Lokasi Penerapan</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sop as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_sop }}</td>
                                        <td>{{ $item->lokasi->nama_lokasi }}</td>
                                        <td>

                                            <div class="dropdown">
                                                <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                        href="{{ url('/uploads/sop/' . $item->file_sop) }}" target="_blank"><i
                                                            class="fal fa-eye"></i> Lihat</a>
                                                            @role('admin lab')
                                                    <a class="dropdown-item"
                                                        href="{{route('lab.sop.edit', $item->encrypt_id ) }}"><i
                                                            class="fa fa-pencil"></i> Edit</a>
                                                            @endrole
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

    <!-- Input Validation End -->
@endsection
