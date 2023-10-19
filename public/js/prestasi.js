$(function() {
    var dataNpm = $('.data-npm').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: '{{ route('jurusan.prestasi.index') }}',
        columns: [
            {
                data: null,
                name: 'no',
                render: function(data, type, row, meta) {
                    var index = meta.row + meta.settings._iDisplayStart + 1;
                    return index;
                }
            },
            {
                data: 'mahasiswa.nama_mahasiswa',
                name: 'nama_mahasiswa'
            },
            {
                data: 'mahasiswa.npm',
                name: 'npm'
            },
            {
                data: 'nama_prestasi',
                name: 'nama_prestasi'
            },
            {
                data: 'scala',
                name: 'scala'
            },
            {
                data: 'capaian',
                name: 'capaian'
            },
            {
                data: 'mahasiswa.npm',
                name: 'tanggal'
            },
            {
                data: null,
                name: 'aksi',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    var downloadUrl = "{{ asset('uploads/file_prestasi') }}"+'/'+row.file_prestasi;
                    var deleteUrl = "{{ asset('uploads/file_prestasi') }}"+'/'+row.file_prestasi;
                    return `
                        <div class="dropdown">
                            <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="${downloadUrl}">
                                    <i class="fa-solid fa-file-arrow-down"></i> Dokumen
                                </a>
                                <form action="${deleteUrl}" method="POST">
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
