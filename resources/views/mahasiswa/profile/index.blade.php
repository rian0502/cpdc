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
                                    </ul>
                                    <div class="tab-content">
                                        <!-- Prestasi Tab start -->
                                        <div class="tab-pane fade show active" id="prestasi" role="tabpanel">
                                            <div class="pd-20">
                                                {{-- style="max-height:468px; overflow-y: scroll;" --}}
                                                <div class="profile-timeline" style="margin-top: -30px">
                                                    <a href="{{ route('mahasiswa.prestasi.create') }}"
                                                        style="margin-left:15px;">
                                                        <button class="btn btn-success ">
                                                            <i class="icon-copy fi-page-add"></i>
                                                            Tambah Data
                                                        </button>
                                                    </a>
                                                    <table
                                                        class="table data-table-responsive stripe data-table-noexport wrap ">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Prestasi</th>
                                                                <th>Tingkat</th>
                                                                <th>Tanggal</th>
                                                                <th>Capaian</th>
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
                                                                    <td>{{ $item->tanggal }}</td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <a class="btn btn-outline-primary dropdown-toggle"
                                                                                href="#" role="button"
                                                                                data-toggle="dropdown">
                                                                                <i class="fa fa-ellipsis-h"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                                <a class="dropdown-item" target="_blank"
                                                                                    href="/uploads/file_prestasi/{{ $item->file_prestasi }}"><i
                                                                                        class="fal fa-file"></i> Lihat
                                                                                    File</a>
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('mahasiswa.prestasi.edit', $item->encrypt_id) }}"><i
                                                                                        class="fa fa-pencil"></i> Edit</a>
                                                                                <form class="deleteForm2"
                                                                                    action="{{ route('mahasiswa.prestasi.destroy', $item->encrypt_id) }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="button"
                                                                                        class="dropdown-item text-danger deleteBtn2"
                                                                                        onclick="showDeleteConfirmation(event)"><i
                                                                                            class="fa fa-trash"></i>
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
                                        <!-- Prestas Tab End -->

                                        <!-- Extra Activity Tab start -->
                                        <div class="tab-pane fade" id="extra" role="tabpanel">
                                            <div class="pd-20 profile-task-wrap">

                                                <!-- Extra Activity start -->
                                                <div class="profile-timeline" style="margin-top: -30px">
                                                    <a href="/mahasiswa/kegiatan/create" style="margin-left:15px;">
                                                        <button class="btn btn-success ">
                                                            <i class="icon-copy fi-page-add"></i>
                                                            Tambah Data
                                                        </button>
                                                    </a>
                                                    <table
                                                        class="table data-table-responsive stripe data-table-noexport wrap ">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Judul Kegiatan</th>
                                                                <th>Peran</th>
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
                                                                    <td>{{ $item->tanggal }}</td>
                                                                    <td>{{ $item->sks_konversi }} SKS</td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <a class="btn btn-outline-primary dropdown-toggle"
                                                                                href="#" role="button"
                                                                                data-toggle="dropdown">
                                                                                <i class="fa fa-ellipsis-h"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                                <a class="dropdown-item"
                                                                                    href="/uploads/file_act_mhs/{{ $item->file_aktivitas }}"><i
                                                                                        class="fal fa-file"
                                                                                        target="_blank"></i> Lihat File</a>
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('mahasiswa.kegiatan.edit', $item->encrypt_id) }}"><i
                                                                                        class="fa fa-pencil"></i> Edit</a>
                                                                                <form class="deleteForm2"
                                                                                    action="{{ route('mahasiswa.kegiatan.destroy', $item->encrypt_id) }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="button"
                                                                                        class="dropdown-item text-danger deleteBtn2"
                                                                                        onclick="showDeleteConfirmation(event)"><i
                                                                                            class="fa fa-trash"></i>
                                                                                        Hapus</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <!-- Extra activity End -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Extra Activity Tab End -->

                                        <!-- Setting Tab start -->
                                        {{-- <div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
                                            <div class="profile-setting">
                                                <form id="delete">
                                                    <ul class="profile-edit-list row">
                                                        <li class="weight-500 col-md-6">
                                                            <h4 class="text-blue h5 mb-20">
                                                                Edit Your Personal Setting
                                                            </h4>
                                                            <div class="form-group">
                                                                <label>Full Name</label>
                                                                <input class="form-control form-control-lg"
                                                                    type="text" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <input class="form-control form-control-lg"
                                                                    type="text" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control form-control-lg"
                                                                    type="email" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Date of birth</label>
                                                                <input class="form-control form-control-lg date-picker"
                                                                    type="text" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Gender</label>
                                                                <div class="d-flex">
                                                                    <div class="custom-control custom-radio mb-5 mr-20">
                                                                        <input type="radio" id="customRadio4"
                                                                            name="customRadio"
                                                                            class="custom-control-input" />
                                                                        <label class="custom-control-label weight-400"
                                                                            for="customRadio4">Male</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio mb-5">
                                                                        <input type="radio" id="customRadio5"
                                                                            name="customRadio"
                                                                            class="custom-control-input" />
                                                                        <label class="custom-control-label weight-400"
                                                                            for="customRadio5">Female</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <select class="selectpicker form-control form-control-lg"
                                                                    data-style="btn-outline-secondary btn-lg"
                                                                    title="Not Chosen">
                                                                    <option>United States</option>
                                                                    <option>India</option>
                                                                    <option>United Kingdom</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>State/Province/Region</label>
                                                                <input class="form-control form-control-lg"
                                                                    type="text" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Postal Code</label>
                                                                <input class="form-control form-control-lg"
                                                                    type="text" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Phone Number</label>
                                                                <input class="form-control form-control-lg"
                                                                    type="text" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <textarea class="form-control"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Visa Card Number</label>
                                                                <input class="form-control form-control-lg"
                                                                    type="text" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Paypal ID</label>
                                                                <input class="form-control form-control-lg"
                                                                    type="text" />
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox mb-5">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck1-1" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="customCheck1-1">I agree to receive
                                                                        notification
                                                                        emails</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <input type="submit" id="deleteBtn"
                                                                    class="btn btn-primary" value="Update Information" />
                                                            </div>
                                                        </li>
                                                        <li class="weight-500 col-md-6">
                                                            <h4 class="text-blue h5 mb-20">
                                                                Edit Social Media links
                                                            </h4>
                                                            <div class="form-group">
                                                                <label>Facebook URL:</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    placeholder="Paste your link here" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Twitter URL:</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    placeholder="Paste your link here" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Linkedin URL:</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    placeholder="Paste your link here" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Instagram URL:</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    placeholder="Paste your link here" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Dribbble URL:</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    placeholder="Paste your link here" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Dropbox URL:</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    placeholder="Paste your link here" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Google-plus URL:</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    placeholder="Paste your link here" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pinterest URL:</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    placeholder="Paste your link here" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Skype URL:</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    placeholder="Paste your link here" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Vine URL:</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    placeholder="Paste your link here" />
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <input type="submit" id="deleteBtn"
                                                                    class="btn btn-primary" value="Save & Update" />
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </form>
                                            </div>
                                        </div> --}}
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
@endsection
