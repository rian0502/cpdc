@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Admin Lab</h4>
                        <a href="#">
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
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>Tanggal Surat Keputusan</th>
                                    <th>Berkas Surat Keputusan</th>
                                    <th>Alamat</th>
                                    <th>Nomor Telepon</th>
                                    <th>Role Admin</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($adm_berkas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nip }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->ttl }}</td>
                                        <td>{{ $item->tanggal_sk }}</td>
                                        <td>{{ $item->berkas_sk }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->no_tlp }}</td>
                                        <td>{{ $item->role_admin }}</td>
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
                                                        <form
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
