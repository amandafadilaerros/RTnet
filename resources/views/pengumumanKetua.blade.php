@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-md-8">
      <a class="btn btn-sm btn-primary" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahModal">Tambah</a>
    </div>
    <div class="col-md-4" style="">
      <div class="row">
          <input type="text" id="customSearchBox" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
          <button class="btn btn-primary" id="customSearchButton" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
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
      <table class="table table-hover table-striped" id="table_pengumuman">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Pengumuman</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
  </div>
</div>
<!-- Modal tambah pengumuman -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahPengumumanForm" action="{{url('/ketuaRt/pengumuman')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul:</label>
                        <input type="text" class="form-control" id="judul" name="judul">
                    </div>
                    <div class="form-group">
                        <label for="kegiatan">Kegiatan:</label>
                        <input type="text" class="form-control" id="kegiatan" name="kegiatan">
                    </div>
                    <div class="form-group">
                        <label for="jadwal">Jadwal Pelaksanaan:</label>
                        <input type="date" class="form-control" id="jadwal" name="jadwal">
                    </div>
                    <div class="form-group">
                        <label for="detail">Deskripsi:</label>
                        <input type="textarea" class="form-control" id="detail" name="deskripsi">
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
                <h5 class="modal-title" id="editModalLabel">Edit Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPengumumanForm" action="{{url('/ketuaRt/pengumuman/edit')}}" method="POST">
                    @csrf
                    <input type="hidden" id="id_pengumuman" name="id_pengumuman" value="">
                    <div class="form-group">
                        <label for="judul">Judul:</label>
                        <input type="text" class="form-control" id="judul" name="judul">
                    </div>
                    <div class="form-group">
                        <label for="kegiatan">Kegiatan:</label>
                        <input type="text" class="form-control" id="kegiatan" name="kegiatan">
                    </div>
                    <div class="form-group">
                        <label for="jadwal">Jadwal Pelaksanaan:</label>
                        <input type="date" class="form-control" id="jadwal_pelaksanaan" name="jadwal">
                    </div>
                    <div class="form-group">
                        <label for="detail">Deskripsi:</label>
                        <input type="textarea" class="form-control" id="detail" name="deskripsi">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Show Modal --}}
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">Detail Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Judul:</label>
                        <input type="text" class="form-control" id="judul" name="judul" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kegiatan">Kegiatan:</label>
                        <input type="text" class="form-control" id="kegiatan" name="kegiatan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jadwal">Jadwal Pelaksanaan:</label>
                        <input type="text" class="form-control" id="jadwal_pelaksanaan" name="jadwal" readonly>
                    </div>
                    <div class="form-group">
                        <label for="detail">Deskripsi:</label>
                        <input type="textarea" class="form-control" id="detail" name="deskripsi" readonly>
                    </div>
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
          <form id="hapusForm" action="{{url('/ketuaRt/pengumuman/delete')}}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id_pengumuman" id="id_pengumuman">
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
      var dataBarang = $('#table_pengumuman').DataTable({
          serverSide: true,
          searching: false,
          ajax: {
              "url": "{{ url('ketuaRt/pengumuman/list') }}",
              "dataType": "json",
              "type": "POST",
              "data": function (d){
                  d.id_pengumuman = $('#id_pengumuman').val();
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
                  data: "",
                  classname: "",
                  orderable: false, //orderable false jika ingin kolom bisa diurutkan
                  searchable: true, //searchable false jika ingin kolom bisa dicari
                  render: function (data, type, row) {
                        return row.judul + ' - ' + row.kegiatan + ' (' + row.jadwal_pelaksanaan + ')';
                    }
              },{
                  data: null,
                  classname: "",
                  orderable: false, //orderable true jika ingin kolom bisa diurutkan
                  searchable: false, //searchable true jika ingin kolom bisa dicari
                  render: function (data, type, row) {
                      return '<a href="#" class="btn btn-primary btn-sm btn-show" data-toggle="modal" data-target="#showModal" data-id="' + row.id_pengumuman + '"><i class="fas fa-eye"></i></a> <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="' + row.id_pengumuman + '"><i class="fas fa-pen"></i></a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="' + row.id_pengumuman + '"><i class="fas fa-trash"></i></a>';
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
        $(".modal-body #id_pengumuman").val( ids );
        $.ajax({
            url: "{{ url('ketuaRt/pengumuman/getData') }}",
            type: "POST",
            dataType: "json",
            data: {
                id_pengumuman: ids
            },
            success: function(response) {
                // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
                $('.modal-body #judul').val(response.judul);
                $('.modal-body #kegiatan').val(response.kegiatan);
                $('.modal-body #jadwal_pelaksanaan').val(response.jadwal_pelaksanaan);
                // Isi formulir lainnya sesuai kebutuhan Anda
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan yang terjadi
            }
        });
      });
      $(document).on("click", ".btn-show", function () {
        var ids = $(this).data('id');
        $(".modal-body #id_pengumuman").val( ids );
        $.ajax({
            url: "{{ url('ketuaRt/pengumuman/getData') }}",
            type: "POST",
            dataType: "json",
            data: {
                id_pengumuman: ids
            },
            success: function(response) {
                // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
                $('.modal-body #judul').val(response.judul);
                $('.modal-body #kegiatan').val(response.kegiatan);
                $('.modal-body #jadwal_pelaksanaan').val(response.jadwal_pelaksanaan);
                // Isi formulir lainnya sesuai kebutuhan Anda
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan yang terjadi
            }
        });
      });
      $(document).on("click", ".btn-delete", function () {
        var ids = $(this).data('id');
        $(".modal-footer #id_pengumuman").val( ids );
      });
    });
  </script>
@endpush