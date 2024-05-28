@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-md-6">
        <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahKkModal">Tambah</a>
    </div>
    <div class="col-md-6">
        <div class="row justify-content-end">
            <form id="searchKkForm" class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" id="searchKk" style="border-radius: 20px; width: 260px;" placeholder="Cari disini..." aria-label="Search" aria-describedby="search-addon">
                </div>
                <button type="submit" class="btn btn-primary" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
            </form>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        <table class="table table-hover table-striped" id="table_kk_paguyuban">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kepala Keluarga</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal tambah KK -->
<div class="modal fade" id="tambahKkModal" tabindex="-1" role="dialog" aria-labelledby="tambahKkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKkModalLabel">Tambah Anggota Paguyuban</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('bendahara/paguyuban/tambah') }}" class="form-horizontal"> @csrf
                    <div class="form-group">
                        <label for="warga_kas">Pilih Warga:</label>
                        <select class="form-control" id="no_kk" name="no_kk" required>
                            <option value="">- Pilih Warga -</option>
                            @foreach($kkNonPaguyuban as $item)
                            <option value="{{ $item->no_kk }}">{{ $item->nama_kepala_keluarga }}</option>
                            @endforeach
                        </select>
                        @error('no_kk')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit KK -->
<div class="modal fade" id="editKkModal" tabindex="-1" role="dialog" aria-labelledby="editKkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKkModalLabel">Edit KK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('bendahara/paguyuban/update') }}" class="form-horizontal">
                    @csrf
                    <input type="hidden" id="old_no_kk" name="old_no_kk">
                    <div class="form-group">
                        <label for="warga_kas">Pilih Warga:</label>
                        <select class="form-control" id="no_kk" name="no_kk" required>
                            <option value="">- Pilih Warga -</option>
                            @foreach($kk as $item)
                            <option value="{{ $item->no_kk }}">{{ $item->nama_kepala_keluarga }}</option>
                            @endforeach
                        </select>
                        @error('no_kk')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<!-- Modal hapus KK -->
<div class="modal fade" id="hapusKkModal" tabindex="-1" role="dialog" aria-labelledby="hapusKkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusKkModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin menghapus data ini?
            </div>
            <div class="modal-footer justify-content">
                <form id="hapusKkForm" action="{{ url('bendahara/paguyuban/destroy') }}" method="post">
                    @csrf
                    <input type="hidden" name="no_kk" id="no_kk">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .dataTables_filter {
        display: none;
    }
</style>
@endpush

@push('js')
<script>
    $(document).on('click', '.btn-edit', function() {
        var ids = $(this).data('id');
        var oldNoKk = $(this).data('old_no_kk');

        // Set nilai hidden input untuk old_no_kk dan no_kk baru
        $('#editKkModal #old_no_kk').val(oldNoKk);
        $('#editKkModal #no_kk').val(ids);

        // Buka modal edit
        $('#editKkModal').modal('show');

        // Mengambil data KK yang akan diedit
        $.ajax({
            url: "{{ url('paguyuban/kk/edit') }}", // URL endpoint untuk mendapatkan data KK
            type: "POST",
            dataType: "json",
            data: {
                _token: '{{ csrf_token() }}', // Token CSRF untuk keamanan
                no_kk: ids
            },
            success: function(response) {
                // Mengisi form modal dengan data yang diterima dari server
                $('#editKkModal #nama_kk_edit').val(response.nama_kepala_keluarga);
                $('#editKkModal #no_kk').val(response.no_kk);
                $('#editKkModal #alamat_edit').val(response.alamat);
            },
            error: function(xhr, status, error) {
                // Tangani error jika terjadi
                console.error('Error fetching KK data:', error);
            }
        });
    });



    $(document).ready(function() {
        var dataKkPaguyuban = $('#table_kk_paguyuban').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('bendahara/paguyuban/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    d.search = $('#searchKk').val();
                }
            },
            columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                }, {
                    data: "nama_kepala_keluarga",
                    className: "",
                    orderable: true,
                }, {
                    data: "alamat",
                    className: "",
                    orderable: true,
                },
                {
                    data: null,
                    className: "",
                    orderable: false,
                    // Kolom aksi di DataTable
                    render: function(data, type, row) {
                        return '<a href="#" class="btn btn-success btn-sm btn-edit" data-old_no_kk="' + row.no_kk + '"><i class="fas fa-pen"></i></a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusKkModal" data-id="' + row.no_kk + '"><i class="fas fa-trash"></i></a>';
                    }

                }
            ]
        });

        $('#searchKkForm').on('submit', function(e) {
            e.preventDefault();
            dataKkPaguyuban.ajax.reload();
        });

        $(document).on("click", ".btn-delete", function() {
            var ids = $(this).data('id');
            $(".modal-footer #no_kk").val(ids);
        });
    });
</script>
@endpush