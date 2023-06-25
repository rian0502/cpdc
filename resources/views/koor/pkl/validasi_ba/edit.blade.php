@extends('layouts.admin')
@section('admin')
    <style>
        .left {
            text-align: left;
        }

        .center {
            text-align: center;
        }

        .centered-text {
            text-align: left;
            display: inline-block;
        }

        a:hover {
            cursor: pointer;
        }

        .right {
            float: right;
        }
    </style>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <!-- jquery-dateFormat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Data Registrasi Start -->

                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Bukti Seminar</h4>
                            <small>
                                <b>
                                    <p
                                        class="mb-30 text-center
                                        {{-- {{ $seminar->proses_admin == 'Valid' ? 'Valid' : ($seminar->proses_admin == 'Proses' ? 'Proses' : 'Invalid') }} --}}
                                        ">
                                        {{-- {{ $seminar->proses_admin }} --}}
                                    </p>
                                </b>
                            </small>
                        </div>
                    </div>

                    <div class="bukti_seminar">
                        <div class="pl-3 pr-3 pb-0 mb-2 bg-light text-dark rounded-div">
                            <div class="row border-bottom">
                                <label class="col-md-3 bold"> <strong>Berita Acara Seminar</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a href="/uploads/berita_acara_seminar_kp/{{ $seminar->berita_acara->berkas_ba_seminar_kp }}"
                                        target="_blank">Lihat</a>
                                </div>
                                <label class="col-md-3 bold mt-2"><b>Tanggal Seminar</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->jadwal->tanggal_skp }}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Laporan Final PKL/KP</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a href="/uploads/laporan_kp/{{ $seminar->berita_acara->laporan_kp }}"
                                        target="_blank">Lihat</a>
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Status Bukti</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->proses_admin }}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Nilai Lapangan</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->berita_acara->nilai_lapangan }}
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Nilai Akademik</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->berita_acara->nilai_akd }}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Nilai Total</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->berita_acara->nilai_akhir }}
                                </div>
                                <label class="col-md-3 bold mt-1"><strong>Nilai Mutu</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->berita_acara->nilai_mutu }}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Nomor Surat Berita Acara</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->berita_acara->no_ba_seminar_kp }}
                                </div>
                            </div>

                            <form id="formStatus" action="{{ route('koor.validasiBaPKL.update', $seminar->encrypt_id) }}"
                                method="post">
                                @method('put')
                                @csrf
                                <div class="form-group" style="margin-top: 20px">
                                    <label><b>Status Seminar</b></label>
                                    <select name="status_seminar" id="status" class="selectpicker form-control"
                                        data-size="5">
                                        <option value="Belum Selesai"
                                            {{ $seminar->status_seminar == 'Belum Selesai' ? 'selected' : '' }}>Belum
                                            Selesai
                                        </option>
                                        <option value="Selesai"
                                            {{ $seminar->status_seminar == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    @error('status_seminar')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row border-bottom mt-3">
                                    <label class="col-md-12 bold"><b>Catatan</b></label>
                                    <textarea id="catatan" name="keterangan" class="form-control m-3" style="height: 100px;">{{ $seminar->keterangan }}</textarea>
                                    @error('keterangan')
                                        <div class="form-control-feedback has-danger col-md-12 mb-3">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="submitButton" class="submit btn btn-primary">Submit</button>
                                </div>
                            </form>

                            <a href="{{ route('koor.validasiBaPKL.index') }}">
                                <button class="batal btn btn-secondary">Batal</button>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Data Registrasi End -->

            </div>
        </div>
        <!-- Input Validation End -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js"></script>
@endsection
