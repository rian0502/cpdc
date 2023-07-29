@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Data Organisasi</h4>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="d-flex mt-4">


                            <a href="{{ route('dosen.publikasi.create') }}"
                                class="bg-light-blue btn text-blue weight-500"><i class="ion-plus-round"></i> Tambah</a>
                            <a href="{{ url('uploads/Template Publikasi.xlsx') }}"
                                class="bg-success btn text-white ml-4 weight-500"><i class="far fa-file-download"></i>
                                Download Template Import Data</a>
                            <a href="#" class="bg-secondary btn text-white ml-4 weight-500" data-toggle="modal"
                                data-target="#via-excel" type="button">
                                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                Upload Publikasi via Excel (xlsx)
                            </a>

                        </div>
                        <div class="col-md-4 col-sm-12 mb-30">
                            <div class="modal fade" id="via-excel" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myLargeModalLabel">
                                                Tambah Data Publikasi
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('dosen.publikasi.import') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div id="input_fields">
                                                    <div class="input-group mb-3">
                                                        <input
                                                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                                            type="file" name="publikasi" id="publikasi"
                                                            class="form-control-file">
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Tutup
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                Kirim
                                            </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-20 m-3">
                        <table id="data-npm" class="table data-table-responsive stripe data-table-noexport">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td class="max-w-md">Judul</td>
                                    <td>Tahun</td>
                                    <td>Scala</td>
                                    <td>Kategori</td>
                                    <td>Litabmas</td>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach (Auth::user()->dosen->publikasi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-break max-w-md text-left">
                                            {{ $item->judul }}</td>
                                        <td>{{ $item->tahun }}</td>
                                        <td>{{ $item->scala }}</td>
                                        <td>{{ $item->kategori }}</td>
                                        <td>{{ $item->kategori_litabmas }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    data-color="#1b3133" href="#" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('dosen.publikasi.show', $item->encrypt_id) }}"><i
                                                            class="dw dw-eye"></i>
                                                        Lihat</a>
                                                    @if ($item->anggotaPublikasi[0]->id_dosen == Auth::user()->dosen->id)
                                                        <a class="dropdown-item"
                                                            href="{{ route('dosen.publikasi.edit', $item->encrypt_id) }}"><i
                                                                class="dw dw-edit2"></i>
                                                            Edit</a>
                                                        <form class="deleteForm2"
                                                            action="{{ route('dosen.publikasi.destroy', $item->encrypt_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="dropdown-item text-danger deleteBtn2"
                                                                onclick="showDeleteConfirmation(event)"><i
                                                                    class="dw dw-delete-3"></i>
                                                                Hapus</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <!-- Input Validation End -->
@endsection
