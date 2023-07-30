@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah Aktivitas Laboratorium</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('lab.ruang.store') }}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Kegiatan</label>
                                    <input type="text" value="{{ old('nama_kegiatan') }}"
                                        class="form-control @error('nama_kegiatan') form-control-danger @enderror"
                                        name="nama_kegiatan" placeholder="Nama Kegiatan" />
                                    @error('nama_kegiatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Keperluan</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px"
                                        name="keperluan" onchange="toggleDropdown(this, 'anggota_asistensi')">
                                        
                                        <option value="Praktikum"{{ old('keperluan') == 'Praktikum' ? 'selected' : '' }}>
                                            Praktikum</option>
                                        <option value="Ujian" {{ old('keperluan') == 'Ujian' ? 'selected' : '' }}>
                                            Ujian</option>
                                        <option value="PKL" {{ old('keperluan') == 'PKL' ? 'selected' : '' }}>
                                            PKL</option>
                                        <option value="PKM" {{ old('keperluan') == 'PKM' ? 'selected' : '' }}>
                                            PKM</option>
                                        <option value="MBKM" {{ old('keperluan') == 'MBKM' ? 'selected' : '' }}>
                                            MBKM</option>
                                        <option value="Lainnya" {{ old('keperluan') == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control textarea @error('ket') form-control-danger @enderror" name="ket">{{ old('ket') }}</textarea>
                                    @error('ket')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="merek weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Kegiatan</label>
                                    <input type="date" value="{{ old('tanggal_kegiatan') }}"
                                        class="form-control @error('tanggal_kegiatan') form-control-danger @enderror"
                                        name="tanggal_kegiatan" placeholder="Tanggal Pakai" />
                                    @error('tanggal_kegiatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jam Mulai</label>
                                    <input
                                        class="form-control @error('jam_mulai') form-control-danger @enderror"
                                        placeholder="jam" type="time" name="jam_mulai"
                                        value="{{ old('jam_mulai') }}" />
                                    @error('jam_mulai')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jam Selesai</label>
                                    <input
                                        class="form-control @error('jam_selesai') form-control-danger @enderror"
                                        placeholder="jam" type="time" name="jam_selesai"
                                        value="{{ old('jam_selesai') }}" />
                                </div>
                                @error('jam_selesai')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label>Jumlah Peserta</label>
                                    <input class="form-control @error('jumlah_mahasiswa') form-control-danger @enderror"
                                        placeholder="Jumlah Peserta" type="number" name="jumlah_mahasiswa" min="1"
                                        value="{{ old('jumlah_mahasiswa') }}" />
                                </div>
                                @error('jumlah_mahasiswa')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group" id="anggota_asistensi"
                                    style="display: {{ old('keperluan') == 'Praktikum' ? 'block' : 'none' }}"
                                    {{ old('keperluan') == 'Praktikum' ? '' : 'hidden' }}>
                                    <label>Anggota Asistensi</label>
                                    <select
                                        class="custom-select2 form-control @error('anggota_asistensi') form-control-danger @enderror"
                                        multiple="multiple" style="width: 100%" name="anggota_asistensi[]">
                                        <optgroup label="Nama Mahasiswa">
                                            @foreach ($mahasiswa as $item)
                                                <option value="{{ $item->id }}">{{ $item->npm }} -
                                                    {{ $item->nama_mahasiswa }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                @error('anggota_asistensi')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                    </form>
                    <a href="{{ route('lab.ruang.index') }}">
                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
