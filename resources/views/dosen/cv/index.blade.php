<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/Assets/images/logo/color.png" rel="icon">
    <link rel="stylesheet" href="/Assets/cv/css/cv.css">
    <title>CV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* #header {
    background-color: #333f50;
    color: #fff;
    padding: 20px;
    text-align: center;
} */

        #header {
            background-color: #333f50;
            color: #fff;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }


        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            /* Atur padding untuk memberikan jarak pada sel */
        }

        .back-button:hover,
        .export-button:hover {
            background-color: #ddd;
        }

        #main {
            border-radius: 50px;
            max-width: 100%;
            min-width: 100%;
            background-color: #fff;
            padding-right: 50x;
            padding-left: 50x;
        }

        .header-main {

            padding-right: 50x;
            padding-left: 50x;
        }
        .section
        {
            padding-right: 50x;
            padding-left: 50x;
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


        .section ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }


        .section ul li .date {
            color: #777;
            font-size: 14px;
        }

        .biodata-section {
            color: #fff;

        }

        .color {
            background-color: #333f50;
            padding-top: 50px;
            padding-bottom: 50px;
            padding-right: 50px;
            padding-left: 50px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .research-item {
            display: grid;
            grid-template-columns: auto 1fr;
            grid-column-gap: 10px;
        }

        .research-item div:nth-child(1) {
            justify-self: start;
        }

        .research-item div:nth-child(2) {
            justify-self: end;
        }

        .biodata-section p {
            margin-bottom: 10px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: 1fr 10fr;
            align-items: center;
        }



        .year {
            margin-top: 25px;
        }

        .nama {
            font-size: 30px;
            margin-top: 80px;
        }

        /* Media Queries */
    </style>
</head>

<body>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div id="main">
                <div class="section biodata-section color">
                    <div class="content">
                        <p>{{ Auth::user()->dosen->no_hp }}</p>
                        <p class="email">{{ Auth::user()->email }}</p>
                        <h1 class="nama text-light">Kamisah Delilawati Pandiangan</h1>
                    </div>
                </div>
                <div class="header-main">
                    <div class="section">
                        <h2>Biodata</h2>
                        <p>{{ Auth::user()->name }}, dengan Nomor Induk Pegawai {{ Auth::user()->dosen->nip }},
                            berpangkat {{ Auth::user()->dosen->pangkatTerakhir->kepangkatan }}
                            dan menjabat sebagai {{ Auth::user()->dosen->jabatanTerakhir->jabatan }} di Jurusan Kimia,
                            Fakultas Matematika dan Ilmu Pengetahuan Alam, Universitas Lampung.</p>
                    </div>

                    <div class="section">
                        <h2>Penelitian</h2>
                        <ul class="grid-container" id="grid-container">
                            <table>
                                @foreach ($penelitian as $item)
                                    <tr>
                                        <td rowspan="2">{{ $item->tahun_penelitian }}</td>
                                        <td>{{ $item->nama_litabmas }}</td>
                                    </tr>
                                    <tr>
                                        <td> {{ $item->sumber_dana }} - {{ $item->jumlah_dana }} </td>
                                    </tr>
                                @endforeach
                            </table>


                        </ul>
                    </div>

                    <div class="section">
                        <h2>Pengabdian</h2>
                        <ul class="grid-container" id="grid-container">
                            <table>

                                @foreach ($pengabdian as $item)
                                    <tr>
                                        <td rowspan="2">{{ $item->tahun_penelitian }}</td>
                                        <td>{{ $item->nama_litabmas }}</td>
                                    </tr>
                                    <tr>
                                        <td> {{ $item->sumber_dana }} - {{ $item->jumlah_dana }} </td>
                                    </tr>
                                @endforeach
                            </table>

                        </ul>
                    </div>

                    <div class="section">
                        <h2>Publikasi</h2>
                        <ul class="grid-container" id="grid-container">
                            <table>
                                @foreach ($publikasi as $item)
                                    <tr>
                                        <td rowspan="2">{{ $item->tahun }}</td>
                                        <td>{{ $item->nama_publikasi }}</td>
                                    </tr>
                                    <tr>
                                        <td> {{ $item->judul }}, Vol.{{ $item->vol }}, Hal.{{ $item->halaman }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </ul>
                    </div>

                    <div class="section">
                        <h2>Organisasi</h2>
                        <ul class="grid-container" id="grid-container">
                            <table>
                                @foreach ($organisasi as $item)
                                    <tr>
                                        <td rowspan="2">{{ $item->tahun_menjabat }}</td>
                                        <td>{{ $item->nama_organisasi }}</td>
                                    </tr>
                                    <tr>
                                        <td> {{ $item->jabatan }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
