@extends('layouts.template')
@section('content')
<div class="col-md-6 offset-md-6 mb-4">
  <div class="input-group">
    <input type="text" id="customSearchBox" class="form-control" style="border-radius: 20px ;margin-left : 200px;" placeholder="Cari...">
    <div class="input-group-append">
      <a class="btn btn-sm btn-primary mt-1" id="customSearchButton" style="border-radius: 20px; background-color: #424874; margin-left:10px; width:100px;">Cari</a>
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

    <div class="table-responsive">
      <table class="table table-hover table-striped" id="table_peminjaman">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Warga</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Jumlah Peminjaman</th>
            <th scope="col">Tanggal Peminjaman</th>
            <th scope="col">Tanggal Pengembalian</th>
            <th scope="col">Status Peminjaman</th>
          </tr>
        </thead>
        {{-- hanya CONTOH DATA TABEL --}}
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@push('css')
@endpush

@push('js')
<script>
  $(document).ready(function(){
      var dataBarang = $('#table_peminjaman').DataTable({
          serverSide: true,
          searching: false,
          ajax: {
              "url": "{{ url('ketuaRt/daftar_peminjaman/list') }}",
              "dataType": "json",
              "type": "POST",
              "data": function (d){
                  d.kategori_id = $('#kategori_id').val();
                  d.customSearch = $('#customSearchBox').val();
              }
          },
          columns: [
              {
                  data: "DT_RowIndex", //nomor urut dari laravel datatable addindexcolumn()
                  classname: "text-center",
                  orderable: false,
                  searchable: false
              },{
                  data: "id_peminjam",
                  classname: "",
                  orderable: false, //orderable false jika ingin kolom bisa diurutkan
                  searchable: false, //searchable false jika ingin kolom bisa dicari
              },{
                  data: "inventaris.nama_barang",
                  classname: "",
                  orderable: true, //orderable true jika ingin kolom bisa diurutkan
                  searchable: true //searchable true jika ingin kolom bisa dicari
              },{
                  data: "jumlah_peminjaman",
                  classname: "",
                  orderable: false, //orderable true jika ingin kolom bisa diurutkan
                  searchable: false //searchable true jika ingin kolom bisa dicari
              },{
                  data: "tanggal_peminjaman",
                  classname: "",
                  orderable: false, //orderable true jika ingin kolom bisa diurutkan
                  searchable: false //searchable true jika ingin kolom bisa dicari
              },{
                  data: "tanggal_kembali",
                  classname: "",
                  orderable: false, //orderable true jika ingin kolom bisa diurutkan
                  searchable: false //searchable true jika ingin kolom bisa dicari
              },{
                  data: null,
                  classname: "",
                  orderable: false, //orderable true jika ingin kolom bisa diurutkan
                  searchable: false, //searchable true jika ingin kolom bisa dicari
                  render: function(data, type, row) {
                      if (row.tanggal_kembali === null) {
                        var url = 'daftar_peminjaman/edit/'+ row.id_peminjaman;
                          return '<a class="btn btn-success btn-sm" href="'+url+'" style="border-radius: 20px; background-color: #747998; min-width: 170px; max-width: 70%;">Kembalikan</a>';
                      } else {
                          return '<button class="btn btn-primary btn-sm" style="border-radius: 20px; background-color: #424874; min-width: 170px; max-width: 70%;">Selesai</button>';
                      }
                  }
              }
          ]
      });
      $('#customSearchButton').on('click', function() {
            dataBarang.ajax.reload(); // Reload tabel dengan parameter pencarian baru
        });
      $('#customSearchBox').on('keyup', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                dataBarang.ajax.reload(); // Reload tabel saat menekan tombol Enter
            }
        });
    });
</script>
@endpush
