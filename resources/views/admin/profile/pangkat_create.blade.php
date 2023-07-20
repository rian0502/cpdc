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
                    <form action="{{ route('admin.pangkat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label for="kepangkatan">Pangkat</label>
                                    <select name="kepangkatan" style="width: 100%; height: 38px" id="kepangkatan" class="custom-select2 form-control @error('kepangkatan') form-control-danger @enderror">

                                        <option value="I A" {{ old('kepangkatan') == 'I A' ? 'selected' : '' }}>I A</option>
                                        <option value="I B" {{ old('kepangkatan') == 'I B' ? 'selected' : '' }}>I B</option>
                                        <option value="I C" {{ old('kepangkatan') == 'I C' ? 'selected' : '' }}>I C</option>
                                        <option value="I D" {{ old('kepangkatan') == 'I D' ? 'selected' : '' }}>I D</option>
                                        <option value="II A" {{ old('kepangkatan') == 'II A' ? 'selected' : '' }}>II A</option>
                                        <option value="II B" {{ old('kepangkatan') == 'II B' ? 'selected' : '' }}>II B</option>
                                        <option value="II C" {{ old('kepangkatan') == 'II C' ? 'selected' : '' }}>II C</option>
                                        <option value="II D" {{ old('kepangkatan') == 'II D' ? 'selected' : '' }}>II D</option>
                                        <option value="III A" {{ old('kepangkatan') == 'III A' ? 'selected' : '' }}>III A</option>
                                        <option value="III B" {{ old('kepangkatan') == 'III B' ? 'selected' : '' }}>III B</option>
                                        <option value="III C" {{ old('kepangkatan') == 'III C' ? 'selected' : '' }}>III C</option>
                                        <option value="III D" {{ old('kepangkatan') == 'III D' ? 'selected' : '' }}>III D</option>
                                        <option value="IV A" {{ old('kepangkatan') == 'IV A' ? 'selected' : '' }}>IV A</option>*
                                        <option value="IV B" {{ old('kepangkatan') == 'IV B' ? 'selected' : '' }}>IV B</option>
                                        <option value="IV C" {{ old('kepangkatan') == 'IV C' ? 'selected' : '' }}>IV C</option>
                                        <option value="IV D" {{ old('kepangkatan') == 'IV D' ? 'selected' : '' }}>IV D</option>
                                        <option value="IV E" {{ old('kepangkatan') == 'IV E' ? 'selected' : '' }}>IV E</option>
                                    </select>
                                    @error('kepangkatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Surat Keputusan Pangkat</label>
                                    <input value="{{old('tanggal_sk')}}" autofocus name="tanggal_sk" id="tanggal_sk"
                                        class="form-control @error('tanggal_sk') form-control-danger @enderror"
                                        type="date" placeholder="TANGGAL SK">
                                    @error('tanggal_sk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>File Surat Keputusan Pangkat<small> <a id="view-file-link-pangkat" href="#"
                                        target="_blank" style="display: none;">Lihat File</a> </small></label>
                            <div class="custom-file">
                                <label class="custom-file-label" for="file_sk" id="file-label-pangkat">Pilih
                                    File</label>
                                <input value="{{ old('file_sk') }}" accept=".pdf" autofocus name="file_sk"
                                    id="file_sk"
                                    class="custom-file-input form-control @error('file_sk') form-control-danger @enderror"
                                    type="file" placeholder="FILE SK" onchange="updateFileNamePangkat(event)">
                            </div>
                            @error('file_sk')
                                <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            {{-- <div class="d-flex"> --}}

                                <button type="submit" class="submit btn btn-primary">Kirim</button>
                                <a href="{{route('admin.profile.index')}}" class="submit ml-2 btn btn-secondary">Batal</a>
                            {{-- </div> --}}
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>

    <script>
        function updateFileNamePangkat(event) {
            var input = event.target;
            var label = document.getElementById("file-label-pangkat");
            var viewFileLink = document.getElementById("view-file-link-pangkat");

            label.textContent = input.files[0].name;
            viewFileLink.href = URL.createObjectURL(input.files[0]);
            viewFileLink.style.display = "inline";
        }
    </script>
@endsection
