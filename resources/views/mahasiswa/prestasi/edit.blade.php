@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Edit Data Prestasi</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('mahasiswa.prestasi.update', $prestasi->encrypt_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Prestasi</label>
                                    <input autofocus name="nama_prestasi" id="nama_prestasi"
                                        value="{{ old('nama_prestasi', $prestasi->nama_prestasi) }}"
                                        class="form-control
                                        type="text"
                                        placeholder="Nama Prestasi">
                                </div>
                                <div class="form-group">
                                    <label>Tingkatan</label>
                                    <select class="selectpicker form-control" data-size="5" name="scala">
                                        <option value="Universitas"
                                            {{ old('scala', $prestasi->scala) == 'Universitas' ? 'selected' : '' }}>
                                            Universitas</option>
                                        <option value="Kabupaten/Kota"
                                            {{ old('scala', $prestasi->scala) == 'Kabupaten/Kota' ? 'selected' : '' }}>
                                            Kabupaten/Kota</option>
                                        <option value="Provinsi"
                                            {{ old('scala', $prestasi->scala) == 'Provinsi' ? 'selected' : '' }}>Provinsi
                                        </option>
                                        <option value="Nasional"
                                            {{ old('scala', $prestasi->scala) == 'Nasional' ? 'selected' : '' }}>Nasional
                                        </option>
                                        <option value="Internasional"
                                            {{ old('scala', $prestasi->scala) == 'Internasional' ? 'selected' : '' }}>
                                            Internasional</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Capai</label>
                                    <input autofocus name="tanggal" value="{{ old('tanggal', $prestasi->tanggal) }}"
                                        id="tanggal" class="form-control" type="date">
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Capaian</label>
                                    <select class="selectpicker form-control" data-size="5" name="capaian">
                                        <option value="Juara 1"
                                            {{ old('capaian', $prestasi->capaian) == 'Juara 1' ? 'selected' : '' }}>Juara 1
                                        </option>
                                        <option value="Juara 2"
                                            {{ old('capaian', $prestasi->capaian) == 'Juara 2' ? 'selected' : '' }}>Juara 2
                                        </option>
                                        <option value="Juara 3"
                                            {{ old('capaian', $prestasi->capaian) == 'Juara 3' ? 'selected' : '' }}>Juara 3
                                        </option>
                                        <option value="Harapan 1"
                                            {{ old('capaian', $prestasi->capaian) == 'Harapan 1' ? 'selected' : '' }}>
                                            Juara Harapan 1</option>
                                        <option value="Harapan 2"
                                            {{ old('capaian', $prestasi->capaian) == 'Harapan 2' ? 'selected' : '' }}>
                                            Juara Harapan 2</option>
                                        <option value="Harapan 3"
                                            {{ old('capaian', $prestasi->capaian) == 'Harapan 3' ? 'selected' : '' }}>
                                            Juara Harapan 3</option>
                                        <option value="Peserta">Peserta</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Dokumen Prestasi<small> <a id="link-prestasi" href="#" target="_blank"
                                                style="display: none;">Lihat File</a> </small></label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="file_prestasi" id="label-prestasi">Pilih
                                            File</label>
                                        <input value="{{ old('file_prestasi') }}" accept=".pdf" autofocus
                                            name="file_prestasi" id="file_prestasi"
                                            class="custom-file-input form-control @error('file_prestasi') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file_prestasi','label-prestasi','link-prestasi')">
                                    </div>
                                    @error('file_prestasi')
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
