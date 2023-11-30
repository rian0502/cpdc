@extends('layouts.datatable')
@section('datatable')
    <style>
        /* Gaya tombol normal (berada di kanan) */
        .tambah-data {
            text-align: right;
            margin-bottom: -80px;
        }

        /* Gaya tombol saat mode seluler (berada di tengah) */
        @media only screen and (max-width: 767px) {
            .tambah-data {
                text-align: center;
                margin-bottom: 0px;
            }
        }
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Lokasi</h4>
                        <div class="tambah-data">
                            <a href="{{ route('jurusan.lokasi.create') }}">
                                <button class="btn btn-success mt-3">
                                    <i class="icon-copy fi-page-add"></i>
                                    Tambah Data
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export nowrap ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lokasi</th>
                                    <th>Lantai</th>
                                    <th>Nama Gedung</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_lokasi }}</td>
                                        <td>{{ $item->lantai_tingkat }}</td>
                                        <td>{{ $item->nama_gedung }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    data-color="#1b3133" href="#" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('jurusan.lokasi.edit', $item->encrypt_id) }}"><i
                                                            class="dw dw-edit2"></i>
                                                        Edit</a>
                                                    @if ($item->barangs->count() < 1)
                                                        <form id="delete"
                                                            action="{{ route('jurusan.lokasi.destroy', $item->encrypt_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?')">
                                                                <i class="dw dw-delete-3"></i>
                                                                Hapus
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
            </div>
        </div>
    </div>
@endsection
