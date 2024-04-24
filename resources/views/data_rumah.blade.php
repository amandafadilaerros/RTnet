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
            <div class="modal-header d-flex justify-content-between align-items-center">
                <!-- <a data-toggle="modal" data-id="10" class="passingID"> -->
                <h5 class="modal-title text-center" id="editModalLabel" style="font-weight: bold; color: #424874; margin: 0 auto;">Edit Data Rumah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 20px; right: 20px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- </a> -->
            </div>
            <div class="modal-body">
                <form id="editRumahForm">
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
                        <button type="submit" class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; border: none; width: 200px;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 25px;">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h5 class="modal-title text-center" id="hapusModalLabel" style="font-weight: bold; color: #424874; margin: 0 auto;">Hapus Data Rumah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 20px; right: 20px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Isi dengan konfirmasi untuk menghapus data rumah -->
                <p>Anda yakin ingin menghapus data rumah ini?</p>
                <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; border: none; width: 200px;">Hapus</button>
                    </div>
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
                    "type": "POST"
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
                        data: "aksi",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }

                ]
            });
            
        });

   </script>
@endpush
