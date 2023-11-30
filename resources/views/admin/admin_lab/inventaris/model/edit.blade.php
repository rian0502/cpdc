@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Edit Model</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>

                    </div>
                    <form action="{{ route('sudo.model.update', $model->encrypt_id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <label>Nama Model</label>
                                <input autofocus name="nama_model" id="nama_model" value="{{ $model->nama_model }}"
                                    class="form-control @error('nama_model') form-control-danger @enderror" type="text"
                                    placeholder="Nama Model">
                                @error('nama_model')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="merek weight-500 col-md-6">
                                <label>Merek</label>
                                <input autofocus name="merk" id="merk" value="{{ $model->merk }}"
                                    class="form-control @error('merk') form-control-danger @enderror" type="text"
                                    placeholder="Merek">
                                @error('merk')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="weight-500 col-md-6">
                                <label>Kategori</label>
                                <select class="custom-select2 form-control" style="width: 100%; height: 38px" name="id_kategori">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->encrypt_id }}"
                                            {{ old('id_kategori', $model->id_kategori) == $item->id_kategori ? 'selected' : '' }}>
                                            {{ $item->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                    </form>
                    <a href="{{route('sudo.model.index')}}">
                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
