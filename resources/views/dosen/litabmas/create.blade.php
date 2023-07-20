@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah LITABMAS</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('dosen.litabmas.store') }}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama LITABMAS</label>
                                    <input value="{{ old('nama_litabmas') }}" autofocus name="nama_litabmas"
                                        id="nama_litabmas"
                                        class="form-control @error('nama_litabmas') form-control-danger @enderror"
                                        type="text" placeholder="Nama LITABMAS">
                                    @error('nama_litabmas')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select name="kategori" id="kategori" class="selectpicker form-control">
                                        <option value="Penelitian" {{ old('kategori') == 'Penelitian' ? 'selected' : '' }}>
                                            Penelitian</option>
                                        <option value="Pengabdian" {{ old('kategori') == 'Pengabdian' ? 'selected' : '' }}>
                                            Pengabdian</option>
                                    </select>
                                    @error('kategori')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Sumber Dana</label>
                                    <input value="{{ old('sumber_dana') }}" autofocus name="sumber_dana" id="sumber_dana"
                                        class="form-control @error('sumber_dana') form-control-danger @enderror"
                                        type="text" placeholder="Sumber Dana">
                                    @error('sumber_dana')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Dana</label>
                                    <input value="{{ old('jumlah_dana') }}" autofocus name="jumlah_dana" id="jumlah_dana"
                                        class="form-control @error('jumlah_dana') form-control-danger @enderror"
                                        type="number" placeholder="Jumlah Dana">
                                    @error('jumlah_dana')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tahun Pelaksanaan</label>
                                    <input value="{{ old('tahun_pelaksanaan') }}" name="tahun_pelaksanaan"
                                        id="tahun_pelaksanaan"
                                        class="form-control year-picker @error('tahun_pelaksanaan') form-control-danger @enderror"
                                        type="year" placeholder="Tahun pelaksanaan">
                                    @error('tahun_pelaksanaan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">

                                <div class="form-group">
                                    <label>Anggota</label>
                                    <select class="custom-select2 form-control" multiple="multiple" style="width: 100%"
                                        name="anggota[]">
                                        <optgroup label="Nama Dosen">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}">{{ $item->nama_dosen }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Anggota Eksternal</label>
                                    <textarea value="{{ old('anggota_external') }}" autofocus name="anggota_external"
                                        id="anggota_external"
                                        class="form-control @error('anggota_external') form-control-danger @enderror"
                                        type="text"></textarea>
                                    @error('anggota_external')
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
