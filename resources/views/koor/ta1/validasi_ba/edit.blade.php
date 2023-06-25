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
                                <label class="col-md-3 bold"> <strong>Bukti Seminar</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a target="_blank"
                                        href="/uploads/ba_seminar_ta_satu/{{ $seminar->ba_seminar->berkas_ba_seminar_ta_satu }}">Lihat</a>
                                </div>
                                <label class="col-md-3 bold mt-2"><b>Nomor Bukti Seminar</b></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->ba_seminar->no_berkas_ba_seminar_ta_satu }}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Bukti Nilai Seminar</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a target="_blank"
                                        href="/uploads/nilai_seminar_ta_satu/{{ $seminar->ba_seminar->berkas_nilai_seminar_ta_satu }}">Lihat</a>
                                </div>
                                <label class="col-md-3 bold"> <strong>Huruf Mutu</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->ba_seminar->huruf_mutu }}
                                </div>
                            </div>
                            <div class="row border-bottom mt-2">
                                <label class="col-md-3 bold"> <strong>Power Point</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    <a target="_blank"
                                        href="{{ $seminar->ba_seminar->berkas_ppt_seminar_ta_satu }}">Lihat</a>
                                </div>
                                <label class="col-md-3 bold"> <strong>Nilai</strong></label>
                                <div class="col-md-3" style="display:block;word-wrap:break-word;">
                                    {{ $seminar->ba_seminar->nilai }}
                                </div>
                            </div>

                            <form id="formStatus" action="{{ route('koor.validasiBaTA1.update', $seminar->encrypt_id) }}"
                                method="post">
                                @method('put')
                                @csrf
                                <div class="form-group" style="margin-top: 20px">
                                    <label><b>Status Seminar</b></label>
                                    <select name="status_koor" id="status" class="selectpicker form-control"
                                        onchange="toggleCatatan()" data-size="5">
                                        <option value="Belum Selesai"
                                            {{ $seminar->status_koor == 'Belum Selesai' ? 'selected' : '' }}>Belum
                                            Selesai
                                        </option>
                                        <option value="Perbaikan"
                                            {{ $seminar->status_koor == 'Perbaikan' ? 'selected' : '' }}>Perbaikan
                                        </option>
                                        <option value="Selesai" {{ $seminar->status_koor == 'Selesai' ? 'selected' : '' }}>
                                            Selesai</option>
                                        <option value="Tidak Lulus"
                                            {{ $seminar->status_koor == 'Tidak Lulus' ? 'selected' : '' }}>Tidak Lulus
                                        </option>
                                    </select>
                                    @error('status_seminar')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row border-bottom mt-3">
                                    <label class="col-md-12 bold"><b>Catatan</b></label>
                                    <textarea id="catatan" name="keterangan" class="form-control m-3" style="height: 100px;">{{ old('keterangan', $seminar->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
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
