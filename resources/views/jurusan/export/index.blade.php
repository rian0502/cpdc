@extends('layouts.admin')
@section('admin')
    <style>
        .containerr {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
        }

        .card-box {
            min-height: 200px;
        }

        @media screen and (max-width: 767px) {
            .containerr {
                grid-template-columns: 1fr;
                /* Mengubah ke satu kolom saja */
            }
        }
    </style>
    <div class="main-container">

        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="title pb-20">
                <h2 class="h2 mb-0">Unduh Data</h2>
            </div>

            <div class="containerr">
                <div class="card-box">
                    <div class="pd-20">
                        <div class="h5 mb-0">LITABMAS</div>
                    </div>
                    <div class="name-avatar d-flex align-items-center pr-2">
                        <div class="weight-500 col-md-9" style="margin-left: 5px">
                            <div class="form-group">
                                <label>Penelitian</label>
                                <select class="custom-select2 form-control" name="tahun-penelitian" id="tahun-penelitian"
                                    style="width: 100%; height: 38px">
                                    <optgroup label="Tahun">
                                        <!-- menampilkan beberapa tahun kebelakang sesuai JS -->
                                    </optgroup>
                                </select>
                                @error('tahun-penelitian')
                                    <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Pengabdian</label>
                                <select class="custom-select2 form-control" name="tahun" id="tahun-pengabdian"
                                    style="width: 100%; height: 38px">
                                    <optgroup label="Tahun">
                                        <!-- menampilkan beberapa tahun kebelakang sesuai JS -->
                                    </optgroup>
                                </select>
                                @error('tahun-pengabdian')
                                    <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="weight-500 col-md-3">
                            <div class="form-group">
                                <div class="cta  d-flex align-items-center justify-content-end mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-primary">Unduh</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="cta  d-flex align-items-center justify-content-end mt-5"
                                    style="margin-bottom: -10px">
                                    <a href="#" class="btn btn-sm btn-outline-primary">Unduh</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-box" style="height:256px;">
                    <div class="pd-20">
                        <div class="h5 mb-0">Publikasi</div>
                    </div>
                    <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                        <div class="weight-500 col-md-9" style="margin-left: 5px">
                            <div class="form-group">
                                <label>Data Publikasi</label>
                                <select class="custom-select2 form-control" name="tahun-publikasi" id="tahun-publikasi"
                                    style="width: 100%; height: 38px">
                                    <optgroup label="Tahun">
                                        <!-- menampilkan beberapa tahun kebelakang sesuai JS -->
                                    </optgroup>
                                </select>
                                @error('tahun-publikasi')
                                    <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="weight-500 col-md-3">
                            <div class="form-group">
                                <div class="cta  d-flex align-items-center justify-content-end mt-4">
                                    <a href="#" class="btn btn-sm btn-outline-primary">Unduh</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-box" style="height:256px;">
                    <div class="pd-20">
                        <div class="h5 mb-0">Prestasi</div>
                    </div>
                    <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                        <div class="weight-500 col-md-9" style="margin-left: 5px">
                            <div class="form-group">
                                <label>Data Prestasi</label>
                                <select class="custom-select2 form-control" name="tahun-prestasi" id="tahun-prestasi"
                                    style="width: 100%; height: 38px">
                                    <optgroup label="Tahun">
                                        <!-- menampilkan beberapa tahun kebelakang sesuai JS -->
                                    </optgroup>
                                </select>
                                @error('tahun-presatasi')
                                    <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="weight-500 col-md-3">
                            <div class="form-group">
                                <div class="cta  d-flex align-items-center justify-content-end mt-4">
                                    <a href="#" class="btn btn-sm btn-outline-primary">Unduh</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-box" style="height:256px;">
                    <div class="pd-20">
                        <div class="h5 mb-0">Aktivitas</div>
                    </div>
                    <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                        <div class="weight-500 col-md-9" style="margin-left: 5px">
                            <div class="form-group">
                                <label>Data Aktivitas</label>
                                <select class="custom-select2 form-control" name="tahun-aktivitas" id="tahun-aktivitas"
                                    style="width: 100%; height: 38px">
                                    <optgroup label="Tahun">
                                        <!-- menampilkan beberapa tahun kebelakang sesuai JS -->
                                    </optgroup>
                                </select>
                                @error('tahun-aktivitas')
                                    <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="weight-500 col-md-3">
                            <div class="form-group">
                                <div class="cta  d-flex align-items-center justify-content-end mt-4">
                                    <a href="#" class="btn btn-sm btn-outline-primary">Unduh</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const currentYear = new Date().getFullYear();
        function populateSelect(selectId) {
            const selectElement = document.getElementById(selectId);
            for (let year = currentYear; year >= currentYear - 100; year--) {
                const option = document.createElement("option");
                option.text = year;
                option.value = year;
                selectElement.appendChild(option);
            }
            const selectedYear = localStorage.getItem(selectId);
            if (selectedYear) {
                selectElement.value = selectedYear;
            }

            selectElement.addEventListener("change", function() {
                localStorage.setItem(selectId, selectElement.value);
            });
        }
        populateSelect("tahun-penelitian");
        populateSelect("tahun-pengabdian");
        populateSelect("tahun-publikasi");
        populateSelect("tahun-prestasi");
        populateSelect("tahun-aktivitas");
    </script>
@endsection