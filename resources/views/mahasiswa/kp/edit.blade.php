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
                            <h4 class="text-dark h4">Daftar Kerja Praktik</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('mahasiswa.seminar.kp.update', $seminar->encrypt_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Mitra</label>
                                    <input autofocus name="mitra" id="mitra" class="form-control" type="text"
                                        placeholder="Nama Mitra PKL/KP" value="{{ $seminar->mitra }}">
                                    @error('mitra')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <select name="semester" id="semester" class="selectpicker form-control" data-size="5">
                                        <option value="Ganjil" {{ $seminar->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil
                                        </option>
                                        <option value="Genap" {{ $seminar->semester == 'Genap' ? 'selected' : '' }}>Genap
                                        </option>
                                    </select>
                                    @error('semester')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>SKS</label>
                                    <input autofocus name="sks" id="sks" class="form-control" type="number"
                                        placeholder="Jumlah SKS" value="{{ $seminar->sks }}">
                                    @error('sks')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tahun Akademik</label>
                                    <select id="tahunAkademik" name="tahun_akademik" class="selectpicker form-control"
                                        data-size="5">
                                    </select>
                                    @error('tahun_akademik')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label></label>
                                    <label>Domisili PKL/KP</label>
                                    <select name="region" id="region" class="selectpicker form-control" data-size="5">
                                        <option value="Unila" {{ $seminar->region = 'Unila' ? 'selected' : '' }}>
                                            Universitas Lampung</option>
                                        <option value="Dalam Lampung"
                                            {{ $seminar->region = 'Dalam Lampung' ? 'selected' : '' }}>Dalam Lampung
                                        </option>
                                        <option value="Luar Lampung"
                                            {{ $seminar->region = 'Luar Lampung' ? 'selected' : '' }}>Luar Lampung</option>
                                    </select>
                                    @error('region')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>IPK</label>
                                    <input autofocus name="ipk" id="ipk" class="form-control" type="text"
                                        placeholder="Nilai IPK" value="{{ old('ipk', $seminar->ipk) }}">
                                    @error('ipk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>
                                        Berkas Kelengkapan
                                        <small></small>
                                        <a target="_blank" href="/uploads/syarat_seminar/{{ $syarat->path_file }}">Lihat
                                            Persyaratan</a>
                                        </small>
                                    </label>
                                    <div class="custom-file mb-1">
                                        <label class="custom-file-label" for="link-berkas_seminar_pkl"
                                            id="label-berkas_seminar_pkl">Pilih File</label>
                                        <input value="{{ old('berkas_seminar_pkl') }}" accept=".pdf" autofocus
                                            name="berkas_seminar_pkl" id="file-berkas_seminar_pkl"
                                            class="custom-file-input form-control @error('berkas_seminar_pkl') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file-berkas_seminar_pkl','label-berkas_seminar_pkl','link-berkas_seminar_pkl')">
                                    </div>
                                    <small class="mt-2"> <a id="link-berkas_seminar_pkl" href="#"
                                            target="_blank" style="display: none;">Lihat File</a> </small>
                                    @error('berkas_seminar_pkl')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Dosen Pembimbing PKL</label>
                                    <select class="custom-select2 form-control" name="id_dospemkp">
                                        <optgroup label="Dosen Pembimbing PKL">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ $seminar->dosen->encrypt_id == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                        </optgroup>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pembimbing Lapangan</label>
                                    <input autofocus name="pembimbing_lapangan" id="pembimbing_lapangan"
                                        class="form-control" type="text" placeholder="Pembimbing Lapangan"
                                        value="{{ $seminar->pembimbing_lapangan }}">
                                    @error('pembimbing_lapangan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Nomor Karyawan / NIP Pembimbing Lapangan</label>
                                    <input autofocus name="ni_pemlap" id="ni_pemlap" class="form-control" type="text"
                                        placeholder="NIP / Nomor Karyawan"value="{{ old('ni_pemlab', $seminar->ni_pemlap) }}">
                                    @error('ni_pemlap')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Rencana Seminar</label>
                                    <input name="rencana_seminar" id="rencana_seminar" autofocus
                                        class="form-control month-picker" type="text" placeholder="Rencana Seminar"
                                        value="{{ old('rencana_seminar', $seminar->rencana_seminar) }}">
                                    @error('rencana_seminar')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>TOEFL
                                        <small>
                                            <em>
                                                Kosongkan Jika Belum Ada
                                            </em>
                                        </small>
                                    </label>
                                    <input autofocus name="toefl" id="toefl" class="form-control" type="number"
                                        placeholder="Nilai TOEFL" value="{{ old('toefl', $seminar->toefl) }}">
                                    @error('toefl')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Judul atau Topik PKL/KP</label>
                                    <textarea id="judul" name="judul" class="form-control">{{ $seminar->judul_kp }}</textarea>
                                    @error('judul')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                <label>
                                    Berkas Kelengkapan
                                    <small></small>
                                        <a target="_blank" href="/uploads/syarat_seminar/{{ $syarat->path_file }}">Lihat
                                            Persyaratan</a>
                                    </small>
                                </label>
                                <div class="custom-file mb-1">
                                    <label class="custom-file-label" for="link-berkas_seminar_pkl"
                                        id="label-berkas_seminar_pkl">Pilih File</label>
                                    <input value="{{ old('berkas_seminar_pkl') }}" accept=".pdf" autofocus
                                        name="berkas_seminar_pkl" id="file-berkas_seminar_pkl"
                                        class="custom-file-input form-control @error('berkas_seminar_pkl') form-control-danger @enderror"
                                        type="file" placeholder="FILE SK"
                                        onchange="updateFileNameAndLink('file-berkas_seminar_pkl','label-berkas_seminar_pkl','link-berkas_seminar_pkl')">
                                </div>
                                <small class="mt-2"> <a id="link-berkas_seminar_pkl" href="#" target="_blank"
                                        style="display: none;">Lihat File</a> </small>
                                @error('berkas_seminar_pkl')
                                    <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                @enderror

                            </div>

                        </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="submit btn btn-primary">Submit</button>
                </div>
                </form>
                <a href="/mahasiswa/seminar/kp">
                    <button class="batal btn btn-secondary">Batal</button>
                </a>
            </div>
        </div>
    </div>
    <!-- Input Validation End -->
    </div>

    <script>
        // Mendapatkan elemen select
        var select = document.getElementById("tahunAkademik");

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
@endsection
