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
                            <h4 class="text-dark h4">Edit Aktivitas</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('mahasiswa.aktivitas_alumni.update',1) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Nama Perusahaan/Usaha/Universitas</label>
                                    <input autofocus class="form-control @error('tempat') form-control-danger @enderror" type="text" name="tempat"
                                        value="{{ old('tempat',$item->tempat) }}" id="tempat"
                                        placeholder="Nama Perusahaan/Usaha/Universitas">
                                    @error('tempat')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat Perusahaan/Usaha/Universitas</label>
                                    <input autofocus class="form-control @error('alamat') form-control-danger @enderror" type="text" name="alamat"
                                        value="{{ old('alamat',$item->alamat) }}" id="alamat"
                                        placeholder="Nama Perusahaan/Usaha/Universitas">
                                    @error('alamat')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jabatan/Posisi</label>
                                    <input autofocus class="form-control @error('jabatan') form-control-danger @enderror" type="text" name="jabatan"
                                        value="{{ old('jabatan',$item->jabatan) }}" id="jabatan"
                                        placeholder="Jabatan">
                                    @error('jabatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input autofocus class="form-control @error('tanggal_masuk') form-control-danger @enderror date-picker" type="text" name="tanggal_masuk"
                                        value="{{ old('tanggal_masuk',$item->tanggal_masuk) }}" id="tanggal_masuk"
                                        placeholder="Tanggal Masuk">
                                    @error('tanggal_masuk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Gaji</label>
                                    <input autofocus class="form-control @error('gaji') form-control-danger @enderror" type="number" name="gaji"
                                        value="{{ old('gaji',$item->gaji) }}" id="gaji"
                                        placeholder="Gaji">
                                    @error('gaji')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Hubungan<small><i> Kaitan Studi Lanjut atau perkerjaan dengan perkuliahan</i></small> </label>
                                    <select name="hubungan" id="hubungan" class="selectpicker form-control" data-size="5"
                                        name="hubungan">
                                        <option value="Sangat Erat"
                                            {{ old('hubungan',$item->hubungan) == 'Sangat Erat' ? 'selected' : '' }}>Sangat Erat
                                        </option>
                                        <option value="Erat"
                                            {{ old('hubungan',$item->hubungan) == 'Erat' ? 'selected' : '' }}>Erat
                                        </option>
                                        <option value="Cukup Erat"
                                            {{ old('hubungan',$item->hubungan) == 'Cukup Erat' ? 'selected' : '' }}>Cukup Erat
                                        </option>
                                        <option value="Tidak Erat"
                                            {{ old('hubungan',$item->hubungan) == 'Tidak Erat' ? 'selected' : '' }}>Tidak Erat
                                        </option>
                                    </select>
                                    @error('hubungan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="selectpicker form-control" data-size="5"
                                        name="status">
                                        <option value="Kerja"
                                            {{ old('status',$item->status) == 'Kerja' ? 'selected' : '' }}>Kerja
                                        </option>
                                        <option value="Kuliah"
                                            {{ old('status',$item->status) == 'Kuliah' ? 'selected' : '' }}>Kuliah
                                        </option>
                                        <option value="Wirausaha"
                                            {{ old('status',$item->status) == 'Wirausaha' ? 'selected' : '' }}>Wirausaha
                                        </option>
                                        <option value="Lainnya"
                                            {{ old('status',$item->status) == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror

                                </div>


                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <a href="{{ route('mahasiswa.aktivitas_alumni.index') }}">
                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->
    </div>
@endsection
