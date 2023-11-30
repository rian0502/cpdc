@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah Organisasi</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('dosen.organisasi.store') }}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Organisasi</label>
                                    <input value="{{ old('nama_organisasi') }}" autofocus name="nama_organisasi"
                                        id="nama_organisasi"
                                        class="form-control @error('nama_organisasi') form-control-danger @enderror"
                                        type="text" placeholder="Nama Organisasi">
                                    @error('nama_organisasi')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input value="{{ old('jabatan') }}" autofocus name="jabatan" id="jabatan"
                                        class="form-control @error('jabatan') form-control-danger @enderror" type="text"
                                        placeholder="Jabatan">
                                    @error('Jabatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Tahun Menjabat</label>
                                    <input value="{{ old('tahun_menjabat') }}" autofocus name="tahun_menjabat"
                                        id="tahun_menjabat"
                                        class="form-control year-picker @error('tahun_menjabat') form-control-danger @enderror"
                                        type="year" placeholder="Tahun Menjabat">
                                    @error('tahun_menjabat')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tahun Berakhir</label>
                                    <input value="{{ old('tahun_berakhir') }}" autofocus name="tahun_berakhir"
                                        id="tahun_berakhir"
                                        class="form-control year-picker @error('tahun_berakhir') form-control-danger @enderror"
                                        type="year" placeholder="Tahun Berakhir">
                                    @error('tahun_berakhir')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>

                    </form>
                    <a href="{{ route('dosen.organisasi.index') }}">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
