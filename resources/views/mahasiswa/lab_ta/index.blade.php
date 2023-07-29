@extends('layouts.admin')
@section('admin')
    <style>
        .left {
            text-align: left;
        }

        .center {
            text-align: center;
        }

        .centered-text {
            text-align: left;
            display: inline-block;
        }

        a:hover {
            cursor: pointer;
        }

        .right {
            float: right;
        }

        .Valid {
            background-color: #198754;
            color: white;
        }

        .Proses {
            background-color: #0dcaf0;
            color: white;
        }

        .Invalid {
            background-color: #dc3545;
            color: white
        }

        .Failed {
            background-color: black;
            color: white
        }
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jquery-dateFormat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-30">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Daftar Hadir Pengerjaan Tugas Akhir di Laboratorium Utama</h4>
                            <div>Presensi Lab Utama (Peer Group)</div>
                        </div>
                    </div>
                    <div class="jadwal_seminar">
                        <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Tanggal Presensi</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $carbon::parse($lab->tanggal_kegiatan)->format('d F Y')  }} --}}
                                </div>
                                <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $carbon::parse($lab->jam_mulai)->format('H:i') }} WIB --}}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Lokasi Penelitian Utama</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <div>
                                        {{-- {{ $lab_utama->lokasi->nama_lokasi }} --}}
                                    </div>
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Jam Selesai</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $carbon::parse($lab->jam_selesai)->format('H:i') }} WIB --}}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Nama Kegiatan</strong></label>
                                <div class="col" style="display:block;word-wrap:break-word;">
                                    <div>
                                        {{-- {{ $lab->nama_kegiatan }} --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Keterangan</strong></label>
                                <div class="col" style="display:block;word-wrap:break-word;">
                                    <div>
                                        {{-- {{ $lab->keterangan }} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix mb-30 mt-5">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Daftar Hadir Pengerjaan Tugas Akhir di Laboratorium Alternatif</h4>
                            <div>Presensi Lab Alternatif</div>
                        </div>
                    </div>
                    <div class="jadwal_seminar">
                        <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                            <div class="row border-bottom">
                                <label class="col-md-3 bold mt-2"> <strong>Tanggal Presensi</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $carbon::parse($lab->tanggal_kegiatan)->format('d F Y')  }} --}}
                                </div>
                                <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $carbon::parse($lab->jam_mulai)->format('H:i') }} WIB --}}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Lokasi Penelitian Utama</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <div>
                                        {{-- {{ $lab_utama->lokasi->nama_lokasi }} --}}
                                    </div>
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Jam Selesai</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{-- {{ $carbon::parse($lab->jam_selesai)->format('H:i') }} WIB --}}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Nama Kegiatan</strong></label>
                                <div class="col" style="display:block;word-wrap:break-word;">
                                    <div>
                                        {{-- {{ $lab->nama_kegiatan }} --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Keterangan</strong></label>
                                <div class="col" style="display:block;word-wrap:break-word;">
                                    <div>
                                        {{-- {{ $lab->keterangan }} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Pendataan Peer Group Lab</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{-- route('lab.ruang.store') --}}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Lokasi Peer Group</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px"
                                        name="id_lokasi" required>
                                        {{-- @foreach ($lokasi as $item)
                                            <option value="{{ $item->encrypt_id }}"
                                                {{ $user->lokasi_id == $item->id || old('id_lokasi') == $item->encrypt_id ? 'selected' : '' }}>
                                                {{ $item->nama_lokasi }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </div>

                            </div>
                            {{-- form untuk sebelah kanan --}}

                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Presensi Aktivitas Laboratorium Utama (Peer Group)</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{-- route('lab.ruang.store') --}}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Judul Penelitian</label>
                                    <input type="text" value="{{ old('nama_kegiatan') }}"
                                        class="form-control @error('nama_kegiatan') form-control-danger @enderror"
                                        name="nama_kegiatan" placeholder="Nama Kegiatan" />
                                    @error('nama_kegiatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
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

                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Presensi Aktivitas Laboratorium Alternatif</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{-- route('lab.ruang.store') --}}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Judul Penelitian</label>
                                    <input type="text" value="{{ old('nama_kegiatan') }}"
                                        class="form-control @error('nama_kegiatan') form-control-danger @enderror"
                                        name="nama_kegiatan" placeholder="Nama Kegiatan" />
                                    @error('nama_kegiatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
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
                                    <label>Lokasi </label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px"
                                        name="id_lokasi" required>
                                        {{-- @foreach ($lokasi as $item)
                                            <option value="{{ $item->encrypt_id }}"
                                                {{ $user->lokasi_id == $item->id || old('id_lokasi') == $item->encrypt_id ? 'selected' : '' }}>
                                                {{ $item->nama_lokasi }}
                                            </option>
                                        @endforeach --}}
                                    </select>
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

                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Presensi Aktivitas Laboratorium Utama (Peer Group)</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{-- route('lab.ruang.store') --}}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
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

                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Presensi Aktivitas Laboratorium Alternatif</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{-- route('lab.ruang.store') --}}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
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
                                    <label>Lokasi </label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px"
                                        name="id_lokasi" required>
                                        {{-- @foreach ($lokasi as $item)
                                            <option value="{{ $item->encrypt_id }}"
                                                {{ $user->lokasi_id == $item->id || old('id_lokasi') == $item->encrypt_id ? 'selected' : '' }}>
                                                {{ $item->nama_lokasi }}
                                            </option>
                                        @endforeach --}}
                                    </select>
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

                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->
    </div>
@endsection
