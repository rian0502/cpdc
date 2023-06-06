@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Edit Lokasi</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>

                    </div>
                    <form action="{{ route('jurusan.lokasi.update', $lokasi->encrypt_id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Lokasi</label>
                                    <input autofocus name="nama_lokasi" id="nama_lokasi" value="{{ $lokasi->nama_lokasi }}"
                                        class="form-control @error('nama_lokasi') form-control-danger @enderror"
                                        type="text" placeholder="Nama Lokasi">
                                    @error('nama_lokasi')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Gedung</label>
                                    <input autofocus name="nama_gedung" id="nama_gedung" value="{{ $lokasi->nama_gedung }}"
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
                                    <label>Lantai Tingkat</label>
                                    <input autofocus name="lantai_tingkat" id="lantai_tingkat"
                                        value="{{ $lokasi->lantai_tingkat }}"
                                        class="form-control @error('lantai_tingkat') form-control-danger @enderror"
                                        min="0" type="number" placeholder="Lantai Tingkat">
                                    @error('lantai_tingkat')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Submit</button>
                        </div>

                    </form>
                    <a href="{{ route('jurusan.lokasi.index') }}">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
