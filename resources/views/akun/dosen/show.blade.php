@extends('layouts.datatable')
@section('datatable')
    <style>
        a:hover {
            cursor: pointer;
        }

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
            /* Sesuaikan dengan tinggi yang diinginkan */
            object-fit: cover;
        }

        .right-button {
            float: right;
            margin-top: -25px;
        }
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Detail Dosen</h4>
                        <a href="{{ route('sudo.akun_dosen.index') }}">
                            <button class="btn btn-primary right-button">Kembali</button>
                        </a>
                    </div>
                    <div class="p-md-4">
                        <div class="profile-photo center-div mt-2">
                            {{-- <a href="#" class="edit-avatar" data-toggle="modal" data-target="#modal"> --}}
                            <a href="/uploads/profile/{{ $lecturer->user->profile_picture }}">

                                <img src="/uploads/profile/{{ $lecturer->user->profile_picture }}"
                                    onerror="this.src='/uploads/profile/default.png';" class="foto" alt="Foto Profil" />
                            </a>
                        </div>
                        <div class="p-3 mb-2 bg-light text-dark rounded-div">
                            <div class="row">
                                <label class="col-md-3 bold"> <strong> Nama Dosen</strong></label>
                                <div class="col-md-3">
                                    {{ $lecturer->nama_dosen }}
                                </div>
                                <label class="col-md-3 bold"><b>Tanggal Lahir</b></label>
                                <div class="col-md-3" id="tanggal-lahir">
                                    {{ $lecturer->tanggal_lahir }}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><b>NIP</b></label>
                                <div class="col-md-3">
                                    {{ $lecturer->nip }}
                                </div>
                                <label class="col-md-3 bold"><strong>Alamat</strong></label>
                                <div class="col-md-3">
                                    {{ $lecturer->alamat }}
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3 bold"><b>Nomor Induk Dosen Nasional</b></label>
                                <div class="col-md-3">
                                    {{ $lecturer->nidn }}
                                </div>
                                <label class="col-md-3 bold"> <strong> Status</strong></label>
                                <div class="col-md-3">
                                    {{ $lecturer->status }}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"> <strong> Jabatan</strong></label>
                                <div class="col-md-3">
                                    @if (count($jabatan) > 0)
                                        {{ $jabatan->first()->jabatan }}
                                    @else
                                        -
                                    @endif
                                </div>
                                <label class="col-md-3 bold"><b>Email</b></label>
                                <div class="col-md-3">
                                    {{ $lecturer->user->email }}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"><strong> Pangkat </strong></label>
                                <div class="col-md-3">

                                    @if (count($pangkat) > 0)
                                        {{ $pangkat->first()->kepangkatan }}
                                    @else
                                        -
                                    @endif
                                </div>
                                <label class="col-md-3 bold"><b>Nomor Telepon</b></label>
                                <div class="col-md-3">
                                    {{ $lecturer->no_hp }}
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 bold"> <strong> Umur </strong></label>
                                <div class="col-md-3" id="umur">
                                    {{ $lecturer->tanggal_lahir }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Organisasi</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export nowrap ">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama Organisasi</td>
                                    <td>Masa Jabatan</td>
                                    <td>Jabatan</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($organisasi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_organisasi }}</td>
                                        <td>{{ $item->tahun_menjabat . ' - ' . $item->tahun_berakhir }}</td>
                                        <td>{{ $item->jabatan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">LITABMAS</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export nowrap ">
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

                                @foreach ($litabmas as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-break max-w-md text-left">

                                            {{ $item->litabmas->nama_litabmas }}
                                        </td>
                                        <td>
                                            {{ $item->litabmas->kategori }}
                                        </td>
                                        <td>
                                            {{ $item->litabmas->tahun_penelitian }}
                                        </td>
                                        </td>
                                        <td>
                                            <div>
                                                <a class="btn btn-warning" href="{{ route('dosen.litabmas.show', $item->litabmas->encrypt_id) }}"
                                                    role="button">
                                                    <i class="fal fa-eye"></i>
                                                    Detail</a>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">PUBLIKASI</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export nowrap ">
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

                                @foreach ($publikasi as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}</td>
                                        <td class="text-break max-w-md text-left">
                                            {{ $item->publikasi->judul }}</td>
                                        <td>
                                            {{ $item->publikasi->tahun }}</td>
                                        <td>
                                            {{ $item->publikasi->scala }}</td>
                                        <td>
                                            {{ $item->publikasi->kategori }}</td>
                                        <td>
                                            {{ $item->publikasi->kategori_litabmas }}</td>
                                        <td>
                                            <div>
                                                <a class="btn btn-warning" href="{{ route('dosen.publikasi.show', $item->publikasi->encrypt_id) }}"
                                                    role="button">
                                                    <i class="fal fa-eye"></i>
                                                    Detail</a>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">JABATAN</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export nowrap ">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama Jabatan</td>
                                    <td>Tanggal Sk</td>
                                    <td>File SK</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jabatan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->jabatan }}</td>
                                        <td>{{ $item->tgl_sk }}</td>
                                        <td><a href="/uploads/sk_jabatan_dosen/{{ $item->file_sk }}"
                                                class="btn btn-success" target="_blank"> Lihat</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">KEPANGKATAN</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export nowrap ">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Pangkat</td>
                                    <td>Tanggal Sk</td>
                                    <td>File SK</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pangkat as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kepangkatan }}</td>
                                        <td>{{ $item->tgl_sk }}</td>
                                        <td><a class="btn btn-success"
                                                href="/uploads/sk_pangkat_dosen/{{ $item->file_sk }}">
                                                Lihat</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">GELAR</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export nowrap">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Instansi Pendidikan</td>
                                    <td>Jurusan</td>
                                    <td>Tahun Lulus</td>
                                    <td>Nama Gelar</td>
                                    <td>Singkatan Gelar</td>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Seminar Dosen</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Scala</th>
                                    <th>Dokumentasi</th>
                                    <th>Uraian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($seminar as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->scala }}</td>
                                        <td><a href="{{$item->url}}" class="text-primary">Klik</a></td>
                                        <td>{{ $item->uraian }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Penghargaan Dosen</h4>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    <th>Scala</th>
                                    <th>Dokumentasi</th>
                                    <th>Uraian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penghargaan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->Kategori }}</td>
                                        <td>{{ $item->scala }}</td>
                                        <td><a href="{{$item->url}}" class="text-primary">Klik</a></td>
                                        <td>{{ $item->uraian }}</td>
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
