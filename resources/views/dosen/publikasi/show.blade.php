@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4 mb-2">Detail Publikasi Dosen</h4>
                        </div>
                    </div>
                    <div class="table-responsive mb-2">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Volume</th>
                                    <th scope="col">Halaman</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Scala</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Kategori LITABMAS</th>
                                    <th scope="col">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col">{{ $publikasi->judul}}</th>
                                    <th scope="col">{{ $publikasi->vol}}</th>
                                    <th scope="col">{{ $publikasi->halaman}}</th>
                                    <th scope="col">{{ $publikasi->tahun}}</th>
                                    <th scope="col">{{ $publikasi->scala}}</th>
                                    <th scope="col">{{ $publikasi->kategori}}</th>
                                    <th scope="col">{{ $publikasi->kategori_litabmas}}</th>
                                    <th scope="col"><a href="{{ $publikasi->url}}" class="text-primary">Klik</a></th>

                                </tr>
                            </tbody>
                        </table>
                        <h4 class="text-dark h4 mb-2">
                            Daftar Anggota
                        </h4>
                        <table class="table table-striped mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Posisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggota as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <th scope="row">{{ $item->dosen->nama_dosen }}</th>
                                    <th scope="row">{{ $item->posisi }}</th>
                                 </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h4 class="text-dark h4 mb-2">
                            Anggota External
                        </h4>
                        <textarea name="form-control" disabled readonly>{{$publikasi->anggota_external}}</textarea>
                    </div>
                    <a href="{{ route('dosen.profile.index') }}">
                        <button class="btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
