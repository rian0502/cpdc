@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Akun Dosen</h4>
                        @role('sudo')
                            <div class="d-flex">

                                <a href="{{ route('sudo.akun_dosen.create') }}" class="btn" type="button">
                                    <button class="btn btn-success mt-3">
                                        <i class="fa fa-add"></i>
                                        Tambah Akun
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="pb-20 m-4">
                            <table class="table data-table-responsive stripe data-table-noexport nowrap" id="data">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Dosen</th>
                                        <th>Email</th>
                                        <th>Aktivasi</th>
                                        <th>Profil</th>
                                        <th class="table-plus datatable-nosort">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($account as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td style="text-align: left;">
                                                {{ $item->name }}
                                            </td>

                                            <td style="text-align: left; word-wrap: break-word;">
                                                {{ $item->email }}
                                            </td>
                                            <td>
                                                @if ($item->email_verified_at == null)
                                                    <span class="badge badge-danger">Belum Aktivasi</span>
                                                @else
                                                    {{ $carbon::parse($item->email_verified_at)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->dosen)
                                                    <span class="badge badge-success">Sudah</span>
                                                @else
                                                    <span class="badge badge-danger">Belum</span>
                                                @endif
                                            </td>
                                            <td>


                                                <div class="dropdown">
                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                        data-color="#1b3133" href="#" role="button"
                                                        data-toggle="dropdown">
                                                        <i class="dw dw-more"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        @role('sudo')
                                                            <a class="dropdown-item"
                                                                href="{{ route('sudo.akun_dosen.edit', $item->id) }}"><i
                                                                    class="dw dw-edit2"></i> Edit</a>
                                                            <form id="delete"
                                                                action="{{ route('sudo.akun_dosen.destroy', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" id="deleteBtn"
                                                                    class="dropdown-item text-danger"><i class="dw dw-delete-3"></i>
                                                                    Hapus</button>
                                                            </form>
                                                        @endrole
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endrole



                    @role('jurusan')
                        <div class="pb-20">
                            <table class="table data-table-responsive stripe data-table-noexport" id="data">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Dosen</th>
                                        <th>NIP</th>
                                        <th>NIDN</th>
                                        <th>Umur</th>
                                        <th>Status</th>
                                        <th>Email</th>
                                        <th class="table-plus datatable-nosort">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($lecturers as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->nama_dosen }}
                                            </td>

                                            <td>
                                                {{ $item->nip }}
                                            </td>
                                            <td>
                                                {{ $item->nidn }}
                                            </td>
                                            <td class="umur">
                                                {{ //generate umur dari tanggal lahir
                                                    \Carbon\Carbon::parse($item->tanggal_lahir)->age }}
                                            </td>
                                            <td>
                                                {{ $item->status }}
                                            </td>

                                            <td>
                                                {{ $item->user->email }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                        data-color="#1b3133" href="#" role="button"
                                                        data-toggle="dropdown">
                                                        <i class="dw dw-more"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        @role('jurusan')
                                                            <a class="dropdown-item"
                                                                href="{{ route('sudo.akun_dosen.show', $item->encrypt_id) }}"><i
                                                                    class="dw dw-eye"></i>
                                                                Lihat</a>
                                                        @endrole
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    @endrole



                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var max_fields = 20; // maximum input fields allowed
            var wrapper = $("#input_fields"); // input fields wrapper
            var add_button = $(".add_field_button"); // add field button

            var x = 1; // initial input field count
            $(add_button).click(function(e) { // add field button on click
                e.preventDefault();
                if (x < max_fields) { // check maximum input fields allowed
                    x++; // increment input field count
                    $(wrapper).append(
                        '<div class="input-group mb-3"><input type="text" class="form-control" name="nidn[]" placeholder="NIDN"><input type="text" class="form-control" name="nip[]" placeholder="NIP"><div class="input-group-append"><button class="btn btn-danger remove_field_button" type="button">-</button></div></div></div>'
                    ); // add input field
                } else if (x == max_fields) {
                    alert('Maksimal 20')
                }
            });

            $(wrapper).on("click", ".remove_field_button", function(e) { // remove field button on click
                e.preventDefault();
                $(this).parent().parent().remove(); // remove input field
                x--; // decrement input field count
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.umur').each(function() {
                var umur = parseInt($(this).text());
                var color = '';

                if (umur >= 20 && umur < 35) {
                    color = '#539165'; // Hijau muda
                } else if (umur >= 35 && umur < 45) {
                    color = 'green'; // Hijau tua
                } else if (umur >= 45 && umur < 55) {
                    color = '#E8630A'; // Kuning tua
                } else if (umur >= 55 && umur < 65) {
                    color = '#D864A9'; // Merah muda
                } else if (umur >= 65) {
                    color = 'red'; // Merah tua
                }

                // Atur warna latar belakang dan teks
                $(this).css('background-color', color);
                $(this).css('color', 'white');
            });
        });
    </script>
@endsection
