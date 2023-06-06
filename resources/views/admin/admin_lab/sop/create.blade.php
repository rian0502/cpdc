@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
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
                                    <label>Dokumen SOP</label>
                                    <input value="{{ old('file_sop') }}" autofocus name="file_sop" id="file_sop"
                                        class="form-control @error('file_sop') form-control-danger @enderror" type="file"
                                        placeholder="Dokumen SOP" accept=".pdf">
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
                                    <label>Lokasi Penerapan</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px" name="id_lokasi" required>
                                        @foreach ($locations as $item)
                                            <option value="{{ $item->encrypt_id }}"
                                                {{ old('id_lokasi') == $item->encrypt_id ? 'selected' : '' }}>
                                                {{ $item->nama_lokasi . ', Lt-' . $item->lantai_tingkat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">

                            <button type="submit" class="submit btn btn-primary">Submit</button>
                        </div>

                    </form>
                    <a href="{{ route('lab.sop.index') }}">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
