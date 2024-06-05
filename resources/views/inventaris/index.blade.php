@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-md-8">
      <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahModal">Tambah</a>
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
  {{-- <div class="card-header">
      <h3 class="card-title">
        {{ $page->title }}
      </h3>
      <div class="card-tools">
          <a href="{{url('user/create')}}" class="btn btn-sm btn-primary mt-1">Tambah</a>
      </div>
  </div> --}}
  <div class="card-body">
      @if (session('success'))
          <div class="alert alert-success">{{session('success')}}</div>
      @endif
      @if (session('error'))
          <div class="alert alert-danger">{{session('error')}}</div>
      @endif
      <div class="table-responsive">
        <table class="table table-hover table-striped" id="table_inventaris">
            <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Gambar</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Aksi</th>
                </tr>
            </thead>
        </table>
      </div>
  </div>
</div>

<!-- Modal tambah pengeluaran -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 25px;">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Inventaris</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="tambahPengeluaranForm" action="{{url('/ketuaRt/inventaris')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="jenis_keuangan">Tambah Data</label>
              <div class="form-group">
                <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang">
                </label>
              </div>
              <div class="form-group">
                <label for="jumlah">Jumlah:</label>
                <input type="text" class="form-control" id="jumlah" name="jumlah">
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="gambar">Gambar:</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                <label class="custom-file-label" for="gambar">Choose file</label>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal edit pengeluaran -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 25px;">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Inventaris</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPengeluaranForm" action="{{url('/ketuaRt/inventaris/edit')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" id="id_inventaris" name="id_inventaris" value="">
                    <div class="form-group">
                        <label for="jenis_keuangan_edit">Tambah Data</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah:</label>
                            <input type="text" class="form-control" id="jumlah" name="jumlah">
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar:</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="gambar" name="gambar">
                          <label class="custom-file-label" for="gambar">Choose file</label>
                        </div>
                      </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin menghapus data ini?
        </div>
        <div class="modal-footer justifiy-content">
          <form id="hapusForm" action="{{url('/ketuaRt/inventaris/delete')}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" id="id_inventaris" name="id_inventaris" value="">
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
@endpush

@push('js')
<script>
  $(document).ready(function(){
      var dataBarang = $('#table_inventaris').DataTable({
          serverSide: true,
          searching: false,
          ajax: {
              "url": "{{ url('ketuaRt/daftar_inventaris/list') }}",
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
                  data: "gambar",
                  classname: "",
                  orderable: false, //orderable false jika ingin kolom bisa diurutkan
                  searchable: false, //searchable false jika ingin kolom bisa dicari
                  render: function(data, type, full, meta) {
                    var baseUrl = '{{ asset('storage/inventaris/') }}';
                    return '<img src="' + baseUrl+'/' + data + '" alt="Gambar Inventaris" style="max-width: 100px; max-height: 100px;">';
                }
              },{
                  data: "nama_barang",
                  classname: "",
                  orderable: true, //orderable true jika ingin kolom bisa diurutkan
                  searchable: true //searchable true jika ingin kolom bisa dicari
              },{
                  data: "jumlah",
                  classname: "",
                  orderable: false, //orderable true jika ingin kolom bisa diurutkan
                  searchable: false //searchable true jika ingin kolom bisa dicari
              },{
                  data: null,
                  classname: "",
                  orderable: false, //orderable true jika ingin kolom bisa diurutkan
                  searchable: false, //searchable true jika ingin kolom bisa dicari
                  render: function (data, type, row) {
                      return '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="' + row.id_inventaris + '"><i class="fas fa-pen"></i></a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="' + row.id_inventaris + '"><i class="fas fa-trash"></i></a>';
                  }
              }
          ]
      });
      $('#kategori_id').on('change', function(){
          dataBarang.ajax.reload();
      });
      $('#customSearchButton').on('click', function() {
            dataBarang.ajax.reload(); // Reload tabel dengan parameter pencarian baru
        });
      $('#customSearchBox').on('keyup', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                dataBarang.ajax.reload(); // Reload tabel saat menekan tombol Enter
            }
        });
      $(document).on("click", ".btn-edit", function () {
        var ids = $(this).data('id');
        $(".modal-body #id_inventaris").val( ids );
        $.ajax({
            url: "{{ url('ketuaRt/inventaris/getData') }}",
            type: "POST",
            dataType: "json",
            data: {
                id_inventaris: ids
            },
            success: function(response) {
                // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
                $('.modal-body #nama_barang').val(response.nama_barang);
                $('.modal-body #jumlah').val(response.jumlah);
                // Isi formulir lainnya sesuai kebutuhan Anda
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan yang terjadi
            }
        });
      });
      $(document).on("click", ".btn-delete", function () {
        var ids = $(this).data('id');
        $(".modal-footer #id_inventaris").val( ids );
      });
});
</script>
@endpush