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
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jquery-dateFormat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Data Registrasi Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix" style="margin-bottom: 50px; margin-top: 10px;">
                        <div class="pull-left">
                            <h4 class="text-dark h4" style="margin-left: 10px">Jadwalkan Seminar PKL/KP</h4>
                        </div>
                    </div>
                    <div class="pl-3 pr-3 pb-0 mb-2">
                        <form id="formStatus" action="{{ route('koor.arsip.pkl.update', $seminar->encrypt_id) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="profile-edit-list row">
                                <div class="weight-500 col-md-6">
                                    <div class="form-group">
                                        <label>Nama Mitra</label>
                                        <input autofocus name="mitra" value="{{ old('mitra', $seminar->mitra) }}"
                                            id="mitra" class="form-control" type="text"
                                            placeholder="Nama Mitra PKL/KP">
                                        @error('mitra')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

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
                                        <select id="tahunAkademik" class="selectpicker form-control" data-size="5"
                                            name="tahun_akademik">
                                        </select>
                                        @error('tahun_akademik')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Domisili PKL/KP</label>
                                        <select id="region" class="selectpicker form-control" data-size="5"
                                            name="region">
                                            <option value="Unila"
                                                {{ old('region', $seminar->region) == 'Unila' ? 'selected' : '' }}>
                                                Universitas
                                                Lampung</option>
                                            <option value="Dalam Lampung"
                                                {{ old('region', $seminar->region) == 'Dalam Lampung' ? 'selected' : '' }}>
                                                Dalam
                                                Lampung</option>
                                            <option value="Luar Lampung"
                                                {{ old('region', $seminar->region) == 'Luar Lampung' ? 'selected' : '' }}>
                                                Luar
                                                Lampung</option>
                                        </select>
                                        @error('region')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>SKS</label>
                                        <input autofocus name="sks" value="{{ old('sks', $seminar->sks) }}"
                                            id="jumlah_sks" class="form-control" type="number"
                                            value="{{ old('sks', $seminar->sks) }}" placeholder="Jumlah SKS">
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
                                            min="0" value="{{ old('toefl', $seminar->toefl) }}"
                                            placeholder="Nilai TOEFL">
                                        @error('toefl')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>IPK</label>
                                        <input autofocus name="ipk" id="ipk" class="form-control" type="text"
                                            value="{{ old('ipk', $seminar->ipk) }}" placeholder="Contoh : 3.55">
                                        @error('ipk')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Berkas Kelengkapan

                                        </label>
                                        <div class="custom-file mb-1">
                                            <label class="custom-file-label" for="link-berkas_seminar_pkl"
                                                id="label-berkas_seminar_pkl">Pilih File</label>
                                            <input value="{{ old('berkas_seminar_pkl', $seminar->berkas_seminar_pkl) }}"
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
                                    <div class="form-group">
                                        <label><b>Status Seminar</b></label>
                                        <select name="status_seminar" id="status" class="selectpicker form-control"
                                            data-size="5">
                                            <option value="Belum Selesai"
                                                {{ old('status_seminar'),$seminar->status_seminar == 'Belum Selesai' ? 'selected' : '' }}>Belum
                                                Selesai
                                            </option>
                                            <option value="Selesai"
                                                {{ old('status_seminar'),$seminar->status_seminar == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        @error('status_seminar')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><b>Status Administratif</b></label>
                                        <select onchange="toggleCatatan()" name="proses_admin" id="status"
                                            class="selectpicker form-control" data-size="5">
                                            <option value="proses" {{ old('proses_admin'),$seminar->proses_admin == 'Proses' ? 'selected' : '' }}>
                                                Diproses</option>
                                            <option value="Valid" {{ old('proses_admin'),$seminar->proses_admin == 'Valid' ? 'selected' : '' }}>
                                                Valid</option>
                                            <option value="Invalid" {{ old('proses_admin'),$seminar->proses_admin == 'Invalid' ? 'selected' : '' }}>
                                                Invalid</option>
                                        </select>
                                        @error('proses_admin')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @if ($seminar->berita_acara)

                                    <div class="form-group">
                                        <label>Nilai Pembimbing Lapangan</label>
                                        <input autofocus name="nilai_lapangan" id="nilai_lapangan" class="form-control @error('nilai_lapangan') form-control-danger @enderror"
                                            type="text" value="{{ old('nilai_lapangan',$seminar->berita_acara->nilai_lapangan) }}" placeholder="Contoh : 89.87">
                                        @error('nilai_lapangan')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nilai Dosen Pembimbing</label>
                                        <input autofocus name="nilai_akd" id="nilai_akd" class="form-control @error('nilai_akd') form-control-danger @enderror" type="text"
                                            value="{{ old('nilai_akd',$seminar->berita_acara->nilai_akd) }}" placeholder="Contoh : 89.87">
                                        @error('nilai_akd')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nilai Akhir</label>
                                        <input autofocus name="nilai_akhir" id="nilai_akhir" class="form-control @error('nilai_akhir') form-control-danger @enderror" type="text"
                                            value="{{ old('nilai_akhir',$seminar->berita_acara->nilai_akhir) }}" placeholder="Contoh : 89.87">
                                        @error('nilai_akhir')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Pilih Huruf Mutu</label>
                                        <select class="custom-select2 form-control @error('nilai_mutu') form-control-danger @enderror" name="nilai_mutu"
                                            style="width: 100%; height: 38px">
                                            <optgroup label="Huruf Mutu">
                                                <option value="A"{{old('nilai_mutu',$seminar->berita_acara->nilai_mutu)=='A'?'selected':''}}>A</option>
                                                <option value="A-"{{old('nilai_mutu',$seminar->berita_acara->nilai_mutu)=='A-'?'selected':''}}>A-</option>
                                                <option value="AB"{{old('nilai_mutu',$seminar->berita_acara->nilai_mutu)=='AB'?'selected':''}}B>AB</option>
                                                <option value="B+"{{old('nilai_mutu',$seminar->berita_acara->nilai_mutu)=='B+'?'selected':''}}>B+</option>
                                                <option value="B"{{old('nilai_mutu',$seminar->berita_acara->nilai_mutu)=='B'?'selected':''}}>B</option>
                                                <option value="B-"{{old('nilai_mutu',$seminar->berita_acara->nilai_mutu)=='B-'?'selected':''}}>B-</option>
                                                <option value="BC"{{old('nilai_mutu',$seminar->berita_acara->nilai_mutu)=='BC'?'selected':''}}C>BC</option>
                                                <option value="C+"{{old('nilai_mutu',$seminar->berita_acara->nilai_mutu)=='C+'?'selected':''}}>C+</option>
                                                <option value="C"{{old('nilai_mutu',$seminar->berita_acara->nilai_mutu)=='C'?'selected':''}}>C</option>
                                                <option value="D"{{old('nilai_mutu',$seminar->berita_acara->nilai_mutu)=='D'?'selected':''}}>D+</option>
                                                <option value="E"{{old('nilai_mutu',$seminar->berita_acara->nilai_mutu)=='E'?'selected':''}}>E</option>
                                            </optgroup>

                                        </select>
                                        @error('nilai_mutu')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>No Berita Acara Seminar Kerja Praktik</label>
                                        <input autofocus name="no_ba_seminar_kp" id="no_ba_seminar_kp" class="form-control @error('no_ba_seminar_kp') form-control-danger @enderror"
                                            type="text" value="{{ old('no_ba_seminar_kp',$seminar->berita_acara->no_ba_seminar_kp) }}" placeholder="Contoh : 123UN">
                                        @error('no_ba_seminar_kp')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">

                                        <label> Berkas Berita Acara<small> <a id="link-berkas_ba_seminar_kp" href="#"
                                                    target="_blank" style="display: none;">Lihat File</a> </small></label>
                                        <div class="custom-file">
                                            <label class="custom-file-label" for="link-berkas_ba_seminar_kp"
                                                id="label-berkas_ba_seminar_kp">Pilih File</label>
                                            <input value="{{ old('berkas_ba_seminar_kp',$seminar->berkas_ba_seminar_kp) }}" accept=".pdf" autofocus
                                                name="berkas_ba_seminar_kp" id="file-berkas_ba_seminar_kp"
                                                class="custom-file-input form-control @error('berkas_ba_seminar_kp') form-control-danger @enderror"
                                                type="file" placeholder="FILE SK" onchange="updateFileNameAndLink('file-berkas_ba_seminar_kp','label-berkas_ba_seminar_kp','link-berkas_ba_seminar_kp')">
                                        </div>
                                        @error('berkas_ba_seminar_kp')
                                            <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="form-group">

                                        <label> Berkas Laporan PKL/KP <small> <a id="link-laporan_kp" href="#"
                                                    target="_blank" style="display: none;">Lihat File</a> </small></label>
                                        <div class="custom-file">
                                            <label class="custom-file-label" for="link-laporan_kp"
                                                id="label-laporan_kp">Pilih File</label>
                                            <input value="{{ old('laporan_kp',$seminar->laporan_kp) }}" accept=".pdf" autofocus
                                                name="laporan_kp" id="file-laporan_kp"
                                                class="custom-file-input form-control @error('laporan_kp') form-control-danger @enderror"
                                                type="file" placeholder="FILE SK" onchange="updateFileNameAndLink('file-laporan_kp','label-laporan_kp','link-laporan_kp')">
                                        </div>
                                        @error('laporan_kp')
                                            <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    @endif


                                </div>

                                {{-- form untuk sebelah kanan --}}
                                <div class="kanan weight-500 col-md-6">
                                    <div class="form-group">
                                        <label>Dosen Pembimbing</label>
                                        <select class="custom-select2 form-control" name="id_dospemkp"
                                            style="width: 100%; height: 38px">
                                            <optgroup label="Dosen Pembimbing PKL/KP">
                                                @foreach ($dosen as $item)
                                                    <option value="{{ $item->encrypt_id }}"
                                                        {{ old('id_dospemkp', $seminar->id_dospemkp) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_dosen }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Pembimbing Lapangan</label>
                                        <input autofocus name="pembimbing_lapangan" id="pembimbing_lapangan"
                                            value="{{ old('pembimbing_lapangan', $seminar->pembimbing_lapangan) }}"
                                            class="form-control" type="text" placeholder="Pembimbing Lapangan">
                                        @error('pembimbing_lapangan')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Karyawan / NIP Pembimbing Lapangan</label>
                                        <input autofocus name="ni_pemlap" id="ni_pemlap" class="form-control"
                                            type="text" value="{{ old('ni_pemlap', $seminar->ni_pemlap) }}"
                                            placeholder="NIP / Nomor Karyawan">
                                        @error('ni_pemlap')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Rencana Seminar</label>
                                        <input readonly class="form-control month-picker" type="text"
                                            name="rencana_seminar"
                                            value="{{ old('rencana_seminar', $seminar->rencana_seminar) }}"
                                            id="rencana_seminar" placeholder="Rencana Seminar">
                                        @error('rencana_seminar')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if ($seminar->jadwal)


                                        <div class="form-group">
                                            <label>Tanggal Seminar</label>
                                            <input value="{{ $seminar->jadwal->tanggal_skp }}" autofocus name="tanggal_skp"
                                                id="tanggal_skp"
                                                class="form-control @error('tanggal_skp') form-control-danger @enderror"
                                                type="date" placeholder="Nama Barang">
                                            @error('tanggal_skp')
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
                                            <input type="time" value="{{ $seminar->jadwal->jam_mulai_skp }}"
                                                name="jam_mulai_skp"
                                                class="form-control @error('jam_mulai_skp') form-control-danger @enderror">
                                            @error('jam_mulai_skp')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Jam Selesai</label>
                                            <input type="time" name="jam_selesai_skp"
                                                value="{{ $seminar->jadwal->jam_selesai_skp }}"
                                                class="form-control @error('jam_selesai_skp') form-control-danger @enderror">
                                            @error('jam_selesai_skp')
                                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @endif

                                    {{-- hanya tampil saat mode mobile --}}
                                    <div class="form-group" id="form-mobile">
                                        <label>Judul atau Topik</label>
                                        <textarea name="judul_kp" id="judul" class="form-control" name="judul_kp">{{ old('judul_kp', $seminar->judul_kp) }}</textarea>
                                        @error('judul_kp')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group" id="form-mobile">
                                        <label>Keterangan Perbaikan <i><small>Kosongkan apabila data sesuai</small></i></label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" name="keterangan">{{ old('keterangan', $seminar->keterangan) }}</textarea>
                                        @error('keterangan')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <button id="submitButton" type="submit" class="submit btn btn-primary">Kirim</button>
                            </div>
                        </form>
                        <a href="{{ route('koor.jadwalPKL.index') }}">
                            <button class="batal btn btn-secondary">Batal</button>
                        </a>
                    </div>
                </div>
                <!-- Data Registrasi End -->

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
