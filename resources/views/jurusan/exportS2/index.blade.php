@extends('layouts.admin')
@section('admin')
    <style>
        .containerr {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
        }

        .card-box {
            min-height: 200px;
        }

        @media screen and (max-width: 767px) {
            .containerr {
                grid-template-columns: 1fr;

            }
        }
    </style>
    <div class="main-container">

        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="title pb-20">
                <h2 class="h2 mb-0">Unduh Data</h2>
            </div>

            <div class="containerr">
                

                <div class="card-box" style="height:256px;">
                    <div class="pd-20">
                        <div class="h5 mb-0">Prestasi Mahasiswa S2</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.prestasiS2') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Prestasi</label>
                                    <select class="custom-select2 form-control" name="tahun_prestasi" id="tahun_prestasi"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Tahun">
                                            @foreach ($prestasi as $item)
                                                <option value="{{ $item->year }}">{{ $item->year }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="weight-500 col-md-3">
                                <div class="form-group">
                                    <div class="cta  d-flex align-items-center justify-content-end mt-4">
                                        <button class="btn btn-sm btn-outline-primary">Unduh</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-box" style="height:256px;">
                    <div class="pd-20">
                        <div class="h5 mb-0">Aktivitas Mahasiswa S2</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.aktivitasS2') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Aktivitas</label>
                                    <select class="custom-select2 form-control" name="tahun_aktivitas"
                                        id="tahun_aktivitas" style="width: 100%; height: 38px">
                                        <optgroup label="Tahun">
                                            @foreach ($aktivitas as $item)
                                                <option value="{{ $item->year }}">{{ $item->year }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="weight-500 col-md-3">
                                <div class="form-group">
                                    <div class="cta  d-flex align-items-center justify-content-end mt-4">
                                        <button class="btn btn-sm btn-outline-primary">Unduh</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-box" style="height:256px;">
                    <div class="pd-20">
                        <div class="h5 mb-0">Mahasiswa S2</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.mahasiswas2') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Mahasiswa</label>
                                    <select class="custom-select2 form-control" name="tahun_mahasiswa"
                                        id="tahun_mahasiswa" style="width: 100%; height: 38px">
                                        <optgroup label="Angkatan">
                                            @foreach ($mahasiswa as $item)
                                                <option value="{{ $item->angkatan }}">{{ $item->angkatan }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="weight-500 col-md-3">
                                <div class="form-group">
                                    <div class="cta  d-flex align-items-center justify-content-end mt-4">
                                        <button class="btn btn-sm btn-outline-primary">Unduh</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-box" style="height:256px;">
                    <div class="pd-20">
                        <div class="h5 mb-0">Alumni S2</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.alumniS2') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Alumni</label>
                                    <select class="custom-select2 form-control" name="tahun_alumni" id="tahun_alumni"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Angkatan">
                                            @foreach ($alumni as $item)
                                                <option value="{{ $item->angkatan }}">{{ $item->angkatan }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="weight-500 col-md-3">
                                <div class="form-group">
                                    <div class="cta  d-flex align-items-center justify-content-end mt-4">
                                        <button class="btn btn-sm btn-outline-primary">Unduh</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-box" style="height:256px;">
                    <div class="pd-20">
                        <div class="h5 mb-0">Tesis 1</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.tesis1') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Mahasiswa</label>
                                    <select class="custom-select2 form-control" name="akt_tesis_1" id="akt_tesis_1"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Angkatan">
                                            @foreach ($tesis_1 as $item)
                                                <option value="{{ $item->angkatan }}">{{ $item->angkatan }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="weight-500 col-md-3">
                                <div class="form-group">
                                    <div class="cta  d-flex align-items-center justify-content-end mt-4">
                                        <button class="btn btn-sm btn-outline-primary">Unduh</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-box" style="height:256px;">
                    <div class="pd-20">
                        <div class="h5 mb-0">Tesis 2</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.tesis2') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Mahasiswa</label>
                                    <select class="custom-select2 form-control" name="akt_tesis_2" id="akt_tesis_2"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Angkatan">
                                            @foreach ($tesis_2 as $item)
                                                <option value="{{ $item->angkatan }}">{{ $item->angkatan }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="weight-500 col-md-3">
                                <div class="form-group">
                                    <div class="cta  d-flex align-items-center justify-content-end mt-4">
                                        <button class="btn btn-sm btn-outline-primary">Unduh</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-box" style="height:256px;">
                    <div class="pd-20">
                        <div class="h5 mb-0">Sidang Tesis</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.sidang') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Mahasiswa</label>
                                    <select class="custom-select2 form-control" name="akt_sidang" id="akt_sidang"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="angkatan">
                                            @foreach ($sidang as $item)
                                                <option value="{{ $item->angkatan }}">{{ $item->angkatan }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="weight-500 col-md-3">
                                <div class="form-group">
                                    <div class="cta  d-flex align-items-center justify-content-end mt-4">
                                        <button class="btn btn-sm btn-outline-primary">Unduh</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
