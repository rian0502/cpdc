@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah Model</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>

                    </div>
                    <form action="{{ route('lab.model.store') }}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Model</label>
                                    <input value="{{ old('nama_model') }}" autofocus name="nama_model" id="nama_model"
                                        class="form-control @error('nama_model') form-control-danger @enderror"
                                        type="text" placeholder="Nama Model">
                                    @error('nama_model')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px" name="id_kategori">
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->encrypt_id }}"
                                                {{ old('id_kategori') == $item->encrypt_id ? 'selected' : '' }}>
                                                {{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kategori')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="merek weight-500 col-md-6">
                                <label>Merek</label>
                                <input value="{{ old('merk') }}" autofocus name="merk" id="merk"
                                    class="form-control @error('merk') form-control-danger @enderror" type="text"
                                    placeholder="Merek">
                                @error('merk')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group">

                            <button type="submit" class="submit btn btn-primary">Submit</button>
                        </div>

                    </form>
                    <a href="{{ route('lab.model.index') }}">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
