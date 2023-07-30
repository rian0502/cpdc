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
                @if ($absen || $absen_second)
                    <div class="pd-20 card-box mb-30">
                        @if ($absen)
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
                                            {{ $carbon::parse($absen->tanggal_kegiatan)->format('d F Y') }}
                                        </div>
                                        <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                            {{ $carbon::parse($absen->jam_mulai)->format('H:i') }} WIB
                                        </div>
                                    </div>
                                    <div class="row border-bottom mt-2">
                                        <label class="col-md-3 bold"> <strong>Lokasi Penelitian Utama</strong></label>
                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                            <div>
                                                {{ $absen->lokasi->nama_lokasi }}
                                            </div>
                                        </div>
                                        <label class="col-md-3 bold mt-1"><strong>Jam Selesai</strong></label>
                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                            {{ $carbon::parse($absen->jam_selesai)->format('H:i') }} WIB
                                        </div>
                                    </div>
                                    <div class="row border-bottom mt-2">
                                        <label class="col-md-3 bold"> <strong>Nama Kegiatan</strong></label>
                                        <div class="col" style="display:block;word-wrap:break-word;">
                                            <div>
                                                {{ $absen->nama_kegiatan }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row border-bottom mt-2">
                                        <label class="col-md-3 bold"> <strong>Keterangan</strong></label>
                                        <div class="col" style="display:block;word-wrap:break-word;">
                                            <div>
                                                {{ $absen->keterangan }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($absen_second)
                            <div class="clearfix mb-30 mt-5">
                                <div class="pull-left">
                                    <h4 class="text-dark h4">Daftar Hadir Pengerjaan Tugas Akhir di Laboratorium Alternatif
                                    </h4>
                                    <div>Presensi Lab Alternatif</div>
                                </div>
                            </div>
                            <div class="jadwal_seminar">
                                <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                                    <div class="row border-bottom">

                                        <label class="col-md-3 bold mt-2"> <strong>Tanggal Presensi</strong></label>
                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                            {{ $carbon::parse($absen_second->tanggal_kegiatan)->format('d F Y') }}
                                        </div>
                                        <label class="col-md-3 bold mt-2"><b>Jam Mulai</b></label>
                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                            {{ $carbon::parse($absen_second->jam_mulai)->format('H:i') }} WIB
                                        </div>
                                    </div>
                                    <div class="row border-bottom mt-2">
                                        <label class="col-md-3 bold"> <strong>Lokasi Penelitian Kedua</strong></label>
                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                            <div>
                                                {{ $absen_second->lokasi->nama_lokasi }}
                                            </div>
                                        </div>
                                        <label class="col-md-3 bold mt-1"><strong>Jam Selesai</strong></label>
                                        <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                            {{ $carbon::parse($absen_second->jam_selesai)->format('H:i') }} WIB
                                        </div>
                                    </div>
                                    <div class="row border-bottom mt-2">
                                        <label class="col-md-3 bold"> <strong>Nama Kegiatan</strong></label>
                                        <div class="col" style="display:block;word-wrap:break-word;">
                                            <div>
                                                {{ $absen_second->nama_kegiatan }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row border-bottom mt-2">
                                        <label class="col-md-3 bold"> <strong>Keterangan</strong></label>
                                        <div class="col" style="display:block;word-wrap:break-word;">
                                            <div>
                                                {{ $absen_second->keterangan }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                @if (!Auth::user()->lokasi_id)
                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4 class="text-dark h4">Pendataan Peer Group Lab</h4>
                                <p class="mb-30">Isi data dengan benar</p>
                            </div>
                        </div>
                        <form action="{{ route('mahasiswa.lab.per.group') }}" method="POST">
                            @csrf
                            <div class="profile-edit-list row">
                                {{-- form untuk sebelah kiri --}}
                                <div class="weight-500 col-md-6">
                                    <div class="form-group">
                                        <label>Lokasi Peer Group</label>
                                        <select
                                            class="custom-select2 form-control @error('lokasi_pergroup') form-control-danger @enderror"
                                            name="lokasi_pergroup" style="width: 100%; height: 38px">
                                            @foreach ($lokasi as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_lokasi') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_lokasi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('lokasi_pergroup')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                {{-- form untuk sebelah kanan --}}

                            </div>
                            <div class="form-group">
                                <button type="submit" class="submit btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                @elseif(Auth::user()->mahasiswa->ta_satu->first())
                    @if (!$absen)
                        <div class="pd-20 card-box mb-30">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-dark h4">Presensi Aktivitas Laboratorium Utama (Peer Group)</h4>
                                    <p class="mb-30">Isi data dengan benar</p>
                                </div>
                            </div>
                            <form action="{{ route('mahasiswa.lab.cekin.store') }}" method="POST">
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
                                            <input class="form-control @error('jam_mulai') form-control-danger @enderror"
                                                placeholder="jam" type="time" name="jam_mulai"
                                                value="{{ old('jam_mulai') }}" />
                                            </div>
                                            @error('jam_mulai')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        <div class="form-group">
                                            <label>Jam Selesai</label>
                                            <input class="form-control @error('jam_selesai') form-control-danger @enderror"
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
                    @endif
                    @if (!$absen_second)
                        <div class="pd-20 card-box mb-30">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-dark h4">Presensi Aktivitas Laboratorium Alternatif</h4>
                                    <p class="mb-30">Isi data dengan benar</p>
                                </div>
                            </div>
                            <form action="{{ route('mahasiswa.lab.cekin.alternatif.store') }}" method="POST">
                                @csrf
                                <div class="profile-edit-list row">
                                    {{-- form untuk sebelah kiri --}}
                                    <div class="weight-500 col-md-6">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control textarea @error('ket2') form-control-danger @enderror" name="ket2">{{ old('ket2') }}</textarea>
                                            @error('ket2')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    {{-- form untuk sebelah kanan --}}
                                    <div class="merek weight-500 col-md-6">
                                        <div class="form-group">
                                            <label>Lokasi </label>
                                            <select
                                                class="custom-select2 form-control @error('id_lokasi2') form-control-danger @enderror"
                                                name="id_lokasi2" style="width: 100%; height: 38px">
                                                @foreach ($alternatif as $item)
                                                    <option value="{{ $item->encrypt_id }}"
                                                        {{ $user->lokasi_id == $item->id || old('id_lokasi2') == $item->encrypt_id ? 'selected' : '' }}>
                                                        {{ $item->nama_lokasi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_lokasi2')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Jam Mulai</label>
                                            <input class="form-control @error('jam_mulai2') form-control-danger @enderror"
                                                placeholder="jam" type="time" name="jam_mulai2"
                                                value="{{ old('jam_mulai2') }}" />
                                            </div>
                                            @error('jam_mulai2')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        <div class="form-group">
                                            <label>Jam Selesai</label>
                                            <input class="form-control @error('jam_selesai2') form-control-danger @enderror"
                                                placeholder="jam" type="time" name="jam_selesai2"
                                                value="{{ old('jam_selesai2') }}" />
                                        </div>
                                        @error('jam_selesai2')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="submit btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    @endif
                @else
                    @if (!$absen)
                        <div class="pd-20 card-box mb-30">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-dark h4">Presensi Aktivitas Laboratorium Utama (Peer Group)</h4>
                                    <p class="mb-30">Isi data dengan benar</p>
                                </div>
                            </div>
                            <form action="{{ route('mahasiswa.lab.cekin.belum.ta') }}" method="POST">
                                @csrf
                                <div class="profile-edit-list row">
                                    {{-- form untuk sebelah kiri --}}
                                    <div class="weight-500 col-md-6">
                                        <div class="form-group">
                                            <label>Judul Penelitian</label>
                                            <input type="text" value="{{ old('nama_kegiatan') }}"
                                                class="form-control @error('nama_kegiatan') form-control-danger @enderror"
                                                name="nama_kegiatan" placeholder="Masukkan judul penelitian kamu" />
                                            @error('nama_kegiatan')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea placeholder="Jelaskan apa yang mau kamu lakukan hari ini"
                                                class="form-control textarea @error('ket') form-control-danger @enderror" name="ket">{{ old('ket') }}</textarea>
                                            @error('ket')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- form untuk sebelah kanan --}}
                                    <div class="merek weight-500 col-md-6">

                                        <div class="form-group">
                                            <label>Jam Mulai</label>
                                            <input class="form-control @error('jam_mulai') form-control-danger @enderror"
                                                placeholder="jam" type="time" name="jam_mulai"
                                                value="{{ old('jam_mulai') }}" />
                                            </div>
                                            @error('jam_mulai')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
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
                    @endif

                    @if (!$absen_second)
                        <div class="pd-20 card-box mb-30">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h4 class="text-dark h4">Presensi Aktivitas Laboratorium Alternatif</h4>
                                    <p class="mb-30">Isi data dengan benar</p>
                                </div>
                            </div>
                            <form action="{{ route('mahasiswa.lab.cekin.belum.ta.alternatif') }}" method="POST">
                                @csrf
                                <div class="profile-edit-list row">
                                    {{-- form untuk sebelah kiri --}}
                                    <div class="weight-500 col-md-6">
                                        <div class="form-group">
                                            <label>Judul Penelitian</label>
                                            <input type="text" value="{{ old('nama_kegiatan2') }}"
                                                class="form-control @error('nama_kegiatan2') form-control-danger @enderror"
                                                name="nama_kegiatan2" placeholder="Nama Kegiatan" />
                                            @error('nama_kegiatan2')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control textarea @error('ket2') form-control-danger @enderror" name="ket2">{{ old('ket2') }}</textarea>
                                            @error('ket2')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    {{-- form untuk sebelah kanan --}}
                                    <div class="merek weight-500 col-md-6">
                                        <div class="form-group">
                                            <label>Lokasi </label>
                                            <select
                                                class="custom-select2 form-control @error('id_lokasi2') form-control-danger @enderror"
                                                name="id_lokasi2" style="width: 100%; height: 38px">
                                                @foreach ($alternatif as $item)
                                                    <option value="{{ $item->encrypt_id }}"
                                                        {{ $user->lokasi_id == $item->id || old('id_lokasi2') == $item->encrypt_id ? 'selected' : '' }}>
                                                        {{ $item->nama_lokasi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_lokasi2')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Jam Mulai</label>
                                            <input class="form-control @error('jam_mulai2') form-control-danger @enderror"
                                                placeholder="jam" type="time" name="jam_mulai2"
                                                value="{{ old('jam_mulai2') }}" />
                                            </div>
                                            @error('jam_mulai2')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        <div class="form-group">
                                            <label>Jam Selesai</label>
                                            <input
                                                class="form-control @error('jam_selesai2') form-control-danger @enderror"
                                                placeholder="jam" type="time" name="jam_selesai2"
                                                value="{{ old('jam_selesai2') }}" />
                                        </div>
                                        @error('jam_selesai2')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="submit btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    @endif
                @endif





            </div>
        </div>
        <!-- Input Validation End -->
    </div>
@endsection
