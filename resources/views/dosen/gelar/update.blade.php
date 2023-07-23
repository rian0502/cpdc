@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah Gelar</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('dosen.gelar.update', $gelar->encrypt_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Instansi</label>
                                    <input value="{{ old('instansi_pendidikan',$gelar->instansi_pendidikan) }}" autofocus name="instansi_pendidikan"
                                        id="instansi_pendidikan"
                                        class="form-control @error('instansi_pendidikan') form-control-danger @enderror"
                                        type="text" placeholder="contoh: Universitas Lampung">
                                    @error('instansi_pendidikan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <input value="{{ old('jurusan',$gelar->jurusan) }}" autofocus name="jurusan"
                                        id="jurusan"
                                        class="form-control @error('jurusan') form-control-danger @enderror"
                                        type="text" placeholder="contoh: Ekonomi">
                                    @error('jurusan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tahun Lulus</label>
                                    <input value="{{ old('tahun_lulus',$gelar->tahun_lulus) }}" autofocus name="tahun_lulus"
                                        id="tahun_lulus"
                                        class="form-control year-picker @error('tahun_lulus') form-control-danger @enderror"
                                        type="text" placeholder="Contoh: 2020">
                                    @error('tahun_lulus')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Gelar</label>
                                    <input value="{{ old('nama_gelar',$gelar->nama_gelar) }}" autofocus name="nama_gelar"
                                        id="nama_gelar"
                                        class="form-control @error('nama_gelar') form-control-danger @enderror"
                                        type="text" placeholder="contoh: Sarjana Ekonomi">
                                    @error('nama_gelar')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Singkatan Gelar</label>
                                    <input value="{{ old('singkatan_gelar',$gelar->singkatan_gelar) }}" autofocus name="singkatan_gelar"
                                        id="singkatan_gelar"
                                        class="form-control @error('singkatan_gelar') form-control-danger @enderror"
                                        type="text" placeholder="contoh: S.E">
                                    @error('singkatan_gelar')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>

                    </form>
                    <a href="{{ route('dosen.profile.index') }}">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
