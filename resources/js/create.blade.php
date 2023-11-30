@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Buat Profile</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('dosen.profile.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>FOTO PROFILE</label>
                                    <div class=" custom-file">
                                        <input value="{{old('foto_profile')}}" autofocus name="foto_profile" id="foto_profile"
                                            class="custom-file-input form-control @error('foto_profile') form-control-danger @enderror"
                                            type="file" placeholder="FOTO PROFILE">
                                        <label class="custom-file-label" for="foto_profile">Pilih file</label>
                                    </div>
                                    @error('foto_profile')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>NAMA</label>
                                    <input value="{{old('nama_dosen')}}" autofocus name="nama_dosen" id="nama"
                                        class="form-control @error('nama_dosen') form-control-danger @enderror"
                                        type="text" placeholder="NAMA">
                                    @error('nama_dosen')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>NIP</label>
                                    <input value="{{old('nip')}}" autofocus name="nip" id="nip"
                                        class="form-control @error('nip') form-control-danger @enderror"
                                        type="number" placeholder="NIP">
                                    @error('nip')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>NIDN</label>
                                    <input value="{{old('nidn')}}" autofocus name="nidn" id="nidn"
                                        class="form-control @error('nidn') form-control-danger @enderror"
                                        type="number" placeholder="NIDN">
                                    @error('nidn')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>NO TELPHONE</label>
                                    <input value="{{old('no_hp')}}" autofocus name="no_hp" id="no_hp"
                                        class="form-control @error('no_hp') form-control-danger @enderror"
                                        type="number" placeholder="NO TELPHONE">
                                    @error('no_hp')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>ALAMAT</label>
                                    <input value="{{old('alamat')}}" autofocus name="alamat" id="alamat"
                                        class="form-control @error('alamat') form-control-danger @enderror"
                                        type="text" placeholder="ALAMAT">
                                    @error('alamat')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>TEMPAT LAHIR</label>
                                    <input value="{{old('tempat_lahir')}}" autofocus name="tempat_lahir" id="tempat_lahir"
                                        class="form-control @error('tempat_lahir') form-control-danger @enderror"
                                        type="text" placeholder="TEMPAT LAHIR">
                                    @error('tempat_lahir')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>TANGGAL LAHIR</label>
                                    <input value="{{old('tanggal_lahir')}}" autofocus name="tanggal_lahir" id="tanggal_lahir"
                                        class="form-control @error('tanggal_lahir') form-control-danger @enderror"
                                        type="date" placeholder="TANGGAL LAHIR">
                                    @error('tanggal_lahir')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label for="jabatan">JABATAN</label>

                                    <select name="jaban" id="jabatan"
                                        class="selectpicker form-control @error('jabatan') form-control-danger @enderror">
                                        <option value="Asisten Ahli">Asisten Ahli</option>
                                        <option value="Lektor">Lektor</option>
                                        <option value="Lektor Kepala">Lektor Kepala</option>
                                        <option value="Tenaga Pengajar">Tenaga Pengajar</option>
                                        <option value="Guru Besar">Guru Besar</option>
                                    </select>
                                    @error('jabatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>TANGGAL SK JABATAN</label>
                                    <input value="{{old('tanggal_sk_jabatan')}}" autofocus name="tanggal_sk_jabatan" id="tanggal_sk_jabatan"
                                        class="form-control @error('tanggal_sk_jabatan') form-control-danger @enderror"
                                        type="date" placeholder="TANGGAL SK">
                                    @error('tanggal_sk_jabatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>FILE SK JABATAN</label>
                                    <div class=" custom-file">
                                        <label class="custom-file-label" for="file_sk_jabatan">Pilih File</label>

                                        <input value="{{old('file_sk_jabatan')}}" autofocus name="file_sk_jabatan" id="file_sk_jabatan"
                                            class="custom-file-input form-control @error('file_sk_jabatan') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK">
                                    </div>
                                    @error('file_sk_jabatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kepangkatan">PANGKAT</label>
                                    <select name="kepangkatan" id="kepangkatan" class="selectpicker form-control @error('kepangkatan') form-control-danger @enderror">
                                        <option value="III A" {{ old('kepangkatan') == 'III A' ? 'selected' : '' }} >III A</option>
                                        <option value="III B" {{ old('kepangkatan') == 'III B' ? 'selected' : '' }}>III B</option>
                                        <option value="III C" {{ old('kepangkatan') == 'III C' ? 'selected' : '' }}>III C</option>
                                        <option value="IV A" {{ old('kepangkatan') == 'IV A' ? 'selected' : '' }}>IV A</option>
                                        <option value="IV B" {{ old('kepangkatan') == 'IV B' ? 'selected' : '' }}>IV B</option>
                                        <option value="IV C" {{ old('kepangkatan') == 'IV C' ? 'selected' : '' }}>IV C</option>
                                        <option value="IV D" {{ old('kepangkatan') == 'IV D' ? 'selected' : '' }}>IV D</option>
                                        <option value="IV E" {{ old('kepangkatan') == 'IV E' ? 'selected' : '' }}>IV E</option>
                                    </select>
                                    @error('kepangkatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>TANGGAL SK PANGKAT</label>
                                    <input value="{{old('tanggal_sk_pangkat')}}" autofocus name="tanggal_sk_pangkat" id="tanggal_sk_pangkat"
                                        class="form-control @error('tanggal_sk_pangkat') form-control-danger @enderror"
                                        type="date" placeholder="TANGGAL SK">
                                    @error('tanggal_sk_pangkat')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>FILE SK PANGKAT</label>
                                    <div class=" custom-file">
                                        <label class="custom-file-label" for="file_sk_pangkat">Pilih File</label>

                                        <input value="{{old('file_sk_pangkat')}}" autofocus name="file_sk_pangkat" id="file_sk_pangkat"
                                            class="custom-file-input form-control @error('file_sk_pangkat') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK">
                                    </div>
                                    @error('file_sk_pangkat')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Submit</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
