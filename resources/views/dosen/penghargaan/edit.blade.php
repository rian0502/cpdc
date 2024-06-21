@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah Data Penghargaan/Prestasi</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('dosen.penghargaan.update', $penghargaan->encrypt_id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Penghargaan/Prestasi</label>
                                    <input autofocus name="nama" id="nama" value="{{old('nama', $penghargaan->nama)}}"
                                        class="form-control @error('nama') form-control-danger @enderror"
                                        type="text"
                                        placeholder="Nama Penghargaan/Prestasi">
                                    @error('nama')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Scala</label>
                                    <select class="selectpicker form-control @error('scala') form-control-danger @enderror" data-size="5" name="scala">
                                        <option value="Universitas" {{ old('scala', $penghargaan->scala) == 'Universitas' ? 'selected' : '' }}>
                                            Universitas</option>
                                        <option value="Kabupaten/Kota"
                                            {{ old('scala', $penghargaan->scala) == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                                        <option value="Provinsi" {{ old('scala', $penghargaan->scala) == 'Provinsi' ? 'selected' : '' }}>Provinsi
                                        </option>
                                        <option value="Nasional" {{ old('scala', $penghargaan->scala) == 'Nasional' ? 'selected' : '' }}>Nasional
                                        </option>
                                        <option value="Internasional"
                                            {{ old('scala', $penghargaan->scala) == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                    </select>
                                    @error('scala')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>

                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Capaian </label>
                                    <input autofocus name="tanggal" value="{{old('tanggal', $penghargaan->tanggal)}}" id="tanggal"
                                    class="form-control  @error('tanggal') form-control-danger @enderror"
                                    type="date" >
                                    @error('tanggal')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="custom-select2 form-control"style="width: 100%"
                                        name="kategori">
                                        ['Satya Lencana', 'Sertifikat Kompetensi', 'Piagam Penghargaan', 'Narasumber', 'Staff
                                        Ahli', 'Tenaga Ahli/Konsultan', 'Keynote Speaker', 'Invited Speaker', 'Visiting
                                        Lecturer', 'Visiting Researcher', 'Editor/Mitra Bestari']
                                        <optgroup label="Nama Dosen">
                                            <option value="Satya Lencana"
                                                {{ old('kategori', $penghargaan->kategori) == 'Satya Lencana' ? 'selected' : '' }}>Satya Lencana
                                            </option>
                                            <option value="Sertifikat Kompetensi"
                                                {{ old('kategori', $penghargaan->kategori) == 'Sertifikat Kompetensi' ? 'selected' : '' }}>
                                                Sertifikat
                                                Kompetensi</option>
                                            <option value="Piagam Penghargaan"
                                                {{ old('kategori', $penghargaan->kategori) == 'Piagam Penghargaan' ? 'selected' : '' }}>Piagam
                                                Penghargaan</option>
                                            <option value="Narasumber"
                                                {{ old('kategori', $penghargaan->kategori) == 'Narasumber' ? 'selected' : '' }}>
                                                Narasumber</option>
                                            <option value="Staff Ahli"
                                                {{ old('kategori', $penghargaan->kategori) == 'Staff Ahli' ? 'selected' : '' }}>
                                                Staff Ahli</option>
                                            <option value="Tenaga Ahli/Konsultan"
                                                {{ old('kategori', $penghargaan->kategori) == 'Tenaga Ahli/Konsultan' ? 'selected' : '' }}>Tenaga
                                                Ahli/Konsultan</option>
                                            <option value="Keynote Speaker"
                                                {{ old('kategori', $penghargaan->kategori) == 'Keynote Speaker' ? 'selected' : '' }}>Keynote
                                                Speaker
                                            </option>
                                            <option value="Invited Speaker"
                                                {{ old('kategori', $penghargaan->kategori) == 'Invited Speaker' ? 'selected' : '' }}>Invited
                                                Speaker
                                            </option>
                                            <option value="Visiting Lecturer"
                                                {{ old('kategori', $penghargaan->kategori) == 'Visiting Lecturer' ? 'selected' : '' }}>Visiting
                                                Lecturer</option>
                                            <option value="Visiting Researcher"
                                                {{ old('kategori', $penghargaan->kategori) == 'Visiting Researcher' ? 'selected' : '' }}>Visiting
                                                Researcher</option>
                                            <option value="Editor/Mitra Bestari"
                                                {{ old('kategori', $penghargaan->kategori) == 'Editor/Mitra Bestari' ? 'selected' : '' }}>
                                                Editor/Mitra
                                                Bestari</option>

                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Uraian</label>
                                    <textarea class="form-control textarea @error('uraian') form-control-danger @enderror" name="uraian">{{ old('uraian', $penghargaan->uraian) }}</textarea>
                                    @error('uraian')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Link Dokumen</label>
                                    <input value="{{ old('url', $penghargaan->url) }}" autofocus name="url" id="url"
                                        class="form-control @error('url') form-control-danger @enderror" type="text"
                                        placeholder="Link publikasi">
                                    @error('url')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>

                    </form>
                    <a href="{{ route('dosen.penghargaan.index') }}">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->
    </div>
@endsection
