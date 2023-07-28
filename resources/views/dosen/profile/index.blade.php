@extends('layouts.datatable')
@section('datatable')
    <style>
        @media(max-width:767px) {
            .nav-tabs {
                display: flex !important;
                flex-wrap: nowrap;
                /* font-size: 50%; */
            }

            .nav-tabs .nav-item {
                width: 50%;
                font-size: 70%;
            }

            .tabbable .nav-tabs {
                overflow-x: auto;
                overflow-y: hidden;
                flex-wrap: nowrap;
            }

            .tabbable .nav-tabs .nav-link {
                white-space: nowrap;
            }

            .scrollable {
                overflow-x: auto;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
                /* enable momentum scrolling on iOS devices */
            }

        }

        .foto {
            border-radius: 50%;
            width: 170px;
            /* Sesuaikan dengan lebar yang diinginkan */
            height: 170px;
            /* Sesuaikan dengan tinggi yang diinginkan */
            object-fit: cover;
        }
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="title">
                                <h4>Profile</h4>
                            </div>
                            <div class="col-md-12 col-sm-12 d-flex align-items-center justify-content-between">
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="index.html">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Profile
                                        </li>
                                    </ol>
                                </nav>
                                <div class="text-right">
                                    <a href="cv" target="_blank">
                                        <button class="btn btn-primary mt-3">
                                            <i class="bi bi-file-earmark-pdf-fill"></i>
                                            Unduh CV
                                        </button>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <div class="profile-photo mt-2">

                                {{-- <a href="#" class="edit-avatar" data-toggle="modal" data-target="#modal"> --}}
                                <a href="{{ route('dosen.profile.edit', Auth::user()->dosen->nip) }}" class="edit-avatar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <img src="/uploads/profile/{{ Auth::user()->profile_picture }}"
                                    onerror="this.src='/uploads/profile/default.png';" class="foto" alt="Foto Profil" />
                            </div>
                            <h5 class="text-center h5 mb-0">{{ Auth::user()->dosen->nama_dosen }}</h5>
                            <p class="text-center text-muted font-14">
                                {{ ucwords(auth()->user()->roles->pluck('name')->implode(', ')) }} <br>
                                NIP. {{ Auth::user()->dosen->nip }}
                            </p>
                            <div class="profile-info">
                                <h5 class="mb-20 h5 text-blue">Biodata</h5>
                                <ul>
                                    <li>
                                        <span>NIDN:</span>
                                        {{ Auth::user()->dosen->nidn }}
                                    </li>
                                    <li>
                                        <span>Tempat Lahir:</span>
                                        {{ Auth::user()->dosen->tempat_lahir }}
                                    </li>
                                    <li>
                                        <span>Tanggal Lahir:</span>
                                        <div id="tanggal-lahir">

                                            {{ Auth::user()->dosen->tanggal_lahir }}

                                        </div>
                                    </li>
                                    <li>
                                        <span>Umur:</span>
                                        <div id="umur">
                                            {{ $umur }}
                                        </div>
                                    </li>
                                    <li>
                                        <span>Jenis Kelamin:</span>
                                        {{ Auth::user()->dosen->jenis_kelamin }}
                                    </li>
                                    <li>
                                        <span>Status:</span>
                                        {{ Auth::user()->dosen->status }}
                                    </li>
                                    <li>
                                        <span>Email:</span>
                                        {{ Auth::user()->email }}
                                    </li>
                                    <li>
                                        <span>Nomor Telepon:</span>
                                        {{ Auth::user()->dosen->no_hp }}
                                    </li>
                                    <li>
                                        <span>Alamat:</span>
                                        {{ Auth::user()->dosen->alamat }}
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                        <div class="card-box height-100-p overflow-hidden">
                            <div class="profile-tab height-100-p">
                                <div class="tab height-100-p">
                                    <div class="scrollable">
                                        <ul class="nav nav-tabs customtab" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#publikasi"
                                                    role="tab">Publikasi</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#jabatan"
                                                    role="tab">Jabatan</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#pangkat"
                                                    role="tab">Pangkat</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#gelar"
                                                    role="tab">Gelar</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content">
                                       
                                        <!-- Tasks Tab End -->
                                        <!-- Setting Tab start -->
                                        <div class="tab-pane fade" id="publikasi" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="">
                                                    <!-- Open Task start -->
                                                    <div class="task-title row align-items-center">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Data Publikasi</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="{{ route('dosen.publikasi.create') }}"
                                                                class="bg-light-blue btn text-blue weight-500"><i
                                                                    class="ion-plus-round"></i> Tambah</a>
                                                        </div>
                                                    </div>
                                                    <div class="profile-task-list pb-30 table-responsive">
                                                        <table
                                                            class="table data-table-responsive stripe data-table-export">
                                                            <thead>
                                                                <tr>
                                                                    <td>No</td>
                                                                    <td class="max-w-md">Judul</td>
                                                                    <td>Tahun</td>
                                                                    <td>Scala</td>
                                                                    <td>Kategori</td>
                                                                    <td>Litabmas</td>
                                                                    <th class="table-plus datatable-nosort">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @foreach (Auth::user()->dosen->publikasi as $item)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td class="text-break max-w-md text-left">
                                                                            {{ $item->judul }}</td>
                                                                        <td>{{ $item->tahun }}</td>
                                                                        <td>{{ $item->scala }}</td>
                                                                        <td>{{ $item->kategori }}</td>
                                                                        <td>{{ $item->kategori_litabmas }}</td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                                                    data-color="#1b3133" href="#"
                                                                                    role="button" data-toggle="dropdown">
                                                                                    <i class="dw dw-more"></i>
                                                                                </a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('dosen.publikasi.show', $item->encrypt_id) }}"><i
                                                                                            class="dw dw-eye"></i>
                                                                                        Lihat</a>
                                                                                    @if ($item->anggotaPublikasi[0]->id_dosen == Auth::user()->dosen->id)
                                                                                        <a class="dropdown-item"
                                                                                            href="{{ route('dosen.publikasi.edit', $item->encrypt_id) }}"><i
                                                                                                class="dw dw-edit2"></i>
                                                                                            Edit</a>
                                                                                        <form class="deleteForm2"
                                                                                            action="{{ route('dosen.publikasi.destroy', $item->encrypt_id) }}"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <button type="button"
                                                                                                class="dropdown-item text-danger deleteBtn2"
                                                                                                onclick="showDeleteConfirmation(event)"><i
                                                                                                    class="dw dw-delete-3"></i>
                                                                                                Hapus</button>
                                                                                        </form>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Open Task End -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade show active" id="jabatan" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="">
                                                    <!-- Open Task start -->
                                                    <div class="task-title row align-items-center">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Data Jabatan</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="{{ route('dosen.jabatan.create') }}"
                                                                class="bg-light-blue btn text-blue weight-500"><i
                                                                    class="ion-plus-round"></i> Tambah</a>
                                                        </div>
                                                    </div>
                                                    <div class="profile-task-list pb-30 table-responsive">
                                                        <table
                                                            class="table data-table-responsive stripe data-table-export">
                                                            <thead>
                                                                <tr>
                                                                    <td>No</td>
                                                                    <td>Nama Jabatan</td>
                                                                    <td>Tanggal Sk</td>
                                                                    <td>File SK</td>
                                                                    <th class="table-plus datatable-nosort">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($jabatan as $item)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $item->jabatan }}</td>
                                                                        <td>{{ $item->tgl_sk }}</td>
                                                                        <td><a href="/uploads/sk_jabatan_dosen/{{ $item->file_sk }}"
                                                                                target="_blank"> Lihat</a>
                                                                        </td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                                                    data-color="#1b3133" href="#"
                                                                                    role="button" data-toggle="dropdown">
                                                                                    <i class="dw dw-more"></i>
                                                                                </a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('dosen.jabatan.edit', $item->encrypted_id) }}"><i
                                                                                            class="dw dw-edit2"></i>
                                                                                        Edit</a>
                                                                                    <form class="deleteForm2"
                                                                                        action="{{ route('dosen.jabatan.destroy', $item->encrypted_id) }}"
                                                                                        method="POST">
                                                                                        @method('DELETE')
                                                                                        @csrf
                                                                                        <button type="button"
                                                                                            class="dropdown-item text-danger deleteBtn2"
                                                                                            onclick="showDeleteConfirmation(event)"><i
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
                                        <div class="tab-pane fade" id="pangkat" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="">
                                                    <!-- Open Task start -->
                                                    <div class="task-title row align-items-center">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Data Kepangkatan</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="{{ route('dosen.pangkat.create') }}"
                                                                class="bg-light-blue btn text-blue weight-500"><i
                                                                    class="ion-plus-round"></i> Tambah</a>
                                                        </div>
                                                    </div>
                                                    <div class="profile-task-list pb-30 table-responsive">
                                                        <table
                                                            class="table data-table-responsive stripe data-table-export">
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
                                                                @foreach ($kepangkatan as $item)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $item->kepangkatan }}</td>
                                                                        <td>{{ $item->tgl_sk }}</td>
                                                                        <td>
                                                                            <a
                                                                                href="/uploads/sk_pangkat_dosen/{{ $item->file_sk }}">
                                                                                Lihat</a>
                                                                        </td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                                                    data-color="#1b3133" href="#"
                                                                                    role="button" data-toggle="dropdown">
                                                                                    <i class="dw dw-more"></i>
                                                                                </a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('dosen.pangkat.edit', $item->encrypted_id) }}"><i
                                                                                            class="dw dw-edit2"></i>
                                                                                        Edit</a>
                                                                                    <form class="deleteForm2"
                                                                                        action="{{ route('dosen.pangkat.destroy', $item->encrypted_id) }}"
                                                                                        method="POST">
                                                                                        @method('DELETE')
                                                                                        @csrf
                                                                                        <button type="button"
                                                                                            class="dropdown-item text-danger deleteBtn2"
                                                                                            onclick="showDeleteConfirmation(event)"><i
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
                                        <div class="tab-pane fade" id="gelar" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="">
                                                    <!-- Open Task start -->
                                                    <div class="task-title row align-items-center">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Data Gelar</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="{{ route('dosen.gelar.create') }}"
                                                                class="bg-light-blue btn text-blue weight-500"><i
                                                                    class="ion-plus-round"></i> Tambah</a>
                                                        </div>
                                                    </div>
                                                    <div class="profile-task-list pb-30">
                                                        <table class="table stripe data-table-export ">
                                                            <thead>
                                                                <tr>
                                                                    <td>No</td>
                                                                    <td>Instansi Pendidikan</td>
                                                                    <td>Jurusan</td>
                                                                    <td>Tahun Lulus</td>
                                                                    <td>Nama Gelar</td>
                                                                    <td>Singkatan Gelar</td>
                                                                    <th class="table-plus datatable-nosort">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($gelar as $item)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $item->instansi_pendidikan }}</td>
                                                                        <td>{{ $item->jurusan }}</td>
                                                                        <td>{{ $item->tahun_lulus }}</td>
                                                                        <td>{{ $item->nama_gelar }}</td>
                                                                        <td>{{ $item->singkatan_gelar }}</td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                                                    data-color="#1b3133" href="#"
                                                                                    role="button" data-toggle="dropdown">
                                                                                    <i class="dw dw-more"></i>
                                                                                </a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('dosen.gelar.edit', $item->encrypt_id) }}"><i
                                                                                            class="dw dw-edit2"></i>
                                                                                        Edit</a>
                                                                                    <form class="deleteForm2"
                                                                                        action="{{ route('dosen.gelar.destroy', $item->encrypt_id) }}"
                                                                                        method="POST">
                                                                                        @method('DELETE')
                                                                                        @csrf
                                                                                        <button type="button"
                                                                                            class="dropdown-item text-danger deleteBtn2"
                                                                                            onclick="showDeleteConfirmation(event)"><i
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
                                        <!-- Setting Tab End -->
                                    </div>
                                </div>
                            </div>
                        </div>
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
@endsection
