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
                    <form action="{{ route('mahasiswa.bakerjapraktik.update', $seminar->encrypt_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nilai Pembimbing 1</label>
                                    <input autofocus name="nilai_pemb1" id="nilai_pemb1" class="form-control" type="text"
                                        value="{{ old('nilai_pemb1') }}" placeholder="Contoh : 89.87">
                                    @error('nilai_pemb1')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nilai Pembimbing 2</label>
                                    <input autofocus name="nilai_pemb2" id="nilai_pemb2" class="form-control" type="text"
                                        value="{{ old('nilai_pemb2') }}" placeholder="Contoh : 89.87">
                                    @error('nilai_pemb2')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nilai Akhir</label>
                                    <input autofocus name="nilai_akhir" id="nilai_akhir" class="form-control" type="text"
                                        value="{{ old('nilai_akhir') }}" placeholder="Contoh : 89.87">
                                    @error('nilai_akhir')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Berita Acara Seminar Tugas Akhir 1</label>
                                    <input autofocus name="no_ba_seminar_ta2" id="no_ba_seminar_ta2" class="form-control"
                                        type="text" value="{{ old('no_ba_seminar_ta2') }}"
                                        placeholder="Contoh : 986/UN26.17.03/DT/2022">
                                    @error('no_ba_seminar_ta2')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Pilih Huruf Mutu</label>
                                    <select class="custom-select2 form-control" name="nilai_mutu"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Huruf Mutu">
                                            <option value="A"{{ old('nilai_mutu') == 'A' ? 'selected' : '' }}>A
                                            </option>
                                            <option value="A-"{{ old('nilai_mutu') == 'A-' ? 'selected' : '' }}>A-
                                            </option>
                                            <option value="AB"{{ old('nilai_mutu') == 'AB' ? 'selected' : '' }}B>AB
                                            </option>
                                            <option value="B+"{{ old('nilai_mutu') == 'B+' ? 'selected' : '' }}>B+
                                            </option>
                                            <option value="B"{{ old('nilai_mutu') == 'B' ? 'selected' : '' }}>B
                                            </option>
                                            <option value="B-"{{ old('nilai_mutu') == 'B-' ? 'selected' : '' }}>B-
                                            </option>
                                            <option value="BC"{{ old('nilai_mutu') == 'BC' ? 'selected' : '' }}C>BC
                                            </option>
                                            <option value="C+"{{ old('nilai_mutu') == 'C+' ? 'selected' : '' }}>C+
                                            </option>
                                            <option value="C"{{ old('nilai_mutu') == 'C' ? 'selected' : '' }}>C
                                            </option>
                                            <option value="D"{{ old('nilai_mutu') == 'D' ? 'selected' : '' }}>D+
                                            </option>
                                            <option value="E"{{ old('nilai_mutu') == 'E' ? 'selected' : '' }}>E
                                            </option>
                                        </optgroup>
                                    </select>
                                    @error('nilai_mutu')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label> Berkas Berita Acara<small> <a id="link-berkas_ba_seminar_ta2" href="#"
                                                target="_blank" style="display: none;">Lihat File</a> </small></label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="link-berkas_ba_seminar_ta2"
                                            id="label-berkas_ba_seminar_ta2">Pilih File</label>
                                        <input value="{{ old('berkas_ba_seminar_ta2') }}" accept=".pdf" autofocus
                                            name="berkas_ba_seminar_ta2" id="file-berkas_ba_seminar_ta2"
                                            class="custom-file-input form-control @error('berkas_ba_seminar_ta2') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file-berkas_ba_seminar_ta2','label-berkas_ba_seminar_ta2','link-berkas_ba_seminar_ta2')">
                                    </div>
                                    @error('berkas_ba_seminar_ta2')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label> Berkas Laporan Tugas Akhir 2 <small> <a id="link-laporan_ta2" href="#"
                                                target="_blank" style="display: none;">Lihat File</a> </small></label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="link-laporan_ta2" id="label-laporan_ta2">Pilih
                                            File</label>
                                        <input value="{{ old('laporan_ta2') }}" accept=".pdf" autofocus name="laporan_ta2"
                                            id="file-laporan_ta2"
                                            class="custom-file-input form-control @error('laporan_ta2') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file-laporan_ta2','label-laporan_ta2','link-laporan_ta2')">
                                    </div>
                                    @error('laporan_ta2')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mt-3"> Berkas PowerPoint Bahasa Inggris <small> <a
                                                id="link-laporan_ppt_bing" href="#" target="_blank"
                                                style="display: none;">Lihat File</a> </small></label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="link-laporan_ppt_bing"
                                            id="label-laporan_ppt_bing">Pilih File</label>
                                        <input value="{{ old('laporan_ppt_bing') }}" accept=".pdf" autofocus
                                            name="laporan_ppt_bing" id="file-laporan_ppt_bing"
                                            class="custom-file-input form-control @error('laporan_ppt_bing') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file-laporan_ppt_bing','label-laporan_ppt_bing','link-laporan_ppt_bing')">
                                    </div>
                                    @error('laporan_ppt_bing')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <a href="/mahasiswa/seminar/ta2">
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
