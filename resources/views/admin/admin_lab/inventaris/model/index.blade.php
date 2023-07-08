@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Model</h4>
                        <a href="{{ route('sudo.model.create') }}">
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
                                    <th>Nama Model</th>
                                    <th>Merek</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($models as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_model }}</td>
                                        <td>{{ $item->merk }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-outline-primary dropdown-toggle" href="#"
                                                    role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('sudo.model.edit', $item->encrypt_id) }}">
                                                        <i class="fa fa-pencil"></i>
                                                        Edit</a>
                                                    @if ($item->barangs->count() < 1)
                                                        <form id="delete" action="{{ route('sudo.model.destroy', $item->encrypt_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fa fa-trash"></i>
                                                                Delete
                                                            </button>
                                                        </form>
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
                {{-- <div class="table-actions">
                    <a class="edit" href="{{ route('sudo.model.edit', $item->encrypt_id) }}">
                        <button class="btn btn-warning">
                            <i class="icon-copy fi-page-edit"></i>
                            Edit
                        </button>
                    </a>
                    @if ($item->barangs->count() == 0)
                        <form action="{{ route('sudo.model.destroy', $item->encrypt_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                <i class="icon-copy fi-page-delete"></i>
                                Hapus
                            </button>
                        </form>
                    @endif

                </div> --}}
            </div>
        </div>
    </div>

    <!-- Input Validation End -->
@endsection
