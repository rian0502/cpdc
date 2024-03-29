@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Data Organisasi</h4>
                        {{-- @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif --}}
                        <div class="d-flex mt-4">


                            <a href="{{ route('dosen.organisasi.create') }}" class="bg-light-blue btn text-blue weight-500"><i
                                    class="ion-plus-round"></i> Tambah</a>
                            {{-- <a href="#" class="btn" data-toggle="modal" data-target="#via-excel" type="button">
                                <button class="btn btn-secondary mt-3">
                                    <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                    Import NPM
                                </button>
                            </a> --}}

                        </div>
                    </div>
                    <div class="pb-20 m-3">
                        <table id="data-npm" class="table data-table-responsive stripe data-table-noexport">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama Organisasi</td>
                                    <td>Masa Jabatan</td>
                                    <td>Jabatan</td>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($organisasi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-left">{{ $item->nama_organisasi }}</td>
                                        <td>{{ $item->tahun_menjabat . ' - ' . $item->tahun_berakhir }}
                                        </td>
                                        <td class="text-left">{{ $item->jabatan }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    data-color="#1b3133" href="#"
                                                    role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div
                                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('dosen.organisasi.edit', $item->encrypt_id) }}"><i
                                                            class="dw dw-edit2"></i>
                                                        Edit</a>
                                                    <form class="deleteForm2"
                                                        action="{{ route('dosen.organisasi.destroy', $item->encrypt_id) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button"
                                                            class="dropdown-item text-danger deleteBtn2"
                                                            onclick="showDeleteConfirmation(event)"><i
                                                                class="dw dw-delete-3"></i>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <!-- Input Validation End -->
@endsection
