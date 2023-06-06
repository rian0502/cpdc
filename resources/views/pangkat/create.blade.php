@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Tambah Pangkat</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('dosen.pangkat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label for="kepangkatan">PANGKAT</label>
                                    <select name="kepangkatan" style="width: 100%; height: 38px" id="kepangkatan" class="selectpicker form-control @error('kepangkatan') form-control-danger @enderror">
                                        <option value="III A" {{ old('kepangkatan') == 'III A' ? 'selected' : '' }} >III A</option>
                                        <option value="III B {{ old('kepangkatan') == 'III B' ? 'selected' : '' }} ">III B</option>
                                        <option value="III C {{ old('kepangkatan') == 'III C' ? 'selected' : '' }} ">III C</option>
                                        <option value="IV A {{ old('kepangkatan') == 'IV A' ? 'selected' : '' }} ">IV A</option>
                                        <option value="IV B {{ old('kepangkatan') == 'IV B' ? 'selected' : '' }} ">IV B</option>
                                        <option value="IV C {{ old('kepangkatan') == 'IV C' ? 'selected' : '' }} ">IV C</option>
                                        <option value="IV D {{ old('kepangkatan') == 'IV D' ? 'selected' : '' }} ">IV D</option>
                                        <option value="IV E {{ old('kepangkatan') == 'IV E' ? 'selected' : '' }} ">IV E</option>
                                    </select>
                                    @error('kepangkatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>TANGGAL SK PANGKAT</label>
                                    <input value="{{old('tanggal_sk')}}" autofocus name="tanggal_sk" id="tanggal_sk"
                                        class="form-control @error('tanggal_sk') form-control-danger @enderror"
                                        type="date" placeholder="TANGGAL SK">
                                    @error('tanggal_sk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>FILE SK PANGKAT</label>
                                    <div class=" custom-file">
                                        <label class="custom-file-label" for="file_sk">Pilih File</label>

                                        <input value="{{old('file_sk')}}" autofocus name="file_sk" id="file_sk"
                                            class="custom-file-input form-control @error('file_sk') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK">
                                    </div>
                                    @error('file_sk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Submit</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
