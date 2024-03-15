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
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jquery-dateFormat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

            <div class="min-height-200px">

                <!-- Data Registrasi Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix" style="margin-bottom: 50px; margin-top: 10px;">
                        <div class="pull-left">
                            <h4 class="text-dark h4" style="margin-left: 10px">Seminar TA 1 S1 </h4>
                        </div>
                    </div>
                    <div class="pl-3 pr-3 pb-0 mb-2">
                        <form id="formStatus" action="{{ route('koor.arsip.ta1.update', $seminar->encrypt_id) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="profile-edit-list row">
                                <div class="weight-500 col-md-6">
                                    <div class="form-group">
                                        <label>Semester</label>
                                        <select name="semester" id="semester" class="selectpicker form-control" data-size="5"
                                            name="semester">
                                            <option value="Ganjil"
                                                {{ old('semester', $seminar->semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil
                                            </option>
                                            <option value="Genap"
                                                {{ old('semester', $seminar->semester) == 'Ganjil' ? '' : 'selected' }}>Genap
                                            </option>
                                        </select>
                                        @error('semester')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Akademik</label>
                                        <select id="tahun_akademik" class="selectpicker form-control" data-size="5"
                                            name="tahun_akademik">
                                        </select>
                                        @error('tahun_akademik')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>SKS</label>
                                        <input autofocus name="sks" id="jumlah_sks" class="form-control" type="number"
                                            value="{{ old('sks', $seminar->sks) }}" placeholder="Jumlah SKS Saat Ini">
                                        @error('sks')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>IPK</label>
                                        <input autofocus name="ipk" id="ipk" class="form-control" type="text"
                                            value="{{ old('ipk', $seminar->ipk) }}" placeholder="Nilai IPK Saat Ini">
                                        @error('ipk')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Dosen Pembimbing 1</label>
                                        <select class="custom-select2 form-control" name="id_pembimbing_satu"
                                            id="id_pembimbing_satu" style="width: 100%; height: 38px">
                                            <optgroup label="Pembimbing 1">
                                                @foreach ($dosen as $item)
                                                    <option value="{{ $item->encrypt_id }}"
                                                        {{ old('id_pembimbing_satu', $seminar->pembimbing_satu->encrypt_id) == $item->encrypt_id ? 'selected' : '' }}>
                                                        {{ $item->nama_dosen }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pembimbing 2</label>
                                        <select
                                            class="custom-select2 form-control @error('id_pembimbing_dua') form-control-danger @enderror"
                                            name="id_pembimbing_dua" id="id_pembimbing_dua" style="width: 100%; height: 38px"
                                            onchange="toggleInput(this, 'Pembimbing2', 'pbl2_nama')">
                                            <optgroup label="Pembimbing 2">
                                                @foreach ($dosen as $item)
                                                    <option value="{{ $item->encrypt_id }}"
                                                        {{ old('id_pembimbing_dua', $seminar->pembimbing_dua->encrypt_id ?? null) == $item->encrypt_id ? 'selected' : '' }}>
                                                        {{ $item->nama_dosen }}</option>
                                                @endforeach
                                                @if (in_array(old('id_pembimbing_dua', $seminar->id_pembimbing_dua), ['new', null]) ||
                                                        $errors->has('pbl2_nama'))
                                                    <option value="new" selected>Tidak Ada di Daftar Ini</option>
                                                @else
                                                    <option value="new">Tidak Ada di Daftar Ini</option>
                                                @endif
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div id="pbl2_nama"
                                        style="display: {{ in_array(old('id_pembimbing_dua', $seminar->id_pembimbing_dua), ['new', null]) ? 'block' : 'none' }};"
                                        {{ in_array(old('id_pembimbing_dua', $seminar->id_pembimbing_dua), ['new', null]) ? '' : 'hidden' }}>
                                        <div class="form-group">
                                            <label>Nama Pembimbing 2</label>
                                            <input autofocus name="pbl2_nama"
                                                class="form-control @error('pbl2_nama') form-control-danger @enderror"
                                                type="text" value="{{ old('pbl2_nama', $seminar->pbl2_nama) }}"
                                                placeholder="Masukkan Nama Pembimbing 2">
                                            @error('pbl2_nama')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="Pembimbing2"
                                        style="display: {{ in_array(old('id_pembimbing_dua', $seminar->id_pembimbing_dua ?? null), ['new', null]) ? 'block' : 'none' }};"
                                        {{ in_array(old('id_pembimbing_dua', $seminar->id_pembimbing_dua ?? null), ['new', null]) ? '' : 'hidden' }}>
                                        <div class="form-group">
                                            <label>NIP Pembimbing 2</label>
                                            <input autofocus name="pbl2_nip"
                                                class="form-control @error('pbl2_nip') form-control-danger @enderror"
                                                type="text" value="{{ old('pbl2_nip', $seminar->pbl2_nip) }}"
                                                placeholder="Masukkan NIP Pembimbing 2">
                                            @error('pbl2_nip')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Pembahas</label>
                                        <select class="custom-select2 form-control" name="id_pembahas" id="id_pembahas"
                                            style="width: 100%; height: 38px">
                                            {{-- style="width: 100%; height: 38px" onchange="toggleInput(this, 'Pembahas')"> --}}
                                            <optgroup label="id_pembahas">
                                                @foreach ($dosen as $item)
                                                    <option value="{{ $item->encrypt_id }}"
                                                        {{ old('pembahas', $seminar->pembahas->encrypt_id) == $item->encrypt_id ? 'selected' : '' }}>
                                                        {{ $item->nama_dosen }}
                                                    </option>
                                                @endforeach
                                                {{-- <option value="Tidak Ada di Daftar Ini">Tidak Ada di Daftar Ini</option> --}}
                                            </optgroup>
                                        </select>
                                        @error('id_pembahas')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>

                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><b>Status Seminar</b></label>
                                        <select name="status_koor" id="status" class="selectpicker form-control"
                                            data-size="5">
                                            <option value="Belum Selesai"
                                                {{$seminar->status_koor == 'Belum Selesai' ? 'selected' : '' }}>Belum
                                                Selesai
                                            </option>
                                            <option value="Selesai"
                                                {{$seminar->status_koor == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        @error('status_koor')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><b>Status Administratif</b></label>
                                        <select onchange="toggleCatatan()" name="status_admin" id="status"
                                            class="selectpicker form-control" data-size="5">
                                            <option value="Process" {{$seminar->status_admin == 'Process' ? 'selected' : '' }}>
                                                Diproses</option>
                                            <option value="Valid" {{$seminar->status_admin == 'Valid' ? 'selected' : '' }}>
                                                Valid</option>
                                            <option value="Invalid" {{$seminar->status_admin == 'Invalid' ? 'selected' : '' }}>
                                                Invalid</option>
                                        </select>
                                        @error('status_admin')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @if ($seminar->ba_seminar)


                                    <div class="form-group">
                                        <label>Nilai</label>
                                        <input autofocus name="nilai" id="nilai" class="form-control @error('nilai') form-control-danger @enderror" type="text"
                                            value="{{ old('nilai', $seminar->ba_seminar->nilai) }}" placeholder="Contoh : 89.87">
                                        @error('nilai')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Berita Acara Seminar Tugas Akhir 1</label>
                                        <input autofocus name="no_berkas_ba_seminar_ta_satu" id="no_berkas_ba_seminar_ta_satu"
                                            class="form-control @error('no_berkas_ba_seminar_ta_satu') form-control-danger @enderror" type="text"
                                            value="{{ old('no_berkas_ba_seminar_ta_satu', $seminar->ba_seminar->no_berkas_ba_seminar_ta_satu) }}"
                                            placeholder="Contoh : 986/UN26.17.03/DT/2022">
                                        @error('no_berkas_ba_seminar_ta_satu')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Pilih Huruf Mutu</label>
                                        <select class="custom-select2 form-control @error('huruf_mutu') form-control-danger @enderror" name="huruf_mutu"
                                            style="width: 100%; height: 38px">
                                            <optgroup label="Huruf Mutu">
                                                <option
                                                    value="A"{{ old('huruf_mutu', $seminar->ba_seminar->huruf_mutu) == 'A' ? 'selected' : '' }}>
                                                    A
                                                </option>
                                                <option
                                                    value="A-"{{ old('huruf_mutu', $seminar->ba_seminar->huruf_mutu) == 'A-' ? 'selected' : '' }}>
                                                    A-
                                                </option>
                                                <option
                                                    value="AB"{{ old('huruf_mutu', $seminar->ba_seminar->huruf_mutu) == 'AB' ? 'selected' : '' }}B>
                                                    AB
                                                </option>
                                                <option
                                                    value="B+"{{ old('huruf_mutu', $seminar->ba_seminar->huruf_mutu) == 'B+' ? 'selected' : '' }}>
                                                    B+
                                                </option>
                                                <option
                                                    value="B"{{ old('huruf_mutu', $seminar->ba_seminar->huruf_mutu) == 'B' ? 'selected' : '' }}>
                                                    B
                                                </option>
                                                <option
                                                    value="B-"{{ old('huruf_mutu', $seminar->ba_seminar->huruf_mutu) == 'B-' ? 'selected' : '' }}>
                                                    B-
                                                </option>
                                                <option
                                                    value="BC"{{ old('huruf_mutu', $seminar->ba_seminar->huruf_mutu) == 'BC' ? 'selected' : '' }}C>
                                                    BC
                                                </option>
                                                <option
                                                    value="C+"{{ old('huruf_mutu', $seminar->ba_seminar->huruf_mutu) == 'C+' ? 'selected' : '' }}>
                                                    C+
                                                </option>
                                                <option
                                                    value="C"{{ old('huruf_mutu', $seminar->ba_seminar->huruf_mutu) == 'C' ? 'selected' : '' }}>
                                                    C
                                                </option>
                                                <option
                                                    value="D"{{ old('huruf_mutu', $seminar->ba_seminar->huruf_mutu) == 'D' ? 'selected' : '' }}>
                                                    D+
                                                </option>
                                                <option
                                                    value="E"{{ old('huruf_mutu', $seminar->ba_seminar->huruf_mutu) == 'E' ? 'selected' : '' }}>
                                                    E
                                                </option>
                                            </optgroup>
                                        </select>
                                        <div class="form-group">
                                            <label> Berkas Berita Acara<small> <a id="link-berkas_ba_seminar_ta_satu" href="#"
                                                        target="_blank" style="display: none;">Lihat File</a> </small></label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="link-berkas_ba_seminar_ta_satu"
                                                    id="label-berkas_ba_seminar_ta_satu">Pilih File</label>
                                                <input value="{{ old('berkas_ba_seminar_ta_satu') }}" accept=".pdf" autofocus
                                                    name="berkas_ba_seminar_ta_satu" id="file-berkas_ba_seminar_ta_satu"
                                                    class="custom-file-input form-control @error('berkas_ba_seminar_ta_satu') form-control-danger @enderror"
                                                    type="file" placeholder="FILE SK"
                                                    onchange="updateFileNameAndLink('file-berkas_ba_seminar_ta_satu','label-berkas_ba_seminar_ta_satu','link-berkas_ba_seminar_ta_satu')">
                                            </div>
                                            @error('berkas_ba_seminar_ta_satu')
                                                <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="mt-2"> Berkas Nilai Tugas Akhir 1 <small> <a
                                                        id="link-berkas_nilai_seminar_ta_satu" href="#" target="_blank"
                                                        style="display: none;">Lihat File</a>
                                                </small></label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="link-berkas_nilai_seminar_ta_satu"
                                                    id="label-berkas_nilai_seminar_ta_satu">Pilih
                                                    File</label>
                                                <input value="{{ old('berkas_nilai_seminar_ta_satu') }}" accept=".pdf" autofocus
                                                    name="berkas_nilai_seminar_ta_satu" id="file-berkas_nilai_seminar_ta_satu"
                                                    class="custom-file-input form-control @error('berkas_nilai_seminar_ta_satu') form-control-danger @enderror"
                                                    type="file" placeholder="FILE SK"
                                                    onchange="updateFileNameAndLink('file-berkas_nilai_seminar_ta_satu','label-berkas_nilai_seminar_ta_satu','link-berkas_nilai_seminar_ta_satu')">
                                            </div>
                                            @error('berkas_nilai_seminar_ta_satu')
                                                <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Power Point Bahasa Inggris</label>
                                            <input autofocus name="berkas_ppt_seminar_ta_satu" id="berkas_ppt_seminar_ta_satu"
                                                class="form-control @error('berkas_ppt_seminar_ta_satu') form-control-danger @enderror" type="text"
                                                value="{{ old('berkas_ppt_seminar_ta_satu', $seminar->ba_seminar->berkas_ppt_seminar_ta_satu) }}"
                                                placeholder="Link Gdrive / Penyimpanan Cloud Power Point">
                                            @error('berkas_ppt_seminar_ta_satu')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @error('huruf_mutu')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @endif


                                </div>

                                {{-- form untuk sebelah kanan --}}
                                <div class="kanan weight-500 col-md-6">
                                    <div class="form-group">
                                        <label>Rencana Periode Seminar</label>
                                        <input readonly class="form-control month-picker" type="text" name="periode_seminar"
                                            value="{{ old('periode_seminar', $seminar->periode_seminar) }}"
                                            id="periode_seminar" placeholder="Periode Seminar">
                                        @error('periode_seminar')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if ($seminar->jadwal)


                                        <div class="form-group">
                                            <label>Tanggal Seminar</label>
                                            <input value="{{ $seminar->jadwal->tanggal_seminar_ta_satu }}" autofocus name="tanggal_seminar_ta_satu"
                                                id="tanggal_seminar_ta_satu"
                                                class="form-control @error('tanggal_seminar_ta_satu') form-control-danger @enderror"
                                                type="date" placeholder="Nama Barang">
                                            @error('tanggal_seminar_ta_satu')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select class="custom-select2 form-control" style="width: 100%; height: 38px"
                                                name="id_lokasi" required>
                                                @foreach ($lokasi as $item)
                                                    <option value="{{ $item->encrypt_id }}"
                                                        {{ $seminar->jadwal->id_lokasi == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_lokasi . ', LT-' . $item->lantai_tingkat }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    {{-- form untuk sebelah kanan --}}

                                        <div class="form-group">
                                            <label>Jam Mulai</label>
                                            <input type="time" value="{{ $seminar->jadwal->jam_mulai_seminar_ta_satu }}"
                                                name="jam_mulai_seminar_ta_satu"
                                                class="form-control @error('jam_mulai_seminar_ta_satu') form-control-danger @enderror">
                                            @error('jam_mulai_seminar_ta_satu')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Jam Selesai</label>
                                            <input type="time" name="jam_selesai_seminar_ta_satu"
                                                value="{{ $seminar->jadwal->jam_selesai_seminar_ta_satu }}"
                                                class="form-control @error('jam_selesai_seminar_ta_satu') form-control-danger @enderror">
                                            @error('jam_selesai_seminar_ta_satu')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @endif

                                    {{-- hanya tampil saat mode mobile --}}

                                    {{-- fungsi jika tidak ada tersedia nama pembimbing dan pembahas di data diatas --}}


                                    <div class="form-group">
                                        <label>TOEFL</label>
                                        <input autofocus name="toefl" id="toefl" class="form-control" type="number"
                                            min="0" value="{{ old('toefl', $seminar->toefl) }}"
                                            placeholder="Nilai TOEFL">
                                        @error('toefl')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Berkas Kelengkapan
                                            <small>
                                                <a target="_blank" href="/uploads/syarat_seminar/">Lihat
                                                    Persyaratan</a>
                                            </small>
                                        </label>
                                        <div class="custom-file mb-1">
                                            <label class="custom-file-label" for="link-berkas_ta_satu"
                                                id="label-berkas_ta_satu">Pilih File</label>
                                            <input value="{{ old('berkas_ta_satu') }}" accept=".pdf" autofocus
                                                name="berkas_ta_satu" id="file-berkas_ta_satu"
                                                class="custom-file-input form-control @error('berkas_ta_satu') form-control-danger @enderror"
                                                type="file" placeholder="FILE SK"
                                                onchange="updateFileNameAndLink('file-berkas_ta_satu','label-berkas_ta_satu','link-berkas_ta_satu')">
                                        </div>
                                        <small class="mt-2"> <a id="link-berkas_ta_satu" href="#"
                                                target="_blank" style="display: none;">Lihat File</a> </small>
                                        @error('berkas_ta_satu')
                                            <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- hanya tampil saat mode mobile --}}
                                    <div class="form-group" id="form-mobile">
                                        <label>Payung Penelitian</label>
                                        <select name="sumber_penelitian"
                                            class="selectpicker form-control @error('sumber_penelitian') form-control-danger @enderror">
                                            <option value="Dosen"
                                                {{ old('sumber_penelitian', $seminar->sumber_penelitian) == 'Dosen' ? 'selected' : '' }}>
                                                Penelitian Dosen</option>
                                            <option value="Mahasiswa"
                                                {{ old('sumber_penelitian', $seminar->sumber_penelitian) == 'Mahasiswa' ? 'selected' : '' }}>
                                                Non Penelitian Dosen</option>
                                        </select>
                                        @error('sumber_penelitian')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group" id="form-mobile">
                                        <label>Judul Tugas Akhir</label>
                                        <textarea name="judul_ta" id="judul_ta" rows="" class="form-control">{{ old('judul_ta', $seminar->judul_ta) }}</textarea>
                                        @error('judul_ta')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group" id="form-mobile">
                                        <label>Keterangan Perbaikan <i><small>Kosongkan apabila data sesuai</small></i></label>
                                        <textarea name="komentar" id="komentar" class="form-control" name="komentar">{{ old('komentar', $seminar->komentar) }}</textarea>
                                        @error('komentar')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <button id="submitButton" type="submit" class="submit btn btn-primary">Kirim</button>
                            </div>
                        </form>
                        <a href="{{ route('koor.arsip.ta1.index') }}">
                            <button class="batal btn btn-secondary">Batal</button>
                        </a>
                    </div>
                </div>
                <!-- Data Registrasi End -->

            </div>
        </div>
        <!-- Input Validation End -->
    </div>

    <script>
        // Mendapatkan elemen select
        var select = document.getElementById("tahun_akademik");

        // Mendapatkan tahun saat ini
        var tahunSekarang = new Date().getFullYear();

        // Loop untuk menghasilkan 5 tahun ke belakang
        for (var i = 0; i < 5; i++) {
            var tahun = tahunSekarang - i;
            var option = document.createElement("option");
            option.value = tahun + "/" + (tahun + 1);
            option.text = tahun + "/" + (tahun + 1);
            select.add(option);
        }
    </script>
    <script>
        @if (old('pbl2_nama', $seminar->pbl2_nama))
            toggleInput(document.getElementById('id_pembimbing_dua'), 'Pembimbing2')
        @endif
    </script>
@endsection
