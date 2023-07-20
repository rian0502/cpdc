@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah SOP</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('lab.sop.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Dokumen SOP<small> <a id="link-file_sop" href="#" target="_blank"
                                                style="display: none;">Lihat File</a> </small></label>
                                    <div class=" custom-file">
                                        <label class="custom-file-label" for="file_sop" id="label-file_sop">Pilih
                                            File</label>

                                        <input value="{{ old('file_sop') }}" autofocus name="file_sop" id="file_sop"
                                            accept=".pdf"
                                            class="custom-file-input form-control @error('file_sop') form-control-danger @enderror"
                                            type="file" placeholder="Dokumen SOP"
                                            onchange="updateFileNameAndLink('file_sop','label-file_sop','link-file_sop')">
                                    </div>
                                    @error('file_sop')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama SOP</label>
                                    <input type="text" value="{{ old('nama_sop') }}"
                                        class="form-control @error('nama_sop') form-control-danger @enderror"
                                        name="nama_sop" placeholder="Nama SOP" />
                                    @error('nama_sop')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="merek weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <input type="text" value="{{ $locations->nama_lokasi }}"
                                        class="form-control @error('nama_sop') form-control-danger @enderror" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                    </form>
                    <a href="{{ route('lab.sop.index') }}">
                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
