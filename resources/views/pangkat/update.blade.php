@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Edit Data Pangkat</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('dosen.pangkat.update', $pangkat->encrypted_id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label for="kepangkatan" style="width: 100%; height: 38px" >Pangkat</label>
                                    <select name="kepangkatan" id="kepangkatan" class="selectpicker form-control @error('kepangkatan') form-control-danger @enderror">
                                        <option value="III A" {{ $pangkat->kepangkatan == 'III A' ? 'selected' : '' }} >III A</option>
                                        <option value="III B {{ $pangkat->kepangkatan == 'III B' ? 'selected' : '' }} ">III B</option>
                                        <option value="III C {{ $pangkat->kepangkatan == 'III C' ? 'selected' : '' }} ">III C</option>
                                        <option value="III D {{ $pangkat->kepangkatan == 'III D' ? 'selected' : '' }} ">III D</option>
                                        <option value="IV A {{ $pangkat->kepangkatan == 'IV A' ? 'selected' : '' }} ">IV A</option>
                                        <option value="IV B {{ $pangkat->kepangkatan == 'IV B' ? 'selected' : '' }} ">IV B</option>
                                        <option value="IV C {{ $pangkat->kepangkatan == 'IV C' ? 'selected' : '' }} ">IV C</option>
                                        <option value="IV D {{ $pangkat->kepangkatan == 'IV D' ? 'selected' : '' }} ">IV D</option>
                                        <option value="IV E {{ $pangkat->kepangkatan == 'IV E' ? 'selected' : '' }} ">IV E</option>
                                    </select>
                                    @error('kepangkatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Surat Keterangan Pangkat</label>
                                    <input value="{{$pangkat->tgl_sk}}" autofocus name="tgl_sk" id="tgl_sk"
                                        class="form-control @error('tgl_sk') form-control-danger @enderror"
                                        type="date" placeholder="TANGGAL SK">
                                    @error('tgl_sk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>File Surat Keterangan Pangkat<small> <a id="link-file_sk" href="#"
                                        target="_blank" style="display: none;">Lihat File</a> </small></label>
                                    <div class=" custom-file">
                                        <label class="custom-file-label" for="file_sk" id="label-file_sk">Pilih File</label>

                                        <input value="{{$pangkat->file_sk}}" autofocus name="file_sk" id="file_sk"
                                            class="custom-file-input form-control @error('file_sk') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK" onchange="updateFileNameAndLink('file_sk','label-file_sk','link-file_sk')">
                                    </div>
                                    @error('file_sk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
