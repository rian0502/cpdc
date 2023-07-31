@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Edit Publikasi</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('dosen.publikasi.update', $publikasi->encrypt_id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input value="{{ $publikasi->judul }}" autofocus name="judul" id="judul"
                                        class="form-control @error('judul') form-control-danger @enderror" type="text"
                                        placeholder="Judul publikasi">
                                    @error('judul')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Publikasi</label>
                                    <input value="{{ $publikasi->nama_publikasi }}" autofocus name="nama_publikasi"
                                        id="nama_publikasi"
                                        class="form-control @error('nama_publikasi') form-control-danger @enderror"
                                        type="text" placeholder="nama_publikasi publikasi">
                                    @error('nama_publikasi')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Volume</label>
                                    <input value="{{ $publikasi->vol }}" autofocus name="vol" id="vol"
                                        class="form-control @error('vol') form-control-danger @enderror" type="number"
                                        placeholder="vol publikasi">
                                    @error('vol')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Halaman</label>
                                    <input value="{{ $publikasi->halaman }}" autofocus name="halaman" id="halaman"
                                        class="form-control @error('halaman') form-control-danger @enderror"
                                        type="text" placeholder="Jumlah Halaman Publikasi">
                                    @error('halaman')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kategori_litabmas">LITABMAS</label>
                                    <select name="kategori_litabmas" id="kategori_litabmas" class="selectpicker form-control">
                                        <option value="Penelitian"
                                            {{ $publikasi->kategori_litabmas == 'Penelitian' ? 'selected' : '' }}>
                                            Penelitian</option>
                                        <option value="Pengabdian"
                                            {{ $publikasi->kategori_litabmas == 'Pengabdian' ? 'selected' : '' }}>
                                            Pengabdian</option>
                                    </select>
                                    @error('kategori_litabmas')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input value="{{ $publikasi->tahun }}" autofocus name="tahun" id="tahun"
                                        class="form-control @error('tahun') form-control-danger @enderror" type="year"
                                        placeholder="Tahun pelaksanaan">
                                    @error('tahun')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}

                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Link</label>
                                    <input value="{{ $publikasi->url }}" autofocus name="url" id="url"
                                        class="form-control @error('url') form-control-danger @enderror" type="text"
                                        placeholder="Link publikasi">
                                    @error('url')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Scala</label>
                                    <select name="scala" id="scala" class="selectpicker form-control">
                                        <option value="Nasional" {{ $publikasi->scala == 'Nasional' ? 'selected' : '' }}>
                                            Nasional</option>
                                        <option value="Internasional"
                                            {{ $publikasi->scala == 'Internasional' ? 'selected' : '' }}>
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
                                            {{ $publikasi->kategori == 'Buku Referensi' ? 'selected' : '' }}>
                                            Buku Referensi</option>
                                        <option value="Monograf" {{ $publikasi->kategori == 'Monograf' ? 'selected' : '' }}>
                                            Monograf</option>
                                        <option value="Buku Nasional"
                                            {{ $publikasi->kategori == 'Buku Nasional' ? 'selected' : '' }}>
                                            Buku Nasional</option>
                                        <option value="Buku Internasional"
                                            {{ $publikasi->kategori == 'Buku Internasional' ? 'selected' : '' }}>
                                            Buku Internasional</option>
                                        <option value="Artikel Internasional Bereputasi"
                                            {{ $publikasi->kategori == 'Artikel Internasional Bereputasi' ? 'selected' : '' }}>
                                            ' Internasional Bereputas</option>
                                        <option value="Artikel Internasional Terindkes"
                                            {{ $publikasi->kategori == 'Artikel Internasional Terindkes' ? 'selected' : '' }}>
                                            Artikel Internasional Terindke</option>
                                        <option value="Jurnal Nasional Terakreditasi Dikti"
                                            {{ $publikasi->kategori == 'Jurnal Nasional Terakreditasi Dikti' ? 'selected' : '' }}>
                                            Jurnal Nasional Terakreditasi Dikt</option>
                                        <option value="Jurnal Nasional"
                                            {{ $publikasi->kategori == 'Jurnal Nasional' ? 'selected' : '' }}>
                                            Jurnal Nasional</option>
                                        <option value="Jurnal Ilmiah"
                                            {{ $publikasi->kategori == 'Jurnal Ilmiah' ? 'selected' : '' }}>
                                            Jurnal Ilmiah</option>
                                        <option value="Prosiding Internasional Terindeks"
                                            {{ $publikasi->kategori == 'Prosiding Internasional Terindeks' ? 'selected' : '' }}>
                                            Prosiding Internasional Terindek</option>
                                        <option value="Prosiding Internasional"
                                            {{ $publikasi->kategori == 'Prosiding Internasional' ? 'selected' : '' }}>
                                            Prosiding Internasiona</option>
                                        <option value="Prosiding Nasional"
                                            {{ $publikasi->kategori == 'Prosiding Nasional' ? 'selected' : '' }}>
                                            Prosiding Nasion</option>
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
                                                    {{ in_array($item->id, $anggota) ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Anggota External</label>
                                    <textarea autofocus name="anggota_external" id="anggota_external"
                                    placeholder='contoh: &#10;Dr. John Doe, &#10;Prof. Jane Smith, &#10;Dr. Michael Johnson,'
                                    class="form-control @error('anggota_external') form-control-danger @enderror" type="text">{{ $publikasi->anggota_external }}</textarea>
                                    @error('anggota_external')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
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
