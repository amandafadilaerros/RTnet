@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Filter -->
        <div class="col-md-4">

        </div>
    </div>
    <!-- Search -->
    <div class="col-md-4" style="">
        <div class="row">
            <form id="searchForm" class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" id="search" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                </div>
                <button type="submit" class="btn btn-primary" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
            </form>
        </div>
    </div>
</div>
<div class="card">
    {{-- <div class="card-header">
        <h3 class="card-title">Laporan Keuangan</h3>
    </div> --}}
    <div class="card-body">
        <table class="table table-hover table-striped" id="laporan">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Keuangan Masuk</th>
                    <th scope="col">Keuangan Keluar</th>
                    <th scope="col">Saldo</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('css')

@endpush
@push('js')
<script>
    $(document).ready(function() {
        var dataLaporan = $('#laporan').DataTable({
            serverSide: true, //jika ingin menggunakan server side processing
            ajax: {
                "url": "{{ url('bendahara/laporan/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    d.search = $('#search').val();
                }
            },
            columns: [{
                data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColimn()
                className: "text-center",
                orderable: false,
                searchable: false
            }, {
                data: "jenis_iuran",
                className: "",
                orderable: true, //jika ingin kolom bisa urut
                searchable: true // jika kolom bisa dicari
            }, {
                data: "jumlah_uang_masuk",
                className: "",
                orderable: true, //jika ingin kolom bisa urut
                searchable: true // jika kolom bisa dicari
            }, {
                data: "jumlah_uang_keluar",
                className: "",
                orderable: true, //jika ingin kolom bisa urut
                searchable: true // jika kolom bisa dicari
            }, {
                data: "saldo",
                className: "",
                orderable: true, //jika ingin kolom bisa urut
                searchable: true // jika kolom bisa dicari
            }]
        });
        $('#id_iuran').on('change', function() {
            dataLaporan.ajax.reload();
        });


        $('#searchForm').on('submit', function(e) {
            e.preventDefault(); // Mencegah form untuk submit
            dataLaporan.ajax.reload(); // Memuat ulang data tabel dengan pencarian yang baru
        });
    });
</script>
@endpush