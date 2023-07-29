<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Chemistry Program Data Center</title>

    <!-- Favicon -->
    <style>
        div.dataTables_wrapper div.dataTables_length select {
            width: auto;
            display: inline-block;

        }

        div.dataTables_wrapper div.dataTables_length {
            width: auto;
            display: inline-block;
            margin-top: 20px;



        }
    </style>

    <link href="/Assets/images/logo/color.png" rel="icon">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="/Assets/admin/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/Assets/auth/src/plugins/sweetalert2/sweetalert2.css" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/Assets/admin/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="/Assets/admin/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css"
        href="/Assets/admin/src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="/Assets/admin/src/plugins/datatables/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="/Assets/admin/vendors/styles/style.css" />
    <link rel="stylesheet" type="text/css" href="/Assets/src/lib/toastify/src/toastify.css" />

    <!-- FontAwesome -->
    <link href="/Assets/FontAwesome/css/fontawesome.css" rel="stylesheet">
    <link href="/Assets/FontAwesome/css/brands.css" rel="stylesheet">
    <link href="/Assets/FontAwesome/css/solid.css" rel="stylesheet">
    <!-- FontAwesome -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <style>
        .photo-profil {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
    <!-- End Google Tag Manager -->
</head>

<body  class="sidebar-light">
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="/Assets/images/logo/color.svg" width="100" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div>


    <div class="header">
        <div class="header-left">
            <div class="menu-icon bi bi-list"></div>
        </div>
        <div class="header-right">
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            {{-- <img src="/Assets/images/profile_picture/default.png" alt="" /> --}}
                            {{-- <img src="{{ asset('/Assets/images/profile_picture/' . $user->profile_picture) }}"
                                alt="" /> --}}
                            <img src="/uploads/profile/{{ Auth::user()->profile_picture }}"
                                onerror="this.src='/uploads/profile/default.png'" alt="" class="photo-profil" />
                        </span>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="/"><i class="dw dw-home"></i> Beranda</a>
                        @if (auth()->user()->hasRole('admin lab'))
                            <a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i
                                    class="dw dw-user1"></i>
                                Profil</a>
                        @elseif(auth()->user()->hasRole('admin berkas'))
                            <a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i
                                    class="dw dw-user1"></i>
                                Profil</a>
                        @elseif(auth()->user()->hasRole('dosen'))
                            <a class="dropdown-item" href="{{ route('dosen.profile.index') }} "><i
                                    class="dw dw-user1"></i> Profil</a>
                        @elseif(auth()->user()->hasRole(['mahasiswa', 'alumni']))
                            <a class="dropdown-item" href="{{ route('mahasiswa.profile.index') }}"><i
                                    class="dw dw-user1"></i>
                                Profil</a>
                        @elseif(auth()->user()->hasRole('kalab'))
                            <a class="dropdown-item" href="#"><i class="dw dw-user1"></i> Profil</a>
                        @elseif(auth()->user()->hasRole('jurusan'))
                            <a class="dropdown-item" href="#"><i class="dw dw-user1"></i> Profil</a>
                        @endif
                        <a class="dropdown-item" href="/settings"><i class="dw dw-settings2"></i> Pengaturan</a>

                        <a class="dropdown-item" href="/helps"><i class="dw dw-help"></i> Bantuan</a>

                        <a class="dropdown-item" href="/logout"><i class="dw dw-logout"></i> Keluar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="/" class="text-dark text-bold">
                <img src="/Assets/images/logo/color-text.png" width="" alt="Logo CPDC">
                {{-- <img src="/Assets/admin/vendors/images/deskapp-logo.svg" alt="" class="dark-logo" />
                <img src="/Assets/admin/vendors/images/deskapp-logo-white.svg" alt="" class="light-logo" /> --}}
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    @auth
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('dashboard*') ? 'active' : '' }}">
                                <span class="micon bi bi-grid-fill"></span><span class="mtext">Dashboard</span>
                            </a>
                        </li>
                    @endauth
                    @role('jurusan')
                        <li>
                            <a href="{{ route('jurusan.lokasi.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('jurusan/lokasi*') ? 'active' : '' }}">
                                <span class="micon bi bi-pin-map"></span><span class="mtext">Lokasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sudo.akun_dosen.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('sudo/akun_dosen*') ? 'active' : '' }}">
                                <span class="micon bi bi-person-rolodex"></span><span class="mtext">Data Dosen</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sudo.akun_admin.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('sudo/akun_admin*') ? 'active' : '' }}">
                                <span class="micon bi bi-person-workspace"></span><span class="mtext">Data Admin</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jurusan.mahasiswa.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('jurusan/mahasiswa*') ? 'active' : '' }}">
                                <span class="micon fa-solid fa-users"></span><span class="mtext">Data Mahasiswa</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jurusan.alumni.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('jurusan/alumni*') ? 'active' : '' }}">
                                <span class="micon fa-solid fa-users"></span><span class="mtext">Data Alumni</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jurusan.prestasi.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('jurusan/prestasi*') ? 'active' : '' }}">
                                <span class="micon bi bi-award"></span><span class="mtext">Prestasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jurusan.aktivitas.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('jurusan/aktivitas*') ? 'active' : '' }}">
                                <span class="micon bi bi-clock-history"></span><span class="mtext">Extra Aktivity</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jurusan.publikasi.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('jurusan/publikasi*') ? 'active' : '' }}">
                                <span class="micon bi bi-journal-text"></span><span class="mtext">PUBLIKASI</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jurusan.litabmas.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('jurusan/litabmas*') ? 'active' : '' }}">
                                <span class="micon bi bi-journal-richtext"></span><span class="mtext">LITABMAS</span>
                            </a>
                        </li>
                    @endrole
                    @role('jurusan|tpmps')
                        <li>
                            <a href="{{ route('jurusan.penghargaan.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('jurusan/penghargaan*') ? 'active' : '' }}">
                                <span class="micon bi bi-trophy"></span><span class="mtext">Penghargaan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jurusan.seminar.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('jurusan/seminar*') ? 'active' : '' }}">
                                <span class="micon bi bi-mic"></span><span class="mtext">Seminar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jurusan.unduh.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('jurusan/unduh*') ? 'active' : '' }}">
                                <span class="micon bi bi-download"></span><span class="mtext">Unduh Data</span>
                            </a>
                        </li>
                    @endrole
                    @role('admin lab|kalab')
                        <li>
                            <a href="{{ route('lab.ruang.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('admin/lab/ruang*') ? 'active' : '' }}">
                                <span class="micon bi bi-radioactive"></span><span class="mtext">Laboratorium</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lab.sop.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('admin/lab/sop*') ? 'active' : '' }}">
                                <span class="micon bi bi-file-earmark-ruled"></span><span class="mtext">SOP</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lab.barang.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('admin/lab/barang*') ? 'active' : '' }}">
                                <span class="micon bi bi-box"></span><span class="mtext">Inventaris</span>
                            </a>
                        </li>
                    @endrole
                    @role('sudo')
                        <li
                            class="dropdown {{ Request::is('sudo/akun_mahasiswa*') || Request::is('sudo/akun_dosen*') || Request::is('sudo/akun_admin*') ? 'show' : '' }}">
                            <a href="javascript:;" class="dropdown-toggle"
                                data-option="{{ Request::is('sudo/akun_mahasiswa*') || Request::is('sudo/akun_dosen*') || Request::is('sudo/akun_admin*') ? 'on' : '' }}">

                                <span class="micon bi bi-person-rolodex"></span><span class="mtext">Akun</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('sudo.akun_mahasiswa.index') }}"
                                        class="{{ Request::is('sudo/akun_mahasiswa*') ? 'active' : '' }}">Mahasiswa</a>
                                </li>
                                <li><a href="{{ route('sudo.akun_dosen.index') }}"
                                        class="{{ Request::is('sudo/akun_dosen*') ? 'active' : '' }}">Dosen</a>
                                </li>
                                <li><a href="{{ route('sudo.akun_admin.index') }}"
                                        class="{{ Request::is('sudo/akun_admin*') ? 'active' : '' }}">Admin</a>
                                </li>

                            </ul>
                        </li>
                        <li
                            class="dropdown {{ Request::is('sudo/kategori*') || Request::is('sudo/model*') ? 'show' : '' }}">
                            <a href="javascript:;" class="dropdown-toggle"
                                data-option="{{ Request::is('sudo/kategori*') || Request::is('sudo/model*') ? 'on' : '' }}">

                                <span class="micon bi bi-box"></span><span class="mtext">Inventaris</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('sudo.kategori.index') }}"
                                        class="{{ Request::is('sudo/kategori*') ? 'active' : '' }}">Kategori</a>
                                </li>
                                <li><a href="{{ route('sudo.model.index') }}"
                                        class="{{ Request::is('sudo/model*') ? 'active' : '' }}">Model</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('sudo.reset.seminar.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('sudo/resetSeminar*') ? 'active' : '' }}">
                                <span class="micon bi bi-arrow-counterclockwise"></span><span class="mtext">Reset
                                    TA</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sudo.base_npm.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('sudo/base_npm*') ? 'active' : '' }}">
                                <span class="micon bi bi bi-person-lines-fill"></span><span class="mtext">Data NPM</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sudo.kalab.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('sudo/kalab*') ? 'active' : '' }}">
                                <span class="micon bi bi bi-person-fill"></span><span class="mtext">Kepala
                                    Laboratorium</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sudo.admin_jurusan.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('sudo/admin_jurusan*') ? 'active' : '' }}">
                                <span class="micon bi bi bi-person-fill"></span><span class="mtext">Admin Jurusan</span>
                            </a>
                        </li>
                    @endrole

                    @role('mahasiswa')
                        <li
                            class="dropdown {{ Request::is('mahasiswa/seminar/kp*') || Request::is('mahasiswa/seminar/skripsi*') || Request::is('mahasiswa/seminar/usul*') || Request::is('mahasiswa/seminar/semhas*') || Request::is('mahasiswa/seminar/kompre*') ? 'show' : '' }}">
                            <a href="javascript:;" class="dropdown-toggle"
                                data-option="{{ Request::is('mahasiswa/seminar/kp*') || Request::is('mahasiswa/seminar/skripsi*') || Request::is('mahasiswa/seminar/usul*') || Request::is('mahasiswa/seminar/semhas*') || Request::is('mahasiswa/seminar/kompre*') ? 'show' : '' }}">
                                <span class="micon fa-regular fa-graduation-cap"></span><span
                                    class="mtext">Seminar</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('mahasiswa.seminar.kp.index') }}"
                                        class="{{ Request::is('mahasiswa/seminar/kp*') ? 'active' : '' }}">Kerja
                                        Praktik</a></li>
                                <li><a href="{{ route('mahasiswa.seminar.tugas_akhir_1.index') }}"
                                        class="{{ Request::is('mahasiswa/seminar/tugas_akhir_1*') ? 'active' : '' }}">Tugas
                                        Akhir
                                        1</a></li>
                                <li><a href="{{ route('mahasiswa.seminar.tugas_akhir_2.index') }}"
                                        class="{{ Request::is('mahasiswa/seminar/tugas_akhir_2*') ? 'active' : '' }}">Tugas
                                        Akhir
                                        2</a></li>
                                <li><a href="{{ route('mahasiswa.sidang.kompre.index') }}"
                                        class="{{ Request::is('mahasiswa/sidang/kompre*') ? 'active' : '' }}">Sidang
                                        Komprehensif</a></li>
                            </ul>

                        </li>
                        <li>
                            <a href="{{ route('mahasiswa.lab.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('mahasiswa/lab*') ? 'active' : '' }}">
                                <span class="micon fa-solid fa-flask-vial"></span><span class="mtext">Laboratorium
                                    TA</span>
                            </a>
                        </li>

                        @if (Auth::user()->mahasiswa->komprehensif->first())
                            <li>
                                <a href="{{ route('mahasiswa.pendataan_alumni.index') }}"
                                    class="dropdown-toggle no-arrow {{ Request::is('mahasiswa/pendataan_alumni*') ? 'active' : '' }}">
                                    <span class="micon fa fa-user-graduate"></span><span class="mtext">Pendataan
                                        Alumni</span>
                                </a>
                            </li>
                        @endif
                    @endrole
                    @role('alumni')
                        <li>
                            <a href="{{ route('mahasiswa.aktivitas_alumni.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('mahasiswa/aktivitas_alumni*') ? 'active' : '' }}">
                                <span class="micon fa fa-user-graduate"></span><span class="mtext">Aktivitas
                                    Alumni</span>
                            </a>
                        </li>
                    @endrole

                    {{-- @if (!Auth::user()->suggestion)
                        <li>
                            <a href="{{ route('mahasiswa.survey.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('mahasiswa/survey*') ? 'active' : '' }}">
                                <span class="micon bi bi-newspaper"></span><span class="mtext">Survei
                                </span>
                            </a>
                        </li>
                    @endif --}}
                    @role('admin berkas')
                        <li>
                            <a href="{{ route('berkas.berkas_persyaratan.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('admin/berkas/berkas_persyaratan*') ? 'active' : '' }}">
                                <span class="micon fa-solid fa-file"></span><span class="mtext">Syarat Seminar</span>
                            </a>
                        </li>
                        <li class="dropdown {{ Request::is('admin/berkas/validasi/seminar*') ? 'show' : '' }}">
                            <a href="javascript:;" class="dropdown-toggle"
                                data-option="{{ Request::is('admin/berkas/validasi/seminar*') ? 'on' : '' }}">

                                <span class="micon bi bi-person-rolodex"></span><span class="mtext">Validasi
                                    Seminar</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('berkas.validasi.seminar.kp.index') }}"
                                        class="{{ Request::is('admin/berkas/validasi/seminar/kp*') ? 'active' : '' }}">PKL/KP</a>
                                </li>
                                <li><a href="{{ route('berkas.validasi.seminar.ta1.index') }}"
                                        class="{{ Request::is('admin/berkas/validasi/seminar/ta1*') ? 'active' : '' }}">Tugas
                                        Akhir 1</a>
                                </li>
                                <li><a href="{{ route('berkas.validasi.seminar.ta2.index') }}"
                                        class="{{ Request::is('admin/berkas/validasi/seminar/ta2*') ? 'active' : '' }}">Tugas
                                        Akhir 2</a>
                                </li>
                                <li><a href="{{ route('berkas.validasi.sidang.kompre.index') }}"
                                        class="{{ Request::is('admin/berkas/validasi/sidang/kompre*') ? 'active' : '' }}">Komprehensif</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('berkas.validasi.pendataan_alumni.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('admin/berkas/validasi/pendataan_alumni*') ? 'active' : '' }}">
                                <span class="micon fa fa-user-graduate"></span><span class="mtext">Validasi
                                    Alumni</span>
                            </a>
                        </li>
                    @endrole

                    @role('dosen')
                        <li class="dropdown {{ Request::is('dosen/mahasiswa/bimbingan*') ? 'show' : '' }}">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa-solid fa-user"></span><span class="mtext">Bimbingan</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('dosen.mahasiswa.bimbingan.akademik.index') }}"
                                        class="{{ Request::is('dosen/mahasiswa/bimbingan/akademik*') ? 'active' : '' }}">Bimbingan
                                        Akademik</a></li>
                                <li><a href="{{ route('dosen.mahasiswa.bimbingan.kp.index') }}"
                                        class="{{ Request::is('dosen/mahasiswa/bimbingan/kp*') ? 'active' : '' }}">Bimbingan
                                        PKL/KP</a></li>
                                <li><a href="{{ route('dosen.mahasiswa.bimbingan.kompre.index') }}"
                                        class="{{ Request::is('dosen/mahasiswa/bimbingan/kompre*') ? 'active' : '' }}">Bimbingan
                                        Tugas Akhir</a></li>
                            </ul>
                        </li>
                        <li
                            class="dropdown {{ Request::is('dosen/litabmas*') || Request::is('dosen/publikasi*') || Request::is('dosen/organisasi*') || Request::is('dosen/penghargaan*') || Request::is('dosen/seminar*') ? 'show' : '' }}">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon far fa-file-certificate"></span><span class="mtext">Aktivitas
                                    Dosen</span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('dosen.litabmas.index') }}"
                                        class="{{ Request::is('dosen/litabmas*') ? 'active' : '' }}">LITABMAS</a></li>
                                <li><a href="{{ route('dosen.publikasi.index') }}"
                                        class="{{ Request::is('dosen/publikasi*') ? 'active' : '' }}">Publikasi</a></li>
                                <li><a href="{{ route('dosen.organisasi.index') }}"
                                        class="{{ Request::is('dosen/organisasi*') ? 'active' : '' }}">Organisasi</a>
                                </li>
                                <li><a href="{{ route('dosen.penghargaan.index') }}"
                                        class="{{ Request::is('dosen/penghargaan*') ? 'active' : '' }}">Penghargaan</a>
                                </li>
                                <li><a href="{{ route('dosen.seminar.index') }}"
                                        class="{{ Request::is('dosen/seminar*') ? 'active' : '' }}">Seminar</a></li>
                            </ul>


                        </li>
                    @endrole
                    @role('pkl')
                        <li>
                            <a href="{{ route('koor.jadwalPKL.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('koor/jadwalPKL*') ? 'active' : '' }}">
                                <span class="micon bi bi-calendar-week"></span><span class="mtext">Penjadwalan
                                    PKL/KP</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('koor.validasiBaPKL.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('koor/validasiBaPKL*') ? 'active' : '' }}">
                                <span class="micon bi bi-folder-check"></span><span class="mtext">Validasi Bukti
                                    PKL/KP</span>
                            </a>
                        </li>
                    @endrole
                    @role('ta1')
                        <li>
                            <a href="{{ route('koor.jadwalTA1.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('koor/jadwalTA1*') ? 'active' : '' }}">
                                <span class="micon bi bi-calendar-week"></span><span class="mtext">Penjadwalan TA
                                    1</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('koor.validasiBaTA1.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('koor/validasiBaTA1*') ? 'active' : '' }}">
                                <span class="micon bi bi-folder-check"></span><span class="mtext">Validasi Bukti TA
                                    1</span>
                            </a>
                        </li>
                    @endrole
                    @role('ta2')
                        <li>
                            <a href="{{ route('koor.jadwalTA2.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('koor/jadwalTA2*') ? 'active' : '' }}">
                                <span class="micon bi bi-calendar-week"></span><span class="mtext">Penjadwalan TA
                                    2</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('koor.validasiBaTA2.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('koor/validasiBaTA2*') ? 'active' : '' }}">
                                <span class="micon bi bi-folder-check"></span><span class="mtext">Validasi Bukti TA
                                    2</span>
                            </a>
                        </li>
                    @endrole
                    @role('kompre')
                        <li>
                            <a href="{{ route('koor.jadwalKompre.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('koor/jadwalKompre*') ? 'active' : '' }}">
                                <span class="micon bi bi-calendar-week"></span><span class="mtext">Penjadwalan
                                    Kompre</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('koor.validasiBaKompre.index') }}"
                                class="dropdown-toggle no-arrow {{ Request::is('koor/validasiBaKompre*') ? 'active' : '' }}">
                                <span class="micon bi bi-folder-check"></span><span class="mtext">Validasi Bukti
                                    Kompre</span>
                            </a>
                        </li>
                    @endrole
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay">
    </div>
    <div id="toast"></div>
    @yield('datatable')



    <!-- js -->
    <script src="/Assets/admin/vendors/scripts/core.js"></script>
    <script src="/Assets/admin/vendors/scripts/script.min.js"></script>
    <script src="/Assets/admin/vendors/scripts/process.js"></script>
    <script src="/Assets/admin/vendors/scripts/layout-settings.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/table.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <script src="/Assets/admin/vendors/scripts/dashboard3.js"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- buttons for Export datatable -->
    <script src="/Assets/admin/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/buttons.print.min.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/buttons.html5.min.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/buttons.flash.min.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/excel.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/vfs_fonts.js"></script>
    <script src="/Assets/admin/src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="/Assets/admin/src/plugins/sweetalert2/sweet-alert.init.js"></script>
    <!-- bootstrap-tagsinput js -->
    <script src="/Assets/admin/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="/Assets/src/lib/toastify/src/toastify.js"></script>
    <!-- Datatable Setting js -->
    <script src="/Assets/admin/vendors/scripts/datatable-setting.js"></script>
    <script src="/Assets/src/js/nocopy.js"></script>
    <!-- Tambahkan HTML untuk menampilkan notifikasi -->

    <!-- Tambahkan script untuk menampilkan notifikasi -->
    <script>
        @if (session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                gravity: "bottom",
                position: "right",
                backgroundColor: "#1abc9c",
                stopOnFocus: true,
            }).showToast();
        @elseif (session('error'))
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                gravity: "bottom",
                position: "right",
                backgroundColor: "#e74c3c",
                stopOnFocus: true,
            }).showToast();
        @elseif (session('message'))
            Toastify({
                text: "{{ session('message') }}",
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "#3498db",
                stopOnFocus: true,
            }).showToast();
        @endif
    </script>
    <script>
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => input.setAttribute('autocomplete', 'off'));
    </script>
    <script>
        function showConfirmationForm() {
            swal({
                title: 'Apakah Anda yakin ingin submit data ini ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('formStatus').submit();
                }
            })
        }

        // Mengambil elemen tombol submit
        const submitButton = document.getElementById('submitButton');

        // Menangani klik tombol submit
        submitButton.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah pengiriman form secara langsung

            // Panggil fungsi untuk menampilkan konfirmasi
            showConfirmationForm();
        });
    </script>

    <script>
        function deleteConfirmationForm(event) {
            event.preventDefault(); // Menghentikan aksi default dari event klik tombol

            swal({
                title: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                buttons: {
                    cancel: {
                        text: 'Tidak',
                        value: false,
                        visible: true,
                        className: 'btn btn-danger',
                        closeModal: true,
                    },
                    confirm: {
                        text: 'Ya',
                        value: true,
                        visible: true,
                        className: 'btn btn-success',
                        closeModal: true
                    }
                }
            }).then((result) => {
                if (result) {
                    document.getElementById('deleteForm').submit();
                }
            });
        }

        // Mengambil elemen tombol submit
        const deleteButton = document.getElementById('deleteBtn');

        // Menangani klik tombol submit
        deleteButton.addEventListener('click', deleteConfirmationForm);
    </script>
    <script>
        function showDeleteConfirmation(event) {
            event.preventDefault(); // Mencegah pengiriman form secara langsung

            const form = event.target.closest('form'); // Mendapatkan elemen form terdekat dari tombol yang diklik

            swal({
                title: 'Apakah Anda yakin ingin menghapus data ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result && result.value) {
                    form.submit();
                }
            });
        }
    </script>
    </script>


    <script>
        function updateFileNameAndLink(inputId, labelId, linkId) {
            var input = document.getElementById(inputId);
            var label = document.getElementById(labelId);
            var link = document.getElementById(linkId);

            if (input.files && input.files[0]) {
                label.textContent = input.files[0].name;
                link.href = URL.createObjectURL(input.files[0]);
                link.style.display = "inline";
            }
        }
    </script>
    <script>
        function toggleInput(selectElement, targetId, targetId2) {
            var selectedValue = selectElement.value;
            var targetElement2 = document.getElementById(targetId2);
            var targetElement = document.getElementById(targetId);
            if (selectedValue === "new") {
                targetElement.style.display = "block";
                targetElement2.style.display = "block";
                targetElement.hidden = false;
                targetElement2.hidden = false;
            } else {
                targetElement.style.display = "none";
                targetElement2.style.display = "none";
                targetElement.hidden = true;
                targetElement2.hidden = true;
            }
        }
    </script>
    <script>
        function toggleDropdown(selectElement, targetId) {
            var selectedValue = selectElement.value;
            var targetElement = document.getElementById(targetId);
            if (selectedValue === "Praktikum") {
                targetElement.style.display = "block";
                targetElement.hidden = false;
            } else {
                targetElement.style.display = "none";
                targetElement.hidden = true;
            }
        }
    </script>
    @role('kompre|ta2|ta1|pkl')
        <script>
            $(document).ready(function() {
                $('#formJadwal').submit(function(e) {
                    e.preventDefault();
                    var request = new FormData(this);
                    var endpoint = '/api/check-jadwal';
                    $.ajax({
                        url: endpoint,
                        method: "POST",
                        data: request,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data['message'] == 'Valid') {
                                swal({
                                    title: "Berhasil",
                                    text: "Jadwal Bisa digunakan",
                                    type: "question",
                                    showCancelButton: true,
                                    confirmButtonText: "Ya, Buat Jadwal",
                                }).then(function(result) {
                                    if (result.value) {
                                        $('#formJadwal').unbind('submit').submit();
                                    }
                                });
                            } else {
                                swal({
                                    title: "Gagal",
                                    text: "Jadwal yang anda masukkan sudah terdaftar",
                                    type: "error",
                                    button: "Ok",
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            var error_data = JSON.parse(xhr.responseText)['errors'];

                            var error_msg = "";
                            for (var key in error_data) {
                                error_msg += error_data[key] + ",";
                            }
                            swal({
                                title: "Gagal",
                                text: error_msg,
                                type: "error",
                                button: "Ok",
                            });
                        },
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#formJadwalUpdate').submit(function(e) {
                    e.preventDefault();
                    var request = new FormData(this);
                    var endpoint = '/api/check-update';
                    $.ajax({
                        url: endpoint,
                        method: "POST",
                        data: request,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data['message'] == 'Valid') {
                                swal({
                                    title: "Berhasil",
                                    text: "Jadwal Bisa digunakan",
                                    type: "question",
                                    showCancelButton: true,
                                    confirmButtonText: "Ya, Buat Jadwal",
                                }).then(function(result) {
                                    if (result.value) {
                                        $('#formJadwalUpdate').unbind('submit').submit();
                                    }
                                });
                            } else {
                                swal({
                                    title: "Gagal",
                                    text: "Jadwal yang anda masukkan sudah terdaftar",
                                    type: "error",
                                    button: "Ok",
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            var error_data = JSON.parse(xhr.responseText)['errors'];

                            var error_msg = "";
                            for (var key in error_data) {
                                error_msg += error_data[key] + ",";
                            }
                            swal({
                                title: "Gagal",
                                text: error_msg,
                                type: "error",
                                button: "Ok",
                            });
                        },
                    });
                });
            });
        </script>
    @endrole
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/datatables.min.js">
    </script> --}}

</body>

</html>
