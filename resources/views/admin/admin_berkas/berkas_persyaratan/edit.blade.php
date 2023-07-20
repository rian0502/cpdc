@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Edit Berkas Persyaratan</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>

                    </div>
                    <form action="{{ route('berkas.berkas_persyaratan.update', $file->encrypt_id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama File</label>
                                        <input value="{{$file->nama_file}}" autofocus
                                            name="nama_file" readonly
                                            class="form-control @error('nama_file') form-control-danger @enderror"
                                            type="text">

                                    @error('nama_file')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>File Persyaratan<small> <a id="link-file_persyaratan" href="#"
                                        target="_blank" style="display: none;">Lihat File</a> </small></label>
                                    <div class=" custom-file">
                                        <label class="custom-file-label" for="file_persyaratan" id="label-file_persyaratan">Pilih File</label>

                                        <input accept=".pdf" value="{{old('file_persyaratan')}}" autofocus name="file_persyaratan" id="file_persyaratan"
                                            class="custom-file-input form-control @error('file_persyaratan') form-control-danger @enderror"
                                            type="file" placeholder="FILE PERSYARATAN" onchange="updateFileNameAndLink('file_persyaratan','label-file_persyaratan','link-file_persyaratan')">
                                    </div>
                                    @error('file_persyaratan')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}

                        </div>


                        <div class="form-group">

                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>

                    </form>
                    <a href="/admin/berkas/berkas_persyaratan">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
