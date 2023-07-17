@extends('layouts.admin')
@section('admin')
    <link href="/Assets/images/logo/color.png" rel="icon">
    <link rel="stylesheet" href="/Assets/cv/css/cv.css">
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Circulum Vitae</h4>
                        </div>
                        <div class="col-md-12 col-sm-12 d-flex align-items-center justify-content-between">
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/">Home</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">
                                        Profile
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Circulum Vitae
                                    </li>
                                </ol>
                            </nav>
                            <div class="text-right">
                                <a href="/export">
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
            <div id="main">
                <div class="section biodata-section color">
                    <div class="content">
                        <p>081379284072</p>
                        <p class="email">kamisah.delilawati@fmipa.unila.ac.id</p>
                        <h1 class="nama text-light">Kamisah Delilawati Pandiangan</h1>
                    </div>
                </div>
                <div class="header-main">

                    <div class="section">
                        <h2>Biodata</h2>
                        <p>Kamisah Delilawati Pandiangan, dengan Nomor Induk Pegawai 197212051997032001, berpangkat Guru
                            Besar
                            dan menjabat sebagai Dosen.</p>
                    </div>

                    <div class="section">
                        <h2>Penelitian</h2>
                        <ul class="grid-container" id="grid-container">
                            <li>
                                <p class="date year">2018</p>
                            </li>
                            <li>
                                <h3>Penelitian 1</h3>
                                <p>sumber dana - jumlah</p>
                            </li>
                            <li>
                                <p class="date year">2016</p>
                            </li>
                            <li>
                                <h3>Penelitian 2</h3>
                                <p>sumber dana - jumlah</p>
                            </li>
                        </ul>
                    </div>

                    <div class="section">
                        <h2>Pengabdian</h2>
                        <ul class="grid-container" id="grid-container">
                            <li>
                                <p class="date year">2018</p>
                            </li>
                            <li>
                                <h3>Pengabdian 1</h3>
                                <p>sumber dana - jumlah</p>
                            </li>
                            <li>
                                <p class="date year">2016</p>
                            </li>
                            <li>
                                <h3>Pengabdian 2</h3>
                                <p>sumber dana - jumlah</p>
                            </li>
                        </ul>
                    </div>

                    <div class="section">
                        <h2>Publikasi</h2>
                        <ul class="grid-container" id="grid-container">
                            <li>
                                <p class="date year">2018</p>
                            </li>
                            <li>
                                <h3>Publikasi 1</h3>
                                <p>sumber dana - jumlah</p>
                            </li>
                            <li>
                                <p class="date year">2016</p>
                            </li>
                            <li>
                                <h3>Publikasi 2</h3>
                                <p>sumber dana - jumlah</p>
                            </li>
                        </ul>
                    </div>

                    <div class="section">
                        <h2>Organisasi</h2>
                        <ul class="grid-container" id="grid-container">
                            <li>
                                <p class="date year">2018</p>
                            </li>
                            <li>
                                <h3>Organisasi 1</h3>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque voluptate quod eligendi
                                    ratione molestias dolorem dicta. Laborum labore nulla vitae voluptatibus! Tenetur in
                                    officiis ipsam fugit. Maxime, quidem odit, veniam, incidunt excepturi dolores natus ad
                                    eum
                                    quasi doloribus eius. Nihil, id laborum hic animi doloribus voluptas dolores! Fugit
                                    aspernatur dolorum animi quam ipsam inventore quasi. Aut maxime beatae officia
                                    laudantium
                                    neque consectetur dolore, nisi officiis fuga veritatis modi minus ipsum nemo cupiditate
                                    nam
                                    iste dignissimos. Natus accusamus veniam, amet officiis officia doloremque, maiores,
                                    labore
                                    autem saepe ipsam mollitia accusantium a! Veniam corporis eum vel ea nam amet tempore
                                    dignissimos possimus!</p>
                            </li>
                            <li>
                                <p class="date year">2016</p>
                            </li>
                            <li>
                                <h3>Organisasi 2</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa tenetur</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
