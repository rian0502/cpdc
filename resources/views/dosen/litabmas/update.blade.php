@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Update LITABMAS</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('dosen.litabmas.update', $litabmas->encrypt_id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama litabmas</label>
                                    <input value="{{ $litabmas->nama_litabmas }}" autofocus name="nama_litabmas"
                                        id="nama_litabmas"
                                        class="form-control @error('nama_litabmas') form-control-danger @enderror"
                                        type="text" placeholder="Nama LITABMAS">
                                    @error('nama_litabmas')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select name="kategori" id="kategori" class="selectpicker form-control">
                                        <option value="Penelitian"
                                            {{ $litabmas->kategori == 'Penelitian' ? 'selected' : '' }}>
                                            Penelitian</option>
                                        <option value="Pengabdian"
                                            {{ $litabmas->kategori == 'Pengabdian' ? 'selected' : '' }}>
                                            Pengabdian</option>
                                    </select>
                                    @error('kategori')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Sumber Dana</label>
                                    <input value="{{ $litabmas->sumber_dana }}" autofocus name="sumber_dana"
                                        id="sumber_dana"
                                        class="form-control @error('sumber_dana') form-control-danger @enderror"
                                        type="text" placeholder="Sumber Dana">
                                    @error('sumber_dana')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Dana</label>
                                    <input value="{{ $litabmas->jumlah_dana }}" autofocus name="jumlah_dana"
                                        id="jumlah_dana"
                                        class="form-control @error('jumlah_dana') form-control-danger @enderror"
                                        type="number" placeholder="jumlah Dana">
                                    @error('jumlah_dana')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tahun Pelaksanaan</label>
                                    <input value="{{ $litabmas->tahun_penelitian }}" autofocus name="tahun_pelaksanaan"
                                        id="tahun_pelaksanaan" min="0"
                                        class="form-control @error('tahun_pelaksanaan') form-control-danger @enderror"
                                        type="year" placeholder="Tahun penelitian">
                                    @error('tahun_pelaksanaan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Link Dokumen</label>
                                    <input value="{{ $litabmas->url }}" autofocus name="url" id="url"
                                        class="form-control @error('url') form-control-danger @enderror" type="text"
                                        placeholder="Link publikasi">
                                    @error('url')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">

                                <div class="form-group">
                                    <label for="anggota">Anggota</label>
                                    <select class="custom-select2 form-control" multiple="multiple" style="width: 100%"
                                        name="anggota[]">
                                        <optgroup label="Nama Dosen">
                                            @foreach ($dosen as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ in_array($item->id, $anggota) ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Dosen Peneliti Lainnya <small>Yang tidak tercantum pada isian
                                            anggota</small></label>
                                    <textarea autofocus name="anggota_external" id="anggota_external"
                                        placeholder='contoh: &#10;Dr. John Doe, &#10;Prof. Jane Smith, &#10;Dr. Michael Johnson,'
                                        class="form-control @error('anggota_external') form-control-danger @enderror" type="text">{{ $litabmas->anggota_external }}</textarea>
                                    @error('anggota_external')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Mahasiswa Peneliti Lainnya <small>Diisikan Mahasiswa S1 atau S2 yang
                                            berkolaborasi</small></label>
                                    <textarea autofocus name="anggota_external" id="anggota_external"
                                        placeholder='Format:&#10;Npm - Nama - Jenjang Studi, &#10;Contoh: &#10;2017051062 - Doe Joe - S1, &#10;2017051033 - Kamal Ramadhan - S2, &#10;2017051024 - Urip Surhajo - S2,'
                                        class="form-control @error('anggota_external') form-control-danger @enderror" type="text">{{ $litabmas->anggota_mahasiswa }}</textarea>
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
                    <a href="{{ route('dosen.litabmas.index') }}">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
