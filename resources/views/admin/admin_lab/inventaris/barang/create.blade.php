@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah Data Barang</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('lab.barang.store') }}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input value="{{ old('nama_barang') }}" autofocus name="nama_barang" id="nama_barang"
                                        class="form-control @error('nama_barang') form-control-danger @enderror"
                                        type="text" placeholder="Nama Barang">
                                    @error('nama_barang')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input value="{{ old('jumlah_akhir') }}" autofocus name="jumlah_akhir" id="jumlah_akhir"
                                        min="0"
                                        class="form-control @error('jumlah_akhir') form-control-danger @enderror"
                                        type="number" placeholder="Jumlah">
                                    @error('jumlah_akhir')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Model</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px"
                                        name="id_model">
                                        @foreach ($models as $item)
                                            <option value="{{ $item->encrypt_id }}"
                                                {{ old('id_model') == $item->encrypt_id ? 'selected' : '' }}>
                                                {{ $item->merk . ', ' . $item->nama_model }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <input 
                                        class="form-control" readonly disabled
                                        value="{{$lokasi->nama_lokasi}}"
                                        type="text" placeholder="Lokasi">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                    </form>
                    <a href="{{ route('lab.barang.index') }}">
                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
