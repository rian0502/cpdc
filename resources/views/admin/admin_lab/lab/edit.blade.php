@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Edit Aktivitas Laboratorium</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('lab.ruang.update', $lab->encrypted_id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Kegiatan</label>
                                    <input value="{{ $lab->nama_kegiatan }}" type="text"
                                        class="form-control @error('nama_kegiatan') form-control-danger @enderror"
                                        name="nama_kegiatan" placeholder="Nama Kegiatan" />
                                    @error('nama_kegiatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Keperluan</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px"
                                        name="keperluan" onchange="toggleDropdown(this, 'anggota_asistensi')"
                                        onload="toggleInput(this, 'anggota_asistensi')">
                                        <option value="Penelitian"
                                            {{ old('keperluan', $lab->keperluan) == 'Penelitian' ? 'selected' : '' }}>
                                            Penelitian</option>
                                        <option
                                            value="Praktikum"{{ old('keperluan', $lab->keperluan) == 'Praktikum' ? 'selected' : '' }}>
                                            Praktikum</option>
                                        <option value="PKL"
                                            {{ old('keperluan', $lab->keperluan) == 'PKL' ? 'selected' : '' }}>
                                            PKL</option>
                                        <option value="PKM"
                                            {{ old('keperluan', $lab->keperluan) == 'PKM' ? 'selected' : '' }}>
                                            PKM</option>
                                        <option value="MBKM"
                                            {{ old('keperluan', $lab->keperluan) == 'MBKM' ? 'selected' : '' }}>
                                            MBKM</option>
                                        <option value="Lainnya"
                                            {{ old('keperluan', $lab->keperluan) == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control textarea @error('ket') form-control-danger @enderror" name="ket">{{ $lab->keterangan }}</textarea>
                                    @error('ket')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="merek weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Kegiatan</label>
                                    <input value="{{ $lab->tanggal_kegiatan }}" type="date"
                                        class="form-control @error('tanggal_kegiatan') form-control-danger @enderror"
                                        name="tanggal_kegiatan" placeholder="Tanggal Pakai" />
                                    @error('tanggal_kegiatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jam Mulai</label>
                                    <input value="{{ $lab->jam_mulai }}"
                                        class="form-control @error('jam_mulai') form-control-danger @enderror"
                                        placeholder="jam" type="time" name="jam_mulai" />
                                    @error('jam_mulai')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jam Selesai</label>
                                    <input value="{{ $lab->jam_selesai }}"
                                        class="form-control @error('jam_selesai') form-control-danger @enderror"
                                        placeholder="jam" type="time" name="jam_selesai" />
                                    @error('jam_selesai')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Peserta</label>
                                    <input class="form-control @error('jumlah_mahasiswa') form-control-danger @enderror"
                                        placeholder="Jumlah Mahasiswa" type="number" name="jumlah_mahasiswa" min="1"
                                        value="{{ $lab->jumlah_mahasiswa }}" />
                                </div>
                                @error('jumlah_mahasiswa')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group" id="anggota_asistensi"
                                    style="display: {{ old('keperluan', $lab->keperluan) == 'Praktikum' ? 'block' : 'none' }}"
                                    {{ old('keperluan', $lab->keperluan) == 'Praktikum' ? '' : 'hidden' }}>
                                    <label>Anggota Asistensi</label>
                                    <select
                                        class="custom-select2 form-control @error('anggota_asistensi') form-control-danger @enderror"
                                        multiple="multiple" style="width: 100%" name="anggota_asistensi[]">
                                        <optgroup label="Nama Mahasiswa">
                                            @foreach ($mahasiswa as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ in_array($item->id, $anggota) ? 'selected' : '' }}>
                                                    {{ $item->nama_mahasiswa }} - {{ $item->npm }} </option>
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
