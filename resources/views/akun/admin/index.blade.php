@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">
                            @role('sudo')
                                Akun Admin
                            @endrole
                            @role('jurusan')
                                Data Admin
                            @endrole
                        </h4>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @role('sudo')
                            <div class="d-flex">

                                <a href="{{ route('sudo.akun_admin.create') }}" class="btn" type="button">
                                    <button class="btn btn-success mt-3">
                                        <i class="fa fa-add"></i>
                                        Tambah Akun
                                    </button>
                                </a>

                            </div>
                        @endrole


                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-noexport">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Admin</th>
                                    <th>NIP</th>
                                    @role('jurusan')
                                        <th>Umur</th>
                                    @endrole
                                    <th>Email</th>
                                    <th>Admin</th>
                                    <th>Status</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td style="text-align: left;">
                                            {{ $item->nama_administrasi }}
                                        </td>
                                        <td>
                                            {{ $item->nip }}
                                        </td>
                                        @role('jurusan')
                                            <td class="umur">
                                                {{ //generate umur dari tanggal lahir
                                                    \Carbon\Carbon::parse($item->tanggal_lahir)->age }}
                                            </td>
                                        @endrole
                                        <td style="text-align: left; word-wrap: break-word;">
                                            {{ $item->user->email }}
                                        </td>
                                        <td>
                                            {{ $item->user->hasRole('admin lab') ? 'Lab' : 'Berkas' }}
                                        </td>
                                        <td>
                                            {{ $item->status }}
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
                                                            href="{{ route('sudo.akun_admin.show', $item->id) }}"><i
                                                                class="dw dw-eye"></i>
                                                            Lihat</a>
                                                    @endrole
                                                    @role('sudo')
                                                        <a class="dropdown-item"
                                                            href="{{ route('sudo.akun_admin.edit', $item->id) }}"><i
                                                                class="dw dw-edit2"></i>
                                                            Edit</a>
                                                        <form id="delete"
                                                            action="{{ route('sudo.akun_admin.destroy', $item->id) }}"
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
                        '<div class="input-group mb-3"><input type="text" class="form-control" name="nip[]" placeholder="nip"><div class="input-group-append"><button class="btn btn-danger remove_field_button" type="button">-</button></div></div>'
                    ); // add input field
                } else if (x == max_fields) {
                    alert('Maksimal 20 nip')
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
                    color = 'lightgreen'; // Hijau muda
                } else if (umur >= 35 && umur < 45) {
                    color = 'green'; // Hijau tua
                } else if (umur >= 45 && umur < 55) {
                    color = 'khaki'; // Kuning tua
                } else if (umur >= 55 && umur < 65) {
                    color = 'pink'; // Merah muda
                } else if (umur >= 65) {
                    color = 'red'; // Merah tua
                }

                // Atur warna latar belakang dan teks
                $(this).css('background-color', color);
                $(this).css('color', 'white');
            });
        });
    </script>
    <!-- Input Validation End -->
@endsection
