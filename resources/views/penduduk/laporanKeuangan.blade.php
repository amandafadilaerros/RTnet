@extends('layouts.template')

@section('content')
<div class="row">
 
    <!-- Search -->
 <div class="col-md-4" style="">
    <div class="row">
        <input type="text" id="searchInput" name="searchInput" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">

        <button class="btn btn-primary" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
    </div>
</div>
</div>        

<div class="card">
    <div class="card-body">
        <table class="table table-hover table-striped" id="laporan_keuangan_table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis Transaksi</th>
                    <th scope="col">Jenis Iuran</th>
                    <th scope="col">Keuangan Masuk</th>
                    <th scope="col">Keuangan Keluar</th>
                    <th scope="col">Saldo</th>
                 
                </tr>
            </thead>
            <tbody>
             
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('css')
    <!-- Tambahkan CSS tambahan jika diperlukan -->
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var laporan_keuangan = $('#laporan_keuangan_table').DataTable({
            serverSide: true,   // Jika ingin menggunakan server-side processing
            searching: false,
            ajax: {
                "url": "{{ url('penduduk/laporan_keuangan/list') }}", // Sesuaikan URL dengan rute yang telah ditambahkan
    "dataType": "json",
    "type": "POST" // Metode POST
            },
            columns: [
                {
                    data: "DT_RowIndex",    // Nomor urut dari Laravel DataTable addIndexColumn()
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "jenis_transaksi",    // Sesuaikan dengan nama kolom untuk jenis iuran
                    className: "",
                    orderable: true,        // Jika ingin kolom bisa diurutkan
                    searchable: true        // Jika kolom bisa dicari
                }, {
                    data: "jenis_iuran",    // Sesuaikan dengan nama kolom untuk jenis iuran
                    className: "",
                    orderable: true,        // Jika ingin kolom bisa diurutkan
                    searchable: true        // Jika kolom bisa dicari
                }, {
                    data: "pemasukan",      // Sesuaikan dengan nama kolom untuk pemasukan
                    className: "",
                    orderable: true,        // Jika ingin kolom bisa diurutkan 
                    searchable: true        // Jika kolom bisa dicari
                }, {
                    data: "pengeluaran",    // Sesuaikan dengan nama kolom untuk pengeluaran
                    className: "",
                    orderable: true,        // Jika ingin kolom bisa diurutkan 
                    searchable: true        // Jika kolom bisa dicari
                }, {
                    data: "saldo",          // Sesuaikan dengan nama kolom untuk saldo
                    className: "",
                    orderable: true,        // Jika ingin kolom bisa diurutkan 
                    searchable: true        // Jika kolom bisa dicari
                }

            ]
        });
        
    });
</script>
@endpush
