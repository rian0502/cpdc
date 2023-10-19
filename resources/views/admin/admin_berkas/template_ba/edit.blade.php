@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Edit Template Berita Acara</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>

                    </div>
                    <form action="{{ route('berkas.template_seminar.update', $file->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama File</label>
                                    <input value="{{ $file->nama }}" autofocus name="nama" readonly
                                        class="form-control @error('nama') form-control-danger @enderror" type="text">

                                    @error('nama')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>File Persyaratan<small> <a id="link-file_template" href="#" target="_blank"
                                                style="display: none;">Lihat File</a> </small></label>
                                    <div class=" custom-file">
                                        <label class="custom-file-label" for="file_template" id="label-file_template">Pilih
                                            File</label>

                                        <input accept=".docx" value="{{ old('file_template') }}" autofocus
                                            name="file_template" id="file_template"
                                            class="custom-file-input form-control @error('file_template') form-control-danger @enderror"
                                            type="file" placeholder="FILE PERSYARATAN"
                                            onchange="updateFileNameAndLink('file_template','label-file_template','link-file_template')">
                                    </div>
                                    @error('file_template')
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
                    <a href="/admin/berkas/template_seminar">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
