@extends('layouts.template')
@section('content')
<div class="row mb-4">
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

    <table class="table table-hover table-striped" id="table_data_rumah">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">No.Rumah</th>
                <th scope="col">Status Rumah</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 25px;">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h5 class="modal-title text-center" id="tambahModalLabel" style="font-weight: bold; color: #424874; margin: 0 auto;">Tambah Data Rumah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 20px; right: 20px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahRumahForm" action="{{url('/ketuaRt/data_rumah')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="no_rumah" style="color: #424874;">No.Rumah</label>
                        <input type="text" class="form-control" id="no_rumah" name="no_rumah">
                    </div>
                    <div class="form-group">
                        <label for="status_rumah" style="color: #424874;">Status Rumah</label>
                        <select class="form-control" id="status_rumah" name="status_rumah">
                            <option value="Rumah Pribadi">Rumah Pribadi</option>
                            <option value="Kos Kecil">Kos Kecil</option>
                            <option value="Kos Besar">Kos Besar</option>
                            <option value="Kontrakan">Kontrakan</option>
                        </select>
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
                <h5 class="modal-title" id="editModalLabel">Edit Data Rumah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editRumahForm" action="{{ url('/ketuaRt/data_rumah/edit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="no_rumah" name="no_rumah" value="">
                    <div class="form-group">
                        <label for="no_rumah" style="color: #424874;">No. Rumah</label>
                        <input type="text" class="form-control" id="no_rumah" name="no_rumah">
                    </div>
                    <div class="form-group">
                        <label for="status_rumah" style="color: #424874;">Status Rumah</label>
                        <select class="form-control" id="status_rumah" name="status_rumah">
                            <option value="Rumah Pribadi">Rumah Pribadi</option>
                            <option value="Kos Kecil">Kos Kecil</option>
                            <option value="Kos Besar">Kos Besar</option>
                            <option value="Kontrakan">Kontrakan</option>
                        </select>
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
          <h5 class="modal-title" id="hapusModalLabel">Hapus Data Rumah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin menghapus data ini?
        </div>
        <div class="modal-footer justifiy-content">
          <form id="hapusForm" method="delete" action="{{url('/ketuaRt/data_rumah/destroy')}}">
            @csrf
            @method('DELETE')
            <input type="hidden" id="no_rumah_delete" name="no_rumah">
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
            var dataRumah = $('#table_data_rumah').DataTable({
                serverSide: true,   //jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ url('ketuaRt/data_rumah/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d){
                  d.no_rumah = $('#no_rumah').val();
              }
                },
                columns: [
                    {
                        data: "DT_RowIndex",    // nomor urut dari laravel datatable addIndexColimn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "no_rumah",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa urut
                        searchable: true        // jika kolom bisa dicari
                    }, {
                        data: "status_rumah",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                        //true, jika ingin kolom bisa dicari
                    }, {
                  data: null,
                  classname: "",
                  orderable: false, //orderable true jika ingin kolom bisa diurutkan
                  searchable: false, //searchable true jika ingin kolom bisa dicari
                  render: function (data, type, row) {
                      return '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="' + row.no_rumah + '"><i class="fas fa-pen"></i></a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="' + row.no_rumah + '"><i class="fas fa-trash"></i></a>';
                  }
              }
          ]
      });

      $('#no_rumah').on('change', function(){
          dataRumah.ajax.reload();
      });
   
    $(document).on("click", ".btn-update", function () {
    var no_rumah = $(this).data('no_rumah');
    $(".modal-body #no_rumah").val( ids );
    $.ajax({
        url: "{{ url('ketuaRt/data_rumah/update') }}",
        type: "POST",
        dataType: "json",
        data: {
            no_rumah: ids
        },
        success: function(response) {
            // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
            $('.modal-body #status_rumah').val(response.status_rumah);
            // Isi formulir lainnya sesuai kebutuhan Anda
        },
        error: function(xhr, status, error) {
            // Tangani kesalahan yang terjadi
        }
    });
});
$(document).on("click", ".btn-delete", function () {
    var no_rumah = $(this).data('no_rumah');
    $(".modal-body #no_rumah").val( no_rumah );
});
});

   </script>
@endpush
