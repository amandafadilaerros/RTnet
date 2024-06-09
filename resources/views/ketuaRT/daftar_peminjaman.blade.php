@extends('layouts.template')
@section('content')
<div class="row">
  <div class="col-md-8">
    <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahModal">Tambah peminjaman anak kos</a>
  </div>
  {{-- <div class="col-md-6"> --}}
    {{-- UNTUK SEARCH --}}
    <div class="col-md-4" style="">
      <div class="row">
          <input type="text" id="customSearchBox" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
          <button class="btn btn-primary" id="customSearchButton" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
      </div>
    </div>
  {{-- </div> --}}
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
{{-- modal --}}
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahModalLabel">Tambah Peminjaman Anak Kos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="tambahPengeluaranForm" action="{{url('/ketuaRt/daftar_peminjaman/store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="nama_warga">Nama Peminjam</label>
            <select class="form-control" name="no_kk" id="no_kk" required>
              <option value="" disabled selected>Pilih Peminjam</option>
              @foreach($kos as $item)
                <option value="{{ $item->no_kk }}">{{ $item->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="id_inventaris">Nama Barang</label>
            <select class="form-control" name="id_inventaris" id="id_inventaris" required>
              <option value="" disabled selected>Pilih Barang</option>
              @foreach($inventaris as $item)
                <option value="{{ $item->id_inventaris }}">{{ $item->nama_barang }}</option>
              @endforeach
            </select>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Tambah</button>
          </div>
        </form>
      </div>
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
                          return '<a class="btn btn-success btn-sm" href="'+url+'" style="border-radius: 20px; background-color: #424874; min-width: 170px; max-width: 70%;">Kembalikan</a>';
                      } else {
                          return '<button class="btn btn-primary btn-sm" style="border-radius: 20px; background-color: #747998; min-width: 170px; max-width: 70%;">Selesai</button>';
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
