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
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq1">
                                        Mendaftar Seminar Kerja Praktik
                                    </button>
                                </div>
                                <div id="faq1" class="collapse" data-parent="#accordion">
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
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq2">
                                        Mendaftar Seminar Tugas Akhir 1
                                    </button>
                                </div>
                                <div id="faq2" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <div>Daftar Seminar Tugas Akhir 1 dapat dilakukan dengan cara berikut:</div>
                                        <div class="text-justify">
                                            Mohon untuk terlebih dahulu masuk ke akun Anda sebelum melanjutkan. Setelah masuk
                                            pada akun, kemudian klik pada tab <strong>Seminar</strong> yang terletak pada bagian
                                            bawah logo
                                            CPDC. Setelah itu, klik pada opsi
                                            <a class="text-primary bold" href="/mahasiswa/seminar/tugas_akhir_1">Tugas Akhir 1</a>.
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
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq3">
                                        Mendaftar Seminar Tugas Akhir 2
                                    </button>
                                </div>
                                <div id="faq3" class="collapse" data-parent="#accordion">
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
                                    <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq4">
                                        Mendaftar Sidang Komprehensif
                                    </button>
                                </div>
                                <div id="faq4" class="collapse" data-parent="#accordion">
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
                                            <a class="text-primary bold"
                                                href="/mahasiswa/sidang/kompre">Sidang Komprehensif</a>.
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
                    <div class="padding-bottom-30">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq1-1">
                                    Collapsible Group Item #1
                                </button>
                            </div>
                            <div id="faq1-1" class="collapse">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                    sunt aliqua put a bird on it squid single-origin coffee
                                    nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                    Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq2-2">
                                    Collapsible Group Item #2
                                </button>
                            </div>
                            <div id="faq2-2" class="collapse">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                    sunt aliqua put a bird on it squid single-origin coffee
                                    nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                    Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq3-3">
                                    Collapsible Group Item #3
                                </button>
                            </div>
                            <div id="faq3-3" class="collapse">
                                <div class="card-body">
                                    <p>
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                                        accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                        tempor, sunt aliqua put a bird on it squid single-origin
                                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt
                                        sapiente ea proident. Ad vegan excepteur butcher vice
                                        lomo. Leggings occaecat craft beer farm-to-table, raw
                                        denim aesthetic synth nesciunt you probably haven't heard
                                        of them accusamus labore sustainable VHS.
                                    </p>
                                    <p class="mb-0">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                                        accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                        tempor, sunt aliqua put a bird on it squid single-origin
                                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt
                                        sapiente ea proident. Ad vegan excepteur butcher vice
                                        lomo. Leggings occaecat craft beer farm-to-table, raw
                                        denim aesthetic synth nesciunt you probably haven't heard
                                        of them accusamus labore sustainable VHS.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq4-4">
                                    Collapsible Group Item #4
                                </button>
                            </div>
                            <div id="faq4-4" class="collapse">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                    sunt aliqua put a bird on it squid single-origin coffee
                                    nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                    Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq5-5">
                                    Collapsible Group Item #5
                                </button>
                            </div>
                            <div id="faq5-5" class="collapse">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                    sunt aliqua put a bird on it squid single-origin coffee
                                    nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                    Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq6-6">
                                    Collapsible Group Item #6
                                </button>
                            </div>
                            <div id="faq6-6" class="collapse">
                                <div class="card-body">
                                    <p>
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                                        accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                        tempor, sunt aliqua put a bird on it squid single-origin
                                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt
                                        sapiente ea proident. Ad vegan excepteur butcher vice
                                        lomo. Leggings occaecat craft beer farm-to-table, raw
                                        denim aesthetic synth nesciunt you probably haven't heard
                                        of them accusamus labore sustainable VHS.
                                    </p>
                                    <p class="mb-0">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                                        accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                        tempor, sunt aliqua put a bird on it squid single-origin
                                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt
                                        sapiente ea proident. Ad vegan excepteur butcher vice
                                        lomo. Leggings occaecat craft beer farm-to-table, raw
                                        denim aesthetic synth nesciunt you probably haven't heard
                                        of them accusamus labore sustainable VHS.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="mb-30 h4 text-blue padding-top-30">Mengubah Kata Sandi</h4>
                    <div class="padding-bottom-30">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq1-1">
                                    Collapsible Group Item #1
                                </button>
                            </div>
                            <div id="faq1-1" class="collapse">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                    sunt aliqua put a bird on it squid single-origin coffee
                                    nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                    Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq2-2">
                                    Collapsible Group Item #2
                                </button>
                            </div>
                            <div id="faq2-2" class="collapse">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                    sunt aliqua put a bird on it squid single-origin coffee
                                    nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                    Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq3-3">
                                    Collapsible Group Item #3
                                </button>
                            </div>
                            <div id="faq3-3" class="collapse">
                                <div class="card-body">
                                    <p>
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                                        accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                        tempor, sunt aliqua put a bird on it squid single-origin
                                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt
                                        sapiente ea proident. Ad vegan excepteur butcher vice
                                        lomo. Leggings occaecat craft beer farm-to-table, raw
                                        denim aesthetic synth nesciunt you probably haven't heard
                                        of them accusamus labore sustainable VHS.
                                    </p>
                                    <p class="mb-0">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                                        accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                        tempor, sunt aliqua put a bird on it squid single-origin
                                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt
                                        sapiente ea proident. Ad vegan excepteur butcher vice
                                        lomo. Leggings occaecat craft beer farm-to-table, raw
                                        denim aesthetic synth nesciunt you probably haven't heard
                                        of them accusamus labore sustainable VHS.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq4-4">
                                    Collapsible Group Item #4
                                </button>
                            </div>
                            <div id="faq4-4" class="collapse">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                    sunt aliqua put a bird on it squid single-origin coffee
                                    nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                    Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq5-5">
                                    Collapsible Group Item #5
                                </button>
                            </div>
                            <div id="faq5-5" class="collapse">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                    sunt aliqua put a bird on it squid single-origin coffee
                                    nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                    Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq6-6">
                                    Collapsible Group Item #6
                                </button>
                            </div>
                            <div id="faq6-6" class="collapse">
                                <div class="card-body">
                                    <p>
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                                        accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                        tempor, sunt aliqua put a bird on it squid single-origin
                                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt
                                        sapiente ea proident. Ad vegan excepteur butcher vice
                                        lomo. Leggings occaecat craft beer farm-to-table, raw
                                        denim aesthetic synth nesciunt you probably haven't heard
                                        of them accusamus labore sustainable VHS.
                                    </p>
                                    <p class="mb-0">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                                        accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                        tempor, sunt aliqua put a bird on it squid single-origin
                                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt
                                        sapiente ea proident. Ad vegan excepteur butcher vice
                                        lomo. Leggings occaecat craft beer farm-to-table, raw
                                        denim aesthetic synth nesciunt you probably haven't heard
                                        of them accusamus labore sustainable VHS.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="mb-30 h4 text-blue padding-top-30">Lupa Kata Sandi</h4>
                    <div class="padding-bottom-30">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq1-1">
                                    Collapsible Group Item #1
                                </button>
                            </div>
                            <div id="faq1-1" class="collapse">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                    sunt aliqua put a bird on it squid single-origin coffee
                                    nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                    Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq2-2">
                                    Collapsible Group Item #2
                                </button>
                            </div>
                            <div id="faq2-2" class="collapse">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                    sunt aliqua put a bird on it squid single-origin coffee
                                    nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                    Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq3-3">
                                    Collapsible Group Item #3
                                </button>
                            </div>
                            <div id="faq3-3" class="collapse">
                                <div class="card-body">
                                    <p>
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                                        accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                        tempor, sunt aliqua put a bird on it squid single-origin
                                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt
                                        sapiente ea proident. Ad vegan excepteur butcher vice
                                        lomo. Leggings occaecat craft beer farm-to-table, raw
                                        denim aesthetic synth nesciunt you probably haven't heard
                                        of them accusamus labore sustainable VHS.
                                    </p>
                                    <p class="mb-0">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                                        accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                        tempor, sunt aliqua put a bird on it squid single-origin
                                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt
                                        sapiente ea proident. Ad vegan excepteur butcher vice
                                        lomo. Leggings occaecat craft beer farm-to-table, raw
                                        denim aesthetic synth nesciunt you probably haven't heard
                                        of them accusamus labore sustainable VHS.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq4-4">
                                    Collapsible Group Item #4
                                </button>
                            </div>
                            <div id="faq4-4" class="collapse">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                    sunt aliqua put a bird on it squid single-origin coffee
                                    nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                    Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq5-5">
                                    Collapsible Group Item #5
                                </button>
                            </div>
                            <div id="faq5-5" class="collapse">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life
                                    accusamus terry richardson ad squid. 3 wolf moon officia
                                    aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                    sunt aliqua put a bird on it squid single-origin coffee
                                    nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt
                                    sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                    Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq6-6">
                                    Collapsible Group Item #6
                                </button>
                            </div>
                            <div id="faq6-6" class="collapse">
                                <div class="card-body">
                                    <p>
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                                        accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                        tempor, sunt aliqua put a bird on it squid single-origin
                                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt
                                        sapiente ea proident. Ad vegan excepteur butcher vice
                                        lomo. Leggings occaecat craft beer farm-to-table, raw
                                        denim aesthetic synth nesciunt you probably haven't heard
                                        of them accusamus labore sustainable VHS.
                                    </p>
                                    <p class="mb-0">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                                        accusamus terry richardson ad squid. 3 wolf moon officia
                                        aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                        tempor, sunt aliqua put a bird on it squid single-origin
                                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt
                                        sapiente ea proident. Ad vegan excepteur butcher vice
                                        lomo. Leggings occaecat craft beer farm-to-table, raw
                                        denim aesthetic synth nesciunt you probably haven't heard
                                        of them accusamus labore sustainable VHS.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
