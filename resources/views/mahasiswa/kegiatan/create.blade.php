@extends('layouts.admin')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include Select2 CSS and JS -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}
                            <h4 class="text-dark h4">Tambah Data Kegiatan</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form
                        action="{{ route(Auth::user()->hasRole('mahasiswaS2') ? 'mahasiswa.kegiatanS2.store' : 'mahasiswa.kegiatan.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Aktivitas</label>
                                    <input autofocus name="nama_aktivitas" id="nama_aktivitas"
                                        class="form-control @error('nama_aktivitas') form-control-danger @enderror"
                                        type="text" placeholder="Tuliskan Judul Kegiatan"
                                        value="{{ old('nama_aktivitas') }}">
                                    @error('nama_aktivitas')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div id="nama_pembimbing"
                                    style="display: {{ old('id_pembimbing') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembimbing') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>Nama Dosen Pembimbing</label>
                                        <input autofocus name="nama_pembimbing" class="form-control" type="text"
                                            value="{{ old('nama_pembimbing') }}"
                                            placeholder="Masukkan Nama Dosen Pembimbing">
                                        @error('nama_pembimbing')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tingkatan</label>
                                    <select class="selectpicker form-control @error('skala') form-control-danger @enderror"
                                        data-size="5" name="skala">
                                        <option value="Universitas" {{ old('skala') == 'Universitas' ? 'selected' : '' }}>
                                            Universitas</option>
                                        <option value="Regional" {{ old('skala') == 'Regional' ? 'selected' : '' }}>Regional
                                        </option>
                                        <option value="Nasional" {{ old('skala') == 'Nasional' ? 'selected' : '' }}>
                                            Nasional
                                        </option>
                                        <option value="Internasional"
                                            {{ old('skala') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                    </select>
                                    @error('skala')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <select class="selectpicker form-control @error('jenis') form-control-danger @enderror"
                                        data-size="5" id="jenis" name="jenis">
                                        <option value="MBKM" {{ old('jenis') == 'MBKM' ? 'selected' : '' }}>MBKM</option>
                                        <option value="PKM" {{ old('jenis') == 'PKM' ? 'selected' : '' }}>PKM</option>
                                        <option value="HIMA" {{ old('jenis') == 'HIMA' ? 'selected' : '' }}>HIMA</option>
                                        <option value="UKM" {{ old('jenis') == 'UKM' ? 'selected' : '' }}>UKM</option>
                                        <option value="Lainnya" {{ old('jenis') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                        <!-- Add more options as needed -->
                                    </select>
                                    @error('jenis')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" id="kategoriInputContainer">

                                    <!-- Dynamic input elements will be added here -->
                                </div>
                                <div class="form-group">
                                    <label>Dokumen Aktivitas<small> <a id="link-aktivitas" href="#" target="_blank"
                                                style="display: none;">Lihat File</a> </small></label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="file_aktivitas" id="label-aktivitas">Pilih
                                            File</label>
                                        <input value="{{ old('file_aktivitas') }}" accept=".pdf" autofocus
                                            name="file_aktivitas" id="file_aktivitas"
                                            class="custom-file-input form-control @error('file_aktivitas') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file_aktivitas','label-aktivitas','link-aktivitas')">
                                    </div>
                                    @error('file_aktivitas')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Dosen Pembimbing</label>
                                    <select class="custom-select2 form-control" name="id_pembimbing" id="id_pembimbing"
                                        style="width: 100%; height: 38px"
                                        onchange="toggleInput(this, 'pembimbing', 'nama_pembimbing')">
                                        <optgroup label="Dosen Pembimbing">
                                            @foreach ($dosen as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('id_pembimbing') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach
                                            @if (old('id_pembimbing') == 'new' || $errors->has('nama_pembimbing'))
                                                <option value="new" selected>Tidak Ada di Daftar Ini</option>
                                            @else
                                                <option value="new">Tidak Ada di Daftar Ini</option>
                                            @endif
                                        </optgroup>
                                    </select>
                                </div>

                                <div id="pembimbing"
                                    style="display: {{ old('id_pembimbing') == 'new' ? 'block' : 'none' }};"
                                    {{ old('id_pembimbing') == 'new' ? '' : 'hidden' }}>
                                    <div class="form-group">
                                        <label>NIP Dosen Pembimbing</label>
                                        <input autofocus name="nip_pembimbing" class="form-control" type="text"
                                            value="{{ old('nip_pembimbing') }}"
                                            placeholder="Masukkan Nomor Karyawan Dosen Pembimbing">
                                        @error('nip_pembimbing')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Peran</label>
                                    <select class="selectpicker form-control" data-size="5" name="peran">
                                        <option value="Ketua" {{ old('peran') == 'Ketua' ? 'selected' : '' }}>Ketua
                                        </option>
                                        <option value="Anggota" {{ old('peran') == 'Anggota' ? 'selected' : '' }}>Anggota
                                        </option>
                                        <option value="Peserta" {{ old('peran') == 'Peserta' ? 'selected' : '' }}>Peserta
                                        </option>
                                    </select>
                                    @error('peran')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>SKS Konversi</label>
                                    <input autofocus name="sks_konversi" id="sks_konversi"
                                        class="form-control @error('sks_konversi') form-control-danger @enderror""
                                        type="number" value="{{ old('sks_konversi') }}"
                                        placeholder="Tuliskan sks yang akan dikonversikan.">
                                    @error('sks_konversi')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input name="tanggal"
                                        class="form-control @error('tanggal') form-control-danger @enderror"
                                        type="date" value="{{ old('tanggal') }}">
                                    @error('tanggal')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>

                    </form>
                    <a href="{{ route('mahasiswa.profile.index') }}">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->
    </div>
    <script>
        function handleJenisChange() {
            var jenisDropdown = $('#jenis');
            var kategoriContainer = $('#kategoriInputContainer');

            // Clear existing elements inside kategoriContainer
            kategoriContainer.empty();

            // Create either select or input based on the selected jenis
            switch (jenisDropdown.val()) {
                case 'MBKM':
                    createSelect(['Pertukaran Mahasiswa', 'Riset', 'Magang Industri', 'Membangun Desa',
                        'Proyek Kemanusiaan', 'Asistensi Mengajar', 'Wirausaha', 'Proyek Independent'
                    ]);
                    break;
                case 'PKM':
                    createSelect(['PKM-RE (PKM Riset Eksakta)', 'PKM-RSH (PKM Riset Sosial Humaniora)',
                        'PKM-K (PKM Kewirausahaan)', 'PKM-PM (PKM Pengabdian kepada Masyarakat)',
                        'PKM-PI (PKM Penerapan Ilmiah)', 'PKM-KC (PKM Karsa Cipta)', 'PKM-KI (PKM Karya Inovatif)',
                        'PKM-VGK (PKM Video Gagasan Konstruktif)', 'PKM-GFT (PKM Gagasan Futuristik Tertulis)',
                        'PKM-AI (PKM Artikel Ilmiah)'
                    ]);
                    break;
                case 'HIMA':
                case 'UKM':
                case 'Lainnya':
                    createInput();
                    break;
                default:
                    // Handle other cases if needed
                    break;
            }
        }

        function createSelect(optionsArray) {
            // Create select element with options
            var select = $('<select class="custom-select2 form-control" style="width: 100%; height: 38px" name="kategori"></select>');
            var label = $('<label>Kategori</label>');

            // Add options based on the provided array
            addOptionsToSelect(select, optionsArray);

            // Append select to kategoriContainer and initialize Select2
            // $('#kategoriInputContainer').append(select).find('select').select2();
            $('#kategoriInputContainer').append(label).append(select).find('select').select2();
        }

        function createInput() {
            // Create input element
            var input = $('<input type="text" style="width: 100%; height: 38px" class="form-control" name="kategori">');
            var label = $('<label>Kategori</label>');

            // Append input to kategoriContainer
            // $('#kategoriInputContainer').append(input);
            $('#kategoriInputContainer').append(label).append(input);
        }

        function addOptionsToSelect(select, optionsArray) {
            optionsArray.forEach(function(optionValue) {
                var option = $('<option></option>').text(optionValue).val(optionValue);
                select.append(option);
            });
        }

        // Call handleJenisChange on page load
        $(document).ready(handleJenisChange);

        // Attach event listener to the jenisDropdown for changes
        $('#jenis').on('change', handleJenisChange);
    </script>
    <script>
        @if (old('nama_pembimbing'))
            toggleInput(document.getElementById('id_pembimbing'), 'pembimbing')
        @endif
    </script>

@endsection
