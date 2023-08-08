@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Validasi Berita Acara Seminar Tugas Akhir 1</h4>
                    </div>
                    <div class="pb-20 m-3">

                        <table class="table data-table-responsive stripe data-table-export">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPM</th>
                                    <th>Judul</th>
                                    <th>No Surat</th>
                                    <th>Status</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($berkas as $item)
                                    {{-- LOKASI TANGGAL JAM MULAI SELESAI MISAL BLM TERJADWAL MAKA OUTPUTIN KONDISIIN TULUSANNYA BLM TERJADWAL --}}
                                    @if ($item->jadwal && $item->ba_seminar)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                    
                                            <td>
                                                {{ $item->mahasiswa->npm }}
                                            </td>
                                            <td>
                                                {{ $item->judul_ta }}
                                            </td>
                                            <td>
                                                {{ $item->ba_seminar->no_berkas_ba_seminar_ta_satu }}
                                            </td>
                                            <td>
                                                {{ $item->status_koor }}
                                            </td>
                                            <td>
                                                <a class="btn btn-warning"
                                                    href="
                                                        {{ route('koor.validasiBaTA1.edit', $item->encrypt_id) }}
                                                        "><i
                                                        class="bi bi-pencil-square"></i>
                                                    Validasi</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
