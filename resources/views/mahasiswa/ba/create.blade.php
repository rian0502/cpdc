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
                    <form action="{{ route('mahasiswa.bakerjapraktik.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nilai Pembimbing Lapangan</label>
                                    <input autofocus name="nilai_lapangan" id="nilai_lapangan" class="form-control"
                                        type="number" value="{{ old('nilai_lapangan') }}" placeholder="Masukkan Nilai">
                                    @error('nilai_lapangan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nilai Dosen Pembimbing</label>
                                    <input autofocus name="nilai_akd" id="nilai_akd" class="form-control" type="number"
                                        value="{{ old('nilai_akd') }}" placeholder="Masukkan Nilai">
                                    @error('nilai_akd')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nilai Akhir</label>
                                    <input autofocus name="nilai_akhir" id="nilai_akhir" class="form-control" type="number"
                                        value="{{ old('nilai_akhir') }}" placeholder="Masukkan Nilai">
                                    @error('nilai_akhir')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>No Berita Acara Seminar Kerja Praktik</label>
                                    <input autofocus name="no_ba_seminar_kp" id="no_ba_seminar_kp" class="form-control"
                                        type="text" value="{{ old('no_ba_seminar_kp') }}" placeholder="ex : 123UN">
                                    @error('no_ba_seminar_kp')
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
                                            <option value="A"{{old('A')}}>A</option>
                                            <option value="A-"{{old('A-')}}>A-</option>
                                            <option value="AB"{{old('AB')}}>AB</option>
                                            <option value="B+"{{old('B+')}}>B+</option>
                                            <option value="B"{{old('B')}}>B</option>
                                            <option value="B-"{{old('B-')}}>B-</option>
                                            <option value="BC"{{old('BC')}}>BC</option>
                                            <option value="C+"{{old('C+')}}>C+</option>
                                            <option value="C"{{old('C')}}>C</option>
                                            <option value="D"{{old('D')}}>D+</option>
                                            <option value="E"{{old('E')}}>E</option>
                                        </optgroup>

                                    </select>
                                    @error('nilai_mutu')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">

                                    <label> Berkas Berita Acara<small> <a id="link-berkas_ba_seminar_kp" href="#"
                                                target="_blank" style="display: none;">Lihat File</a> </small></label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="link-berkas_ba_seminar_kp"
                                            id="label-berkas_ba_seminar_kp">Pilih File</label>
                                        <input value="{{ old('berkas_ba_seminar_kp') }}" accept=".pdf" autofocus
                                            name="berkas_ba_seminar_kp" id="file-berkas_ba_seminar_kp"
                                            class="custom-file-input form-control @error('berkas_ba_seminar_kp') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK" onchange="updateFileNameAndLink('file-berkas_ba_seminar_kp','label-berkas_ba_seminar_kp','link-berkas_ba_seminar_kp')">
                                    </div>
                                    @error('berkas_ba_seminar_kp')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group">

                                    <label> Berkas Laporan PKL/KP <small> <a id="link-berkas_ba_seminar_kp" href="#"
                                                target="_blank" style="display: none;">Lihat File</a> </small></label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="link-laporan_kp"
                                            id="label-laporan_kp">Pilih File</label>
                                        <input value="{{ old('laporan_kp') }}" accept=".pdf" autofocus
                                            name="laporan_kp" id="file-laporan_kp"
                                            class="custom-file-input form-control @error('laporan_kp') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK" onchange="updateFileNameAndLink('file-laporan_kp','label-laporan_kp','link-laporan_kp')">
                                    </div>
                                    @error('laporan_kp')
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
