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
                    <form action="{{ route('admin.pangkat.update', $pangkat->encrypt_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label for="kepangkatan">PANGKAT</label>
                                    <select name="kepangkatan" style="width: 100%; height: 38px" id="kepangkatan"
                                        class="selectpicker form-control @error('kepangkatan') form-control-danger @enderror">
                                        <option value="I A" {{ $pangkat->pangkat == 'I A' ? 'selected' : '' }}>I A
                                        </option>
                                        <option value="I B" {{ $pangkat->pangkat == 'I B' ? 'selected' : '' }}>I B
                                        </option>
                                        <option value="I C" {{ $pangkat->pangkat == 'I C' ? 'selected' : '' }}>I C
                                        </option>
                                        <option value="I D" {{ $pangkat->pangkat == 'I D' ? 'selected' : '' }}>I D
                                        </option>
                                        <option value="II A" {{ $pangkat->pangkat == 'II A' ? 'selected' : '' }}>II A
                                        </option>
                                        <option value="II B" {{ $pangkat->pangkat == 'II B' ? 'selected' : '' }}>II B
                                        </option>
                                        <option value="II C" {{ $pangkat->pangkat == 'II C' ? 'selected' : '' }}>II C
                                        </option>
                                        <option value="II D" {{ $pangkat->pangkat == 'II D' ? 'selected' : '' }}>II D
                                        </option>
                                        <option value="III A" {{ $pangkat->pangkat == 'III A' ? 'selected' : '' }}>III A
                                        </option>
                                        <option value="III B" {{ $pangkat->pangkat == 'III B' ? 'selected' : '' }}>III B
                                        </option>
                                        <option value="III C" {{ $pangkat->pangkat == 'III C' ? 'selected' : '' }}>III C
                                        </option>
                                        <option value="III D" {{ $pangkat->pangkat == 'III D' ? 'selected' : '' }}>III D
                                        </option>
                                        <option value="IV A" {{ $pangkat->pangkat == 'IV A' ? 'selected' : '' }}>IV A
                                        </option>
                                        <option value="IV B" {{ $pangkat->pangkat == 'IV B' ? 'selected' : '' }}>IV B
                                        </option>
                                        <option value="IV C" {{ $pangkat->pangkat == 'IV C' ? 'selected' : '' }}>IV C
                                        </option>
                                        <option value="IV D" {{ $pangkat->pangkat == 'IV D' ? 'selected' : '' }}>IV D
                                        </option>
                                        <option value="IV E" {{ $pangkat->pangkat == 'IV E' ? 'selected' : '' }}>IV E
                                        </option>
                                    </select>
                                    @error('kepangkatan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>TANGGAL SK PANGKAT</label>
                                    <input value="{{ $pangkat->tgl_sk }}" autofocus name="tgl_sk" id="tgl_sk"
                                        class="form-control @error('tgl_sk') form-control-danger @enderror" type="date"
                                        placeholder="TANGGAL SK">
                                    @error('tgl_sk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>FILE SK PANGKAT <small> <a id="view-file-link-pangkat" href="#"
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

                            <button type="submit" class="submit btn btn-primary">Submit</button>
                            <a href="{{ route('admin.profile.index') }}" class="submit ml-2 btn btn-secondary">Batal</a>
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
