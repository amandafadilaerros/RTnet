@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Filter -->
        <div class="col-md-4">
            <select class="form-select" style="border-radius: 20px; width: 170px" aria-label="Filter" aria-describedby="filter-addon">
                <option selected>Filter</option>
                <option value="1">Bulan ini</option>
                <option value="2">Bulan lalu</option>
                <option value="3">Tahun ini</option>
                <option value="4">Tahun lalu</option>
            </select>
        </div>
    </div>
 <!-- Search -->
 <div class="col-md-4" style="">
    <div class="row">
        <input type="text" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
        <button class="btn btn-primary" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
    </div>
</div>
</div>


</div>        
<div class="card">
    {{-- <div class="card-header">
        <h3 class="card-title">Laporan Keuangan</h3>
    </div> --}}
    <div class="card-body">
        <table class="table table-hover table-striped" id="table_keuangan">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis</th>
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
    
@endpush
@push('js')
<script>
    $(document).ready(function(){
      var dataBarang = $('#table_keuangan').DataTable({
          serverSide: true,
          searching: false,
          ajax: {
              "url": "{{ url('ketuaRt/keuangan/list') }}",
              "dataType": "json",
              "type": "POST",
              "data": function (d){
                  d.id_pengumuman = $('#id_pengumuman').val();
              }
          },
          columns: [
              {
                  data: "DT_RowIndex", //nomor urut dari laravel datatable addindexcolumn()
                  classname: "text-center",
                  orderable: false,
                  searchable: false
              },{
                  data: "jenis_iuran",
                  classname: "",
                  orderable: true, //orderable false jika ingin kolom bisa diurutkan
                  searchable: true //searchable false jika ingin kolom bisa dicari
              },{
                  data: "nominal",
                  classname: "",
                  orderable: false, //orderable false jika ingin kolom bisa diurutkan
                  searchable: false //searchable false jika ingin kolom bisa dicari
              },{
                  data: "nominal",
                  classname: "",
                  orderable: false, //orderable false jika ingin kolom bisa diurutkan
                  searchable: false //searchable false jika ingin kolom bisa dicari
              },{
                  data: "nominal",
                  classname: "",
                  orderable: false, //orderable true jika ingin kolom bisa diurutkan
                  searchable: false, //searchable true jika ingin kolom bisa dicari
              }
          ]
      });
      $('#kategori_id').on('change', function(){
          dataBarang.ajax.reload();
      });
    });
  </script>
@endpush
