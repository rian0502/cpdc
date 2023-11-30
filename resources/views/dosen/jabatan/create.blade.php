@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah Data Jabatan</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('dosen.jabatan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>

                                    <select name="jaban" id="jabatan"
                                        class="selectpicker form-control @error('jabatan') form-control-danger @enderror">
                                        <option selected="">Pilih Jabatan</option>
                                        <option value="Tenaga Pengajar"
                                            {{ old('jabatan') == 'Tenaga Pengajar' ? 'selected' : '' }}>Tenaga Pengajar
                                        </option>
                                        <option value="Asisten Ahli"
                                            {{ old('jabatan') == 'Asisten Ahli' ? 'selected' : '' }}>Asisten Ahli</option>
                                        <option value="Lektor" {{ old('jabatan') == 'Lektor' ? 'selected' : '' }}>Lektor
                                        </option>
                                        <option value="Lektor Kepala"
                                            {{ old('jabatan') == 'Lektor Kepala' ? 'selected' : '' }}>Lektor Kepala</option>
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
                                        type="date" placeholder="TANGGAL SK">
                                    @error('tanggal_sk_jabatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>File Surat Keputusan Jabatan <small> <a id="link-file_sk_jabatan" href="#"
                                        target="_blank" style="display: none;">Lihat File</a> </small></label>
                                    <div class=" custom-file">
                                        <label class="custom-file-label" for="file_sk_jabatan" id="label-file_sk_jabatan">Pilih File</label>

                                        <input accept=".pdf" value="{{old('file_sk_jabatan')}}" autofocus name="file_sk_jabatan" id="file_sk_jabatan"
                                            class="custom-file-input form-control @error('file_sk_jabatan') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK" onchange="updateFileNameAndLink('file_sk_jabatan','label-file_sk_jabatan','link-file_sk_jabatan')">
                                    </div>
                                    @error('file_sk_jabatan')
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
        <!-- Input Validation End -->


    </div>
@endsection
