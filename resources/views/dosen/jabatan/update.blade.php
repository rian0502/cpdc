@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Edit Data Jabatan</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('dosen.jabatan.update', $jabatan->encrypted_id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select name="jabatan" id="jabatan" class="selectpicker form-control @error('jabatan') form-control-danger @enderror">
                                        <option value="Tenaga Pengajar" {{ $jabatan->jabatan  == 'Tenaga Pengajar' ? 'selected' : '' }} >Tenaga Pengajar</option>
                                        <option value="Asisten Ahli" {{  $jabatan->jabatan == 'Asisten Ahli' ? 'selected' : '' }} >Asisten Ahli</option>
                                        <option value="Lektor" {{  $jabatan->jabatan  == 'Lektor' ? 'selected' : '' }} >Lektor</option>
                                        <option value="Lektor Kepala" {{  $jabatan->jabatan  == 'Lektor Kepala' ? 'selected' : '' }} >Lektor Kepala</option>
                                        <option value="Guru Besar" {{  $jabatan->jabatan  == 'Guru Besar' ? 'selected' : '' }} >Guru Besar</option>
                                    </select>
                                    @error('jabatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>TANGGAL SK PANGKAT</label>
                                    <input value="{{$jabatan->tgl_sk}}" autofocus name="tanggal_sk" id="tanggal_sk"
                                        class="form-control @error('tanggal_sk') form-control-danger @enderror"
                                        type="date" placeholder="TANGGAL SK">
                                    @error('tanggal_sk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>FILE SK PANGKAT</label>
                                    <div class=" custom-file">
                                        <label class="custom-file-label" for="file_sk">Pilih File</label>

                                        <input value="" autofocus name="file_sk" id="file_sk"
                                            class="custom-file-input form-control @error('file_sk') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK">
                                    </div>
                                    @error('file_sk')
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
