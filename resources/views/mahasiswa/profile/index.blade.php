@extends('layouts.datatable')
@section('datatable')
    <style>
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

                <div class="row">
                    <div class="col-xl-3 mb-30">
                        <div class="pd-20 card-box height-100-p">

                            <div class="profile-photo mt-2">
                                {{-- <a href="#" class="edit-avatar" data-toggle="modal" data-target="#modal"> --}}
                                <a href="{{ route('mahasiswa.profile.edit', Auth::user()->mahasiswa->npm) }}"
                                    class="edit-avatar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <img src="/uploads/profile/{{ Auth::user()->profile_picture }}"
                                    onerror="this.src='/uploads/profile/default.png';" class="foto" alt="Foto Profil" />
                            </div>

                            <h5 class="text-center h5 mb-0">{{ Auth::user()->name }}</h5>
                            <p class="text-center text-muted font-14">
                                {{ ucwords(auth()->user()->roles->pluck('name')->implode(', ')) }}

                            </p>
                            {{-- style="max-height:300px; overflow-y: scroll;" --}}
                            <div class="profile-info">
                                <h5 class="mb-20 h5 text-blue">Biodata</h5>
                                <ul>
                                    <li>
                                        <span>Email:</span>
                                        {{ Auth::user()->email }}
                                    </li>
                                    <li>
                                        <span>Nomor Pokok Mahasiswa:</span>
                                        {{ Auth::user()->mahasiswa->npm }}
                                    </li>
                                    <li>
                                        <span>Nomor Telepon:</span>
                                        {{ Auth::user()->mahasiswa->no_hp }}
                                    </li>
                                    <li>
                                        <span>Status:</span>
                                        {{ Auth::user()->mahasiswa->status }}
                                    </li>
                                    <li>
                                        <span>Angkatan:</span>
                                        {{ Auth::user()->mahasiswa->angkatan }}
                                    </li>
                                    <li>
                                        <span>Semester:</span>
                                        {{ Auth::user()->mahasiswa->semester }}
                                    </li>
                                    <li>
                                        <span>Tanggal Masuk:</span>
                                        {{ $carbon::parse(Auth::user()->mahasiswa->tanggal_masuk)->format('d F Y') }}
                                    </li>
                                    <li>
                                        <span>Jenis Kelamin:</span>
                                        {{ Auth::user()->mahasiswa->jenis_kelamin }}
                                    </li>
                                    <li>
                                        <span>Alamat:</span>
                                        {{ Auth::user()->mahasiswa->alamat }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 mb-30">
                        <div class="card-box height-100-p overflow-hidden">
                            <div class="profile-tab height-100-p">
                                <div class="tab height-100-p">
                                    <ul class="nav nav-tabs customtab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#prestasi"
                                                role="tab">Prestasi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#extra" role="tab">Kegiatan
                                                Lainnya</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#publikasi"
                                                role="tab">Publikasi</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <!-- Prestasi Tab start -->
                                        <div class="tab-pane fade show active" id="prestasi" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="">
                                                    <!-- Open Task start -->
                                                    <div class="task-title row align-items-center">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Data Prestasi</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="{{ route(Auth::user()->hasRole('mahasiswaS2') ? 'mahasiswa.prestasiS2.create' : 'mahasiswa.prestasi.create') }}"
                                                                class="bg-light-blue btn text-blue weight-500"><i
                                                                    class="ion-plus-round"></i> Tambah</a>
                                                        </div>
                                                    </div>
                                                    <div class="profile-task-list  table-responsive">
                                                        <table
                                                            class="table data-table-responsive stripe data-table-noexport">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama Prestasi</th>
                                                                    <th>Tingkat</th>
                                                                    <th>Capaian</th>
                                                                    <th>Jenis</th>
                                                                    <th>Dosen Pembimbing</th>
                                                                    <th>Tanggal</th>
                                                                    <th class="table-plus datatable-nosort">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($prestasi as $item)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $item->nama_prestasi }}</td>
                                                                        <td>{{ $item->scala }}</td>
                                                                        <td>{{ $item->capaian }}</td>
                                                                        <td>{{ $item->jenis }}</td>
                                                                        <td>{{ $item->dosen->nama_dosen ?? $item->nama_pembimbing }}
                                                                        </td>
                                                                        <td>{{ $item->tanggal }}</td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                                                    data-color="#1b3133" href="#"
                                                                                    role="button" data-toggle="dropdown">
                                                                                    <i class="dw dw-more"></i>
                                                                                </a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                                    <a class="dropdown-item" target="_blank"
                                                                                        href="/uploads/file_prestasi/{{ $item->file_prestasi }}"><i
                                                                                            class="dw dw-file"></i> Lihat
                                                                                        File</a>
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route(Auth::user()->hasRole('mahasiswaS2') ? 'mahasiswa.prestasiS2.edit' : 'mahasiswa.prestasi.edit', $item->encrypt_id) }}"><i
                                                                                            class="dw dw-edit2"></i>
                                                                                        Edit</a>
                                                                                    <form class="deleteForm2"
                                                                                        action="{{ route(Auth::user()->hasRole('mahasiswaS2') ? 'mahasiswa.prestasiS2.destroy' : 'mahasiswa.prestasi.destroy', $item->encrypt_id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="button"
                                                                                            class="dropdown-item text-danger deleteBtn2"
                                                                                            onclick="showDeleteConfirmation(event)"><i
                                                                                                class="dw dw-trash"></i>
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
                                        <!-- Prestas Tab End -->

                                        <!-- Extra Activity Tab start -->
                                        <div class="tab-pane fade show" id="extra" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="">
                                                    <!-- Open Task start -->
                                                    <div class="task-title row align-items-center">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Data Kegiatan Lainnya</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="{{ route(Auth::user()->hasRole('mahasiswaS2') ? 'mahasiswa.kegiatanS2.create' : 'mahasiswa.kegiatan.create') }}"
                                                                class="bg-light-blue btn text-blue weight-500"><i
                                                                    class="ion-plus-round"></i> Tambah</a>
                                                        </div>
                                                    </div>
                                                    <div class="profile-task-list  table-responsive">
                                                        <table
                                                            class="table data-table-responsive stripe data-table-noexport">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Judul Kegiatan</th>
                                                                    <th>Peran</th>
                                                                    <th>Tingkatan</th>
                                                                    <th>Jenis</th>
                                                                    <th>Kategori</th>
                                                                    <th>Tanggal</th>
                                                                    <th>SKS Konversi</th>
                                                                    <th class="table-plus datatable-nosort">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($aktivitas as $item)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $item->nama_aktivitas }}</td>
                                                                        <td>{{ $item->peran }}</td>
                                                                        <td>{{ $item->skala }}</td>
                                                                        <td>{{ $item->jenis }}</td>
                                                                        <td>{{ $item->kategori }}</td>
                                                                        <td>{{ $item->tanggal }}</td>
                                                                        <td>{{ $item->sks_konversi }} SKS</td>
                                                                        <td>

                                                                            <div class="dropdown">
                                                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                                                    data-color="#1b3133" href="#"
                                                                                    role="button" data-toggle="dropdown">
                                                                                    <i class="dw dw-more"></i>
                                                                                </a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                                    <a class="dropdown-item" target="_blank"
                                                                                        href="/uploads/file_act_mhs/{{ $item->file_aktivitas }}"><i
                                                                                            class="dw dw-file"></i> Lihat
                                                                                        File</a>
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route(Auth::user()->hasRole('mahasiswaS2') ? 'mahasiswa.kegiatanS2.edit' : 'mahasiswa.kegiatan.edit', $item->encrypt_id) }}"><i
                                                                                            class="dw dw-edit2"></i>
                                                                                        Edit</a>
                                                                                    <form class="deleteForm2"
                                                                                        action="{{ route(Auth::user()->hasRole('mahasiswaS2') ? 'mahasiswa.kegiatanS2.destroy' : 'mahasiswa.kegiatan.destroy', $item->encrypt_id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="button"
                                                                                            class="dropdown-item text-danger deleteBtn2"
                                                                                            onclick="showDeleteConfirmation(event)"><i
                                                                                                class="dw dw-trash"></i>
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
                                        <!-- Extra Activity Tab End -->

                                        <!-- publikasi Tab start -->
                                        <div class="tab-pane fade show" id="publikasi" role="tabpanel">
                                            <div class="pd-20">
                                                <div class="">
                                                    <!-- Open Task start -->
                                                    <div class="task-title row align-items-center">
                                                        <div class="col-md-8 col-sm-12">
                                                            <h5>Data Publikasi</h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 text-right">
                                                            <a href="{{ route('mahasiswa.publikasi.create') }}"
                                                                class="bg-light-blue btn text-blue weight-500"><i
                                                                    class="ion-plus-round"></i> Tambah</a>
                                                        </div>
                                                    </div>
                                                    <div class="profile-task-list  table-responsive">
                                                        <table
                                                            class="table data-table-responsive stripe data-table-noexport">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Judul</th>
                                                                    <th>Tahun</th>
                                                                    <th>Kategori</th>
                                                                    <th>Scala</th>
                                                                    <th>Tautan</th>
                                                                    <th class="table-plus datatable-nosort">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($publikasi as $item)
                                                                    <tr>
                                                                        <td>
                                                                            {{ $loop->iteration }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $item->judul }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $item->tahun }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $item->kategori }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $item->scala }}
                                                                        </td>
                                                                        <td>
                                                                            <a target="_blank"
                                                                                href="{{ $item->url }}">Klik</a>
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
                                                                                        target="_blank"
                                                                                        href="/uploads/file_act_mhs/{{ $item->file_aktivitas }}"><i
                                                                                            class="dw dw-file"></i> Lihat
                                                                                        File</a>
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route(Auth::user()->hasRole('mahasiswaS2') ? 'mahasiswa.kegiatanS2.edit' : 'mahasiswa.kegiatan.edit', $item->encrypt_id) }}"><i
                                                                                            class="dw dw-edit2"></i>
                                                                                        Edit</a>
                                                                                    <form class="deleteForm2"
                                                                                        action="{{ route(Auth::user()->hasRole('mahasiswaS2') ? 'mahasiswa.kegiatanS2.destroy' : 'mahasiswa.kegiatan.destroy', $item->encrypt_id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="button"
                                                                                            class="dropdown-item text-danger deleteBtn2"
                                                                                            onclick="showDeleteConfirmation(event)"><i
                                                                                                class="dw dw-trash"></i>
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
                                        <!-- publikasi Tab End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
