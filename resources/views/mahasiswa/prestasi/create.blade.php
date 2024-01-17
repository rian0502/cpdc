@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <h4 class="text-dark h4">Tambah Data Prestasi</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{route((Auth::user()->hasRole('mahasiswaS2'))?'mahasiswa.prestasiS2.store':'mahasiswa.prestasi.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Prestasi</label>
                                    <input autofocus name="nama_prestasi" value="{{old('nama_prestasi')}}" id="nama_prestasi"
                                        class="form-control @error('nama_prestasi') form-control-danger @enderror"
                                        type="text"
                                        placeholder="Nama Prestasi">
                                    @error('nama_prestasi')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tingkatan</label>
                                    <select class="selectpicker form-control @error('scala') form-control-danger @enderror" data-size="5" name="scala">
                                        <option value="Universitas" {{ old('scala') == 'Universitas' ? 'selected' : '' }}>
                                            Universitas</option>
                                        <option value="Kabupaten/Kota"
                                            {{ old('scala') == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                                        <option value="Provinsi" {{ old('scala') == 'Provinsi' ? 'selected' : '' }}>Provinsi
                                        </option>
                                        <option value="Nasional" {{ old('scala') == 'Nasional' ? 'selected' : '' }}>Nasional
                                        </option>
                                        <option value="Internasional"
                                            {{ old('scala') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                    </select>
                                    @error('scala')
                                    <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Capai</label>
                                    <input autofocus name="tanggal" value="{{old('tanggal')}}" id="tanggal"
                                        class="form-control @error('tanggal') form-control-danger @enderror" type="date" >
                                        @error('tanggal')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Dosen Pembimbing</label>
                                    <select class="custom-select2 form-control" name="id_pembimbing"
                                        id="id_pembimbing" style="width: 100%; height: 38px"
                                        onchange="toggleInput(this, 'pembimbing', 'nama_pembimbing')">
                                        <optgroup label="Dosen Pembimbing">
                                            @foreach ($dosen as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('id_pembimbing') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                            @if (old('id_pembimbing') == 'new' || $errors->has('nama_pembimbing'))
                                                <option value="new" selected>Tidak Ada di Daftar Ini</option>
                                            @else
                                                <option value="new">Tidak Ada di Daftar Ini</option>
                                            @endif
                                        </optgroup>
                                    </select>
                                </div>

                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <select class="selectpicker form-control @error('jenis') form-control-danger @enderror" data-size="5" name="jenis">
                                        <option value="Akademik" {{ old('jenis') == 'Akademik' ? 'selected' : '' }}>Akademik
                                        </option>
                                        <option value="Non Akademik" {{ old('jenis') == 'Non Akademik' ? 'selected' : '' }}>Non Akademik
                                        </option>
                                    </select>
                                    @error('jenis')
                                    <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Capaian</label>
                                    <select class="selectpicker form-control @error('capaian') form-control-danger @enderror" data-size="5" name="capaian">
                                        <option value="Juara 1" {{ old('capaian') == 'Juara 1' ? 'selected' : '' }}>Juara 1
                                        </option>
                                        <option value="Juara 2" {{ old('capaian') == 'Juara 2' ? 'selected' : '' }}>Juara 2
                                        </option>
                                        <option value="Juara 3" {{ old('capaian') == 'Juara 3' ? 'selected' : '' }}>Juara 3
                                        </option>
                                        <option value="Harapan 1"
                                            {{ old('capaian') == 'Harapan 1' ? 'selected' : '' }}>Juara Harapan 1
                                        </option>
                                        <option value="Harapan 2"
                                            {{ old('capaian') == 'Harapan 2' ? 'selected' : '' }}>Juara Harapan 2
                                        </option>
                                        <option value="Harapan 3"
                                            {{ old('capaian') == 'Harapan 3' ? 'selected' : '' }}>Juara Harapan 3
                                        </option>
                                        <option value="Peserta">Peserta</option>
                                    </select>
                                    @error('capaian')
                                    <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                @enderror
                                </div>

                                <div class="form-group">

                                    <label>Dokumen Prestasi<small> <a id="link-prestasi" href="#"
                                                target="_blank" style="display: none;">Lihat File</a> </small></label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="file_prestasi"
                                            id="label-prestasi">Pilih File</label>
                                        <input value="{{ old('file_prestasi') }}" accept=".pdf" autofocus
                                            name="file_prestasi" id="file_prestasi"
                                            class="custom-file-input form-control @error('file_prestasi') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK" onchange="updateFileNameAndLink('file_prestasi','label-prestasi','link-prestasi')">
                                    </div>
                                    @error('file_prestasi')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div id="nama_pembimbing"
                                    style="display: {{ old('id_pembimbing') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembimbing') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>Nama Dosen Pembimbing</label>
                                        <input autofocus name="nama_pembimbing" class="form-control" type="text"
                                            value="{{ old('nama_pembimbing') }}" placeholder="Masukkan Nama Dosen Pembimbing">
                                        @error('nama_pembimbing')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div id="pembimbing"
                                    style="display: {{ old('id_pembimbing') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembimbing') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>NIP Dosen Pembimbing</label>
                                        <input autofocus name="nip_pembimbing" class="form-control" type="text"
                                            value="{{ old('nip_pembimbing') }}"
                                            placeholder="Masukkan Nomor Karyawan Dosen Pembimbing">
                                        @error('nip_pembimbing')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
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
    <script>
        @if (old('nama_pembimbing'))
            toggleInput(document.getElementById('id_pembimbing'), 'pembimbing')
        @endif
    </script>
@endsection
