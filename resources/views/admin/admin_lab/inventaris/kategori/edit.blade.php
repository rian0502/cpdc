@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Edit Kategori</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>

                    </div>
                    <form action="{{ route('lab.kategori.update',$kategori->encrypt_id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <label>Nama Kategori</label>
                                <input autofocus name="nama_kategori" id="nama_kategori" value="{{ $kategori->nama_kategori }}"
                                    class="form-control @error('nama_kategori') form-control-danger @enderror"
                                    type="text" placeholder="Nama Kategori">
                                @error('nama_kategori')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="weight-500 col-md-6">
                                <label>Keterangan</label>
                                <input value="{{ $kategori->ket }}" autofocus name="ket" id="ket"
                                    class="form-control @error('ket') form-control-danger @enderror"
                                    type="text" placeholder="Keterangan">
                                @error('ket')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="merek weight-500 col-md-6">
                                {{-- <label>Merek</label>
                                <input autofocus name="merk" id="merk"
                                    class="form-control @error('merk') form-control-danger @enderror" type="text"
                                    placeholder="Merek">
                                @error('merk')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror --}}
                            </div>
                        </div>


                        <div class="form-group">

                            <button type="submit" class="submit btn btn-primary">Submit</button>
                        </div>

                    </form>
                    <a href="{{route('lab.kategori.index')}}">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
