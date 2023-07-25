@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Daftar Hadir Pengerjaan Tugas Akhir di Laboratorium</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>

                    </div>
                    <form action="{{ route('mahasiswa.survey.store') }}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">


                                <div class="form-group">
                                    <label>Nilai Fungsionalitas</label>
                                    <input required type="number" placeholder="range nilai 1 - 10" min="1"
                                        max="10"
                                        value="{{old('fungsionalitas')}}"
                                        class="form-control @error('fungsionalitas') form-control-danger @enderror"
                                        name="fungsionalitas">
                                    @error('fungsionalitas')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nilai Kemudahan</label>
                                    <input required type="number" placeholder="range nilai 1 - 10" min="1"
                                        max="10"
                                        value="{{old('kemudahan')}}"
                                        class="form-control @error('kemudahan') form-control-danger @enderror"
                                        name="kemudahan">
                                    @error('kemudahan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nilai Tampilan</label>
                                    <input required type="number" placeholder="range nilai 1 - 10" min="1"
                                        max="10"
                                        value="{{old('tampilan')}}" class="form-control @error('tampilan') form-control-danger @enderror"
                                        name="tampilan">
                                    @error('tampilan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="merek weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Kritik</label>
                                    <input required type="textarea"
                                        class="form-control textarea @error('kritik') form-control-danger @enderror"
                                        value="{{old('kritik')}}"
                                        name="kritik">
                                    @error('kritik')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Saran</label>
                                    <input required type="textarea"
                                        class="form-control textarea @error('saran') form-control-danger @enderror"
                                        value="{{old('saran')}}"
                                        name="saran">
                                    @error('saran')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex">

                                    <div class="form-group">
                                        <button type="submit" class="submit btn btn-primary">Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
