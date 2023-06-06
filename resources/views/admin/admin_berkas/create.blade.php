@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah Admin Lab</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>

                    </div>
                    <form action="{{ route('jurusan.lokasi.store') }}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nomor Induk Pegawai</label>
                                    <input value="" autofocus name="" id=""
                                        class="form-control @error('') form-control-danger @enderror" type="text"
                                        placeholder="Nomor Induk Pegawai">
                                    @error('')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input value="" autofocus name="" id=""
                                        class="form-control @error('') form-control-danger @enderror" type="text"
                                        placeholder="Nama">
                                    @error('nama')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input value="" autofocus name="" id=""
                                        class="form-control @error('') form-control-danger @enderror" type="text"
                                        placeholder="Nama">
                                    @error('nama')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="text" class="form-control date-picker" placeholder="Select Date" />
                                </div>

                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="merek weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Tanggal SK</label>
                                    <input type="text" class="form-control date-picker" placeholder="Select Date" />
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input value="" autofocus name="" id=""
                                        class="form-control @error('') form-control-danger @enderror" type="text"
                                        placeholder="Alamat">
                                    @error('nama')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input value="" autofocus name="" id=""
                                        class="form-control @error('') form-control-danger @enderror" type="number"
                                        placeholder="Alamat">
                                    @error('nama')
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
