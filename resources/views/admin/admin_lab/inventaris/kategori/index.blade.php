@extends('layouts.datatable')

@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Kategori</h4>
                        <a href="{{ route('sudo.kategori.create') }}">
                            <button class="btn btn-success mt-3">
                                <i class="icon-copy fi-page-add"></i>
                                Tambah Data
                            </button>
                        </a>
                    </div>
                    <div class="pb-20 m-3">
                        <table class="table data-table-responsive stripe data-table-export">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Keterangan</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_kategori }}</td>
                                        <td>{{ $item->ket }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    data-color="#1b3133" href="#" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('sudo.kategori.edit', $item->encrypt_id) }}"><i
                                                            class="dw dw-edit2"></i>
                                                        Edit</a>
                                                    @if ($item->barangs->count() < 1)
                                                        <form id="delete"
                                                            action="{{ route('sudo.kategori.destroy', $item->encrypt_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" id="deleteBtn"
                                                                class="dropdown-item text-danger">
                                                                <i class="dw dw-delete-3"></i>
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    @endif
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

    <style>
        .delete {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .delete::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120%;
            height: 120%;
            background-color: rgba(255, 0, 0, 0.2);
            opacity: 0;
            border-radius: 50%;
            transition: all 0.3s ease;
            pointer-events: none;
            z-index: -1;
        }

        .delete:hover::before {
            opacity: 1;
        }

        .delete .icon-copy {
            transition: all 0.3s ease;
        }

        .delete:hover .icon-copy {
            transform: rotate(360deg);
        }

        .delete.animated {
            animation-name: shake;
            animation-duration: 0.5s;
        }

        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-8px);
            }

            40% {
                transform: translateX(8px);
            }

            60% {
                transform: translateX(-8px);
            }

            80% {
                transform: translateX(8px);
            }

            100% {
                transform: translateX(0);
            }
        }
    </style>

    <script>
        const deleteButton = document.querySelector('.delete');

        deleteButton.addEventListener('click', function() {
            this.classList.add('animated');
            setTimeout(() => {
                this.classList.remove('animated');
            }, 500);
        });
    </script>

    <!-- Input Validation End -->
@endsection
