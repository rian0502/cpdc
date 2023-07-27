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
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Buat Profil</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('dosen.profile.store') }}" method="POST" enctype="multipart/form-data">
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
                        <div id="imageCropModal" class="modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Sesuaikan Gambar</h5>
                                        <button type="button" class="close" data-dismiss="modal" id="closeModalButton" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <img id="cropperImage" src="" alt="Crop Preview"
                                                style="max-width: 100%;">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" id="cancelButton" data-dismiss="modal">Batal</button>
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
                                    <input value="{{ old('nama_dosen') }}" autofocus name="nama_dosen" id="nama"
                                        class="form-control @error('nama_dosen') form-control-danger @enderror"
                                        type="text" placeholder="NAMA">
                                    @error('nama_dosen')
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
                                    <label>Nomor Induk Dosen Nasional</label>
                                    <input value="{{ old('nidn') }}" autofocus name="nidn" id="nidn"
                                        class="form-control @error('nidn') form-control-danger @enderror" type="number"
                                        placeholder="NIDN">
                                    @error('nidn')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input value="{{ old('no_hp') }}" autofocus name="no_hp" id="no_hp"
                                        class="form-control @error('no_hp') form-control-danger @enderror" type="number"
                                        placeholder="Nomor Telepon">
                                    @error('no_hp')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input value="{{ old('alamat') }}" autofocus name="alamat" id="alamat"
                                        class="form-control @error('alamat') form-control-danger @enderror" type="text"
                                        placeholder="Alamat">
                                    @error('alamat')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input value="{{ old('tempat_lahir') }}" autofocus name="tempat_lahir"
                                        id="tempat_lahir"
                                        class="form-control @error('tempat_lahir') form-control-danger @enderror"
                                        type="text" placeholder="Tempat Lahir">
                                    @error('tempat_lahir')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input value="{{ old('tanggal_lahir') }}" autofocus name="tanggal_lahir"
                                        id="tanggal_lahir"
                                        class="form-control @error('tanggal_lahir') form-control-danger @enderror"
                                        type="date" placeholder="Tanggal Lahir">
                                    @error('tanggal_lahir')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>

                                    <select name="jabatan" id="jabatan"
                                        class="selectpicker form-control @error('jabatan') form-control-danger @enderror">
                                        <option selected="">Pilih Jabatan</option>
                                        <option value="Asisten Ahli"
                                            {{ old('jabatan') == 'Asisten Ahli' ? 'selected' : '' }}>Asisten Ahli</option>
                                        <option value="Lektor" {{ old('jabatan') == 'Lektor' ? 'selected' : '' }}>Lektor
                                        </option>
                                        <option value="Lektor Kepala"
                                            {{ old('jabatan') == 'Lektor Kepala' ? 'selected' : '' }}>Lektor Kepala
                                        </option>
                                        <option value="Tenaga Pengajar"
                                            {{ old('jabatan') == 'Tenaga Pengajar' ? 'selected' : '' }}>Tenaga Pengajar
                                        </option>
                                        <option value="Guru Besar" {{ old('jabatan') == 'Guru Besar' ? 'selected' : '' }}>
                                            Guru Besar</option>
                                    </select>
                                    @error('jabatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Surat Keputusan Jabatan</label>
                                    <input value="{{ old('tanggal_sk_jabatan') }}" autofocus name="tanggal_sk_jabatan"
                                        id="tanggal_sk_jabatan"
                                        class="form-control @error('tanggal_sk_jabatan') form-control-danger @enderror"
                                        type="date" placeholder="Tanggal Surat Keputusan Jabatan">
                                    @error('tanggal_sk_jabatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>File Surat Keputusan Jabatan<small> <a id="link-file_sk_jabatan" href="#"
                                                target="_blank" style="display: none;">Lihat File</a> </small></label>
                                    <div class=" custom-file">
                                        <label class="custom-file-label" for="file_sk_jabatan"
                                            id="label-file_sk_jabatan">Pilih File</label>

                                        <input value="{{ old('file_sk_jabatan') }}" autofocus name="file_sk_jabatan"
                                            id="file_sk_jabatan"
                                            class="custom-file-input form-control @error('file_sk_jabatan') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file_sk_jabatan','label-file_sk_jabatan','link-file_sk_jabatan')">
                                    </div>
                                    @error('file_sk_jabatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{ Log::error('message') }}
                                <div class="form-group">
                                    <label for="kepangkatan">Pangkat</label>
                                    <select name="kepangkatan" id="kepangkatan"
                                        class="selectpicker form-control @error('kepangkatan') form-control-danger @enderror">
                                        <option selected="">Pilih Pangkat</option>
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
                                    <label>Tanggal Surat Keputusan Pangkat</label>
                                    <input value="{{ old('tanggal_sk_pangkat') }}" autofocus name="tanggal_sk_pangkat"
                                        id="tanggal_sk_pangkat"
                                        class="form-control @error('tanggal_sk_pangkat') form-control-danger @enderror"
                                        type="date" placeholder="Tanggal Surat Keputusan Pangkat">
                                    @error('tanggal_sk_pangkat')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">

                                    <label>File Surat Keputusan Pangkat <small> <a id="view-file-link-pangkat"
                                                href="#" target="_blank" style="display: none;">Lihat File</a>
                                        </small></label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="file_sk_pangkat"
                                            id="file-label-pangkat">Pilih File</label>
                                        <input value="{{ old('file_sk_pangkat') }}" accept=".pdf" autofocus
                                            name="file_sk_pangkat" id="file_sk_pangkat"
                                            class="custom-file-input form-control @error('file_sk_pangkat') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK" onchange="updateFileNamePangkat(event)">
                                    </div>
                                    @error('file_sk_pangkat')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
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
        function updateFileName(event) {
            var input = event.target;
            var label = document.getElementById("file-label");
            var viewFileLink = document.getElementById("view-file-link");

            label.textContent = input.files[0].name;
            viewFileLink.href = URL.createObjectURL(input.files[0]);
            viewFileLink.style.display = "inline";
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
    <script src="/Assets/admin/src/scripts/croppingImageProfile.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
