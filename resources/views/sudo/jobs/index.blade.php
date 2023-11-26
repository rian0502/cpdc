@extends('layouts.datatable')
@section('datatable')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">List Failed Jobs</h4>
                    </div>
                    <div class="pb-20 m-3">

                        <table class="table data-table-responsive stripe data-table-export">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>UUID</th>
                                    <th>Gagal</th>
                                    <th>Exception</th>
                                    <th class="table-plus datatable-nosort">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->uuid }}</td>
                                        <td>{{ $item->failed_at }}</td>
                                        <td>{{ Str::limit($item->exception, 150) }}</td>
                                        <td>
                                            {{-- button aksi dropdown untuk aksi view, delete, show --}}
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    data-color="#1b3133" href="#" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('sudo.failed_jobs.show', $item->uuid) }}"><i
                                                            class="dw dw-view"></i>
                                                        Show</a>
                                                    <a class="dropdown-item" href="{{ route('sudo.failed_jobs.retry', $item->uuid) }}"><i
                                                            class="dw dw-refresh1"></i>
                                                        Retry</a>
                                                    <form action="{{ route('sudo.failed_jobs.destroy', $item->uuid) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" id="deleteBtn"
                                                            class="dropdown-item text-danger">
                                                            <i class="dw dw-delete-3"></i> Hapus
                                                        </button>
                                                    </form>
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
@endsection
