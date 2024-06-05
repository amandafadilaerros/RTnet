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
    <div class="col-md-3 mb-4"></div>

    <div class="col-md-6">
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
    {{-- <div class="card-header">
        <h3 class="card-title">Laporan Keuangan</h3>
    </div> --}}
    <div class="card-body">
        <table class="table table-hover table-striped" id="laporan">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Keterangan</th>
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
<style>
    /* Menyembunyikan fitur pencarian di tabel */
    .dataTables_filter {
        display: none;
    }

    #searchOption option:hover {
        outline: none;
        /* Remove default focus outline */
        border-color: #424874;
        /* Change border color to match the desired color */
        box-shadow: 0 0 0 0.2rem rgba(66, 72, 116, 0.25);
        /* Add a box shadow to simulate focus effect */
    }
</style>

<!-- Tambahkan CSS tambahan jika diperlukan -->
@endpush
@push('js')
<script>
    $(document).ready(function() {
        var dataLaporan = $('#laporan').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('bendahara/laporan/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    d.search = $('#search').val();
                    d.filter = $('#searchOption').val(); // Tambahkan filter ke data yang dikirim
                }
            },
            columns: [{
                data: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false
            }, {
                data: "jenis_iuran",
                className: "",
                orderable: true,
                searchable: true
            }, {
                data: "keterangan",
                className: "",
                orderable: true,
                searchable: true
            }, {
                data: "jumlah_uang_masuk",
                className: "",
                orderable: true,
                searchable: true
            }, {
                data: "jumlah_uang_keluar",
                className: "",
                orderable: true,
                searchable: true
            }, {
                data: "saldo",
                className: "",
                orderable: true,
                searchable: true
            }]
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