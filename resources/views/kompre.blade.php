@extends('layouts.table')
@section('table')
    <style>
        .center-align {
            text-align: center;
        }

        .center {
            align-content: center;
            justify-content: center;

        }
    </style>

    <!-- Kompre Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h2>Data Sidang Komprehensif</h2>
            <div class="pb-20 m-3 mt-5">
                <table class="table data-table-responsive stripe data-table-noexport nowrap">
                    <thead>
                        <tr>
                            <th class="center-align">No</th>
                            <th class="center-align">NPM</th>
                            <th class="center-align">Nama</th>
                            <th class="center-align">Tanggal</th>
                            <th class="center-align">Ruangan</th>
                            <th class="center-align">Judul</th>
                            <th class="center-align">Pembimbing 1</th>
                            <th class="center-align">Pembimbing 2</th>
                            <th class="center-align">Pembahas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="center">
                            <td class="center-align">1</td>
                            <td class="center-align">2057031016</td>
                            <td class="center-align">Putu Putra Eka Persada</td>
                            <td class="center-align">30-05-2023</td>
                            <td class="center-align">Ruang Seminar</td>
                            <td class="center-align"> : Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                Voluptatibus
                                dolore doloribus voluptates repellat consequatur totam reiciendis dolores architecto quas
                                ipsa!</td>
                            <td class="center-align"> : Dr. John McQueen, M.A.</td>
                            <td class="center-align"> : Dr. John McQueen, M.A.</td>
                            <td class="center-align"> : Dr. John McQueen, M.A.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Kompre End -->
@endsection
