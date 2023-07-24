@extends('layouts.datatable')
@section('datatable')
    <style>
        .rounded-div {
            border-radius: 10px;
            border: 1px solid #e5e5e5;
            padding: 10px;
            margin-bottom: 10px;
        }

        .center-div {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .foto {
            border-radius: 50%;
            width: 170px;
            /* Sesuaikan dengan lebar yang diinginkan */
            height: 170px;
            .
            /* Sesuaikan dengan tinggi yang diinginkan */
            object-fit: cover;
        }
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Profile Admin</h4>
                    </div>

                    <div class="p-md-4">
                        <div class="profile-photo center-div mt-2">
                            {{-- <a href="#" class="edit-avatar" data-toggle="modal" data-target="#modal"> --}}
                            <a href="{{ route('admin.profile.edit', $profile->encrypt_id) }}" class="edit-avatar">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <img src="/uploads/profile/{{ Auth::user()->profile_picture }}"
                                onerror="this.src='/uploads/profile/default.png';" class="foto" alt="Foto Profil" />
                        </div>
                        <p class="text-center text-dark font-14" style="font-weight: bold;">
                            {{ ucwords(auth()->user()->roles->pluck('name')->implode(', ')) }}
                        </p>

                        <div class="p-3 mb-2 bg-light text-dark rounded-div">
                            <div class="row">
                                <label class="col-md-3 bold"> <strong> Nama Admin</strong></label>
                                <div class="col-md-3">
                                    {{ $profile->nama_administrasi }}
                                </div>
                                <label class="col-md-3 bold"><b>Tanggal Lahir</b></label>
                                <div class="col-md-3" id="tanggal-lahir">
                                    {{ $profile->tanggal_lahir }}

                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><b>Nomor Induk Pegawai</b></label>
                                <div class="col-md-3">
                                    {{ $profile->nip }}
                                </div>
                                <label class="col-md-3 bold"><strong>Alamat</strong></label>
                                <div class="col-md-3">
                                    {{ $profile->alamat }}
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3 bold"> <strong>Status</strong></label>
                                <div class="col-md-3">
                                    {{ $profile->status }}
                                </div>
                                <label class="col-md-3 bold"><b>Email</b></label>
                                <div class="col-md-3">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>


                            <div class="row">
                                <label class="col-md-3 bold"><b>Nomor Telepon</b></label>
                                <div class="col-md-3">
                                    {{ $profile->no_hp }}
                                </div>

                                <label class="col-md-3 bold"> <strong> Umur </strong></label>
                                <div class="col-md-3" id="umur">
                                    {{ $umur }}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><b>Jenis Kelamin</b></label>
                                <div class="col-md-3">
                                    {{ $profile->jenis_kelamin }}
                                </div>

                                <label class="col-md-3 bold"> <strong> </strong></label>
                                <div class="col-md-3" id="umur">
                                </div>
                            </div>


                            <div class="row">
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
                        <h4 class="text-blue h4">KEPANGKATAN</h4>
                        <div class="d-flex">
                            <div class="ml-5">

                            </div>
                            <div class="ml-auto mb-3">
                                <a href="{{ route('admin.pangkat.create') }}" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Tambah
                                    Data</a>
                            </div>
                        </div>
                        <div class="pb-20 m-3">
                            <table class="table data-table-responsive stripe data-table-noexport nowrap ">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Nama Pangkat</td>
                                        <td>Tanggal Sk</td>
                                        <td>File SK</td>
                                        <th class="table-plus datatable-nosort">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pangkat as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->pangkat }}</td>
                                            <td>{{ $item->tgl_sk }}</td>
                                            <td><a target="_blank" href="/uploads/sk_pangkat_admin/{{ $item->file_sk }}">
                                                    Lihat</a>
                                            </td>
                                            <td>

                                                <div class="dropdown">
                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                        data-color="#1b3133" href="#" role="button"
                                                        data-toggle="dropdown">
                                                        <i class="dw dw-more"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.pangkat.edit', $item->encrypt_id) }}"><i
                                                                class="dw dw-edit2"></i> Edit</a>
                                                        <form id="delete"
                                                            action="{{ route('admin.pangkat.destroy', $item->encrypt_id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" id="deleteBtn"
                                                                class="dropdown-item text-danger"><i
                                                                    class="dw dw-delete-3"></i>
                                                                Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script>
            // Ambil elemen tanggal lahir dan umur dari HTML
            const tanggalLahir = document.getElementById('tanggal-lahir').textContent;
            const umur = document.getElementById('umur');

            // Hitung umur
            const tahunLahir = new Date(tanggalLahir).getFullYear();
            const tahunSekarang = new Date().getFullYear();
            const selisihTahun = tahunSekarang - tahunLahir;

            // Tentukan warna berdasarkan umur
            let warna;
            if (selisihTahun >= 20 && selisihTahun < 35) {
                warna = 'lightgreen'; // Hijau muda
            } else if (selisihTahun >= 35 && selisihTahun < 45) {
                warna = 'green'; // Hijau tua
            } else if (selisihTahun >= 45 && selisihTahun < 55) {
                warna = 'khaki'; // Kuning tua
            } else if (selisihTahun >= 55 && selisihTahun < 65) {
                warna = 'pink'; // Merah muda
            } else if (selisihTahun >= 65) {
                warna = 'red'; // Merah tua
            } else {
                warna = 'black'; // Warna default jika umur di luar rentang yang ditentukan
            }

            // Update teks dan latar belakang pada elemen HTML
            umur.textContent = `${selisihTahun} Tahun`;
            umur.style.background = warna;
            umur.style.color = 'white';
            umur.style.fontWeight = 'bold';
            umur.style.borderRadius = '10px';
            umur.style.textAlign = 'center';
        </script>
        <!-- Input Validation End -->
    @endsection
