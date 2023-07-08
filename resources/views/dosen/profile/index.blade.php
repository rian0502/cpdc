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
                                    <a href="{{-- LINK export CV --}}">
                                      <button class="btn btn-primary mt-3">
                                        <i class="bi bi-file-earmark-word-fill"></i>
                                        Export CV
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
                                        {{-- {{ Auth::user()->dosen->jenis_kelamin }} --}}
                                    </li>
                                    <li>
                                        <span>Alamat:</span>
                                        {{ Auth::user()->dosen->alamat }}
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
                                                <a class="nav-link active" data-toggle="tab" href="#organisasi"
                                                    role="tab">ORGANISASI</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#litabmas"
                                                    role="tab">LITABMAS</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#publikasi"
                                                    role="tab">PUBLIKASI</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#jabatan"
                                                    role="tab">JABATAN</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#pangkat"
                                                    role="tab">PANGKAT</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content">
                                        <!-- Timeline Tab start -->
                                        <div class="tab-pane fade show active" id="organisasi" role="tabpanel">
                                            <div class="pd-20 profile-task-wrap">
                                                <div class="container pd-0">
                                                    <!-- Open Task start -->
                                                    <div class="task-title row align-items-center">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Data Organisasi</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="{{ route('dosen.organisasi.create') }}"
                                                                class="bg-light-blue btn text-blue weight-500"><i
                                                                    class="ion-plus-round"></i> Tambah</a>
                                                        </div>
                                                    </div>
                                                    <div class="profile-task-list pb-30 table-responsive">
                                                        <table
                                                            class="table data-table-responsive stripe data-table-export nowrap ">
                                                            <thead>
                                                                <tr>
                                                                    <td>No</td>
                                                                    <td>Nama Organisasi</td>
                                                                    <td>Masa Jabatan</td>
                                                                    <td>Jabatan</td>
                                                                    <th class="table-plus datatable-nosort">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($organisasi as $item)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $item->nama_organisasi }}</td>
                                                                        <td>{{ $item->tahun_menjabat . ' - ' . $item->tahun_berakhir }}
                                                                        </td>
                                                                        <td>{{ $item->jabatan }}</td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-outline-primary dropdown-toggle"
                                                                                    href="#" role="button"
                                                                                    data-toggle="dropdown">
                                                                                    <i class="fa fa-ellipsis-h"></i>
                                                                                </a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('dosen.organisasi.edit', $item->encrypt_id) }}">
                                                                                        <i class="fa fa-pencil"></i>
                                                                                        Edit</a>
                                                                                    <form id="delete" action="{{route('dosen.organisasi.destroy', $item->encrypt_id)}}" method="POST">
                                                                                    @method('DELETE')
                                                                                        <button type="submit" id="deleteBtn"
                                                                                            class="dropdown-item text-danger"><i
                                                                                                class="fa fa-trash"></i>
                                                                                            Delete</button>
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
                                        <!-- Timeline Tab End -->
                                        <!-- Tasks Tab start -->
                                        <div class="tab-pane fade" id="litabmas" role="tabpanel">
                                            <div class="pd-20 profile-task-wrap">
                                                <div class="container pd-0">
                                                    <!-- Open Task start -->
                                                    <div class="task-title row align-items-center">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Data LITABMAS</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="{{ route('dosen.litabmas.create') }}"
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
                                                                    <td>Kategori</td>
                                                                    <td>Tahun Pelaksanaan</td>
                                                                    <th class="table-plus datatable-nosort">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @foreach (Auth::user()->dosen->litabmas as $item)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td class="text-break max-w-md text-left">
                                                                            {{ $item->nama_litabmas }}</td>
                                                                        <td>{{ $item->kategori }}</td>
                                                                        <td>{{ $item->tahun_penelitian }}</td>
                                                                        </td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-outline-primary dropdown-toggle"
                                                                                    href="#" role="button"
                                                                                    data-toggle="dropdown">
                                                                                    <i class="fa fa-ellipsis-h"></i>
                                                                                </a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right">
                                                                                    <a href="{{ route('dosen.litabmas.show', $item->encrypt_id) }}"
                                                                                        class="dropdown-item">
                                                                                        <i class="fal fa-eye"></i>
                                                                                        Detail</a>

                                                                                    @if ($item->anggota_litabmas[0]->dosen_id == Auth::user()->dosen->id)
                                                                                        <a class="dropdown-item"
                                                                                            href="{{ route('dosen.litabmas.edit', $item->encrypt_id) }}">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                            Edit</a>
                                                                                        <form id="delete" action="{{route('dosen.litabmas.destroy', $item->encrypt_id)}}"
                                                                                        @method('DELETE')
                                                                                            method="POST">
                                                                                            <button type="submit" id="deleteBtn"
                                                                                                class="dropdown-item text-danger"><i
                                                                                                    class="fa fa-trash"></i>
                                                                                                Delete</button>
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
                                        <!-- Tasks Tab End -->
                                        <!-- Setting Tab start -->
                                        <div class="tab-pane fade" id="publikasi" role="tabpanel">
                                            <div class="pd-20 profile-task-wrap">
                                                <div class="container pd-0">
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
                                                                        <td>{{ $item->regional }}</td>
                                                                        <td>{{ $item->kategori }}</td>
                                                                        <td>{{ $item->litabmas }}</td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-outline-primary dropdown-toggle"
                                                                                    href="#" role="button"
                                                                                    data-toggle="dropdown">
                                                                                    <i class="fa fa-ellipsis-h"></i>
                                                                                </a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right">
                                                                                    <a href="{{ route('dosen.publikasi.show', $item->encrypt_id) }}"
                                                                                        class="dropdown-item">
                                                                                        <i class="fal fa-eye"></i>
                                                                                        Detail</a>

                                                                                    @if ($item->anggotaPublikasi[0]->id_dosen == Auth::user()->dosen->id)
                                                                                        <a class="dropdown-item"
                                                                                            href="{{ route('dosen.publikasi.edit', $item->encrypt_id) }}">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                            Edit</a>
                                                                                        <form id="delete" action="{{route('dosen.publikasi.destroy', $item->encrypt_id)}}"
                                                                                        @method('DELETE')
                                                                                            method="POST">

                                                                                            <button type="submit" id="deleteBtn"
                                                                                                class="dropdown-item text-danger"><i
                                                                                                    class="fa fa-trash"></i>
                                                                                                Delete</button>
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

                                        <div class="tab-pane fade" id="jabatan" role="tabpanel">
                                            <div class="pd-20 profile-task-wrap">
                                                <div class="container pd-0">
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
                                                            class="table data-table-responsive stripe data-table-export nowrap ">
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
                                                                                <a class="btn btn-outline-primary dropdown-toggle"
                                                                                    href="#" role="button"
                                                                                    data-toggle="dropdown">
                                                                                    <i class="fa fa-ellipsis-h"></i>
                                                                                </a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('dosen.jabatan.edit', $item->encrypted_id) }}">
                                                                                        <i class="fa fa-pencil"></i>
                                                                                        Edit</a>
                                                                                    <form id="delete" action="{{route('dosen.jabatan.destroy', $item->encrypted_id)}}" method="POST">
                                                                                    @method('DELETE')
                                                                                        <button type="submit" id="deleteBtn"
                                                                                            class="dropdown-item text-danger"><i
                                                                                                class="fa fa-trash"></i>
                                                                                            Delete</button>
                                                                                    </form>
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
                                            <div class="pd-20 profile-task-wrap">
                                                <div class="container pd-0">
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
                                                            class="table data-table-responsive stripe data-table-export nowrap ">
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
                                                                        <td><a
                                                                                href="/uploads/sk_pangkat_dosen/{{ $item->file_sk }}">
                                                                                Lihat</a>
                                                                        </td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-outline-primary dropdown-toggle"
                                                                                    href="#" role="button"
                                                                                    data-toggle="dropdown">
                                                                                    <i class="fa fa-ellipsis-h"></i>
                                                                                </a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('dosen.pangkat.edit', $item->encrypted_id) }}">
                                                                                        <i class="fa fa-pencil"></i>
                                                                                        Edit</a>
                                                                                    <form id="delete" action="{{route('dosen.pangkat.destroy', $item->encrypted_id)}}" method="POST">
                                                                                    @method('DELETE')
                                                                                        <button type="submit" id="deleteBtn"
                                                                                            class="dropdown-item text-danger"><i
                                                                                                class="fa fa-trash"></i>
                                                                                            Delete</button>
                                                                                    </form>
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
        if (selisihTahun < 30) {
            warna =
                `rgb(${212-selisihTahun-50}, ${217-selisihTahun-50}, ${37-selisihTahun})`; // warna hijau akan semakin kuat saat umur semakin muda
        } else if (selisihTahun >= 30 && selisihTahun < 50) {
            warna =
                `rgb(${255-selisihTahun}, ${238-selisihTahun}, ${99-selisihTahun})`; // warna kuning akan semakin kuat saat umur mendekati 50 tahun
        } else {
            warna = `rgb(${255-selisihTahun}, 0, 0)`; // warna merah akan semakin kuat saat umur mendekati 70 tahun
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
