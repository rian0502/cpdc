@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah Data Kegiatan</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form
                        action="{{route((Auth::user()->hasRole('mahasiswaS2'))?'mahasiswa.kegiatanS2.store':'mahasiswa.kegiatan.store')}}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Aktivitas</label>
                                    <input autofocus name="nama_aktivitas" id="nama_aktivitas"
                                        class="form-control @error('nama_aktivitas') form-control-danger @enderror"
                                        type="text" placeholder="Tuliskan Judul Kegiatan"
                                        value="{{ old('nama_aktivitas') }}">
                                    @error('nama_aktivitas')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Peran</label>
                                    <select class="selectpicker form-control" data-size="5" name="peran">
                                        <option value="Ketua" {{ old('peran') == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                                        <option value="Anggota" {{ old('peran') == 'Anggota' ? 'selected' : '' }}>Anggota
                                        </option>
                                        <option value="Peserta" {{ old('peran') == 'Peserta' ? 'selected' : '' }}>Peserta
                                        </option>
                                    </select>
                                    @error('peran')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>SKS Konversi</label>
                                    <input autofocus name="sks_konversi" id="sks_konversi"
                                        class="form-control @error('sks_konversi') form-control-danger @enderror""
                                        type="number" value="{{ old('sks_konversi') }}"
                                        placeholder="Tuliskan sks yang akan dikonversikan.">
                                    @error('sks_konversi')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input name="tanggal"
                                        class="form-control @error('tanggal') form-control-danger @enderror" type="date"
                                        value="{{ old('tanggal') }}">
                                    @error('tanggal')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">

                                    <label>Dokumen Aktivitas<small> <a id="link-aktivitas" href="#" target="_blank"
                                                style="display: none;">Lihat File</a> </small></label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="file_aktivitas" id="label-aktivitas">Pilih
                                            File</label>
                                        <input value="{{ old('file_aktivitas') }}" accept=".pdf" autofocus
                                            name="file_aktivitas" id="file_aktivitas"
                                            class="custom-file-input form-control @error('file_aktivitas') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file_aktivitas','label-aktivitas','link-aktivitas')">
                                    </div>
                                    @error('file_aktivitas')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>

                    </form>
                    <a href="{{ route('mahasiswa.profile.index') }}">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->
    </div>
@endsection
