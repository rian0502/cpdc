@extends('layouts.admin')
@section('admin')
    <link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.css">
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
                            <h4 class="text-dark h4">Edit Profile</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.profile.update', $admin->encrypt_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
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
                                        type="file" placeholder="FOTO PROFILE" onchange="previewFile(event)">
                                </div>
                                <div class="center-div">
                                    @error('foto_profile')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Modal for image cropping -->
                        <div id="imageCropModal" class="modal" tabindex="-1" role="dialog" data-backdrop="static"
                            data-keyboard="false">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Sesuaikan Gambar</h5>
                                        {{-- <button type="button" class="close" data-dismiss="modal" id="closeModalButton"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button> --}}
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <img id="cropperImage" src="" alt="Crop Preview"
                                                style="max-width: 100%;">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" id="cancelButton"
                                            data-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary" id="cropImageBtn"
                                            onclick="cropImage()">Potong</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input value="{{ old('nama_admin', $admin->nama_administrasi) }}" autofocus
                                        name="nama_admin" id="nama"
                                        class="form-control @error('nama_admin') form-control-danger @enderror"
                                        type="text" placeholder="NAMA">
                                    @error('nama_admin')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Induk Pegawai</label>
                                    <input value="{{ old('nip', $admin->nip) }}" autofocus name="nip" id="nip"
                                        class="form-control @error('nip') form-control-danger @enderror" type="number"
                                        placeholder="NIP">
                                    @error('nip')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input value="{{ old('no_hp', $admin->no_hp) }}" autofocus name="no_hp" id="no_hp"
                                        class="form-control @error('no_hp') form-control-danger @enderror" type="number"
                                        placeholder="NO TELPHONE">
                                    @error('no_hp')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input value="{{ old('alamat', $admin->alamat) }}" autofocus name="alamat"
                                        id="alamat" class="form-control @error('alamat') form-control-danger @enderror"
                                        type="text" placeholder="ALAMAT">
                                    @error('alamat')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input value="{{ old('tempat_lahir', $admin->tempat_lahir) }}" autofocus
                                        name="tempat_lahir" id="tempat_lahir"
                                        class="form-control @error('tempat_lahir') form-control-danger @enderror"
                                        type="text" placeholder="TEMPAT LAHIR">
                                    @error('tempat_lahir')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input value="{{ old('tanggal_lahir', $admin->tanggal_lahir) }}" autofocus
                                        name="tanggal_lahir" id="tanggal_lahir"
                                        class="form-control @error('tanggal_lahir') form-control-danger @enderror"
                                        type="date" placeholder="TANGGAL LAHIR">
                                    @error('tanggal_lahir')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div class="">
                                        <div class="custom-control custom-radio custom-control-inline pb-0">
                                            <input type="radio" id="male" name="gender" value="Laki-laki"
                                                class="custom-control-input"
                                                {{ old('gender', $admin->jenis_kelamin) == 'Laki-laki' ? 'checked' : '' }} />
                                            <label class="custom-control-label" for="male">Pria</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline pb-0">
                                            <input type="radio" id="female" name="gender" value="Perempuan"
                                                class="custom-control-input"
                                                {{ old('gender', $admin->jenis_kelamin) == 'Perempuan' ? 'checked' : '' }} />
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
                    <a href="{{ route('admin.profile.index') }}">
                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
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
    <script src="/Assets/admin/src/scripts/croppingImageProfile.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
