@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Barang</h4>
                        @role('admin lab')
                            <a href="{{ route('lab.barang.create') }}">
                                <button class="btn btn-success mt-3">
                                    <i class="icon-copy fi-page-add"></i>
                                    Tambah Data
                                </button>
                            </a>
                        @endrole
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
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    data-color="#1b3133" href="#" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('lab.barang.show', $item->encrypt_id) }}"><i
                                                            class="dw dw-eye"></i>
                                                        Lihat</a>
                                                    @role('admin lab')
                                                        <a class="dropdown-item"
                                                            href="{{ route('lab.barang.edit', $item->encrypt_id) }}"><i
                                                                class="dw dw-edit2"></i>
                                                            Edit</a>
                                                        <form id="delete"
                                                            action="{{ route('lab.barang.destroy', $item->encrypt_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" id="deleteBtn"
                                                                class="dropdown-item text-danger"><i class="dw dw-delete-3"></i>
                                                                Hapus</button>
                                                        </form>
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
