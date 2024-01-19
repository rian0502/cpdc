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
                        <div class="h5 mb-0">Prestasi</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.prestasi') }}" method="POST" enctype="multipart/form-data">
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
                                    @error('tahun-presatasi')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
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
                        <div class="h5 mb-0">Aktivitas</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.aktivitas') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Aktivitas</label>
                                    <select class="custom-select2 form-control" name="tahun_aktivitas" id="tahun_aktivitas"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Tahun">
                                            @foreach ($aktivitas as $item)
                                                <option value="{{ $item->year }}">{{ $item->year }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('tahun_aktivitas')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
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
                        <div class="h5 mb-0">Publikasi Mahasiswa</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.publikasi.mahasiswa') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Publikasi Mahasiswa</label>
                                    <select class="custom-select2 form-control" name="tahun_publikasi_mahasiswa"
                                        id="tahun_publikasi_mahasiswa" style="width: 100%; height: 38px">
                                        <optgroup label="Tahun Publikasi">
                                            @foreach ($publikasi_mahasiswa as $item)
                                                <option value="{{ $item->tahun }}">{{ $item->tahun }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('tahun_publikasi_mahasiswa')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
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
                        <div class="h5 mb-0">Mahasiswa</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.mahasiswa') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Mahasiswa</label>
                                    <select class="custom-select2 form-control" name="tahun_mahasiswa" id="tahun_mahasiswa"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Angkatan">
                                            @foreach ($mahasiswa as $item)
                                                <option value="{{ $item->angkatan }}">{{ $item->angkatan }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('tahun_mahasiswa')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
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
                        <div class="h5 mb-0">Alumni</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.alumni') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Alumni</label>
                                    <select class="custom-select2 form-control" name="tahun_alumni" id="tahun_alumni"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Angkatan">
                                            @foreach ($mahasiswa as $item)
                                                <option value="{{ $item->angkatan }}">{{ $item->angkatan }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('tahun_alumni')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
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
                        <div class="h5 mb-0">Seminar PKL / KP</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.kp') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Mahasiswa</label>
                                    <select class="custom-select2 form-control" name="akt_kp" id="akt_kp"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Angkatan">
                                            @foreach ($kp as $item)
                                                <option value="{{ $item->angkatan }}">{{ $item->angkatan }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('akt_kp')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
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
                        <div class="h5 mb-0">Seminar Tugas Akhir 1</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.ta1') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Mahasiswa</label>
                                    <select class="custom-select2 form-control" name="akt_ta1" id="akt_ta1"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Angkatan">
                                            @foreach ($ta1 as $item)
                                                <option value="{{ $item->angkatan }}">{{ $item->angkatan }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('akt_ta1')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
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
                        <div class="h5 mb-0">Seminar Tugas Akhir 2</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.ta2') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Mahasiswa</label>
                                    <select class="custom-select2 form-control" name="akt_ta2" id="akt_ta2"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="angkatan">
                                            @foreach ($ta2 as $item)
                                                <option value="{{ $item->angkatan }}">{{ $item->angkatan }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('akt_ta2')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
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
                        <div class="h5 mb-0">Sidang Komprehensif</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.kompre') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Mahasiswa</label>
                                    <select class="custom-select2 form-control" name="akt_kompre" id="akt_kompre"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Angkatan">
                                            @foreach ($kompre as $item)
                                                <option value="{{ $item->angkatan }}">{{ $item->angkatan }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('akt_kompre')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
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
