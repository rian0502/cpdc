@extends('layouts.blank')
@section('blank')
    <style>
        .custom-file-label::after {
            content: 'Pilih File';
        }

        .foto {
            border-radius: 50%;
            width: 170px;
            /* Sesuaikan dengan lebar yang diinginkan */
            height: 170px;
            /* Sesuaikan dengan tinggi yang diinginkan */
            object-fit: cover;
        }

        .file-foto {
            width: 250px;
        }

        .center-div {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Buat Profile</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3 pb-2">
                            <div class="form-group">
                                <div class="profile-photo">
                                    <img id="preview-image" src="/uploads/profile/{{ Auth::user()->profile_picture }}"
                                        alt="Foto Profile" onerror="this.src='/uploads/profile/default.png'" class="foto">
                                </div>
                                <div class="center-div">
                                    <input value="{{ Auth::user()->profile_picture }}" accept="image/*" autofocus
                                        name="foto_profile" id="foto_profile"
                                        class="mt-2 file-foto form-control @error('foto_profile') form-control-danger @enderror"
                                        type="file" value="{{ old('foto_profile') }}" placeholder="FOTO PROFILE" onchange="previewFile(event)">
                                    @error('foto_profile')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input value="{{ old('nama_administrasi') }}" autofocus name="nama_administrasi"
                                        id="nama"
                                        class="form-control @error('nama_administrasi') form-control-danger @enderror"
                                        type="text" placeholder="NAMA">
                                    @error('nama_administrasi')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Induk Pegawai</label>
                                    <input value="{{ old('nip') }}" autofocus name="nip" id="nip"
                                        class="form-control @error('nip') form-control-danger @enderror" type="number"
                                        placeholder="NIP">
                                    @error('nip')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input value="{{ old('no_hp') }}" autofocus name="no_hp" id="no_hp"
                                        class="form-control @error('no_hp') form-control-danger @enderror" type="number"
                                        placeholder="NO TELPHONE">
                                    @error('no_hp')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input value="{{ old('tempat_lahir') }}" autofocus name="tempat_lahir"
                                        id="tempat_lahir"
                                        class="form-control @error('tempat_lahir') form-control-danger @enderror"
                                        type="text" placeholder="TEMPAT LAHIR">
                                    @error('tempat_lahir')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input value="{{ old('tanggal_lahir') }}" autofocus name="tanggal_lahir"
                                        id="tanggal_lahir"
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
                                    <label>Alamat</label>
                                    <input value="{{ old('alamat') }}" autofocus name="alamat" id="alamat"
                                        class="form-control @error('alamat') form-control-danger @enderror" type="text"
                                        placeholder="ALAMAT">
                                    @error('alamat')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Surat Keputusan Pangkat</label>
                                    <input value="{{ old('tanggal_sk') }}" autofocus name="tanggal_sk" id="tanggal_sk"
                                        class="form-control @error('tanggal_sk') form-control-danger @enderror"
                                        type="date" placeholder="TANGGAL SK">
                                    @error('tanggal_sk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>File Surat Keputusan Pangkat <small> <a id="view-file-link-pangkat" href="#"
                                                target="_blank" style="display: none;">Lihat File</a> </small></label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="file_sk" id="file-label-pangkat">Pilih
                                            File</label>
                                        <input value="{{ old('file_sk') }}" accept=".pdf" autofocus name="file_sk"
                                            id="file_sk"
                                            class="custom-file-input form-control @error('file_sk') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK" onchange="updateFileNamePangkat(event)">
                                    </div>
                                    @error('file_sk')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kepangkatan">Pangkat</label>
                                    <select name="kepangkatan" id="kepangkatan" style="width: 100%; height: 38px"
                                        class="custom-select2 form-control @error('kepangkatan') form-control-danger @enderror">
                                        <option value="I A" {{ old('kepangkatan') == 'I A' ? 'selected' : '' }}>I A
                                        </option>
                                        <option value="I B" {{ old('kepangkatan') == 'I B' ? 'selected' : '' }}>I B
                                        </option>
                                        <option value="I C" {{ old('kepangkatan') == 'I C' ? 'selected' : '' }}>I C
                                        </option>
                                        <option value="I D" {{ old('kepangkatan') == 'I D' ? 'selected' : '' }}>I D
                                        </option>
                                        <option value="II A" {{ old('kepangkatan') == 'II A' ? 'selected' : '' }}>II A
                                        </option>
                                        <option value="II B" {{ old('kepangkatan') == 'II B' ? 'selected' : '' }}>II B
                                        </option>
                                        <option value="II C" {{ old('kepangkatan') == 'II C' ? 'selected' : '' }}>II C
                                        </option>
                                        <option value="II D" {{ old('kepangkatan') == 'II D' ? 'selected' : '' }}>II D
                                        </option>
                                        <option value="III A" {{ old('kepangkatan') == 'III A' ? 'selected' : '' }}>III A
                                        </option>
                                        <option value="III B" {{ old('kepangkatan') == 'III B' ? 'selected' : '' }}>III B
                                        </option>
                                        <option value="III C" {{ old('kepangkatan') == 'III C' ? 'selected' : '' }}>III C
                                        </option>
                                        <option value="III D" {{ old('kepangkatan') == 'III D' ? 'selected' : '' }}>III D
                                        </option>
                                        <option value="IV A" {{ old('kepangkatan') == 'IV A' ? 'selected' : '' }}>IV A
                                        </option>*
                                        <option value="IV B" {{ old('kepangkatan') == 'IV B' ? 'selected' : '' }}>IV B
                                        </option>
                                        <option value="IV C" {{ old('kepangkatan') == 'IV C' ? 'selected' : '' }}>IV C
                                        </option>
                                        <option value="IV D" {{ old('kepangkatan') == 'IV D' ? 'selected' : '' }}>IV D
                                        </option>
                                        <option value="IV E" {{ old('kepangkatan') == 'IV E' ? 'selected' : '' }}>IV E
                                        </option>
                                    </select>
                                    @error('kepangkatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div class="">
                                        <div class="custom-control custom-radio custom-control-inline pb-0">
                                            <input type="radio" id="male" name="gender" value="Laki-laki"
                                                class="custom-control-input"
                                                {{ old('gender') == 'Laki-laki' ? 'checked' : '' }} />
                                            <label class="custom-control-label" for="male">Pria</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline pb-0">
                                            <input type="radio" id="female" name="gender" value="Perempuan"
                                                class="custom-control-input"
                                                {{ old('gender') == 'Perempuan' ? 'checked' : '' }} />
                                            <label class="custom-control-label" for="female">Wanita</label>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewFile(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function() {
                var previewImage = document.getElementById('preview-image');
                previewImage.src = reader.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    </script>
    <script>
        function updateFileNamePangkat(event) {
            var input = event.target;
            var label = document.getElementById("file-label-pangkat");
            var viewFileLink = document.getElementById("view-file-link-pangkat");

            label.textContent = input.files[0].name;
            viewFileLink.href = URL.createObjectURL(input.files[0]);
            viewFileLink.style.display = "inline";
        }
    </script>
@endsection
