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
            margin: 0;
            padding: 0;
        }

        #header {
            background-color: #333f50;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        #grid-container {
            padding-left: 30px;
            margin-top: 20px;
        }



        .back-button:hover,
        .export-button:hover {
            background-color: #ddd;
        }

        #main {
            border-radius: 50px;
            max-width: 100%;
            min-width: 100%;
            /* background-color: #fff; */
            padding-right: 10x;
            padding-left: 10x;
        }

        .header-main {
            margin-top: 60px;
            padding-bottom: 10px;
            padding-right: 10px;
            padding-left: 10px;
        }

        .section {
            padding-right: 10x;
            padding-left: 10x;
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
            /* padding: 0; */
            /* margin: 0; */
        }


        .section ul li .date {
            /* color: #777; */
            font-size: 14px;
        }

        .color {
            background-color: #333f50;
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

        .date {
            /* color: #777; */
            font-size: 14px;
        }

        .biodata-section {
            color: #fff;
            padding: 20px;
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
            font-size: 24px;
            margin-top: 50px;
            margin-bottom: 2px;
            color: black
        }

        .content {
            text-align: center;
        }

        #text {
            font-size: 20px;
        }

        .margin {
            margin-top: -20px;
        }

        .litabmas {
            justify-self: end;
            text-align: right;
            margin-right: 20px;
            /* Adjust this value to control the distance from date year */
        }

        .text-justify {
            text-align: justify;
        }

        .margin {
            padding-right: 30px;
            padding-left: 15px;
        }

        .judul {
            font-weight: bold;
        }

        @media print {
            @page {
                size: auto;
                /* Atur ukuran kertas */
                margin: 0;
                /* Hilangkan margin pada halaman cetak */
            }

            .section h2 {
                break-after: always;
                /* Pindahkan ke kertas berikutnya */
                page-break-after: always;
                /* Pindahkan ke kertas berikutnya */
            }
        }

        @media print {
            @page {
                size: A4;
            }

            #pindah-halaman {
                page-break-after: always;
                margin-top: 50px;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div id="main">
                <div class="">
                    <div class="content">
                        <h1 class="nama">{{ Auth::user()->name }}</h1>
                        <span style="color:black;text-align: center; margin-top:-20px;font-family: Arial, sans-serif;"
                            id="text">
                            @php
                                $noHp = Auth::user()->dosen->no_hp;
                                if (substr($noHp, 0, 1) === '0') {
                                    $noHp = '+62' . substr($noHp, 1);
                                }
                                $noHp = preg_replace('/(\+62)(\d{3})(\d{4})(\d+)/', '$1-$2-$3-$4', $noHp);
                            @endphp

                            {{ $noHp }}

                            |
                            {{ Auth::user()->email }}
                        </span>
                    </div>
                </div>
                <div class="header-main">
                    <div class="section">
                        <h2 style="font-family: Arial, sans-serif;">Biodata</h2>
                        <p style="font-family: Arial, sans-serif;">{{ Auth::user()->name }}, dengan Nomor Induk Pegawai
                            {{ Auth::user()->dosen->nip }},
                            berpangkat {{ Auth::user()->dosen->pangkatTerakhir->kepangkatan }}
                            dan menjabat sebagai {{ Auth::user()->dosen->jabatanTerakhir->jabatan }} di Jurusan Kimia,
                            Fakultas Matematika dan Ilmu Pengetahuan Alam, Universitas Lampung.</p>
                    </div>

                    <div class="section">
                        <h2 style="font-family: Arial, sans-serif;">Penelitian</h2>
                        @foreach ($penelitian as $item)
                            <table>
                                <tr>
                                    <td rowspan="3" class="margin">
                                        {{ $item->tahun_penelitian }}
                                    </td>
                                    <td class="text-justify">
                                        <div class="judul">
                                            {{ $item->nama_litabmas }}
                                        </div>
                                        {{-- <br> --}}
                                        <div style="margin-top: 15px;"></div>
                                        Sumber dana dari {{ $item->sumber_dana }}, dengan anggaran
                                        Rp{{ number_format($item->jumlah_dana, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                    </div>


                    <div class="pindah-halaman">
                        <div class="section">
                            <h2 style="font-family: Arial, sans-serif;">Pengabdian</h2>
                            @foreach ($pengabdian as $item)
                                <table>
                                    <tr>
                                        <td rowspan="3" class="margin">
                                            {{ $item->tahun_penelitian }}
                                        </td>
                                        <td class="text-justify">
                                            <div class="judul">
                                                {{ $item->nama_litabmas }}
                                            </div>
                                            {{-- <br> --}}
                                            <div style="margin-top: 15px;"></div>
                                            Sumber dana dari {{ $item->sumber_dana }}, dengan anggaran
                                            Rp{{ number_format($item->jumlah_dana, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                    </div>

                    <div class="pindah-halaman">
                        <div class="section">
                            <h2 style="font-family: Arial, sans-serif;">Publikasi</h2>
                            @foreach ($publikasi as $item)
                                <table>
                                    <tr>
                                        <td rowspan="3" class="margin">
                                            {{ $item->tahun }}
                                        </td>
                                        <td class="text-justify">
                                            <div class="judul">
                                                {{ $item->nama_publikasi }}
                                            </div>
                                            <div style="margin-top: 15px;"></div>
                                            Publikasi dengan judul "{{ $item->judul }}" berada dalam Volume
                                            {{ $item->vol }} dengan jumlah halaman sebanyak {{ $item->halaman }}.
                                        </td>
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                    </div>
                    <div class="pindah-halaman" id="pindah-halaman">
                        <div class="section">
                            <h2 style="font-family: Arial, sans-serif;">Organisasi</h2>
                            @foreach ($organisasi as $item)
                                <table>
                                    <tr>
                                        <td rowspan="3" class="margin">
                                            {{ $item->tahun_menjabat }}
                                        </td>
                                        <td class="text-justify">
                                            <div class="judul">
                                                {{ $item->nama_organisasi }}
                                            </div>
                                            <div style="margin-top: 15px;"></div>
                                            Menjabat sebagai {{ $item->jabatan }} dengan masa jabatan dari tahun
                                            {{ $item->tahun_menjabat . ' hingga ' . $item->tahun_berakhir }}
                                        </td>
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Periksa apakah elemen berada di bagian bawah halaman
        function isElementAtBottom(element) {
            return element.getBoundingClientRect().bottom <= window.innerHeight;
        }

        // Periksa saat halaman dimuat
        window.addEventListener('load', function() {
            var element = document.getElementById('pindah-halaman');

            // Periksa apakah elemen ada
            if (element) {
                // Periksa apakah elemen berada di bagian bawah halaman saat ini
                if (isElementAtBottom(element)) {
                    // Terapkan gaya CSS
                    element.style.marginBottom = '50px';
                }
            }
        });
    </script>

</body>

</html>
