@extends('layouts.admin')
@section('admin')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jquery-dateFormat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Daftar Seminar Tesis 1</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('mahasiswa.seminarta1s2.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Semester</label>
                                    <select name="semester" id="semester"
                                        class="selectpicker form-control @error('semester') form-control-danger @enderror"
                                        data-size="5" name="semester">
                                        <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil
                                        </option>
                                        <option value="Genap" {{ old('semester') == 'Ganjil' ? '' : 'selected' }}>Genap
                                        </option>
                                    </select>
                                    @error('semester')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tahun Akademik</label>
                                    <select id="tahun_akademik"
                                        class="selectpicker form-control @error('tahun_akademik') form-control-danger @enderror"
                                        data-size="5" name="tahun_akademik">
                                    </select>
                                    @error('tahun_akademik')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>SKS</label>
                                    <input autofocus name="sks" id="jumlah_sks"
                                        class="form-control @error('jumlah_sks') form-control-danger @enderror"
                                        type="number" value="{{ old('sks') }}" placeholder="Jumlah SKS Saat Ini">
                                    @error('sks')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>IPK</label>
                                    <input autofocus name="ipk" id="ipk"
                                        class="form-control @error('ipk') form-control-danger @enderror" type="text"
                                        value="{{ old('ipk') }}" placeholder="Contoh : 3.55">
                                    @error('ipk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Rencana Periode Seminar</label>
                                    <input readonly
                                        class="form-control @error('periode_seminar') form-control-danger @enderror month-picker"
                                        type="text" name="periode_seminar" value="{{ old('periode_seminar') }}"
                                        id="periode_seminar" placeholder="Periode Seminar">
                                    @error('periode_seminar')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>TOEFL</label>
                                    <input autofocus name="toefl" id="toefl"
                                        class="form-control @error('toefl') form-control-danger @enderror" type="number"
                                        min="0" value="{{ old('toefl') }}" placeholder="Nilai TOEFL">
                                    @error('toefl')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>
                                        Berkas Kelengkapan
                                        <small>
                                            <a target="_blank"
                                                href="/uploads/syarat_seminar/{{ $syarat->path_file }}">Lihat
                                                Persyaratan</a>
                                        </small>
                                    </label>
                                    <div class="custom-file mb-1">
                                        <label class="custom-file-label" for="link-berkas_seminar_ta_satu"
                                            id="label-berkas_seminar_ta_satu">Pilih File</label>
                                        <input value="{{ old('berkas_seminar_ta_satu') }}" accept=".pdf" autofocus
                                            name="berkas_seminar_ta_satu" id="file-berkas_seminar_ta_satu"
                                            class="custom-file-input form-control @error('berkas_seminar_ta_satu') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file-berkas_seminar_ta_satu','label-berkas_seminar_ta_satu','link-berkas_seminar_ta_satu')">
                                    </div>
                                    <small class="mt-2"> <a id="link-berkas_seminar_ta_satu" href="#"
                                            target="_blank" style="display: none;">Lihat File</a> </small>
                                    @error('berkas_seminar_ta_satu')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- hanya tampil saat mode mobile --}}
                                <div class="form-group" id="form-mobile">
                                    <label>Payung Peneltian</label>
                                    <select name="sumber_penelitian"
                                        class="selectpicker form-control @error('sumber_penelitian') form-control-danger @enderror">
                                        <option value="Dosen" {{ old('sumber_penelitian') == 'Dosen' ? 'selected' : '' }}>
                                            Penelitian Dosen</option>
                                        <option value="Mahasiswa"
                                            {{ old('sumber_penelitian') == 'Mahasiswa' ? 'selected' : '' }}>Non Penelitian
                                            Dosen
                                        </option>
                                    </select>
                                    @error('sumber_penelitian')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" id="form-mobile">
                                    <label>Judul Tesis</label>
                                    <textarea name="judul_ta" id="judul_ta" rows=""
                                        class="form-control @error('judul_ta') form-control-danger @enderror">{{ old('judul_ta') }}</textarea>
                                    @error('judul_ta')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">

                                <div class="form-group">
                                    <label>Pembimbing 1</label>
                                    <select
                                        class="custom-select2 form-control @error('id_pembimbing_1') form-control-danger @enderror"
                                        name="id_pembimbing_1" id="id_pembimbing_1" style="width: 100%; height: 38px">
                                        <optgroup label="Pembimbing 1">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_pembimbing_1') == $item->encrypt_id ? 'selected' : '' }}>
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
                                        onchange="toggleInput(this, 'Pembimbing2', 'pbl2_nama')">
                                        <optgroup label="Pembahas 1">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_pembimbing_2') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                            @if (old('id_pembimbing_2') == 'new' || $errors->has('pbl2_nama'))
                                                <option value="new" selected>Tidak Ada di Daftar Ini</option>
                                            @else
                                                <option value="new">Tidak Ada di Daftar Ini</option>
                                            @endif
                                        </optgroup>
                                    </select>
                                </div>
                                <div id="pbl2_nama"
                                    style="display: {{ old('id_pembimbing_2') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembimbing_2') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>Nama Pembimbing 2</label>
                                        <input autofocus name="pbl2_nama"
                                            class="form-control @error('pbl2_nama') form-control-danger @enderror"
                                            type="text" value="{{ old('pbl2_nama') }}"
                                            placeholder="Masukkan Nama Pembimbing 2">
                                        @error('pbl2_nama')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div id="Pembimbing2"
                                    style="display: {{ old('id_pembimbing_2') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembimbing_2') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>NIP Pembimbing 2</label>
                                        <input autofocus name="pbl2_nip"
                                            class="form-control @error('pbl2_nip') form-control-danger @enderror"
                                            type="text" value="{{ old('pbl2_nip') }}"
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
                                        name="id_pembahas_1" id="id_pembahas_1" style="width: 100%; height: 38px"
                                        onchange="toggleInput(this, 'pembahas1', 'pembahas_external_1')">
                                        <optgroup label="Pembahas 1">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_pembahas_1') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                            @if (old('id_pembahas_1') == 'new' || $errors->has('pembahas_external_1'))
                                                <option value="new" selected>Tidak Ada di Daftar Ini</option>
                                            @else
                                                <option value="new">Tidak Ada di Daftar Ini</option>
                                            @endif
                                        </optgroup>
                                    </select>
                                </div>

                                <div id="pembahas_external_1"
                                    style="display: {{ old('id_pembahas_1') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembahas_1') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>Nama pembahas 1</label>
                                        <input autofocus name="pembahas_external_1"
                                            class="form-control @error('pembahas_external_1') form-control-danger @enderror"
                                            type="text" value="{{ old('pembahas_external_1') }}"
                                            placeholder="Masukkan Nama pembahas 1">
                                        @error('pembahas_external_1')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div id="pembahas1"
                                    style="display: {{ old('id_pembahas_1') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembahas_1') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>NIP pembahas 1</label>
                                        <input autofocus name="nip_pembahas_external_1"
                                            class="form-control @error('nip_pembahas_external_1') form-control-danger @enderror"
                                            type="text" value="{{ old('nip_pembahas_external_1') }}"
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
                                        name="id_pembahas_2" id="id_pembahas_2" style="width: 100%; height: 38px"
                                        onchange="toggleInput(this, 'pembahas2', 'pembahas_external_2')">
                                        <optgroup label="Pembahas 2">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_pembahas_2') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                            @if (old('id_pembahas_2') == 'new' || $errors->has('pembahas_external_2'))
                                                <option value="new" selected>Tidak Ada di Daftar Ini</option>
                                            @else
                                                <option value="new">Tidak Ada di Daftar Ini</option>
                                            @endif
                                        </optgroup>
                                    </select>
                                </div>

                                <div id="pembahas_external_2"
                                    style="display: {{ old('id_pembahas_2') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembahas_2') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>Nama pembahas 2</label>
                                        <input autofocus name="pembahas_external_2"
                                            class="form-control @error('pembahas_external_2') form-control-danger @enderror"
                                            type="text" value="{{ old('pembahas_external_2') }}"
                                            placeholder="Masukkan Nama pembahas 2">
                                        @error('pembahas_external_2')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div id="pembahas2"
                                    style="display: {{ old('id_pembahas_2') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembahas_2') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>NIP pembahas 2</label>
                                        <input autofocus name="nip_pembahas_external_2"
                                            class="form-control @error('nip_pembahas_external_2') form-control-danger @enderror"
                                            type="text" value="{{ old('nip_pembahas_external_2') }}"
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
                                        name="id_pembahas_3" id="id_pembahas_3" style="width: 100%; height: 38px"
                                        onchange="toggleInput(this, 'pembahas3', 'pembahas_external_3')">
                                        <optgroup label="Pembahas 3">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_pembahas_3') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                            @if (old('id_pembahas_3') == 'new' || $errors->has('pembahas_external_3'))
                                                <option value="new" selected>Tidak Ada di Daftar Ini</option>
                                            @else
                                                <option value="new">Tidak Ada di Daftar Ini</option>
                                            @endif
                                        </optgroup>
                                    </select>
                                </div>

                                <div id="pembahas_external_3"
                                    style="display: {{ old('id_pembahas_3') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembahas_3') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>Nama pembahas 3</label>
                                        <input autofocus name="pembahas_external_3"
                                            class="form-control @error('pembahas_external_3') form-control-danger @enderror"
                                            type="text" value="{{ old('pembahas_external_3') }}"
                                            placeholder="Masukkan Nama pembahas 3">
                                        @error('pembahas_external_3')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div id="pembahas3"
                                    style="display: {{ old('id_pembahas_3') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembahas_3') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>NIP pembahas 3</label>
                                        <input autofocus name="nip_pembahas_external_3"
                                            class="form-control @error('nip_pembahas_external_3') form-control-danger @enderror"
                                            type="text" value="{{ old('nip_pembahas_external_3') }}"
                                            placeholder="Masukkan NIP pembahas 3">
                                        @error('nip_pembahas_external_3')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group" id="form-mobile">
                                    <label class="weight-600">Persetujuan</label>
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" class="custom-control-input" name="agreement"
                                            id="agreement" />
                                        <label class="custom-control-label" for="agreement">
                                            Saya dengan ini menyatakan bahwa dokumen kelengkapan berkas yang telah saya
                                            kirimkan semuanya adalah benar dan dapat saya pertanggung-jawabkan. Saya
                                            bersedia menerima sanksi bilamana saya terbukti melakukan pemalsuan dokumen
                                            (seperti tanda tangan, Bukti Bayar UKT, Transkrip/KRS, dll) dengan ditunda
                                            seminar saya minimal 1 semester atau bahkan sanksi yang lebih berat hingga
                                            dikeluarkan (Drop Out).
                                        </label>
                                        @error('agreement')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row d-flex">
                                <div class="col-md-1">
                                    <button type="submit" class="submit btn btn-primary mt-4">Kirim</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="/uploads/syarat_seminar/pengajuan_mutu_tesis.docx"
                                        class="btn btn-info mt-4">Download Syarat Tesis</a>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
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
        @if (old('pembahas_external_1'))
            toggleInput(document.getElementById('id_pembahas_1'), 'pembahas1')
        @endif
    </script>
    <script>
        @if (old('pembahas_external_2'))
            toggleInput(document.getElementById('id_pembahas_2'), 'pembahas2')
        @endif
    </script>
    <script>
        @if (old('pembahas_external_3'))
            toggleInput(document.getElementById('id_pembahas_3'), 'pembahas3')
        @endif
    </script>
    <script>
        @if (old('pbl2_nama'))
            toggleInput(document.getElementById('id_pembimbing_2'), 'Pembimbing2')
        @endif
    </script>
@endsection
