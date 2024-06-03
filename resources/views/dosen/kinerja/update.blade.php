@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Update Organisasi</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                            @if ($errors->has('validation_error'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('validation_error') }}
                                </div>
                            @endif

                        </div>
                    </div>
                    <form action="{{ route('dosen.kinerja.update', $kinerja->encrypted_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Semester</label>
                                    <select name="semester" id="semester" class="selectpicker form-control" data-size="5"
                                        name="semester">
                                        <option value="Ganjil"
                                            {{ old('semester', $kinerja->semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil
                                        </option>
                                        <option value="Genap"
                                            {{ old('semester', $kinerja->semester) == 'Ganjil' ? '' : 'selected' }}>Genap
                                        </option>
                                    </select>
                                    @error('semester')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tahun Akademik</label>
                                    <select id="tahunAkademik" class="selectpicker form-control" data-size="5"
                                        name="tahun_akademik">
                                    </select>
                                    @error('tahun_akademik')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select name="kategori" id="kategori" class="selectpicker form-control">
                                        <option value="BKD"
                                            {{ old('kategori', $kinerja->kategori) == 'BKD' ? 'selected' : '' }}>
                                            BKD</option>
                                        <option value="Remunerasi"
                                            {{ old('kategori', $kinerja->kategori) == 'Remunerasi' ? 'selected' : '' }}>
                                            Remunerasi</option>
                                    </select>
                                    @error('kategori')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>SKS Pendidikan</label>
                                    <input value="{{ old('sks_pendidikan', $kinerja->sks_pendidikan) }}" autofocus
                                        name="sks_pendidikan" id="sks_pendidikan"
                                        class="form-control @error('sks_pendidikan') form-control-danger @enderror"
                                        type="number" placeholder="SKS Pendidikan" step="0.01" min="0">
                                    @error('sks_pendidikan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>SKS Penelitian</label>
                                    <input value="{{ old('sks_penelitian', $kinerja->sks_penelitian) }}" autofocus
                                        name="sks_penelitian" id="sks_penelitian"
                                        class="form-control @error('sks_penelitian') form-control-danger @enderror"
                                        type="number" placeholder="SKS Penelitian" step="0.01" min="0">
                                    @error('sks_penelitian')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>SKS Pengabdian</label>
                                    <input value="{{ old('sks_penelitian', $kinerja->sks_penelitian) }}" autofocus
                                        name="sks_pengabdian" id="sks_pengabdian"
                                        class="form-control @error('sks_pengabdian') form-control-danger @enderror"
                                        type="number" placeholder="SKS Pengabdian" step="0.01" min="0">
                                    @error('sks_pengabdian')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>SKS Penunjang</label>
                                    <input value="{{ old('sks_penelitian', $kinerja->sks_penelitian) }}" autofocus
                                        name="sks_penunjang" id="sks_penunjang"
                                        class="form-control @error('sks_penunjang') form-control-danger @enderror"
                                        type="number" placeholder="SKS Pengabdian" step="0.01" min="0">
                                    @error('sks_penunjang')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Kirim</button>
                        </div>

                    </form>
                    <a href="{{ route('dosen.kinerja.index') }}">
                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
    <script>
        // Mendapatkan elemen select
        var select = document.getElementById("tahunAkademik");

        // Mendapatkan tahun saat ini
        var tahunSekarang = new Date().getFullYear();

        // Loop untuk menghasilkan 5 tahun ke belakang
        for (var i = 0; i < 10; i++) {
            var tahun = tahunSekarang - i;
            var option = document.createElement("option");
            option.value = tahun + "/" + (tahun + 1);
            option.text = tahun + "/" + (tahun + 1);

            // Set selected attribute if the value matches $kinerja->tahun_akademik
            if (option.value === "{{ $kinerja->tahun_akademik }}") {
                option.selected = true;
            }

            select.add(option);
        }

        var myButton = document.getElementById("submitButton");

        myButton.addEventListener("click", function() {
            myButton.classList.add("btn-pulse");

            setTimeout(function() {
                myButton.classList.remove("btn-pulse");
            }, 500);
        });
    </script>
@endsection
