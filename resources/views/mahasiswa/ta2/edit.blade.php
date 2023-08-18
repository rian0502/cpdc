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
                            <h4 class="text-dark h4">Daftar Seminar Tugas Akhir 2</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('mahasiswa.seminar.tugas_akhir_1.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Semester</label>
                                    <select name="semester" id="semester" class="selectpicker form-control" data-size="5"
                                        name="semester">
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
                                        value="{{ old('sks') }}" placeholder="Jumlah SKS Saat Ini">
                                    @error('sks')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>IPK</label>
                                    <input autofocus name="ipk" id="ipk" class="form-control" type="text"
                                        value="{{ old('ipk') }}" placeholder="Contoh : 3.55">
                                    @error('ipk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Dosen Pembimbing 1</label>
                                    <select class="custom-select2 form-control" name="id_pembimbing_satu"
                                        id="id_pembimbing_satu" style="width: 100%; height: 38px">
                                        <optgroup label="Pembimbing 1">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_pembimbing_satu') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pembimbing 2</label>
                                    <select class="custom-select2 form-control" name="id_pembimbing_dua"
                                        id="id_pembimbing_dua" style="width: 100%; height: 38px"
                                        onchange="toggleInput(this, 'Pembimbing2', 'pbl2_nama')">
                                        <optgroup label="Pembimbing 2">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_pembimbing_dua') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                            @if (old('id_pembimbing_dua') == 'new' || $errors->has('pbl2_nama'))
                                                <option value="new" selected>Tidak Ada di Daftar Ini</option>
                                            @else
                                                <option value="new">Tidak Ada di Daftar Ini</option>
                                            @endif
                                        </optgroup>
                                    </select>
                                </div>
                                <div id="pbl2_nama"
                                    style="display: {{ old('id_pembimbing_dua') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembimbing_dua') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>Nama Pembimbing 2</label>
                                        <input autofocus name="pbl2_nama" class="form-control" type="text"
                                            value="{{ old('pbl2_nama') }}" placeholder="Masukkan Nama Pembimbing 2">
                                        @error('pbl2_nama')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div id="Pembimbing2"
                                    style="display: {{ old('id_pembimbing_dua') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembimbing_dua') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>NIP Pembimbing 2</label>
                                        <input autofocus name="pbl2_nip" class="form-control" type="text"
                                            value="{{ old('pbl2_nip') }}"
                                            placeholder="Masukkan Nomor Karyawan Pembimbing 2">
                                        @error('pbl2_nip')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Pembahas</label>
                                    <select class="custom-select2 form-control" name="pembahas" id="pembahas"
                                        style="width: 100%; height: 38px">
                                        {{-- style="width: 100%; height: 38px" onchange="toggleInput(this, 'Pembahas')"> --}}
                                        <optgroup label="Pembahas">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('pembahas') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}
                                                </option>
                                            @endforeach
                                            {{-- <option value="Tidak Ada di Daftar Ini">Tidak Ada di Daftar Ini</option> --}}
                                        </optgroup>
                                    </select>
                                </div>
                                {{-- fungsi jika tidak ada tersedia nama pembimbing dan pembahas di data diatas --}}

                                <div class="form-group">
                                    <label>Rencana Periode Seminar</label>
                                    <input readonly class="form-control month-picker" type="text" name="periode_seminar"
                                        value="{{ old('periode_seminar') }}" id="periode_seminar"
                                        placeholder="Periode Seminar">
                                    @error('periode_seminar')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>TOEFL</label>
                                    <input autofocus name="toefl" id="toefl" class="form-control" type="number"
                                        min="0" value="{{ old('toefl') }}" placeholder="Nilai TOEFL">
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
                                <div class="form-group" id="form-mobile">
                                    <label>Judul Tugas Akhir</label>
                                    <textarea name="judul_ta" id="judul_ta" rows="" class="form-control">{{ old('judul_ta') }}</textarea>
                                    @error('judul_ta')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
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
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                    </form>
                    <a href="{{ route('mahasiswa.seminar.tugas_akhir_1.index') }}">
                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
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
        @if (old('pbl2_nama'))
            toggleInput(document.getElementById('id_pembimbing_dua'), 'Pembimbing2')
        @endif
    </script>
@endsection
