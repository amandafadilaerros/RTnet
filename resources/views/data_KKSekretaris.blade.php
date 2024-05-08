@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-md-6">
        <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874;width:20%" data-toggle="modal" data-target="#tambahModal">Tambah</a>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <input type="text" class="form-control" style="border-radius: 20px ;margin-left : 200px;" placeholder="Cari...">
            <div class="input-group-append">
                <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-left:10px; width:100px;">Cari</a>
            </div>
        </div>
    </div>
</div>
<div class="card">
  {{-- <div class="card-header">
      <h3 class="card-title">
        {{ $page->title }}
      </h3>
      <div class="card-tools">
          <a href="{{url('data_kk/create')}}" class="btn btn-sm btn-primary mt-1">Tambah</a>
      </div>
  </div> --}}
  <div class="card-body">
      @if (session('success'))
          <div class="alert alert-success">{{session('success')}}</div>
      @endif
      @if (session('error'))
          <div class="alert alert-danger">{{session('error')}}</div>
      @endif
      <table class="table table-hover table-striped" id="table_data_kk">
          <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">No. KK</th>
                <th scope="col">Nama Kepala Keluarga</th>
                <th scope="col">Jumlah Individu</th>
                <th scope="col">Alamat</th>
                <th scope="col">No Rumah</th>
                <th scope="col">Dokumen</th>
                <th scope="col">Aksi</th>
              </tr>
          </thead>
        
<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 25px;">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h5 class="modal-title text-center" id="tambahModalLabel" style="font-weight: bold; color: #424874; margin: 0 auto;">Tambah Data Kartu Keluarga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 20px; right: 20px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahKKForm" action="{{url('/sekretaris/data_kk')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="no_kk">No KK</label>
                  <input type="text" class="form-control" id="no_kk" name="no_kk" placeholder="Masukkan No KK">
                </div>
                <div class="form-group">
                  <label for="nama_kepala_keluarga">Nama Kepala Keluarga</label>
                  <input type="text" class="form-control" id="nama_kepala_keluarga" name="nama_kepala_keluarga" placeholder="Masukkan Nama Kepala Keluarga">
                </div>
                <div class="form-group">
                  <label for="jumlah_individu">Jumlah Individu</label>
                  <input type="text" class="form-control" id="jumlah_individu" name="jumlah_individu" placeholder="Masukkan Jumlah Individu">
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat">
                </div>
                <div class="form-group">
                  <label for="no_rumah">No Rumah</label>
                  <input type="text" class="form-control" id="no_rumah" name="no_rumah" placeholder="Masukkan No Rumah">
                </div>
                <div class="form-group">
                  <label for="dokumen">Dokumen Kartu Keluarga</label>
                  <input type="file" class="form-control-file" id="dokumen" name="dokumen">
                </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; border: none; width: 200px;">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 25px;">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Kartu Keluarga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editKKForm" action="{{ url('/sekretaris/data_kk/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                    <label for="no_kk">No KK</label>
                    <input type="number" class="form-control" id="no_kk" name="no_kk" placeholder="Masukkan No KK"  required>
                  </div>
                  <div class="form-group">
                    <label for="nama_kepala_keluarga">Nama Kepala Keluarga</label>
                    <input type="text" class="form-control" id="nama_kepala_keluarga" name="nama_kepala_keluarga" placeholder="Masukkan  Nama Kepala Keluarga"  required>
                  </div>
                  <div class="form-group">
                    <label for="jumlah_individu">Jumlah Individu</label>
                    <input type="text" class="form-control" id="jumlah_individu" name="jumlah_individu" placeholder="Masukkan Jumlah Individu"  required>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat"  required>
                  </div>
                  <div class="form-group">
                  <label for="no_rumah">No Rumah</label>
                  <input type="text" class="form-control" id="no_rumah" name="no_rumah" placeholder="Masukkan No Rumah"  required>
                  </div>
                  <div class="form-group">
                    <label for="dokumen">Dokumen Kartu Keluarga</label>
                    <input type="file" class="form-control-file" id="dokumen" name="dokumen">
                  </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hapusModalLabel">Hapus Data Kartu Keluarga</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin menghapus data ini?
        </div>
        <div class="modal-footer justifiy-content">
          <form id="hapusForm" method="post" action="{{url('/sekretaris/data_kk/delete')}}">
            @csrf
            @method('DELETE')
            <input type="hidden" id="no_kk" name="no_kk">
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
        $(document).ready(function() {
            var dataKK = $('#table_data_kk').DataTable({
                serverSide: true,   //jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ url('sekretaris/data_kk/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d){
                  d.no_kk = $('#no_kk').val();
              }
                },
                columns: [
                    {
                        data: "DT_RowIndex",    // nomor urut dari laravel datatable addIndexColimn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "no_kk",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa urut
                        searchable: true        // jika kolom bisa dicari
                    }, {
                        data: "nama_kepala_keluarga",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                      data: "jumlah_individu",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                      data: "alamat",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                      data: "no_rumah",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                      data: "dokumen",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                      data: null,
                      classname: "",
                      orderable: false, //orderable true jika ingin kolom bisa diurutkan
                      searchable: false, //searchable true jika ingin kolom bisa dicari
                      render: function (data, type, row) {
                        return '<a href="#" class="btn btn-primary btn-sm btn-detail" data-toggle="modal" data-target="#detailModal" data-id="' + row.no_kk + '"><i class="fas fa-info-circle"></i></a> <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="' + row.no_kk + '"><i class="fas fa-pen"></i></a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="' + row.no_kk + '"><i class="fas fa-trash"></i></a>';

                  }
              }
          ]
      });
      $('#no_kk').on('change', function(){
          dataKK.ajax.reload();
      });
        $(document).on("click", ".btn-edit", function () {
        var ids = $(this).data('id');
        $(".modal-body #id").val( ids );
        $.ajax({
            url: "{{ url('sekretaris/data_kk/edit') }}",
            type: "POST",
            dataType: "json",
            data: {
                no_kk: ids
            },
            success: function(response) {
                // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
                $('.modal-body #no_kk').val(response.no_kk);
                $('.modal-body #nama_kepala_keluarga').val(response.nama_kepala_keluarga);
                $('.modal-body #jumlah_individu').val(response.jumlah_individu);
                $('.modal-body #alamat').val(response.alamat);
                $('.modal-body #no_rumah').val(response.no_rumah);
                $('.modal-body #dokumen').val(response.dokumen);
                // Isi formulir lainnya sesuai kebutuhan Anda
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan yang terjadi
            }
        });
    });
    $(document).on("click", ".btn-delete", function () {
        var no_kk = $(this).data('id');
        $(".modal-footer #no_kk").val( no_kk );
    });
});

    </script>
@endpush
