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

            }
        }
    </style>
    <div class="main-container">

        <div class="xs-pd-20-10 pd-ltr-20">
            <div class="title pb-20">
                <h2 class="h2 mb-0">Unduh Data Lainnya</h2>
            </div>

            <div class="containerr">
                <div class="card-box">
                    <div class="pd-20">
                        <div class="h5 mb-0">Inventaris</div>
                    </div>
                    <form action="{{ route('jurusan.unduh.data.inventaris.index') }}" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="name-avatar d-flex align-items-center pr-2 mt-2">
                            <div class="weight-500 col-md-9" style="margin-left: 5px">
                                <div class="form-group">
                                    <label>Data Inventaris</label>
                                        <div class="form-group">
                                            <div class="cta  d-flex align-items-left justify-content-start">
                                                <button class="btn btn-sm btn-outline-primary">Unduh</button>
                                            </div>
                                        </div>
                                    @error('tahun_Inventaris')
                                        <div class="form-control-feedback has-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
