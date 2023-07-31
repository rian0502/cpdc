@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah Publikasi</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('dosen.publikasi.store') }}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input value="{{ old('judul') }}" autofocus name="judul" id="judul"
                                        class="form-control @error('judul') form-control-danger @enderror" type="text"
                                        placeholder="Judul publikasi">
                                    @error('judul')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Publikasi</label>
                                    <input value="{{ old('nama_publikasi') }}" autofocus name="nama_publikasi"
                                        id="nama_publikasi"
                                        class="form-control @error('nama_publikasi') form-control-danger @enderror"
                                        type="text" placeholder="Nama publikasi">
                                    @error('nama_publikasi')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Volume</label>
                                    <input value="{{ old('vol') }}" autofocus name="vol" id="vol"
                                        class="form-control @error('vol') form-control-danger @enderror" type="number"
                                        placeholder="Edisi publikasi">
                                    @error('vol')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Halaman</label>
                                    <input value="{{ old('halaman') }}" autofocus name="halaman" id="halaman"
                                        class="form-control @error('halaman') form-control-danger @enderror" type="text"
                                        placeholder="Jumlah Halaman publikasi">
                                    @error('halaman')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kategori_litabmas">LITABMAS</label>
                                    <select name="kategori_litabmas" id="kategori_litabmas" class="selectpicker form-control">
                                        <option value="Penelitian" {{ old('kategori_litabmas') == 'Penelitian' ? 'selected' : '' }}>
                                            Penelitian</option>
                                        <option value="Pengabdian" {{ old('kategori_litabmas') == 'Pengabdian' ? 'selected' : '' }}>
                                            Pengabdian</option>
                                    </select>
                                    @error('kategori_litabmas')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input value="{{ old('tahun') }}" name="tahun" id="tahun"
                                        class="form-control year-picker @error('tahun') form-control-danger @enderror"
                                        type="number" placeholder="Tahun pelaksanaan">
                                    @error('tahun')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}

                            <div class="kanan weight-500 col-md-6">


                                <div class="form-group">
                                    <label>Link</label>
                                    <input value="{{ old('url') }}" autofocus name="url" id="url"
                                        class="form-control @error('url') form-control-danger @enderror" type="text"
                                        placeholder="Link publikasi">
                                    @error('url')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Skala</label>
                                    <select name="scala" id="scala" class="selectpicker form-control">
                                        <option value="Nasional" {{ old('scala') == 'Nasional' ? 'selected' : '' }}>
                                            Nasional</option>
                                        <option value="Internasional"
                                            {{ old('scala') == 'Internasional' ? 'selected' : '' }}>
                                            Internasional</option>
                                    </select>
                                    @error('scala')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="kategori" id="kategori" class="selectpicker form-control">
                                        <option value="Buku Referensi"
                                            {{ old('kategori') == 'Buku Referensi' ? 'selected' : '' }}>
                                            Buku Referensi</option>
                                        <option value="Monograf" {{ old('kategori') == 'Monograf' ? 'selected' : '' }}>
                                            Monograf</option>
                                        <option value="Buku Nasional"
                                            {{ old('kategori') == 'Buku Nasional' ? 'selected' : '' }}>
                                            Buku Nasional</option>
                                        <option value="Buku Internasional"
                                            {{ old('kategori') == 'Buku Internasional' ? 'selected' : '' }}>
                                            Buku Internasional</option>
                                        <option value="Artikel Internasional Bereputasi"
                                            {{ old('kategori') == 'Artikel Internasional Bereputasi' ? 'selected' : '' }}>
                                            Artikel Internasional Bereputasi</option>
                                        <option value="Artikel Internasional Terindkes"
                                            {{ old('kategori') == 'Artikel Internasional Terindkes' ? 'selected' : '' }}>
                                            Artikel Internasional Terindkes</option>
                                        <option value="Jurnal Nasional Terakreditasi Dikti"
                                            {{ old('kategori') == 'Jurnal Nasional Terakreditasi Dikti' ? 'selected' : '' }}>
                                            Jurnal Nasional Terakreditasi Dikti</option>
                                        <option value="Jurnal Nasional"
                                            {{ old('kategori') == 'Jurnal Nasional' ? 'selected' : '' }}>
                                            Jurnal Nasional</option>
                                        <option value="Jurnal Ilmiah"
                                            {{ old('kategori') == 'Jurnal Ilmiah' ? 'selected' : '' }}>
                                            Jurnal Ilmiah</option>
                                        <option value="Prosiding Internasional Terindeks"
                                            {{ old('kategori') == 'Prosiding Internasional Terindeks' ? 'selected' : '' }}>
                                            Prosiding Internasional Terindeks</option>
                                        <option value="Prosiding Internasional"
                                            {{ old('kategori') == 'Prosiding Internasional' ? 'selected' : '' }}>
                                            Prosiding Internasional</option>
                                        <option value="Prosiding Nasional"
                                            {{ old('kategori') == 'Prosiding Nasional' ? 'selected' : '' }}>
                                            Prosiding Nasional</option>
                                    </select>
                                    @error('kategori')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Anggota</label>
                                    <select class="custom-select2 form-control" multiple="multiple" style="width: 100%"
                                        name="anggota[]">
                                        <optgroup label="Nama Dosen">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ collect(old('anggota'))->contains($item->encrypt_id) ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Anggota External</label>
                                    <textarea value="{{ old('anggota_external') }}" autofocus name="anggota_external" id="anggota_external"
                                    placeholder='contoh: &#10;Dr. John Doe, &#10;Prof. Jane Smith, &#10;Dr. Michael Johnson,'
                                    class="form-control @error('anggota_external') form-control-danger @enderror" type="text"></textarea>
                                    @error('anggota_external')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <a href="{{ route('dosen.publikasi.index') }}">
                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
