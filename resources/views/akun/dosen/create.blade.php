@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah Akun Dosen</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                </div>
                <form action="{{ route('sudo.akun_dosen.store') }}" method="POST">
                    @csrf
                    <div class="profile-edit-list row">
                        {{-- form untuk sebelah kiri --}}
                        <div class="weight-500 col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input autofocus name="email" id="email" value="{{-- {{ $barang->email }} --}}"
                                    class="form-control @error('email') form-control-danger @enderror" type="text"
                                    placeholder="Email">
                                @error('email')
                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input autofocus name="nama" id="nama"
                                    class="form-control @error('nama') form-control-danger @enderror"
                                    type="text" placeholder="Nama" value="{{old('nama')}}">
                                @error('nama')
                                    <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        {{-- form untuk sebelah kanan --}}
                        <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Kata Sandi</label>
                                    <input autofocus name="password" id="password"
                                        class="form-control @error('password') form-control-danger @enderror"
                                        type="password" placeholder="Password" value="{{old('password')}}">
                                    @error('password')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="custom-select2 form-control" multiple="multiple" style="width: 100%"
                                        name="role[]">
                                        <optgroup label="Role">
                                                <option value="dosen" >Dosen</option>
                                                <option value="kalab" >Kepala Lab</option>
                                                <option value="pkl" >Koordinator PKL</option>
                                                <option value="ta" >Koordinator TA</option>
                                                <option value="kompre" >Kompre</option>
                                                <option value="jurusan" >Ketua Jurusan</option>
    
                                        </optgroup>
                                    </select>
                                </div>

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
