@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Detail LITABMAS</h4>
                        </div>
                    </div>
                    <div class="table-responsive mb-2">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Sumber Dana</th>
                                    <th scope="col">Jumlah Dana</th>
                                    <th scope="col">Tahun Kegiatan</th>
                                    <th scope="col">Url Dokumentasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">{{ $litabmas->nama_litabmas }}</th>
                                    <th scope="row">{{ $litabmas->kategori }}</th>
                                    <th scope="row">{{ $litabmas->sumber_dana }}</th>
                                    <th scope="row">Rp. {{ number_format($litabmas->jumlah_dana, 0, ',', '.') }}</th>
                                    <th scope="row">{{ $litabmas->tahun_penelitian }}</th>
                                    <th scope="col"><a href="{{ $litabmas->url }}" class="text-primary">Klik</a></th>
                                </tr>
                            </tbody>
                        </table>
                        <h4>
                            Anggota
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
                                @foreach ($dosen as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <th scope="row">{{ $item->dosen->nama_dosen }}</th>
                                        <th scope="row">{{ $item->Posisi }}</th>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{-- @if ($litabmas->anggota_dosen != null) --}}
                            <h4 class="text-dark h4 mb-2">
                                Anggota Dosen Lainnya Yang Berkolaborasi
                            </h4>
                            <textarea name="form-control" disabled readonly rows="10" cols="50" style="height: 200px; width: 500px;">{{ $litabmas->anggota_dosen }}</textarea>

                        {{-- @endif --}}
                        {{-- @if ($litabmas->anggota_mahasiswa != null) --}}
                            <h4 class="text-dark h4 mb-2">
                                Anggota Mahasiswa Lainnya Yang Berkolaborasi
                            </h4>
                            <textarea name="form-control" disabled readonly rows="10" cols="50" style="height: 200px; width: 500px;">{{ $litabmas->anggota_mahasiswa }}</textarea>
                        {{-- @endif --}}
                    </div>
                    <a class="" href="{{ route('dosen.litabmas.index') }}">
                        <button class="btn btn-secondary">Kembali</button>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
