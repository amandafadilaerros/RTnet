@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Filter -->
        <div class="col-md-4">
            
        </div>
    </div>
    <!-- Search -->
    <div class="col-md-4">
        <div class="row">
            <input type="text" class="form-control" id="searchInput" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
            <button class="btn btn-primary" id="searchButton" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-hover table-striped" id="laporan">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Keuangan Masuk</th>
                    <th scope="col">Keuangan Keluar</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">Keterangan</th> <!-- Tambah kolom Keterangan -->
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('css')
<style>
    /* Menyembunyikan fitur pencarian di tabel */
    .dataTables_filter {
        display: none;
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataPemasukan = $('#laporan').DataTable({
            serverSide: true, //jika ingin menggunakan server side processing
            searching: true,
            ajax: {
                "url": "{{ url('penduduk/laporan_keuangan/list') }}",
                "dataType": "json",
                "type": "POST"
            },
            columns: [
                {
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColimn()
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "jenis_iuran",
                    className: "",
                    orderable: true, //jika ingin kolom bisa urut
                    searchable: true // jika kolom bisa dicari
                },
                {
                    data: "pemasukan",
                    className: "",
                    orderable: true, //jika ingin kolom bisa urut
                    searchable: true // jika kolom bisa dicari
                },
                {
                    data: "pengeluaran",
                    className: "",
                    orderable: true, //jika ingin kolom bisa urut
                    searchable: true // jika kolom bisa dicari
                },
                {
                    data: "saldo",
                    className: "",
                    orderable: true, //jika ingin kolom bisa urut
                    searchable: true // jika kolom bisa dicari
                },
                {
                    data: "keterangan", // Kolom keterangan dari iurans
                    className: "",
                    orderable: true,
                    searchable: true
                }
            ]
        });

        // Fungsi untuk melakukan pencarian saat tombol cari ditekan
        $('#searchButton').on('click', function() {
            var searchText = $('#searchInput').val();
            dataPemasukan.search(searchText).draw();
        });

        // Fungsi untuk melakukan pencarian saat tombol enter ditekan pada input
        $('#searchInput').on('keypress', function(e) {
            if (e.which === 13) {
                var searchText = $('#searchInput').val();
                dataPemasukan.search(searchText).draw();
            }
        });
    });
</script>
@endpush
