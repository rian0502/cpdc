@extends('layouts.admin')
@section('admin')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jquery-dateFormat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

    <style>

        @keyframes pulseAnimation {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .btn-pulse {
            animation: pulseAnimation 0.5s ease-in-out;
        }
    </style>

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
                    <form id="formStatus" action="{{ route('mahasiswa.seminar.kp.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Mitra</label>
                                    <input autofocus name="mitra" value="{{ old('mitra') }}"
                                        id="mitra" class="form-control" type="text" placeholder="Nama Mitra PKL/KP">
                                    @error('mitra')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Semester</label>
                                    <select name="semester" id="semester" class="selectpicker form-control" data-size="5"
                                        name="semester">
                                        <option value="Ganjil"
                                            {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil
                                        </option>
                                        <option value="Genap"
                                            {{ old('semester') == 'Ganjil' ? '' : 'selected' }}>Genap
                                        </option>
                                    </select>
                                    @error('semester')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Tahun Akademik</label>
                                    <select id="tahunAkademik" class="selectpicker form-control" data-size="5"
                                        name="tahun_akademik">
                                    </select>
                                    @error('tahun_akademik')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Domisili PKL/KP</label>
                                    <select id="region" class="selectpicker form-control" data-size="5" name="region">
                                        <option value="Unila"
                                            {{ old('region') == 'Unila' ? 'selected' : '' }}>Universitas
                                            Lampung</option>
                                        <option value="Dalam Lampung"
                                            {{ old('region') == 'Dalam Lampung' ? 'selected' : '' }}>Dalam
                                            Lampung</option>
                                        <option value="Luar Lampung"
                                            {{ old('region') == 'Luar Lampung' ? 'selected' : '' }}>Luar
                                            Lampung</option>
                                    </select>
                                    @error('region')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>SKS</label>
                                    <input autofocus name="sks" value="{{ old('sks') }}" id="jumlah_sks"
                                        class="form-control" type="number" value="{{ old('sks') }}"
                                        placeholder="Jumlah SKS">
                                    @error('sks')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>TOEFL
                                        <small>
                                            <em>
                                                Jika belum ada Ketik 0
                                            </em>
                                        </small>
                                    </label>
                                    <input autofocus name="toefl" id="toefl" class="form-control" type="number"
                                        min="0" value="{{ old('toefl') }}"
                                        placeholder="Nilai TOEFL">
                                    @error('toefl')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>IPK</label>
                                    <input autofocus name="ipk" id="ipk" class="form-control" type="text"
                                        value="{{ old('ipk') }}" placeholder="Nilai IPK">
                                    @error('ipk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>
                                        Berkas Kelengkapan
                                        <small>
                                            <a target="_blank"
                                                href="/uploads/syarat_seminar/{{ $syarat->path_file}}">Lihat
                                                Persyaratan</a>
                                        </small>
                                    </label>
                                    <div class="custom-file mb-1">
                                        <label class="custom-file-label" for="link-berkas_seminar_pkl"
                                            id="label-berkas_seminar_pkl">Pilih File</label>
                                        <input value="{{ old('berkas_seminar_pkl') }}"
                                            accept=".pdf" autofocus name="berkas_seminar_pkl"
                                            id="file-berkas_seminar_pkl"
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
                                    <label>Dosen Pembimbing</label>
                                    <select class="custom-select2 form-control" name="id_dospemkp"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Dosen Pembimbing PKL/KP">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_dospemkp') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pembimbing Lapangan</label>
                                    <input autofocus name="pembimbing_lapangan" id="pembimbing_lapangan"
                                        value="{{ old('pembimbing_lapangan') }}"
                                        class="form-control" type="text" placeholder="Pembimbing Lapangan">
                                    @error('pembimbing_lapangan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Karyawan / NIP Pembimbing Lapangan</label>
                                    <input autofocus name="ni_pemlap" id="ni_pemlap" class="form-control" type="text"
                                        value="{{ old('ni_pemlap') }}"
                                        placeholder="NIP / Nomor Karyawan">
                                    @error('ni_pemlap')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Rencana Seminar</label>
                                    <input autofocus class="form-control month-picker" type="text" name="rencana_seminar"
                                        value="{{ old('rencana_seminar') }}"
                                        id="rencana_seminar" placeholder="Rencana Seminar">
                                    @error('rencana_seminar')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                {{-- hanya tampil saat mode mobile --}}
                                <div class="form-group" id="form-mobile">
                                    <label>Judul atau Topik</label>
                                    <textarea name="judul_kp" id="judul" class="form-control" name="judul_kp">{{ old('judul_kp') }}</textarea>
                                    @error('judul_kp')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" id="form">
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
                                    </div>
                                    @error('agreement')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submitButton" class="submit btn btn-primary">Submit</button>
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


        var myButton = document.getElementById("submitButton");

        myButton.addEventListener("click", function() {
            myButton.classList.add("btn-pulse");

            setTimeout(function() {
                myButton.classList.remove("btn-pulse");
            }, 500);
        });
    </script>
@endsection
