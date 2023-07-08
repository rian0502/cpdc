@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Akun Mahasiswa</h4>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="d-flex">


                            <a href="#" class="btn" data-toggle="modal" data-target="#tambah-akun" type="button">
                                <button class="btn btn-success mt-3">
                                    <i class="fa fa-add"></i>
                                    Tambah NPM
                                </button>
                            </a>
                            <a href="#" class="btn" data-toggle="modal" data-target="#via-excel" type="button">
                                <button class="btn btn-secondary mt-3">
                                    <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                    Import NPM
                                </button>
                            </a>

                        </div>

                        <div class="col-md-4 col-sm-12 mb-30">
                            <div class="modal fade" id="tambah-akun" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myLargeModalLabel">
                                                Tambah Data Akun Mahasiswa
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('sudo.base_npm.store') }}" method="post">
                                                @csrf
                                                <div id="input_fields">
                                                    <div class="input-group mb-3">
                                                        <input type="number" value="{{ old('npm') }}" autofocus
                                                            class="form-control @error('npm') form-control-danger @enderror"
                                                            name="npm[]" placeholder="NPM">

                                                    </div>
                                                </div>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary add_field_button"
                                                        type="button">+</button>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                Submit
                                            </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mb-30">
                            <div class="modal fade" id="via-excel" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myLargeModalLabel">
                                                Tambah Data Akun Mahasiswa
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('sudo.base_npm.store.excel') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div id="input_fields">
                                                    <div class="input-group mb-3">
                                                        <input
                                                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                                            type="file" name="npm" id="npm"
                                                            class="form-control-file">
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                Submit
                                            </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-20 m-3">
                        <table id="data-npm" class="data-npm table table-striped table-hover nowrap ">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NPM</th>
                                    <th>Status</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            {{-- <tbody>

                                @foreach ($akun as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $item->npm }}
                                        </td>
                                        <td>
                                            {{ $item->status }}

                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-outline-primary dropdown-toggle" href="#"
                                                    role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <a class="dropdown-item"
                                                        href="
                                            {{ route('sudo.base_npm.edit', 1) }}
                                            "><i
                                                            class="fa fa-pencil"></i> Edit</a>
                                                    <form
                                                        action="
                                            {{ route('sudo.base_npm.destroy', 1) }}
                                            "
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger"><i
                                                                class="fa fa-trash"></i>
                                                            Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody> --}}
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
                        '<div class="input-group mb-3"><input type="text" class="form-control" name="npm[]" placeholder="NPM"><div class="input-group-append"><button class="btn btn-danger remove_field_button" type="button">-</button></div></div>'
                    ); // add input field
                } else if (x == max_fields) {
                    alert('Maksimal 20 NPM')
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
    var dataNpm = null; // Menyimpan referensi ke objek DataTable

    $(function() {
        dataNpm = $('.data-npm').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('sudo.base_npm.ajax') }}',
            columns: [
                {
                    data: null,
                    name: 'npm',
                    render: function(data, type, row, meta) {
                        // Menghasilkan nomor urutan perdata
                        var index = meta.row + meta.settings._iDisplayStart + 1;
                        return index;
                    }
                },
                {
                    data: 'npm',
                    name: 'npm'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: null,
                    name: 'null',
                    orderable: false,
                    searchable: false,
                    exportable: false,
                    render: function(data, type, row) {
                        var editUrl = "{{ route('sudo.base_npm.edit', ':id') }}".replace(':id', row.id);
                        var deleteUrl = "{{ route('sudo.base_npm.destroy', ':id') }}".replace(':id', row.id);

                        return `
                        <div class="dropdown">
                            <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="${editUrl}">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <form id="delete" action="${deleteUrl}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>`;
                    }
                }
            ]
        });
    });
</script>



    <!-- Input Validation End -->
@endsection
