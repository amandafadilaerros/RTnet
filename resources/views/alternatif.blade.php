@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-md-8">
      <a class="btn btn-sm btn-primary" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahModal">Tambah</a>
    </div>
    <div class="col-md-4" style="">
      <div class="row">
          <input type="text" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
          <button class="btn btn-primary" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
      </div>
  </div>
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
      <table class="table table-hover table-striped" id="table_alternatif">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Alternatif</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
  </div>
</div>
<!-- Modal tambah alternatif -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Alternatif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahPengumumanForm" action="{{url('/ketuaRt/alternatif')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_alternatif">Nama:</label>
                        <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif">
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
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Alternatif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPengumumanForm" action="{{url('/ketuaRt/alternatif/edit')}}" method="POST">
                    @csrf
                    <input type="hidden" id="id_alternatif_edit" name="id_alternatif" value="">
                    <div class="form-group">
                        <label for="nama_alternatif">Nama:</label>
                        <input type="text" class="form-control" id="nama_alternatif_edit" name="nama_alternatif">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- hapus modal --}}
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
          <form id="hapusForm" action="{{url('/ketuaRt/alternatif/delete')}}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id_alternatif" id="id_alternatif">
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
      var dataBarang = $('#table_alternatif').DataTable({
          serverSide: true,
          searching: false,
          ajax: {
              "url": "{{ url('ketuaRt/alternatif/list') }}",
              "dataType": "json",
              "type": "POST",
              "data": function (d){
                  d.id_alternatif = $('#id_alternatif').val();
              }
          },
          columns: [
              {
                  data: "DT_RowIndex", //nomor urut dari laravel datatable addindexcolumn()
                  classname: "text-center",
                  orderable: false,
                  searchable: false
              },{
                  data: "nama_alternatif",
                  classname: "",
                  orderable: false, //orderable false jika ingin kolom bisa diurutkan
                  searchable: false, //searchable false jika ingin kolom bisa dicari
              },{
                  data: null,
                  classname: "",
                  orderable: false, //orderable true jika ingin kolom bisa diurutkan
                  searchable: false, //searchable true jika ingin kolom bisa dicari
                  render: function (data, type, row) {
                      return '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="' + row.id_alternatif + '"><i class="fas fa-pen"></i></a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="' + row.id_alternatif + '"><i class="fas fa-trash"></i></a>';
                  }
              }
          ]
      });
      $('#kategori_id').on('change', function(){
          dataBarang.ajax.reload();
      });
      $(document).on("click", ".btn-edit", function () {
        var ids = $(this).data('id');
        $(".modal-body #id_alternatif_edit").val( ids );
        $.ajax({
            url: "{{ url('ketuaRt/alternatif/getData') }}",
            type: "POST",
            dataType: "json",
            data: {
                id_alternatif: ids
            },
            success: function(response) {
                // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
                $('.modal-body #nama_alternatif_edit').val(response.nama_alternatif);
                // Isi formulir lainnya sesuai kebutuhan Anda
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan yang terjadi
            }
        });
      });
      $(document).on("click", ".btn-delete", function () {
        var ids = $(this).data('id');
        $(".modal-footer #id_alternatif").val( ids );
      });
    });
  </script>
@endpush