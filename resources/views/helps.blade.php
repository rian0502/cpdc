@extends('layouts.admin')
@section('admin')
    <style>
        .numbered-list {
            counter-reset: list-counter;
            list-style-type: none;
        }

        .numbered-list-item::before {
            counter-increment: list-counter;
            content: counter(list-counter) ". ";
        }

        .numbered-list-item {
            margin-bottom: 5px;
        }

        .bold {
            font-weight: bold;
        }
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="title">
                                <h4>Bantuan</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Bantuan
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="faq-wrap">
                    @role('mahasiswa')
                        <h4 class="mb-20 h4 text-blue">Daftar Seminar</h4>
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
                                            Mohon untuk terlebih dahulu masuk ke akun Anda sebelum melanjutkan. Setelah masuk
                                            pada akun, kemudian pergi ke tab <strong>Seminar</strong> yang terletak pada bagian
                                            bawah logo
                                            CPDC. Setelah itu, klik pada opsi <a class="text-primary bold"
                                                href="/mahasiswa/seminar/kp">Kerja Praktik</a>.

                                            Selanjutnya, isi data dengan benar pada kolom yang tersedia. Jika Anda telah mengisi
                                            data, klik tombol <strong>Submit</strong> untuk melanjutkan.

                                            Dengan mengikuti langkah-langkah di atas, Anda dapat mendaftar seminar kerja praktik
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
                                            Mohon untuk terlebih dahulu masuk ke akun Anda sebelum melanjutkan. Setelah masuk
                                            pada akun, kemudian klik pada tab <strong>Seminar</strong> yang terletak pada bagian
                                            bawah logo
                                            CPDC. Setelah itu, klik pada opsi
                                            <a class="text-primary bold" href="/mahasiswa/seminar/tugas_akhir_1">Tugas Akhir
                                                1</a>.
                                            Selanjutnya, isi data dengan benar pada kolom yang tersedia. Jika Anda telah mengisi
                                            data, klik tombol <strong>Submit</strong> untuk melanjutkan.

                                            Dengan mengikuti langkah-langkah di atas, Anda dapat mendaftar seminar kerja praktik
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
                                            Mohon untuk terlebih dahulu masuk ke akun Anda sebelum melanjutkan. Setelah masuk
                                            pada akun, pastikan anda sudah menyelesaikan
                                            <a class="text-primary bold" href="/mahasiswa/seminar/tugas_akhir_1">
                                                Seminar Tugas Akhir 1
                                            </a>
                                            terlebih dahulu sebelum mendaftar Seminar Tugas Akhir 2. Jika telah menyelesaikan
                                            <strong>Seminar Tugas
                                                Akhir 1</strong>, kemudian klik pada tab <strong>Seminar</strong> yang terletak
                                            pada bagian bawah logo
                                            CPDC. Setelah itu, klik pada opsi
                                            <a class="text-primary bold" href="/mahasiswa/seminar/tugas_akhir_2">Tugas
                                                Akhir 2</a>.
                                            Selanjutnya, isi data dengan benar pada kolom yang tersedia. Jika Anda telah mengisi
                                            data, klik tombol <strong>Submit</strong> untuk melanjutkan.

                                            Dengan mengikuti langkah-langkah di atas, Anda dapat mendaftar seminar kerja praktik
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
                                            Mohon untuk terlebih dahulu masuk ke akun Anda sebelum melanjutkan. Setelah masuk
                                            pada akun, pastikan anda sudah menyelesaikan
                                            <a class="text-primary bold" href="/mahasiswa/seminar/tugas_akhir_2">
                                                Seminar Tugas Akhir 2
                                            </a>
                                            terlebih dahulu sebelum mendaftar Sidang Komprehensif. Jika telah menyelesaikan
                                            <strong>Seminar Tugas
                                                Akhir 2</strong>, kemudian klik pada tab <strong>Seminar</strong> yang terletak
                                            pada bagian bawah logo
                                            CPDC. Setelah itu, klik pada opsi
                                            <a class="text-primary bold" href="/mahasiswa/sidang/kompre">Sidang
                                                Komprehensif</a>.
                                            Selanjutnya, isi data dengan benar pada kolom yang tersedia. Jika Anda telah mengisi
                                            data, klik tombol <strong>Submit</strong> untuk melanjutkan.

                                            Dengan mengikuti langkah-langkah di atas, Anda dapat mendaftar seminar kerja praktik
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
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus debitis ab
                                        iusto quidem consequatur nesciunt corporis illo aliquam dignissimos necessitatibus!
                                        Sed mollitia illum consectetur repellat, magni eaque. Possimus vero tempore ex
                                        deserunt impedit tenetur eaque dolorum voluptatibus aliquid, quaerat quidem
                                        deleniti! Inventore et itaque illum maxime sint distinctio maiores. Consectetur?
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
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque ullam voluptatem
                                        officia natus totam esse distinctio voluptate aspernatur quam molestias! Voluptate,
                                        laborum minus quas recusandae molestiae, dolorum alias libero blanditiis nostrum
                                        nihil, iste dignissimos explicabo enim mollitia! Optio sunt cum vitae repudiandae,
                                        culpa, voluptates, cumque accusantium impedit ratione inventore dicta.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="mb-30 h4 text-blue padding-top-30">Kata Sandi</h4>
                    <div id="accordion2">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#pengaturan">
                                     Mengganti Kata Sandi Akun di Pengaturan
                                </button>
                            </div>
                            <div id="pengaturan" class="collapse" data-parent="#accordion2">
                                <div class="card-body">

                                    <div class="text-justify">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus debitis ab
                                        iusto quidem consequatur nesciunt corporis illo aliquam dignissimos necessitatibus!
                                        Sed mollitia illum consectetur repellat, magni eaque. Possimus vero tempore ex
                                        deserunt impedit tenetur eaque dolorum voluptatibus aliquid, quaerat quidem
                                        deleniti! Inventore et itaque illum maxime sint distinctio maiores. Consectetur?
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
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque ullam voluptatem
                                        officia natus totam esse distinctio voluptate aspernatur quam molestias! Voluptate,
                                        laborum minus quas recusandae molestiae, dolorum alias libero blanditiis nostrum
                                        nihil, iste dignissimos explicabo enim mollitia! Optio sunt cum vitae repudiandae,
                                        culpa, voluptates, cumque accusantium impedit ratione inventore dicta.
                                    </div>
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
