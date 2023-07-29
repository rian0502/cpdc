@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Edit Akun Dosen</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('sudo.akun_dosen.update', $account->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input autofocus name="email" id="email" value="{{ $account->email }}"
                                        class="form-control @error('email') form-control-danger @enderror" type="text"
                                        placeholder="Email">
                                    @error('email')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="custom-select2 form-control" multiple="multiple" style="width: 100%"
                                        name="role[]">
                                        <optgroup label="Role">
                                            <option value="dosen" {{ $account->hasRole('dosen') ? 'selected' : '' }}>
                                                Dosen</option>
                                            <option value="pkl" {{ $account->hasRole('pkl') ? 'selected' : '' }}>
                                                Koordinator PKL</option>
                                            <option value="ta1" {{ $account->hasRole('ta1') ? 'selected' : '' }}>
                                                Koordinator TA 1</option>
                                            <option value="ta2" {{ $account->hasRole('ta2') ? 'selected' : '' }}>
                                                Koordinator TA 2</option>
                                            <option value="kompre" {{ $account->hasRole('kompre') ? 'selected' : '' }}>
                                                KOMPRE
                                            </option>
                                            <option value="jurusan" {{ $account->hasRole('jurusan') ? 'selected' : '' }}>
                                                Ketua Jurusan</option>
                                            <option value="kalab" {{ $account->hasRole('kalab') ? 'selected' : '' }}>
                                                Kepala Lab</option>
                                            <option value="tpmps" {{ $account->hasRole('tpmps') ? 'selected' : '' }}>
                                                TPMPS</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">


                                <div class="form-group">
                                    <label>Kata Sandi</label>
                                    <input autofocus name="password" id="password"
                                        class="form-control @error('password') form-control-danger @enderror" type="text"
                                        placeholder="Password" value="{{ old('password') }}">
                                    @error('password')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if ($account->dosen)
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="custom-select2 form-control" style="width: 100%; height: 38px"
                                            name="status">
                                            <option value="Aktif" {{ $lecturer->status == 'Aktif' ? 'selected' : '' }}>
                                                Aktif</option>
                                            <option value="Pensiun" {{ $lecturer->status == 'Pensiun' ? 'selected' : '' }}>
                                                Pensiun</option>
                                        </select>
                                    </div>
                                @endif


                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>

                    </form>
                    <a href="{{ route('sudo.akun_dosen.index') }}">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
