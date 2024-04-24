@extends('layouts.template')

@section('content')
<div class="row">
  <div class="col-md-6 offset-md-6 mb-4">
    <div class="input-group">
      <input type="text" class="form-control" style="border-radius: 20px; margin-left: 200px;" placeholder="Cari...">
      <div class="input-group-append">
        <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-left: 10px; width: 100px;">Cari</a>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-hover table-striped" id="inventaris_table">
      <thead>
        <tr>
          <th scope="col">ID Inventaris</th>
          <th scope="col">Nama Barang</th>
          <th scope="col">Jumlah</th>
          <th scope="col">ID Gambar</th>
    
        </tr>
      </thead>
    </table>
  </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        var inventaris = $('#inventaris_table').DataTable({
            serverSide: true,   // Jika ingin menggunakan server-side processing
            ajax: {
                "url": "{{ url('penduduk/inventaris/list') }}", // Ganti URL dengan endpoint yang sesuai
                "dataType": "json",
                "type": "POST"
            },
            columns: [
                {
                    data: "DT_RowIndex",    // Nomor urut dari Laravel DataTable addIndexColumn()
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "nama_barang",    // Sesuaikan dengan nama kolom untuk nama barang
                    className: "",
                    orderable: true,        // Jika ingin kolom bisa diurutkan
                    searchable: true        // Jika kolom bisa dicari
                }, {
                    data: "jumlah",    // Sesuaikan dengan nama kolom untuk jumlah barang
                    className: "",
                    orderable: true,        // Jika ingin kolom bisa diurutkan
                    searchable: true        // Jika kolom bisa dicari
                }, {
                    data: "id_gambar",      // Sesuaikan dengan nama kolom untuk foto barang
                    className: "",
                    orderable: false,      // Foto mungkin tidak perlu diurutkan
                    searchable: false      // Foto mungkin tidak perlu dicari
                }
            ]
        });
        
    });
</script>
@endpush
