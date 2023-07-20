@extends('layouts.datatable')
@section('datatable')
    <style>
        .rounded-div {
            border-radius: 10px;
            border: 1px solid #e5e5e5;
            padding: 10px;
            margin-bottom: 10px;
        }
        .right-button{
            float: right;
            margin-top: -25px;
        }
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Detail Barang</h4>
                        <a href="{{ route('lab.barang.index') }}">
                            <button class="btn btn-primary right-button">Kembali</button>
                        </a>
                    </div>
                    <div class="p-md-4">

                        <div class="p-3 mb-2 bg-light text-dark rounded-div">
                            <div class="row">
                                <label class="col-md-3 bold"> <strong> Nama Barang</strong></label>
                                <div class="col-md-3">{{ $barang->nama_barang }}</div>
                                <label class="col-md-3 bold"><b>Gedung / Lantai</b></label>
                                <div class="col-md-3">
                                    {{ $barang->lokasi->nama_gedung . ' / Lt-' . $barang->lokasi->lantai_tingkat }}</div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><b>Kategori</b></label>
                                <div class="col-md-3">{{ $barang->modelBarang->kategori->nama_kategori }}</div>
                                <label class="col-md-3 bold"> <strong> Lokasi</strong></label>
                                <div class="col-md-3">{{ $barang->lokasi->nama_lokasi }}</div>
                            </div>

                            <div class="row">
                                <label class="col-md-3 bold"><b>Model</b></label>
                                <div class="col-md-3">{{ $barang->modelBarang->nama_model }}</div>
                                <label class="col-md-3 bold"> <strong> Jumlah Barang</strong></label>
                                <div class="col-md-3">{{ $barang->jumlah_akhir }}</div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"> <strong> Merek</strong></label>
                                <div class="col-md-3">{{ $barang->modelBarang->merk }}</div>
                                <label class="col-md-3 bold"><b>Diperbarui</b></label>
                                <div class="col-md-3">{{ $carbon::parse($barang->updated_at)->format('d F Y') }}</div>
                            </div>
                        </div>
                        <style type="text/css">
                            a:hover {
                                cursor: pointer;
                            }
                        </style>
                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Histories Barang</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export nowrap ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Diubah</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $carbon::parse($item->updated_at)->format('d F Y') }}</td>
                                        <td>{{ $item->jumlah_awal }}</td>
                                        <td>{{ $item->ket }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Input Validation End -->
@endsection
