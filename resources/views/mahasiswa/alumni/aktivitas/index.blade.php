@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="title">
                                <h4 class="d-flex justify-content-between align-items-center">
                                    Aktivitas Alumni
                                    <a href="{{ route('mahasiswa.aktivitas_alumni.create') }}">
                                        <button class="btn btn-primary">Tambah Aktivitas</button>
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container pd-0">
                    <div class="timeline mb-30">
                        <ul>
                            {{-- BAGIAN SINI ENTAR YANG DI LOOP --}}

                            @foreach ($aktivitas as $item)
                                <li>
                                    <div class="timeline-date">
                                        {{ $carbon::parse($item->tahun_masuk)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                    </div>
                                    <div class="timeline-desc card-box">
                                        <div class="pd-20">
                                            <dl>
                                                <dt class="d-flex align-items-start mb-2">
                                                    <h3><i class="fas fa-solid fa-building mr-3 mt-1" data-toggle="tooltip"
                                                            title="Nama Tempat/Universitas"></i></h3>
                                                    <h3>{{ $item->tempat }}</h3>
                                                </dt>
                                                <dd class="d-flex align-items-start ml-3">
                                                    <i class="fa fa-solid fa-location-dot mr-3 mt-1" data-toggle="tooltip"
                                                        title="Lokasi"></i>
                                                    <div>{{ $item->alamat }}</div>
                                                </dd>
                                                <dd class="d-flex align-items-start ml-3">
                                                    <i class="fa fa-user-tie-hair mr-3 mt-1" data-toggle="tooltip"
                                                        title="Posisi/Jabatan"></i>
                                                    <div>{{ $item->jabatan }}</div>
                                                </dd>
                                                <dd class="d-flex align-items-start ml-3">
                                                    <i class="fa fa-link mr-3 mt-1" data-toggle="tooltip"
                                                        title="Hubungan"></i>
                                                    <div>{{ $item->hubungan }}</div>
                                                </dd>
                                                <dd class="d-flex align-items-start ml-3">
                                                    <i class="fa-solid fa-rupiah-sign mr-3 mt-1" data-toggle="tooltip"
                                                        title="Gaji"></i>
                                                    <div class="gaji">{{ $item->gaji }}</div>
                                                </dd>
                                                <dd class="d-flex align-items-start ml-3">
                                                    <i class="fa-solid fa-user-tag mr-3 mt-1" data-toggle="tooltip"
                                                        title="Status"></i>
                                                    <div>{{ $item->status }}</div>
                                                </dd>
                                                <dt class="d-flex justify-content-end">
                                                    <div class="dropdown">
                                                        <a class="btn btn-outline-primary dropdown-toggle" href="#"
                                                            role="button" data-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                                href="{{ route('mahasiswa.aktivitas_alumni.edit', $item->encrypted_id) }}"><i
                                                                    class="fa fa-pencil"></i> Edit</a>
                                                            <form id="delete"
                                                                action="{{ route('mahasiswa.aktivitas_alumni.destroy', $item->encrypted_id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" id="deleteBtn"
                                                                    class="dropdown-item text-danger"><i
                                                                        class="fa fa-trash"></i>
                                                                    Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </dt>
                                            </dl>
                                        </div>
                                    </div>
                                </li>
                            @endforeach



                            {{-- DISINI END FOREACHNYA --}}

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function formatUang(angka) {
            return angka.toLocaleString('id-ID');
        }

        document.addEventListener("DOMContentLoaded", function() {
            var gajiElements = document.querySelectorAll(".gaji");
            gajiElements.forEach(function(element) {
                var gaji = parseInt(element.textContent);
                element.textContent = formatUang(gaji);
            });
        });
    </script>
@endsection
