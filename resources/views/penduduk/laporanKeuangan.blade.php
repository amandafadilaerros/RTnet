@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="input-group float-right">
            <select class="form-control" id="searchOption" style="border-radius: 20px;">
                <option value="" selected disabled>Filter</option>
                <option value="kas">Kas</option>
                <option value="paguyuban">Paguyuban</option>
            </select>
        </div>
    </div>

        <div class="col-md-8">
            <div class="row justify-content-end">
              <form id="searchForm" class="form-inline">
                <div class="form-group">
                  <input type="text" class="form-control" id="search" style="border-radius: 20px; width: 260px;" placeholder="Cari disini..." aria-label="Search" aria-describedby="search-addon">
                </div>
                <button type="submit" class="btn btn-primary" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
              </form>
          
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
        var dataLaporan = $('#laporan').DataTable({
            serverSide: true, //jika ingin menggunakan server side processing
            searching: true,
            ajax: {
                url: "{{ url('penduduk/laporan_keuangan/list') }}",
                dataType: "json",
                type: "POST",
                data: function(d) {
                    d.search = $('#search').val();
                    d.filter = $('#searchOption').val(); // Tambahkan filter ke data yang dikirim
                }
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

        $('#searchForm').on('submit', function(e) {
            e.preventDefault();
            dataLaporan.ajax.reload();
        });

        $('#searchOption').on('change', function() {
            dataLaporan.ajax.reload(); // Memuat ulang data tabel ketika filter diubah
        });
    });
</script>
@endpush
