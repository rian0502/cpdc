@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Data Kinerja Dosen</h4>

                        <div class="d-flex mt-4">
                            <a href="{{ route('dosen.kinerja.create') }}" class="bg-light-blue btn text-blue weight-500"><i
                                    class="ion-plus-round"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="pb-20 m-3">
                        <table id="data-npm" class="table data-table-responsive stripe data-table-noexport">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Akademik</th>
                                    <th>Semester</th>
                                    <th>Pendidikan</th>
                                    <th>Penelitian</th>
                                    <th>Pengabdian</th>
                                    <th>Penunjang</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kinerja as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tahun_akademik }}</td>
                                        <td>{{ $item->semester }}</td>
                                        <td>{{ $item->sks_pendidikan }}</td>
                                        <td>{{ $item->sks_penelitian }}</td>
                                        <td>{{ $item->sks_pengabdian }}</td>
                                        <td>{{ $item->sks_penunjang }}</td>



                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    data-color="#1b3133" href="#" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('dosen.kinerja.edit', $item->encrypted_id) }}"><i
                                                            class="dw dw-edit2"></i>
                                                        Edit</a>
                                                    <form class="deleteForm2"
                                                        action="{{ route('dosen.kinerja.destroy', $item->encrypted_id) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="button" class="dropdown-item text-danger deleteBtn2"
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
