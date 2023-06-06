@extends('layouts.datatable')
@section('datatable')
    <div class="main-container mt-3">
        <div class="card-box pb-10">
            <div class="h5 pd-20 mb-0">Kerja Praktik</div>
            <a href="{{ route('mahasiswa.kp.create') }}" style="margin-left:15px;">
                <button class="btn btn-success ">
                    <i class="icon-copy fi-page-add"></i>
                    Daftar
                </button>
            </a>
            <table class="table data-table-responsive stripe data-table-export nowrap ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Ruangan</th>
                        <th>Prodi</th>
                        <th>Jenis Seminar</th>
                        <th class="table-plus datatable-nosort">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>1</td>
                            <td>2017031016</td>
                            <td>Putu Putra</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, tenetur.</td>
                            <td>10-10-2023</td>
                            <td>10.10</td>
                            <td>Ruangan Seminar</td>
                            <td>S1 Kimia</td>
                            <td>Kerja Praktik</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fal fa-eye"></i> Detail</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-pencil"></i> Edit</a>
                                        <form action="#" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"><i
                                                    class="fa fa-trash"></i>
                                                Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection
