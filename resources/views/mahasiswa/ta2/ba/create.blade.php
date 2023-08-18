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
                            <h4 class="text-dark h4">Unggah Berita Acara</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('mahasiswa.bata2.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nilai</label>
                                    <input autofocus name="nilai" id="nilai" class="form-control @error('nilai') form-control-danger @enderror" type="text"
                                        value="{{ old('nilai') }}" placeholder="Contoh : 89.87">
                                    @error('nilai')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Berita Acara Tugas Akhir 2</label>
                                    <input autofocus name="no_berkas_ba_seminar_ta_dua" id="no_berkas_ba_seminar_ta_dua" class="form-control @error('no_berkas_ba_seminar_ta_dua') form-control-danger @enderror"
                                        type="text" value="{{ old('no_berkas_ba_seminar_ta_dua') }}"
                                        placeholder="Contoh : 986/UN26.17.03/DT/2022">
                                    @error('no_berkas_ba_seminar_ta_dua')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Realisasi Seminar</label>
                                    <input autofocus name="tgl_realisasi_seminar" id="tgl_realisasi_seminar" class="form-control @error('tgl_realisasi_seminar') form-control-danger @enderror"
                                        type="date" value="{{ old('tgl_realisasi_seminar') }}">
                                    @error('tgl_realisasi_seminar')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Pilih Huruf Mutu</label>
                                    <select class="custom-select2 form-control @error('huruf_mutu') form-control-danger @enderror" name="huruf_mutu"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Huruf Mutu">
                                            <option value="A"{{ old('huruf_mutu') == 'A' ? 'selected' : '' }}>A
                                            </option>
                                            <option value="A-"{{ old('huruf_mutu') == 'A-' ? 'selected' : '' }}>A-
                                            </option>
                                            <option value="AB"{{ old('huruf_mutu') == 'AB' ? 'selected' : '' }}B>AB
                                            </option>
                                            <option value="B+"{{ old('huruf_mutu') == 'B+' ? 'selected' : '' }}>B+
                                            </option>
                                            <option value="B"{{ old('huruf_mutu') == 'B' ? 'selected' : '' }}>B
                                            </option>
                                            <option value="B-"{{ old('huruf_mutu') == 'B-' ? 'selected' : '' }}>B-
                                            </option>
                                            <option value="BC"{{ old('huruf_mutu') == 'BC' ? 'selected' : '' }}C>BC
                                            </option>
                                            <option value="C+"{{ old('huruf_mutu') == 'C+' ? 'selected' : '' }}>C+
                                            </option>
                                            <option value="C"{{ old('huruf_mutu') == 'C' ? 'selected' : '' }}>C
                                            </option>
                                            <option value="D"{{ old('huruf_mutu') == 'D' ? 'selected' : '' }}>D+
                                            </option>
                                            <option value="E"{{ old('huruf_mutu') == 'E' ? 'selected' : '' }}>E
                                            </option>
                                        </optgroup>
                                    </select>
                                    @error('huruf_mutu')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">

                                <div class="form-group">
                                    <label> Berkas Berita Acara<small> <a id="link-ba_seminar_ta_dua" href="#"
                                                target="_blank" style="display: none;">Lihat File</a> </small></label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="link-ba_seminar_ta_dua"
                                            id="label-ba_seminar_ta_dua">Pilih File</label>
                                        <input value="{{ old('ba_seminar_ta_dua') }}" accept=".pdf" autofocus
                                            name="ba_seminar_ta_dua" id="file-ba_seminar_ta_dua"
                                            class="custom-file-input form-control @error('ba_seminar_ta_dua') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file-ba_seminar_ta_dua','label-ba_seminar_ta_dua','link-ba_seminar_ta_dua')">
                                    </div>
                                    @error('ba_seminar_ta_dua')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="mt-2">Berkas Nilai Tugas Akhir 2 <small> <a
                                                id="link-berkas_nilai_seminar_ta_dua" href="#" target="_blank"
                                                style="display: none;">Lihat File</a>
                                        </small></label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="link-berkas_nilai_seminar_ta_dua"
                                            id="label-berkas_nilai_seminar_ta_dua">Pilih
                                            File</label>
                                        <input value="{{ old('berkas_nilai_seminar_ta_dua') }}" accept=".pdf" autofocus
                                            name="berkas_nilai_seminar_ta_dua" id="file-berkas_nilai_seminar_ta_dua"
                                            class="custom-file-input form-control @error('berkas_nilai_seminar_ta_dua') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file-berkas_nilai_seminar_ta_dua','label-berkas_nilai_seminar_ta_dua','link-berkas_nilai_seminar_ta_dua')">
                                    </div>
                                    @error('berkas_nilai_seminar_ta_dua')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Power Point Bahasa Inggris</label>
                                    <input autofocus name="berkas_ppt_seminar_ta_dua" id="berkas_ppt_seminar_ta_dua"
                                        class="form-control @error('berkas_ppt_seminar_ta_dua') form-control-danger @enderror" type="text"
                                        value="{{ old('berkas_ppt_seminar_ta_dua') }}"
                                        placeholder="Link Gdrive / Penyimpanan Cloud Power Point">
                                    @error('berkas_ppt_seminar_ta_dua')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>
                    </form>
                    <a href="{{ route('mahasiswa.seminar.tugas_akhir_2.index') }}">
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
