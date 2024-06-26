@extends('layouts.admin')
@section('admin')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jquery-dateFormat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Daftar Sidang Tesis</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>
                    </div>
                    <form action="{{ route('mahasiswa.sidang.kompres2.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="profile-edit-list row">
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Rencana Periode Seminar</label>
                                    <input readonly class="form-control month-picker" type="text" name="periode_seminar"
                                        value="{{ old('periode_seminar') }}" id="periode_seminar"
                                        placeholder="Periode Seminar">
                                    @error('periode_seminar')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" id="form-mobile">
                                    <label class="weight-600">Persetujuan</label>
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" class="custom-control-input" name="agreement"
                                            id="agreement" />
                                        <label class="custom-control-label" for="agreement">
                                            Saya dengan ini menyatakan bahwa dokumen kelengkapan berkas yang telah saya
                                            kirimkan semuanya adalah benar dan dapat saya pertanggung-jawabkan. Saya
                                            bersedia menerima sanksi bilamana saya terbukti melakukan pemalsuan dokumen
                                            (seperti tanda tangan, Bukti Bayar UKT, Transkrip/KRS, dll) dengan ditunda
                                            seminar saya minimal 1 semester atau bahkan sanksi yang lebih berat hingga
                                            dikeluarkan (Drop Out).
                                        </label>
                                        @error('agreement')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="kanan weight-500 col-md-6">
                                <div class="form-group">
                                    <label>
                                        Draft Artikel
                                    </label>
                                    <div class="custom-file mb-1">
                                        <label class="custom-file-label" for="link-draft_artikel"
                                            id="label-draft_artikel">Pilih File</label>
                                        <input value="{{ old('draft_artikel') }}" accept=".pdf" name="draft_artikel"
                                            id="file-draft_artikel"
                                            class="custom-file-input form-control @error('draft_artikel') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file-draft_artikel','label-draft_artikel','link-draft_artikel')">
                                    </div>
                                    <small class="mt-2"> <a id="link-draft_artikel" href="#" target="_blank"
                                            style="display: none;">Lihat File</a> </small>
                                    @error('draft_artikel')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>
                                        Berkas Kelengkapan
                                        <small>
                                            <a target="_blank" href="/uploads/syarat_seminar/{{ $syarat->path_file }}">Lihat
                                                Persyaratan</a>
                                        </small>
                                    </label>
                                    <div class="custom-file mb-1">
                                        <label class="custom-file-label" for="link-berkas_kompre"
                                            id="label-berkas_kompre">Pilih File</label>
                                        <input value="{{ old('berkas_kompre') }}" accept=".pdf" name="berkas_kompre"
                                            id="file-berkas_kompre"
                                            class="custom-file-input form-control @error('berkas_kompre') form-control-danger @enderror"
                                            type="file" placeholder="FILE SK"
                                            onchange="updateFileNameAndLink('file-berkas_kompre','label-berkas_kompre','link-berkas_kompre')">
                                    </div>
                                    <small class="mt-2"> <a id="link-berkas_kompre" href="#" target="_blank"
                                            style="display: none;">Lihat File</a> </small>
                                    @error('berkas_kompre')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Link Artikel</label>
                                    <input autofocus name="url_draft_artikel" id="url_draft_artikel"
                                        class="form-control @error('url_draft_artikel') form-control-danger @enderror"
                                        type="text" value="{{ old('url_draft_artikel') }}"
                                        placeholder="Link Artikel">
                                    @error('url_draft_artikel')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary mt-4">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->
    </div>

    <script>
        var select = document.getElementById("tahun_akademik");
        var tahunSekarang = new Date().getFullYear();
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
