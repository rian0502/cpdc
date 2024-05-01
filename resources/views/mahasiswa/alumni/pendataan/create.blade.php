@extends('layouts.admin')
@section('admin')
    <style>
        .right {
            float: right;
        }
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jquery-dateFormat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px" >
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box" >
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Pendatan Alumni</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('mahasiswa.pendataan_alumni.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Tahun Akademik</label>
                                    <select id="tahun_akademik" class="selectpicker form-control" data-size="5"
                                        name="tahun_akademik">
                                    </select>
                                    @error('tahun_akademik')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>SKS Akhir</label>
                                    <input autofocus name="sks" id="jumlah_sks" class="form-control" type="number"
                                        value="{{ old('sks') }}" value="{{ old('sks') }}"
                                        placeholder="Jumlah SKS Saat Ini">
                                    @error('sks')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>IPK</label>
                                    <input autofocus name="ipk" id="ipk" class="form-control" type="text"
                                        value="{{ old('ipk') }}" value="{{ old('ipk') }}" placeholder="Contoh : 3.55">
                                    @error('ipk')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                               
                                <div class="form-group">
                                    <label>
                                        Lembar Pengesahan
                                    </label>
                                    <div class="custom-file mb-1">
                                        <label class="custom-file-label" for="link-berkas_pengesahan"
                                            id="label-berkas_pengesahan">Pilih File</label>
                                        <input value="{{ old('berkas_pengesahan') }}" accept=".pdf" autofocus
                                            name="berkas_pengesahan" id="file-berkas_pengesahan"
                                            class="custom-file-input form-control @error('berkas_pengesahan') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file-berkas_pengesahan','label-berkas_pengesahan','link-berkas_pengesahan')">
                                    </div>
                                    <small class="mt-2"> <a id="link-berkas_pengesahan" href="#" target="_blank"
                                            style="display: none;">Lihat File</a> </small>
                                    @error('berkas_pengesahan')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- form untuk sebelah kanan --}}
                            <div class="kanan weight-500 col-md-6">


                                <div class="form-group">
                                    <label>Periode Wisuda</label>
                                    <input class="form-control month-picker" type="text" name="periode_wisuda"
                                        value="{{ old('periode_wisuda') }}" value="{{ old('periode_wisuda') }}"
                                        id="periode_wisuda" placeholder="Periode Wisuda">
                                    @error('periode_wisuda')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>TOEFL</label>
                                    <input autofocus name="toefl" id="toefl" class="form-control" type="number"
                                        value="{{ old('toefl') }}" min="0" value="{{ old('toefl') }}"
                                        placeholder="Nilai TOEFL">
                                    @error('toefl')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>
                                        Transkrip
                                    </label>
                                    <div class="custom-file mb-1">
                                        <label class="custom-file-label" for="link-transkrip" id="label-transkrip">Pilih
                                            File</label>
                                        <input value="{{ old('transkrip') }}" accept=".pdf" autofocus name="transkrip"
                                            id="file-transkrip"
                                            class="custom-file-input form-control @error('transkrip') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file-transkrip','label-transkrip','link-transkrip')">
                                    </div>
                                    <small class="mt-2"> <a id="link-transkrip" href="#" target="_blank"
                                            style="display: none;">Lihat File</a> </small>
                                    @error('transkrip')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>
                                        Berkas TOEFL
                                    </label>
                                    <div class="custom-file mb-1">
                                        <label class="custom-file-label" for="link-berkas_toefl"
                                            id="label-berkas_toefl">Pilih File</label>
                                        <input value="{{ old('berkas_toefl') }}" accept=".pdf" autofocus
                                            name="berkas_toefl" id="file-berkas_toefl"
                                            class="custom-file-input form-control @error('berkas_toefl') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file-berkas_toefl','label-berkas_toefl','link-berkas_toefl')">
                                    </div>
                                    <small class="mt-2"> <a id="link-berkas_toefl" href="#" target="_blank"
                                            style="display: none;">Lihat File</a> </small>
                                    @error('berkas_toefl')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class=" btn btn-primary mt-4">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->
    </div>



    <script>
        // Mendapatkan elemen select
        var select = document.getElementById("tahun_akademik");

        // Mendapatkan tahun saat ini
        var tahunSekarang = new Date().getFullYear();

        // Loop untuk menghasilkan 5 tahun ke belakang
        for (var i = 0; i < 5; i++) {
            var tahun = tahunSekarang - i;
            var option = document.createElement("option");
            option.value = tahun + "/" + (tahun + 1);
            option.text = tahun + "/" + (tahun + 1);
            select.add(option);
        }
    </script>
    <script>
        @if (old('pbl2_nama'))
            toggleInput(document.getElementById('id_pembimbing_dua'), 'Pembimbing2')
        @endif
    </script>
@endsection
