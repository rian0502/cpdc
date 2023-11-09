@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Unggah Data Mahasiswa</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <form action="{{ route('sudo.import.mahasiswa.store') }}" method="post" id="formStatus" enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file mb-1">
                                <label class="custom-file-label" for="link-data_mahasiswa" id="label-data_mahasiswa">Pilih
                                    File</label>
                                <input value="{{ old('data_mahasiswa') }}" accept=".xlsx" autofocus name="data_mahasiswa"
                                    id="file-data_mahasiswa"
                                    class="custom-file-input form-control @error('data_mahasiswa') form-control-danger @enderror"
                                    type="file" placeholder="FILE SK"
                                    onchange="updateFileNameAndLink('file-data_mahasiswa','label-data_mahasiswa','link-data_mahasiswa')">
                            </div>
                            <small class="mt-2"> <a id="link-data_mahasiswa" href="#" target="_blank"
                                    style="display: none;">Lihat File</a> </small>
                            @error('data_mahasiswa')
                                <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <button class="submit btn btn-primary" value="submit" id="submitButton">Kirim</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
