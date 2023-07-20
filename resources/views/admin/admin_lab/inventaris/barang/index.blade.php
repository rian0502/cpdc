@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Barang</h4>
                        <a href="{{ route('lab.barang.create') }}">
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
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Model</th>
                                    <th>Lokasi</th>
                                    <th>Jumlah</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($barang as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->modelBarang->kategori->nama_kategori }}</td>
                                        <td>{{ $item->modelBarang->nama_model }}</td>
                                        <td>{{ $item->lokasi->nama_lokasi }}</td>
                                        <td>{{ $item->jumlah_akhir }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-outline-primary dropdown-toggle" href="#"
                                                    role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('lab.barang.show', $item->encrypt_id) }}"><i
                                                            class="fal fa-eye"></i> Lihat</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('lab.barang.edit', $item->encrypt_id) }}"><i
                                                            class="fa fa-pencil"></i> Edit</a>
                                                    <form id="delete"
                                                        action="{{ route('lab.barang.destroy', $item->encrypt_id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" id="deleteBtn"
                                                            class="dropdown-item text-danger"><i class="fa fa-trash"></i>
                                                            Hapus</button>
                                                    </form>
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
