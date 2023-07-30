@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah Lokasi</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>

                    </div>
                    <form action="{{ route('jurusan.lokasi.store') }}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Lokasi</label>
                                    <input value="{{old('nama_lokasi')}}" autofocus name="nama_lokasi" id="nama_lokasi"
                                        class="form-control @error('nama_lokasi') form-control-danger @enderror"
                                        type="text" placeholder="Nama Lokasi">
                                    @error('nama_lokasi')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Gedung</label>
                                    <input value="{{old('nama_gedung')}}" autofocus name="nama_gedung" id="nama_gedung"
                                        class="form-control @error('nama_gedung') form-control-danger @enderror"
                                        type="text" placeholder="Nama Gedung">
                                    @error('nama_gedung')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="merek weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Tingkatan Lantai</label>
                                    <input value="{{old('lantai_tingkat')}}" autofocus name="lantai_tingkat" id="lantai_tingkat"
                                        class="form-control @error('lantai_tingkat') form-control-danger @enderror"
                                        type="number" placeholder="Tingkatan Lantai Gedung pada Lokasi">
                                    @error('lantai_tingkat')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Lokasi</label>
                                    <div class="@error('jenis_ruangan') form-control-danger @enderror">
                                        <div class="custom-control custom-radio custom-control-inline pb-0">
                                            <input type="radio" id="Lab" name="jenis_ruangan"
                                                value="Lab" class="custom-control-input"
                                                {{ old('jenis_ruangan') == 'Lab' ? 'checked' : '' }} />
                                            <label class="custom-control-label"
                                                for="Lab">Laboratorium</label>
                                        </div>
                                        <div
                                            class="custom-control custom-radio custom-control-inline pb-0">
                                            <input type="radio" id="Kelas" name="jenis_ruangan"
                                                value="Kelas" class="custom-control-input"
                                                {{ old('jenis_ruangan') == 'Kelas' ? 'checked' : '' }} />
                                            <label class="custom-control-label"
                                                for="Kelas">Kelas</label>
                                        </div>
                                    </div>
                                    @error('jenis_ruangan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                    </form>
                    <a href="{{route('jurusan.lokasi.index')}}">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
