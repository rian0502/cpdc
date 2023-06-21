@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Daftar Seminar</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="#" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nomor Pokok Mahasiswa</label>
                                    <input autofocus name="npm" id="npm" class="form-control" type="number"
                                        placeholder="Nomor Pokok Mahasiswa">
                                </div>
                                <div class="form-group">
                                    <label>Nama Mahasiswa</label>
                                    <input autofocus name="nama_mahasiswa" id="nama_mahasiswa" class="form-control"
                                        type="text" placeholder="Nama Mahasiswa">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input name="angkatan"
                                        class="form-control @error('tanggal_seminar') form-control-danger @enderror"
                                        type="date">
                                    @error('tanggal_seminar')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Waktu</label>
                                    <input name="angkatan"
                                        class="form-control @error('waktu_seminar') form-control-danger @enderror"
                                        type="time">
                                    @error('waktu_seminar')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Ruangan</label>
                                    <select class="selectpicker form-control" data-size="5">
                                        <option selected="">-- Pilih Ruangan --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Judul</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">


                                <div class="form-group">
                                    <label>Email</label>
                                    <input autofocus name="email" id="email" class="form-control"
                                        type="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Prodi</label>
                                    <select class="selectpicker form-control" data-size="5">
                                        <option selected="">-- Pilih Prodi --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Seminar</label>
                                    <select class="selectpicker form-control" data-size="5">
                                        <option selected="">-- Pilih Seminar --</option>
                                        <option value="Kerja Praktik">Kerja Praktik</option>
                                        <option value="Seminar Usul">Seminar Usul</option>
                                        <option value="Seminar Hasil">Seminar Hasil</option>
                                        <option value="Ujian Skripsi">Ujian Skripsi</option>
                                        <option value="Seminar Tugas Akhir">Seminar Tugas Akhir</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pembimbing 1</label>
                                    <select class="selectpicker form-control" name="pem1" data-size="5">
                                        <option selected="">-- Pilih Pembimbing 1 --</option>
                                        <option value="Dr. Hj. Nurhasanah, M.Pd.">Dr. Hj. Nurhasanah, M.Pd.</option>
                                        <option value="Dr. rer. nat. Ir. H. Ahmad Yusuf, M.Pd.">Dr. rer. nat. Ir. H. Ahmad Yusuf, M.Pd.</option>
                                        <option value="Prof. Dr. Ir. Soetarto, M.Sc.">Prof. Dr. Ir. Soetarto, M.Sc.</option>
                                        <option value="Drs. H. Abdul Azis, M.Pd.">Drs. H. Abdul Azis, M.Pd.</option>
                                    </select>
                                    @error('id_pembimbing_satu')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>

                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Pembimbing 2</label>
                                    <select class="custom-select2 form-control" name="id_pembimbing_dua"
                                        id="id_pembimbing_dua"
                                        onchange="toggleInput(this, 'Pembimbing2', 'pbl2_nama')">
                                        <optgroup label="Pembimbing 2">
                                            @foreach ($dosens as $item)
                                                <option value="{{ $item->encrypt_id }}"
                                                    {{ old('id_pembimbing_dua') == $item->encrypt_id ? 'selected' : '' }}>
                                                    {{ $item->nama_dosen }}</option>
                                            @endforeach

                                            @if (old('id_pembimbing_dua')=='new' || $errors->has('pbl2_nama'))
                                                <option value="new" selected>Tidak Ada diDaftar Ini</option>
                                            @else
                                                <option value="new">Tidak Ada diDaftar Ini</option>
                                            @endif

                                        </optgroup>
                                    </select>
                                </div>
                                <div id="pbl2_nama" style="display: {{old('id_pembimbing_dua')=='new'?'block':'none'}};" {{old('id_pembimbing_dua')=='new'? '':'hidden'}}>
                                    <div class="form-group">
                                        <label>Nomor Karyawan / NIP Pembimbing 2</label>
                                        <input autofocus name="pbl2_nama" class="form-control" type="text"
                                            value="{{ old('pbl2_nama') }}" placeholder="Masukkan Juga NIP / Nomor Karyawan">
                                        @error('pbl2_nama')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div id="Pembimbing2" style="display: {{old('id_pembimbing_dua')=='new'?'block':'none'}};" {{old('id_pembimbing_dua')=='new'? '':'hidden'}}>
                                    <div class="form-group">
                                        <label>Nomor Karyawan / NIP Pembimbing 2</label>
                                        <input autofocus name="pbl2_nip" class="form-control" type="text"
                                            value="{{ old('pbl2_nip') }}" placeholder="Masukkan Juga NIP / Nomor Karyawan">
                                        @error('pbl2_nip')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <a href="/dashboard">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->
    </div>
@endsection
