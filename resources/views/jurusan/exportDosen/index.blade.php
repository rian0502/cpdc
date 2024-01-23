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
                <div class="card-box">
                    <div class="pd-20">
                        <div class="h5 mb-0">LITABMAS</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.penelitian') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Penelitian</label>
                                    <select class="custom-select2 form-control" name="tahun_penelitian"
                                        id="tahun_penelitian" style="width: 100%; height: 38px">
                                        <optgroup label="Tahun">
                                            @foreach ($penelitian as $item)
                                                <option value="{{ $item->tahun_penelitian }}">{{ $item->tahun_penelitian }}
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
                    <form action="{{ route('jurusan.unduh.pengabdian') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Pengabdian</label>
                                    <select class="custom-select2 form-control" name="tahun_pengabdian"
                                        id="tahun_pengabdian" style="width: 100%; height: 38px">
                                        <optgroup label="Tahun">
                                            @foreach ($pengabdian as $item)
                                                <option value="{{ $item->tahun_penelitian }}">{{ $item->tahun_penelitian }}
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
                <div class="card-box" style="height:280px;">
                    <div class="pd-20">
                        <div class="h5 mb-0">Publikasi</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.publikasi') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Publikasi</label>
                                    <select class="custom-select2 form-control" name="tahun_publikasi" id="tahun_publikasi"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Tahun">
                                            @foreach ($publikasi as $item)
                                                <option value="{{ $item->tahun }}">{{ $item->tahun }}
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
                        <div class="h5 mb-0">Seminar Dosen</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.seminar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Seminar</label>
                                    <select class="custom-select2 form-control" name="tahun_seminar" id="tahun_seminar"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Tahun">
                                            @foreach ($seminar_dosen as $item)
                                                <option value="{{ $item->tahun }}">{{ $item->tahun }}
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
                        <div class="h5 mb-0">Penghargaan Dosen</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.penghargaan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Penghargaan</label>
                                    <select class="custom-select2 form-control" name="tahun_penghargaan"
                                        id="tahun_penghargaan" style="width: 100%; height: 38px">
                                        <optgroup label="Tahun">
                                            @foreach ($penghargaan_dosen as $item)
                                                <option value="{{ $item->tahun }}">{{ $item->tahun }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('tahun_penghargaan')
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
                        <div class="h5 mb-0">Kinerja Dosen</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.kinerja_dosen') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Tahun Akademik</label>
                                    <select class="custom-select2 form-control" name="tahun_akademik" id="tahun_akademik"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Tahun">
                                            @foreach ($kinerja_dosen as $item)
                                                <option value="{{ $item->tahun_akademik }}">{{ $item->tahun_akademik }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('tahun_ajaran')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <select class="custom-select2 form-control" name="semester" id="semester"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Semester">
                                            <option value="Genap">Genap
                                            </option>
                                            <option value="Ganjil">Ganjil
                                            </option>
                                        </optgroup>
                                    </select>
                                    @error('semester')
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
