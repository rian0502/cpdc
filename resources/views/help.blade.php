@extends('layouts.umum')
@section('umum')
    <style>
        .text-justify {
            text-align: justify;
        }
    </style>
    <link rel="stylesheet" href="/Assets/admin/vendors/styles/help.css">
    <script src="/Assets/js/help.js"></script>
    <script src="/Assets/admin/vendors/scripts/core.js"></script>
    <script src="/Assets/admin/vendors/scripts/script.min.js"></script>
    <script src="/Assets/admin/vendors/scripts/process.js"></script>
    <script src="/Assets/admin/vendors/scripts/layout-settings.js"></script>

    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <h1>Bantuan</h1>
            </div>
        </div>

        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="faq-wrap">
                    @if (Auth::check())
                        @role('mahasiswa')
                            <h4 class="mb-20 h4 text-blue mb-3">Daftar Seminar</h4>
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#kp">
                                            Mendaftar Seminar Kerja Praktik
                                        </button>
                                    </div>
                                    <div id="kp" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div>Daftar Seminar kerja praktik dapat dilakukan dengan cara berikut:</div>
                                            <div class="text-justify">
                                                Mohon untuk terlebih dahulu masuk ke akun Anda sebelum melanjutkan. Setelah
                                                masuk
                                                pada akun, kemudian pergi ke tab <strong>Seminar</strong> yang terletak pada
                                                bagian
                                                bawah logo
                                                CPDC. Setelah itu, klik pada opsi <a class="text-primary bold"
                                                    href="/mahasiswa/seminar/kp">Kerja Praktik</a>.

                                                Selanjutnya, <span class="text-danger bold">isi data dengan benar</span> pada
                                                kolom yang tersedia. Jika Anda telah
                                                mengisi
                                                data, klik tombol <strong>Kirim</strong> untuk melanjutkan.

                                                Dengan mengikuti langkah-langkah di atas, Anda dapat mendaftar seminar kerja
                                                praktik
                                                dengan mudah.
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#ta1">
                                            Mendaftar Seminar Tugas Akhir 1
                                        </button>
                                    </div>
                                    <div id="ta1" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div>Daftar Seminar Tugas Akhir 1 dapat dilakukan dengan cara berikut:</div>
                                            <div class="text-justify">
                                                Mohon untuk terlebih dahulu masuk ke akun Anda sebelum melanjutkan. Setelah
                                                masuk
                                                pada akun, kemudian klik pada tab <strong>Seminar</strong> yang terletak pada
                                                bagian
                                                bawah logo
                                                CPDC. Setelah itu, klik pada opsi
                                                <a class="text-primary bold" href="/mahasiswa/seminar/tugas_akhir_1">Tugas Akhir
                                                    1</a>.
                                                Selanjutnya, <span class="text-danger bold">isi data dengan benar</span> pada
                                                kolom yang tersedia. Jika Anda telah
                                                mengisi
                                                data, klik tombol <strong>Kirim</strong> untuk melanjutkan.

                                                Dengan mengikuti langkah-langkah di atas, Anda dapat mendaftar seminar kerja
                                                praktik
                                                dengan mudah.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#ta2">
                                            Mendaftar Seminar Tugas Akhir 2
                                        </button>
                                    </div>
                                    <div id="ta2" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div>Daftar Seminar Tugas Akhir 2 dapat dilakukan dengan cara berikut:</div>
                                            <div class="text-justify">
                                                Mohon untuk terlebih dahulu masuk ke akun Anda sebelum melanjutkan. Setelah
                                                masuk
                                                pada akun, pastikan anda sudah menyelesaikan
                                                <a class="text-primary bold" href="/mahasiswa/seminar/tugas_akhir_1">
                                                    Seminar Tugas Akhir 1
                                                </a>
                                                terlebih dahulu sebelum mendaftar Seminar Tugas Akhir 2. Jika telah
                                                menyelesaikan
                                                <strong>Seminar Tugas
                                                    Akhir 1</strong>, kemudian klik pada tab <strong>Seminar</strong> yang
                                                terletak
                                                pada bagian bawah logo
                                                CPDC. Setelah itu, klik pada opsi
                                                <a class="text-primary bold" href="/mahasiswa/seminar/tugas_akhir_2">Tugas
                                                    Akhir 2</a>.
                                                Selanjutnya, <span class="text-danger bold">isi data dengan benar</span> pada
                                                kolom yang tersedia. Jika Anda telah
                                                mengisi
                                                data, klik tombol <strong>Kirim</strong> untuk melanjutkan.

                                                Dengan mengikuti langkah-langkah di atas, Anda dapat mendaftar seminar kerja
                                                praktik
                                                dengan mudah.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#kompre">
                                            Mendaftar Sidang Komprehensif
                                        </button>
                                    </div>
                                    <div id="kompre" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div>Daftar Sidang Komprehensif dapat dilakukan dengan cara berikut:</div>
                                            <div class="text-justify">
                                                Mohon untuk terlebih dahulu masuk ke akun Anda sebelum melanjutkan. Setelah
                                                masuk
                                                pada akun, pastikan anda sudah menyelesaikan
                                                <a class="text-primary bold" href="/mahasiswa/seminar/tugas_akhir_2">
                                                    Seminar Tugas Akhir 2
                                                </a>
                                                terlebih dahulu sebelum mendaftar Sidang Komprehensif. Jika telah menyelesaikan
                                                <strong>Seminar Tugas
                                                    Akhir 2</strong>, kemudian klik pada tab <strong>Seminar</strong> yang
                                                terletak
                                                pada bagian bawah logo
                                                CPDC. Setelah itu, klik pada opsi
                                                <a class="text-primary bold" href="/mahasiswa/sidang/kompre">Sidang
                                                    Komprehensif</a>.
                                                Selanjutnya, <span class="text-danger bold">isi data dengan benar</span> pada
                                                kolom yang tersedia. Jika Anda telah
                                                mengisi
                                                data, klik tombol <strong>Kirim</strong> untuk melanjutkan.

                                                Dengan mengikuti langkah-langkah di atas, Anda dapat mendaftar seminar kerja
                                                praktik
                                                dengan mudah.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endrole
                        <h4 class="mb-30 h4 text-blue padding-top-30">Mengubah Data Profil Akun</h4>
                        <div id="accordion1">
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#foto">
                                        Mengganti Foto Profil
                                    </button>
                                </div>
                                <div id="foto" class="collapse" data-parent="#accordion1">
                                    <div class="card-body">
                                        <div class="text-justify">
                                            Silakan masuk ke akun Anda terlebih dahulu sebelum melanjutkan. Setelah masuk,
                                            klik
                                            nama akun yang berada di pojok kanan atas, kemudian pilih opsi
                                            @if (auth()->user()->hasRole('admin lab'))
                                                <a class="text-primary bold"
                                                    href="{{ route('admin.profile.index') }}">Profil</a>. Setelah
                                            @elseif(auth()->user()->hasRole('admin berkas'))
                                                <a class="text-primary bold"
                                                    href="{{ route('admin.profile.index') }}">Profil</a>. Setelah
                                            @elseif(auth()->user()->hasRole('dosen'))
                                                <a class="text-primary bold"
                                                    href="{{ route('dosen.profile.index') }}">Profil</a>. Setelah
                                            @elseif(auth()->user()->hasRole('mahasiswa'))
                                                <a class="text-primary bold"
                                                    href="{{ route('mahasiswa.profile.index') }}">Profil</a>. Setelah
                                            @elseif(auth()->user()->hasRole('alumni'))
                                                <a class="text-primary bold" href="#">Profil</a>. Setelah
                                            @elseif(auth()->user()->hasRole('kalab'))
                                                <a class="text-primary bold" href="#">Profil</a>. Setelah
                                            @elseif(auth()->user()->hasRole('jurusan'))
                                                <a class="text-primary bold" href="#">Profil</a>. Setelah
                                            @endif
                                            itu, klik ikon <strong>pensil</strong> untuk mengganti foto profil Anda.
                                            Selanjutnya, klik tombol
                                            <strong>Choose File</strong> untuk membuka jendela <i>file explorer</i>,
                                            <strong>pastikan menggunakan format gambar yang umum digunakan seperti .jpg
                                                atau .png</strong> sebelum memilih gambar yang ingin digunakan sebagai foto
                                            profil. Setelah memilih gambar yang sesuai, klik tombol
                                            <strong>Open</strong>
                                            di <i>file
                                                explorer</i>. Terakhir, klik <strong>Kirim</strong> untuk menyimpan foto
                                            profil
                                            baru
                                            Anda.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#bio">
                                        Mengubah Biodata
                                    </button>
                                </div>
                                <div id="bio" class="collapse" data-parent="#accordion1">
                                    <div class="card-body">
                                        <div class="text-justify">
                                            Silakan masuk ke akun Anda terlebih dahulu sebelum melanjutkan. Setelah masuk,
                                            klik
                                            nama akun yang berada di pojok kanan atas, kemudian pilih opsi
                                            @if (auth()->user()->hasRole('admin lab'))
                                                <a class="text-primary bold"
                                                    href="{{ route('admin.profile.index') }}">Profil</a>. Setelah
                                            @elseif(auth()->user()->hasRole('admin berkas'))
                                                <a class="text-primary bold"
                                                    href="{{ route('admin.profile.index') }}">Profil</a>. Setelah
                                            @elseif(auth()->user()->hasRole('dosen'))
                                                <a class="text-primary bold"
                                                    href="{{ route('dosen.profile.index') }}">Profil</a>. Setelah
                                            @elseif(auth()->user()->hasRole('mahasiswa'))
                                                <a class="text-primary bold"
                                                    href="{{ route('mahasiswa.profile.index') }}">Profil</a>. Setelah
                                            @elseif(auth()->user()->hasRole('alumni'))
                                                <a class="text-primary bold" href="#">Profil</a>. Setelah
                                            @elseif(auth()->user()->hasRole('kalab'))
                                                <a class="text-primary bold" href="#">Profil</a>. Setelah
                                            @elseif(auth()->user()->hasRole('jurusan'))
                                                <a class="text-primary bold" href="#">Profil</a>. Setelah
                                            @endif
                                            itu, klik ikon <strong>pensil</strong> untuk mengubah biodata profil Anda.
                                            Selanjutnya, <span class="text-danger bold">isi data dengan benar</span> pada
                                            kolom yang disediakan.
                                            Terakhir, klik
                                            <strong>Kirim</strong>
                                            untuk menyimpan biodata yang telah diubah sebelumnya.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="mb-30 h4 text-blue padding-top-30">Kata Sandi</h4>
                        <div id="accordion2">
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-block collapsed" data-toggle="collapse"
                                        data-target="#pengaturan">
                                        Mengganti Kata Sandi Akun di Pengaturan
                                    </button>
                                </div>
                                <div id="pengaturan" class="collapse" data-parent="#accordion2">
                                    <div class="card-body">

                                        <div class="text-justify">
                                            Silakan masuk ke akun Anda terlebih dahulu sebelum melanjutkan. Setelah masuk,
                                            klik nama akun yang terletak di pojok kanan atas, kemudian pilih opsi
                                            <a class="text-primary bold" href="/settings">Pengaturan</a>. Di halaman
                                            pengaturan, lengkapi kolom-kolom yang tersedia dengan
                                            benar.
                                            <span class="text-danger bold">Pastikan kata sandi yang Anda masukkan
                                                memiliki
                                                minimal 8 digit dan
                                                merupakan kombinasi huruf atau angka. Selain itu, kata sandi harus
                                                mengandung
                                                setidaknya satu huruf besar, satu huruf kecil, satu angka, dan satu
                                                simbol</span>.
                                            Setelah itu, klik tombol <strong>Simpan</strong> untuk menyimpan perubahan yang
                                            telah Anda buat
                                            sebelumnya pada kata sandi.
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#lupa">
                                        Mengganti Kata Sandi Akun Jika Lupa
                                    </button>
                                </div>
                                <div id="lupa" class="collapse" data-parent="#accordion2">
                                    <div class="card-body">
                                        <div class="text-justify">
                                            Klik tombol <a class="text-primary bold" href="/login">Masuk</a> yang
                                            terletak pada halaman beranda. Setelah itu, cari dan
                                            klik
                                            opsi <a class="text-primary bold" href="/forgot-password">Lupa Kata
                                                Sandi?</a>. Di
                                            halaman selanjutnya, <strong>masukkan alamat email yang
                                                terdaftar pada akun Anda</strong>, dan <span
                                                class="text-danger bold">pastikan
                                                bahwa email tersebut masih aktif</span>.
                                            Setelah
                                            itu, klik tombol <strong>Kirim</strong>. <strong>Buka kotak masuk email Anda dan
                                                temukan email yang
                                                dikirim
                                                untuk mengganti kata sandi akun Anda</strong>. Klik tautan atau tombol
                                            <strong>Reset Password</strong>
                                            yang
                                            disediakan dalam email tersebut. Di halaman reset password, <strong>masukkan
                                                email Anda
                                                dan
                                                masukkan kata sandi baru yang ingin Anda gunakan</strong>. <span
                                                class="text-danger bold">Pastikan kata sandi yang Anda
                                                masukkan memiliki minimal 8 karakter dan merupakan kombinasi huruf atau
                                                angka.
                                                Selain itu, kata sandi harus mengandung setidaknya satu huruf besar, satu
                                                huruf
                                                kecil, satu angka, dan satu simbol</span>. Setelah memasukkan informasi yang
                                            diperlukan,
                                            klik tombol <strong>Reset</strong> untuk mengatur ulang kata sandi Anda. Setelah
                                            berhasil
                                            mereset
                                            kata sandi, Anda dapat <a class="text-primary bold" href="/login">Masuk</a>
                                            kembali ke akun dengan menggunakan kata sandi baru
                                            yang
                                            telah Anda tentukan.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#kp">
                                        Mendaftar Seminar Kerja Praktik
                                    </button>
                                </div>
                                <div id="kp" class="collapse" data-parent="#accordion">
                                    <div class="card-body">

                                        <div class="text-justify">
                                            Mohon untuk terlebih dahulu masuk ke akun Anda sebelum melanjutkan. Setelah
                                            masuk
                                            pada akun, kemudian pergi ke tab <strong>Seminar</strong> yang terletak pada
                                            bagian
                                            bawah logo
                                            CPDC. Setelah itu, klik pada opsi
                                            <a class="text-primary bold">Kerja Praktik</a>.
                                            Selanjutnya, <span class="text-danger bold">isi data dengan benar</span> pada
                                            kolom yang tersedia. Jika Anda telah
                                            mengisi
                                            data, klik tombol <strong>Kirim</strong> untuk melanjutkan.
                                            Dengan mengikuti langkah-langkah di atas, Anda dapat mendaftar seminar kerja
                                            praktik
                                            dengan mudah.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#ta1">
                                        Mendaftar Seminar Tugas Akhir 1
                                    </button>
                                </div>
                                <div id="ta1" class="collapse" data-parent="#accordion">
                                    <div class="card-body">

                                        <div class="text-justify">
                                            Mohon untuk terlebih dahulu masuk ke akun Anda sebelum melanjutkan. Setelah
                                            masuk
                                            pada akun, kemudian klik pada tab <strong>Seminar</strong> yang terletak pada
                                            bagian
                                            bawah logo
                                            CPDC. Setelah itu, klik pada opsi
                                            <span class="text-primary bold">Tugas Akhir
                                                1</span>.
                                            Selanjutnya, <span class="text-danger bold">isi data dengan benar</span> pada
                                            kolom yang tersedia. Jika Anda telah
                                            mengisi
                                            data, klik tombol <strong>Kirim</strong> untuk melanjutkan.

                                            Dengan mengikuti langkah-langkah di atas, Anda dapat mendaftar seminar kerja
                                            praktik
                                            dengan mudah.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#ta2">
                                        Mendaftar Seminar Tugas Akhir 2
                                    </button>
                                </div>
                                <div id="ta2" class="collapse" data-parent="#accordion">
                                    <div class="card-body">

                                        <div class="text-justify">
                                            Mohon untuk terlebih dahulu masuk ke akun Anda sebelum melanjutkan. Setelah
                                            masuk
                                            pada akun, pastikan anda sudah menyelesaikan
                                            <span class="text-primary bold">Seminar Tugas Akhir 1</span>
                                            terlebih dahulu sebelum mendaftar Seminar Tugas Akhir 2. Jika telah
                                            menyelesaikan
                                            <strong>Seminar Tugas
                                                Akhir 1</strong>, kemudian klik pada tab <strong>Seminar</strong> yang
                                            terletak
                                            pada bagian bawah logo
                                            CPDC. Setelah itu, klik pada opsi
                                            <span class="text-primary bold"">Tugas
                                                Akhir 2</span>.
                                            Selanjutnya, <span class="text-danger bold">isi data dengan benar</span> pada
                                            kolom yang tersedia. Jika Anda telah
                                            mengisi
                                            data, klik tombol <strong>Kirim</strong> untuk melanjutkan.

                                            Dengan mengikuti langkah-langkah di atas, Anda dapat mendaftar seminar kerja
                                            praktik
                                            dengan mudah.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-5">
                                <div class="card-header">
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#kompre">
                                        Mendaftar Sidang Komprehensif
                                    </button>
                                </div>
                                <div id="kompre" class="collapse" data-parent="#accordion">
                                    <div class="card-body">

                                        <div class="text-justify">
                                            Mohon untuk terlebih dahulu masuk ke akun Anda sebelum melanjutkan. Setelah
                                            masuk
                                            pada akun, pastikan anda sudah menyelesaikan
                                            <span class="text-primary bold">
                                                Seminar Tugas Akhir 2
                                            </span>
                                            terlebih dahulu sebelum mendaftar Sidang Komprehensif. Jika telah menyelesaikan
                                            <strong>Seminar Tugas
                                                Akhir 2</strong>, kemudian klik pada tab <strong>Seminar</strong> yang
                                            terletak
                                            pada bagian bawah logo
                                            CPDC. Setelah itu, klik pada opsi
                                            <span class="text-primary bold">Sidang
                                                Komprehensif</span>.
                                            Selanjutnya, <span class="text-danger bold">isi data dengan benar</span> pada
                                            kolom yang tersedia. Jika Anda telah
                                            mengisi
                                            data, klik tombol <strong>Kirim</strong> untuk melanjutkan.

                                            Dengan mengikuti langkah-langkah di atas, Anda dapat mendaftar seminar kerja
                                            praktik
                                            dengan mudah.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="mb-30 h4 text-blue padding-top-30 mb-4">Mengubah Data Profil Akun</h4>

                        <div id="accordion1">
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#foto">
                                        Mengganti Foto Profil
                                    </button>
                                </div>
                                <div id="foto" class="collapse" data-parent="#accordion1">
                                    <div class="card-body">
                                        <div class="text-justify">
                                            Silakan masuk ke akun Anda terlebih dahulu sebelum melanjutkan. Setelah masuk,
                                            klik nama akun yang berada di pojok kanan atas, kemudian pilih opsi <span
                                                class="text-primary bold">Profil</span>.
                                            Setelah itu, klik ikon <strong>pensil</strong> untuk mengganti foto profil Anda.
                                            Selanjutnya, klik tombol
                                            <strong>Choose File</strong> untuk membuka jendela <i>file explorer</i>,
                                            <strong>pastikan menggunakan format gambar yang umum digunakan seperti .jpg
                                                atau .png</strong> sebelum memilih gambar yang ingin digunakan sebagai foto
                                            profil. Setelah memilih gambar yang sesuai, klik tombol
                                            <strong>Open</strong>
                                            di <i>file
                                                explorer</i>. Terakhir, klik <strong>Kirim</strong> untuk menyimpan foto
                                            profil
                                            baru
                                            Anda.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-5">
                                <div class="card-header">
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#bio">
                                        Mengubah Biodata
                                    </button>
                                </div>
                                <div id="bio" class="collapse" data-parent="#accordion1">
                                    <div class="card-body">
                                        <div class="text-justify">
                                            Silakan masuk ke akun Anda terlebih dahulu sebelum melanjutkan. Setelah masuk,
                                            klik
                                            nama akun yang berada di pojok kanan atas, kemudian pilih opsi
                                            <span class="text-primary bold">Profil</span>. Setelah itu, klik ikon
                                            <strong>pensil</strong> untuk mengubah biodata profil Anda.
                                            Selanjutnya, <span class="text-danger bold">isi data dengan benar</span> pada
                                            kolom yang disediakan.
                                            Terakhir, klik <strong>Kirim</strong>
                                            untuk menyimpan biodata yang telah diubah sebelumnya.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="mb-30 h4 text-blue padding-top-30 mb-4">Kata Sandi</h4>
                        <div id="accordion2">
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-block collapsed" data-toggle="collapse"
                                        data-target="#pengaturan">
                                        Mengganti Kata Sandi Akun di Pengaturan
                                    </button>
                                </div>
                                <div id="pengaturan" class="collapse" data-parent="#accordion2">
                                    <div class="card-body">

                                        <div class="text-justify">
                                            Silakan masuk ke akun Anda terlebih dahulu sebelum melanjutkan. Setelah masuk,
                                            klik nama akun yang terletak di pojok kanan atas, kemudian pilih opsi
                                            <span class="text-primary bold">Pengaturan</span>. Di halaman pengaturan,
                                            lengkapi kolom-kolom yang tersedia dengan
                                            benar. <strong>Pastikan kata sandi yang Anda masukkan memiliki</strong> <span
                                                class="text-danger bold">minimal 8 digit dan
                                                merupakan kombinasi huruf atau angka. Selain itu, kata sandi harus
                                                mengandung
                                                setidaknya satu huruf besar, satu huruf kecil, satu angka, dan satu
                                                simbol</span>.
                                            Setelah itu, klik tombol <strong>Simpan</strong> untuk menyimpan perubahan yang
                                            telah Anda buat
                                            sebelumnya pada kata sandi.
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#lupa">
                                        Mengganti Kata Sandi Akun Jika Lupa
                                    </button>
                                </div>
                                <div id="lupa" class="collapse" data-parent="#accordion2">
                                    <div class="card-body">
                                        <div class="text-justify">
                                            Klik tombol <a class="text-primary bold" href="/login">Masuk</a> yang
                                            terletak pada halaman beranda. Setelah itu, cari dan
                                            klik
                                            opsi <a class="text-primary bold" href="/forgot-password">Lupa Kata
                                                Sandi?</a>. Di
                                            halaman selanjutnya, <strong>masukkan alamat email yang
                                                terdaftar pada akun Anda</strong>, dan <span
                                                class="text-danger bold">pastikan bahwa email tersebut masih aktif</span>.
                                            Setelah
                                            itu, klik tombol <strong>Kirim</strong>. <strong>Buka kotak masuk email Anda dan
                                                temukan email yang
                                                dikirim
                                                untuk mengganti kata sandi akun Anda</strong>. Klik tautan atau tombol
                                            <strong>Reset Password</strong>
                                            yang
                                            disediakan dalam email tersebut. Di halaman reset password, <strong>masukkan
                                                email Anda
                                                dan
                                                masukkan kata sandi baru yang ingin Anda gunakan</strong>. <span
                                                class="text-danger bold">Pastikan kata sandi yang Anda
                                                masukkan memiliki minimal 8 karakter dan merupakan kombinasi huruf atau
                                                angka.
                                                Selain itu, kata sandi harus mengandung setidaknya satu huruf besar, satu
                                                huruf
                                                kecil, satu angka, dan satu simbol</span>. Setelah memasukkan informasi yang
                                            diperlukan,
                                            klik tombol <strong>Reset</strong> untuk mengatur ulang kata sandi Anda. Setelah
                                            berhasil
                                            mereset
                                            kata sandi, Anda dapat <a class="text-primary bold" href="/login">Masuk</a>
                                            kembali ke akun dengan menggunakan kata sandi baru
                                            yang
                                            telah Anda tentukan.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
