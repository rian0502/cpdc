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
                            <h4 class="text-dark h4">Pendatan Alumni</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{-- route('mahasiswa.seminar.tugas_akhir_1.store') --}}" method="POST" enctype="multipart/form-data">
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
                                    <label>SKS Akhir</label>
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
                                    <label>Nilai</label>
                                    <input autofocus name="nilai" id="nilai" class="form-control" type="text"
                                        value="{{ old('nilai') }}" placeholder="Nilai">
                                    @error('nilai')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Penguji 1</label>
                                    <select class="custom-select2 form-control" name="penguji_1" id="penguji_1"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Penguji 1">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_pembimbing_satu') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Penguji 2</label>
                                    <select class="custom-select2 form-control" name="penguji_2" id="penguji_2"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Penguji 2">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_pembimbing_satu') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Penguji 3</label>
                                    <select class="custom-select2 form-control" name="penguji_3" id="penguji_3"
                                        style="width: 100%; height: 38px">
                                        <optgroup label="Penguji 3">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_pembimbing_satu') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Tanggal Lulus Sidang Komprehensif</label>
                                        <input class="form-control date-picker" type="text" name="periode_seminar"
                                            value="{{ old('periode_seminar') }}" id="periode_seminar"
                                            placeholder="Periode Seminar">
                                        @error('periode_seminar')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Rencana Setelah Lulus</label>
                                        <select name="rencana_lulus" id="rencana_lulus" class="selectpicker form-control"
                                            data-size="5" name="rencana_lulus">
                                            <option value="Bekerja" {{ old('rencana_lulus') == 'Bekerja' ? 'selected' : '' }}>
                                                Bekerja
                                            </option>
                                            <option value="Studi Lanjut" {{ old('rencana_lulus') == 'Studi Lanjut' ? '' : 'selected' }}>
                                                Studi Lanjut
                                            </option>
                                            <option value="Belum Ada" {{ old('rencana_lulus') == 'Belum Ada' ? '' : 'selected' }}>
                                                Belum Ada
                                            </option>
                                        </select>
                                        @error('rencana_lulus')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <label>Masa Studi</label>
                                    <input name="nilai" id="nilai" class="form-control" type="number"
                                        value="{{ old('nilai') }}" placeholder="Masa Studi">
                                    @error('nilai')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Rencana Periode Wisuda</label>
                                    <input class="form-control month-picker" type="text" name="periode_seminar"
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
                                        Berkas Transkrip Nilai
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
                                <div class="form-group">
                                    <label>
                                        Berkas TOEFL
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
                                    <label>Judul atau Topik Tugas Akhir</label>
                                    <textarea name="judul_ta" id="judul_ta" rows="" class="form-control">{{ old('judul_ta') }}</textarea>
                                    @error('judul_ta')
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
