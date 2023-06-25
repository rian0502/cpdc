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
                            <h4 class="text-dark h4">Edit Berita Acara</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('mahasiswa.bata1.update', $seminar->encrypt_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nilai</label>
                                    <input autofocus name="nilai" id="nilai" class="form-control" type="text"
                                        value="{{ old('nilai', $seminar->nilai) }}" placeholder="Contoh : 89.87">
                                    @error('nilai')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Berita Acara Seminar Tugas Akhir 1</label>
                                    <input autofocus name="no_berkas_ba_seminar_ta_satu" id="no_berkas_ba_seminar_ta_satu"
                                        class="form-control" type="text"
                                        value="{{ old('no_berkas_ba_seminar_ta_satu', $seminar->no_berkas_ba_seminar_ta_satu) }}"
                                        placeholder="Contoh : 986/UN26.17.03/DT/2022">
                                    @error('no_berkas_ba_seminar_ta_satu')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Pilih Huruf Mutu</label>
                                    <select class="custom-select2 form-control" name="nilai_mutu"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Huruf Mutu">
                                            <option
                                                value="A"{{ old('nilai_mutu', $seminar->huruf_mutu) == 'A' ? 'selected' : '' }}>
                                                A
                                            </option>
                                            <option
                                                value="A-"{{ old('nilai_mutu', $seminar->huruf_mutu) == 'A-' ? 'selected' : '' }}>
                                                A-
                                            </option>
                                            <option
                                                value="AB"{{ old('nilai_mutu', $seminar->huruf_mutu) == 'AB' ? 'selected' : '' }}B>
                                                AB
                                            </option>
                                            <option
                                                value="B+"{{ old('nilai_mutu', $seminar->huruf_mutu) == 'B+' ? 'selected' : '' }}>
                                                B+
                                            </option>
                                            <option
                                                value="B"{{ old('nilai_mutu', $seminar->huruf_mutu) == 'B' ? 'selected' : '' }}>
                                                B
                                            </option>
                                            <option
                                                value="B-"{{ old('nilai_mutu', $seminar->huruf_mutu) == 'B-' ? 'selected' : '' }}>
                                                B-
                                            </option>
                                            <option
                                                value="BC"{{ old('nilai_mutu', $seminar->huruf_mutu) == 'BC' ? 'selected' : '' }}C>
                                                BC
                                            </option>
                                            <option
                                                value="C+"{{ old('nilai_mutu', $seminar->huruf_mutu) == 'C+' ? 'selected' : '' }}>
                                                C+
                                            </option>
                                            <option
                                                value="C"{{ old('nilai_mutu', $seminar->huruf_mutu) == 'C' ? 'selected' : '' }}>
                                                C
                                            </option>
                                            <option
                                                value="D"{{ old('nilai_mutu', $seminar->huruf_mutu) == 'D' ? 'selected' : '' }}>
                                                D+
                                            </option>
                                            <option
                                                value="E"{{ old('nilai_mutu', $seminar->huruf_mutu) == 'E' ? 'selected' : '' }}>
                                                E
                                            </option>
                                        </optgroup>
                                    </select>
                                    @error('nilai_mutu')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">

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
                                        class="form-control" type="text"
                                        value="{{ old('berkas_ppt_seminar_ta_satu', $seminar->berkas_ppt_seminar_ta_satu) }}"
                                        placeholder="Link Gdrive / Penyimpanan Cloud Power Point">
                                    @error('berkas_ppt_seminar_ta_satu')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Submit</button>
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
