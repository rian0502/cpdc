@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">History</h4>
                        <a href="{{route('lab.barang.history.create')}}">
                            <button class="btn btn-success mt-3">
                                <i class="icon-copy fi-page-add"></i>
                                Tambah Data
                            </button>
                        </a>
                    </div>
                    <div class="pb-20">
                        <table class="table data-table-responsive stripe data-table-export nowrap ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jumlah Barang</th>
                                    <th>ID Barang</th>
                                    <th>Keterangan</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $count = 1;
                                @endphp

                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>Piala</td>
                                    <td>Piala</td>
                                    <td>Piala</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                                            <a href="#" data-color="#e95959"><i
                                                    class="icon-copy dw dw-delete-3"></i></a>
                                        </div>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Input Validation End -->
@endsection
