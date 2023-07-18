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
                <style>
                    .header-main {
                        margin-top: 60px;
                        padding-bottom: 100px;
                        padding-right: 100px;
                        padding-left: 100px;
                    }

                    h1 {
                        font-size: 28px;
                    }

                    h2 {
                        font-size: 24px;
                        margin-bottom: 10px;
                        border-bottom: 3px solid #ccc;
                        padding-bottom: 5px;
                    }

                    p {
                        font-size: 16px;
                        line-height: 1.5;
                        text-align: justify;
                    }

                    .section {
                        margin-bottom: 30px;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    table th {
                        font-size: 18px;
                        font-weight: bold;
                        text-align: left;
                        padding: 8px;
                    }

                    table td {
                        font-size: 16px;
                        padding: 8px;
                    }

                    .date {
                        color: #777;
                        font-size: 14px;
                    }

                    .biodata-section {
                        color: #fff;
                        padding: 15px;
                    }

                    .biodata-section p {
                        margin-bottom: 10px;
                    }
                </style>
                <div class="header-main">
                    <div class="section">
                        <h2>Biodata</h2>
                        <p>Kamisah Delilawati Pandiangan, dengan Nomor Induk Pegawai 197212051997032001, berpangkat Guru
                            Besar dan
                            menjabat sebagai Dosen.</p>
                    </div>
                    <div class="section">
                        <h2>Penelitian</h2>
                        <table>
                            <tr>
                                <th>Tahun</th>
                                <th>Penelitian</th>
                                <th>Sumber Dana - Jumlah</th>
                            </tr>
                            <tr>
                                <td>2018</td>
                                <td>Penelitian 1</td>
                                <td>sumber dana - Jumlah</td>
                            </tr>
                            <tr>
                                <td>2016</td>
                                <td>Penelitian 2</td>
                                <td>sumber dana - Jumlah</td>
                            </tr>
                        </table>
                    </div>

                    <div class="section">
                        <h2>Pengabdian</h2>
                        <table>
                            <tr>
                                <th>Tahun</th>
                                <th>Pengabdian</th>
                                <th>Sumber Dana - Jumlah</th>
                            </tr>
                            <tr>
                                <td>2018</td>
                                <td>Pengabdian 1</td>
                                <td>sumber dana - Jumlah</td>
                            </tr>
                            <tr>
                                <td>2016</td>
                                <td>Pengabdian 2</td>
                                <td>sumber dana - Jumlah</td>
                            </tr>
                        </table>
                    </div>

                    <div class="section">
                        <h2>Publikasi</h2>
                        <table>
                            <tr>
                                <th>Tahun</th>
                                <th>Publikasi</th>
                                <th>Sumber Dana - Jumlah</th>
                            </tr>
                            <tr>
                                <td>2018</td>
                                <td>Publikasi 1</td>
                                <td>sumber dana - jumlah</td>
                            </tr>
                            <tr>
                                <td>2016</td>
                                <td>Publikasi 2</td>
                                <td>sumber dana - jumlah</td>
                            </tr>
                        </table>
                    </div>

                    <div class="section">
                        <h2>Organisasi</h2>
                        <table>
                            <tr>
                                <th>Tahun</th>
                                <th>Organisasi</th>
                                <th>Keterangan</th>
                            </tr>
                            <tr>
                                <td>2018</td>
                                <td>Organisasi 1</td>
                                <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque voluptate quod eligendi
                                    ratione
                                    molestias dolorem dicta. Laborum labore nulla vitae voluptatibus! Tenetur in officiis
                                    ipsam fugit.
                                    Maxime, quidem odit, veniam, incidunt excepturi dolores natus ad</td>
                            </tr>
                            <tr>
                                <td>2016</td>
                                <td>Organisasi 2</td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa tenetur</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
