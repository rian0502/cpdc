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
        .mttesis {
            margin-top: -64px;
            margin-left: 100px;
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
                            <h4 class="text-dark h4" style="margin-left: 10px">Seminar Tesis 2</h4>
                        </div>
                    </div>
                    <div class="pl-3 pr-3 pb-0 mb-2">
                        <form id="formStatus" action="{{ route('koor.arsip.tesis2.update', $seminar->encrypt_id) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="profile-edit-list row">
                                <div class="weight-500 col-md-6">
                                    <div class="form-group">
                                        <label>Semester</label>
                                        <select name="semester" id="semester" class="selectpicker form-control"
                                            data-size="5" name="semester">
                                            <option value="Ganjil"
                                                {{ old('semester', $seminar->semester) == 'Ganjil' ? 'selected' : '' }}>
                                                Ganjil
                                            </option>
                                            <option value="Genap"
                                                {{ old('semester', $seminar->semester) == 'Ganjil' ? '' : 'selected' }}>
                                                Genap
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
                                        <label>Pembimbing 1</label>
                                        <select
                                            class="custom-select2 form-control @error('id_pembimbing_1') form-control-danger @enderror"
                                            name="id_pembimbing_1" style="width: 100%; height: 38px">
                                            <optgroup label="Pembimbing 1">
                                                @foreach ($dosen as $item)
                                                    <option value="{{ $item->encrypt_id }}"
                                                        {{ old('id_pembimbing_1', $seminar->pembimbingSatu->id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_dosen }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Pembimbing 2</label>
                                        <select
                                            class="custom-select2 form-control @error('id_pembimbing_2') form-control-danger @enderror"
                                            name="id_pembimbing_2" id="id_pembimbing_2" style="width: 100%; height: 38px"
                                            onchange="toggleInput(this, 'Pembimbing2', 'pembimbimng_external_2')">
                                            <optgroup label="Pembahas 1">
                                                @foreach ($dosen as $item)
                                                    <option value="{{ $item->encrypt_id }}"
                                                        {{ old('id_pembimbing_2', $seminar->id_pembimbing_2 ?? null) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_dosen }}</option>
                                                @endforeach
                                                @if (in_array(old('id_pembimbing_2', $seminar->id_pembimbing_2), ['new', null]) || $errors->has('pembimbimng_external_2'))
                                                    <option value="new" selected>Tidak Ada di Daftar Ini</option>
                                                @else
                                                    <option value="new">Tidak Ada di Daftar Ini</option>
                                                @endif
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div id="pembimbimng_external_2"
                                        style="display: {{ in_array(old('id_pembimbing_2', $seminar->id_pembimbing_2), ['new', null]) ? 'block' : 'none' }};"
                                        {{ in_array(old('id_pembimbing_2', $seminar->id_pembimbing_2), ['new', null]) ? '' : 'hidden' }}>
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
                                        style="display: {{ in_array(old('id_pembimbing_2', $seminar->id_pembimbing_2 ?? null), ['new', null]) ? 'block' : 'none' }};"
                                        {{ in_array(old('id_pembimbing_2', $seminar->id_pembimbing_2 ?? null), ['new', null]) ? '' : 'hidden' }}>
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
                                        <label>Pembahas 1</label>
                                        <select
                                            class="custom-select2 form-control @error('id_pembahas_1') form-control-danger @enderror"
                                            name="id_pembahas_1" style="width: 100%; height: 38px"
                                            onchange="toggleInput(this, 'pembahas1', 'pembahas_external_1')">
                                            <optgroup label="Pembahas 1">
                                                @foreach ($dosen as $item)
                                                    <option value="{{ $item->encrypt_id }}"
                                                        {{ old('id_pembahas_1', $seminar->pembahasSatu->id ?? null) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_dosen }}</option>
                                                @endforeach
                                                @if (in_array(old('id_pembahas_1', $seminar->pembahasSatu->id ?? null), ['new', null]) ||
                                                        $errors->has('pembahas_external_1'))
                                                    <option value="new" selected>Tidak Ada di Daftar Ini</option>
                                                @else
                                                    <option value="new">Tidak Ada di Daftar Ini</option>
                                                @endif
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div id="pembahas_external_1"
                                        style="display: {{ in_array(old('id_pembahas_1', $seminar->pembahasSatu->id ?? null), ['new', null]) ? 'block' : 'none' }};"
                                        {{ in_array(old('id_pembahas_1', $seminar->pembahasSatu->id ?? null), ['new', null]) ? '' : 'hidden' }}>
                                        <div class="form-group">
                                            <label>Nama pembahas 1</label>
                                            <input autofocus name="pembahas_external_1"
                                                class="form-control @error('pembahas_external_1') form-control-danger @enderror"
                                                type="text"
                                                value="{{ old('pembahas_external_1', $seminar->pembahas_external_1) }}"
                                                placeholder="Masukkan Nama pembahas 1">
                                            @error('pembahas_external_1')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="pembahas1"
                                        style="display: {{ in_array(old('id_pembahas_1', $seminar->pembahasSatu->id ?? null), ['new', null]) ? 'block' : 'none' }};"
                                        {{ in_array(old('id_pembahas_1', $seminar->pembahasSatu->id ?? null), ['new', null]) ? '' : 'hidden' }}>
                                        <div class="form-group">
                                            <label>NIP pembahas 1</label>
                                            <input autofocus name="nip_pembahas_external_1"
                                                class="form-control @error('nip_pembahas_external_1') form-control-danger @enderror"
                                                type="text" type="text"
                                                value="{{ old('nip_pembahas_external_1', $seminar->nip_pembahas_external_1) }}"
                                                placeholder="Masukkan NIP pembahas 1">
                                            @error('nip_pembahas_external_1')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Pembahas 2</label>
                                        <select
                                            class="custom-select2 form-control @error('id_pembahas_2') form-control-danger @enderror"
                                            name="id_pembahas_2" style="width: 100%; height: 38px"
                                            onchange="toggleInput(this, 'pembahas2', 'pembahas_external_2')">
                                            <optgroup label="Pembahas 2">
                                                @foreach ($dosen as $item)
                                                    <option value="{{ $item->encrypt_id }}"
                                                        {{ old('id_pembahas_2', $seminar->pembahasDua->id ?? null) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_dosen }}</option>
                                                @endforeach
                                                @if (in_array(old('id_pembahas_2', $seminar->pembahasDua->id ?? null), ['new', null]) ||
                                                        $errors->has('pembahas_external_2'))
                                                    <option value="new" selected>Tidak Ada di Daftar Ini</option>
                                                @else
                                                    <option value="new">Tidak Ada di Daftar Ini</option>
                                                @endif
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div id="pembahas_external_2"
                                        style="display: {{ in_array(old('id_pembahas_2', $seminar->pembahasDua->id ?? null), ['new', null]) ? 'block' : 'none' }};"
                                        {{ in_array(old('id_pembahas_2', $seminar->pembahasDua->id ?? null), ['new', null]) ? '' : 'hidden' }}>
                                        <div class="form-group">
                                            <label>Nama pembahas 2</label>
                                            <input autofocus name="pembahas_external_2"
                                                class="form-control @error('pembahas_external_2') form-control-danger @enderror"
                                                type="text"
                                                value="{{ old('pembahas_external_2', $seminar->pembahas_external_2) }}"
                                                placeholder="Masukkan Nama pembahas 2">
                                            @error('pembahas_external_2')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="pembahas2"
                                        style="display: {{ in_array(old('id_pembahas_2', $seminar->pembahasDua->id ?? null), ['new', null]) ? 'block' : 'none' }};"
                                        {{ in_array(old('id_pembahas_2', $seminar->pembahasDua->id ?? null), ['new', null]) ? '' : 'hidden' }}>
                                        <div class="form-group">
                                            <label>NIP pembahas 2</label>
                                            <input autofocus name="nip_pembahas_external_2"
                                                class="form-control @error('nip_pembahas_external_2') form-control-danger @enderror"
                                                type="text" type="text"
                                                value="{{ old('nip_pembahas_external_2', $seminar->nip_pembahas_external_2) }}"
                                                placeholder="Masukkan NIP pembahas 2">
                                            @error('nip_pembahas_external_2')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Pembahas 3</label>
                                        <select
                                            class="custom-select2 form-control @error('id_pembahas_3') form-control-danger @enderror"
                                            name="id_pembahas_3" style="width: 100%; height: 38px"
                                            onchange="toggleInput(this, 'pembahas3', 'pembahas_external_3')">
                                            <optgroup label="Pembahas 3">
                                                @foreach ($dosen as $item)
                                                    <option value="{{ $item->encrypt_id }}"
                                                        {{ old('id_pembahas_3', $seminar->pembahasTiga->id?? null) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_dosen }}</option>
                                                @endforeach
                                                @if (in_array(old('id_pembahas_3', $seminar->pembahasTiga->id?? null), ['new', null]) ||
                                                        $errors->has('pembahas_external_3'))
                                                    <option value="new" selected>Tidak Ada di Daftar Ini</option>
                                                @else
                                                    <option value="new">Tidak Ada di Daftar Ini</option>
                                                @endif
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div id="pembahas_external_3"
                                        style="display: {{ in_array(old('id_pembahas_3', $seminar->pembahasTiga->id?? null), ['new', null]) ? 'block' : 'none' }};"
                                        {{ in_array(old('id_pembahas_3', $seminar->pembahasTiga->id?? null), ['new', null]) ? '' : 'hidden' }}>
                                        <div class="form-group">
                                            <label>Nama pembahas 3</label>
                                            <input autofocus name="pembahas_external_3"
                                                class="form-control @error('pembahas_external_3') form-control-danger @enderror"
                                                type="text"
                                                value="{{ old('pembahas_external_3', $seminar->pembahas_external_3) }}"
                                                placeholder="Masukkan Nama pembahas 3">
                                            @error('pembahas_external_3')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="pembahas3"
                                        style="display: {{ in_array(old('id_pembahas_3', $seminar->pembahasTiga->id?? null), ['new', null]) ? 'block' : 'none' }};"
                                        {{ in_array(old('id_pembahas_3', $seminar->pembahasTiga->id?? null), ['new', null]) ? '' : 'hidden' }}>
                                        <div class="form-group">
                                            <label>NIP pembahas 3</label>
                                            <input autofocus name="nip_pembahas_external_3"
                                                class="form-control @error('nip_pembahas_external_3') form-control-danger @enderror"
                                                type="text" type="text"
                                                value="{{ old('nip_pembahas_external_3', $seminar->nip_pembahas_external_3) }}"
                                                placeholder="Masukkan NIP pembahas 3">
                                            @error('nip_pembahas_external_3')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Status Seminar</b></label>
                                        <select name="status_koor" id="status" class="selectpicker form-control"
                                            data-size="5">
                                            <option value="Belum Selesai"
                                                {{ $seminar->status_koor == 'Belum Selesai' ? 'selected' : '' }}>Belum
                                                Selesai
                                            </option>
                                            <option value="Selesai"
                                                {{ $seminar->status_koor == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        @error('status_koor')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><b>Status Administratif</b></label>
                                        <select onchange="toggleCatatan()" name="status_admin" id="status"
                                            class="selectpicker form-control" data-size="5">
                                            <option value="Process"
                                                {{ $seminar->status_admin == 'Process' ? 'selected' : '' }}>
                                                Diproses</option>
                                            <option value="Valid"
                                                {{ $seminar->status_admin == 'Valid' ? 'selected' : '' }}>
                                                Valid</option>
                                            <option value="Invalid"
                                                {{ $seminar->status_admin == 'Invalid' ? 'selected' : '' }}>
                                                Invalid</option>
                                        </select>
                                        @error('status_admin')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @if ($seminar->beritaAcara)
                                        <div class="form-group">
                                            <label>Nilai</label>
                                            <input autofocus name="nilai" id="nilai"
                                                class="form-control @error('nilai') form-control-danger @enderror"
                                                type="text" value="{{ old('nilai', $seminar->beritaAcara->nilai) }}"
                                                placeholder="Contoh : 89.87">
                                            @error('nilai')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Berita Acara Seminar Tugas Akhir 2</label>
                                            <input autofocus name="no_ba" id="no_ba"
                                                class="form-control @error('no_ba') form-control-danger @enderror"
                                                type="text" value="{{ old('no_ba', $seminar->beritaAcara->no_ba) }}"
                                                placeholder="Contoh : 986/UN26.17.03/DT/2022">
                                            @error('no_ba')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Pilih Huruf Mutu</label>
                                            <select
                                                class="custom-select2 form-control @error('nilai_mutu') form-control-danger @enderror"
                                                name="nilai_mutu" style="width: 100%; height: 38px">
                                                <optgroup label="Huruf Mutu">
                                                    <option
                                                        value="A"{{ old('nilai_mutu', $seminar->beritaAcara->nilai_mutu) == 'A' ? 'selected' : '' }}>
                                                        A
                                                    </option>
                                                    <option
                                                        value="A-"{{ old('nilai_mutu', $seminar->beritaAcara->nilai_mutu) == 'A-' ? 'selected' : '' }}>
                                                        A-
                                                    </option>
                                                    <option
                                                        value="AB"{{ old('nilai_mutu', $seminar->beritaAcara->nilai_mutu) == 'AB' ? 'selected' : '' }}B>
                                                        AB
                                                    </option>
                                                    <option
                                                        value="B+"{{ old('nilai_mutu', $seminar->beritaAcara->nilai_mutu) == 'B+' ? 'selected' : '' }}>
                                                        B+
                                                    </option>
                                                    <option
                                                        value="B"{{ old('nilai_mutu', $seminar->beritaAcara->nilai_mutu) == 'B' ? 'selected' : '' }}>
                                                        B
                                                    </option>
                                                    <option
                                                        value="B-"{{ old('nilai_mutu', $seminar->beritaAcara->nilai_mutu) == 'B-' ? 'selected' : '' }}>
                                                        B-
                                                    </option>
                                                    <option
                                                        value="BC"{{ old('nilai_mutu', $seminar->beritaAcara->nilai_mutu) == 'BC' ? 'selected' : '' }}C>
                                                        BC
                                                    </option>
                                                    <option
                                                        value="C+"{{ old('nilai_mutu', $seminar->beritaAcara->nilai_mutu) == 'C+' ? 'selected' : '' }}>
                                                        C+
                                                    </option>
                                                    <option
                                                        value="C"{{ old('nilai_mutu', $seminar->beritaAcara->nilai_mutu) == 'C' ? 'selected' : '' }}>
                                                        C
                                                    </option>
                                                    <option
                                                        value="D"{{ old('nilai_mutu', $seminar->beritaAcara->nilai_mutu) == 'D' ? 'selected' : '' }}>
                                                        D+
                                                    </option>
                                                    <option
                                                        value="E"{{ old('nilai_mutu', $seminar->beritaAcara->nilai_mutu) == 'E' ? 'selected' : '' }}>
                                                        E
                                                    </option>
                                                </optgroup>
                                            </select>
                                            <div class="form-group">
                                                <label> Berkas Berita Acara<small> <a id="link-file_ba" href="#"
                                                            target="_blank" style="display: none;">Lihat File</a>
                                                    </small></label>
                                                <div class="custom-file">
                                                    <label class="custom-file-label" for="link-file_ba"
                                                        id="label-file_ba">Pilih File</label>
                                                    <input value="{{ old('file_ba') }}" accept=".pdf" autofocus
                                                        name="file_ba" id="file-file_ba"
                                                        class="custom-file-input form-control @error('file_ba') form-control-danger @enderror"
                                                        type="file" placeholder="FILE SK"
                                                        onchange="updateFileNameAndLink('file-file_ba','label-file_ba','link-file_ba')">
                                                </div>
                                                @error('file_ba')
                                                    <div class="form-control-feedback has-danger mt-2">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="mt-2"> Berkas Nilai Tesis 1 <small> <a
                                                            id="link-file_nilai" href="#" target="_blank"
                                                            style="display: none;">Lihat File</a>
                                                    </small></label>
                                                <div class="custom-file">
                                                    <label class="custom-file-label" for="link-file_nilai"
                                                        id="label-file_nilai">Pilih
                                                        File</label>
                                                    <input value="{{ old('file_nilai') }}" accept=".pdf" autofocus
                                                        name="file_nilai" id="file-file_nilai"
                                                        class="custom-file-input form-control @error('file_nilai') form-control-danger @enderror"
                                                        type="file" placeholder="FILE SK"
                                                        onchange="updateFileNameAndLink('file-file_nilai','label-file_nilai','link-file_nilai')">
                                                </div>
                                                @error('file_nilai')
                                                    <div class="form-control-feedback has-danger mt-2">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Power Point Bahasa Inggris</label>
                                                <input autofocus name="ppt" id="ppt"
                                                    class="form-control @error('ppt') form-control-danger @enderror"
                                                    type="text" value="{{ old('ppt', $seminar->beritaAcara->ppt) }}"
                                                    placeholder="Link Gdrive / Penyimpanan Cloud Power Point">
                                                @error('ppt')
                                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            @error('nilai_mutu')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif


                                </div>

                                {{-- form untuk sebelah kanan --}}
                                <div class="kanan weight-500 col-md-6">
                                    <div class="form-group">
                                        <label>Rencana Periode Seminar</label>
                                        <input readonly class="form-control month-picker" type="text"
                                            name="periode_seminar"
                                            value="{{ old('periode_seminar', $seminar->periode_seminar) }}"
                                            id="periode_seminar" placeholder="Periode Seminar">
                                        @error('periode_seminar')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if ($seminar->jadwal)


                                        <div class="form-group">
                                            <label>Tanggal Seminar</label>
                                            <input value="{{ $seminar->jadwal->tanggal }}" autofocus name="tanggal"
                                                id="tanggal"
                                                class="form-control @error('tanggal') form-control-danger @enderror"
                                                type="date" placeholder="Nama Barang">
                                            @error('tanggal')
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
                                            <input type="time" value="{{ $seminar->jadwal->jam_mulai }}"
                                                name="jam_mulai"
                                                class="form-control @error('jam_mulai') form-control-danger @enderror">
                                            @error('jam_mulai')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Jam Selesai</label>
                                            <input type="time" name="jam_selesai"
                                                value="{{ $seminar->jadwal->jam_selesai }}"
                                                class="form-control @error('jam_selesai') form-control-danger @enderror">
                                            @error('jam_selesai')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif

                                    {{-- hanya tampil saat mode mobile --}}

                                    {{-- fungsi jika tidak ada tersedia nama pembimbing dan pembahas di data diatas --}}


                                    <div class="form-group">
                                        <label>TOEFL</label>
                                        <input autofocus name="toefl" id="toefl" class="form-control"
                                            type="number" min="0" value="{{ old('toefl', $seminar->toefl) }}"
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
                                            <label class="custom-file-label" for="link-berkas_ta_dua"
                                                id="label-berkas_ta_dua">Pilih File</label>
                                            <input value="{{ old('berkas_ta_dua') }}" accept=".pdf" autofocus
                                                name="berkas_ta_dua" id="file-berkas_ta_dua"
                                                class="custom-file-input form-control @error('berkas_ta_dua') form-control-danger @enderror"
                                                type="file" placeholder="FILE SK"
                                                onchange="updateFileNameAndLink('file-berkas_ta_dua','label-berkas_ta_dua','link-berkas_ta_dua')">
                                        </div>
                                        <small class="mt-2"> <a id="link-berkas_ta_dua" href="#"
                                                target="_blank" style="display: none;">Lihat File</a> </small>
                                        @error('berkas_ta_dua')
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
                                        <label>Keterangan Perbaikan <i><small>Kosongkan apabila data
                                                    sesuai</small></i></label>
                                        <textarea name="komentar" id="komentar" class="form-control" name="komentar">{{ old('komentar', $seminar->komentar) }}</textarea>
                                        @error('komentar')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="submit btn btn-primary mt-4">Kirim</button>
                            </div>
                        </form>
                        <div class="form-group">
                            <a href="{{ route('koor.arsip.tesis2.index') }}">
                                <button class="mttesis btn btn-secondary">Batal</button>
                            </a>
                        </div>
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
        @if (old('pembahas_external_1', $seminar->pembahas_external_1))
            toggleInput(document.getElementById('id_pembahas_satu'), 'pembahas1')
        @endif
    </script>
    <script>
        @if (old('pembahas_external_2', $seminar->pembahas_external_2))
            toggleInput(document.getElementById('id_pembahas_dua'), 'pembahas2')
        @endif
    </script>
    <script>
        @if (old('pembahas_external_3', $seminar->pembahas_external_3))
            toggleInput(document.getElementById('id_pembahas_tiga'), 'pembahas3')
        @endif
    </script>
    <script>
        @if (old('pbl2_nama', $seminar->pbl2_nama))
            toggleInput(document.getElementById('id_pembimbing_2'), 'Pembimbing2')
        @endif
    </script>
