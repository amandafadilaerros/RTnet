@extends('layouts.template')
@section('content')
<div class="row mb-4">
    <div class="col-md-9">
        <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874;width:20%" data-toggle="modal" data-target="#tambahModal">Tambah</a>
    </div>
    <div class="col-md-3" style="">
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

    <div class="table-responsive">
        <table class="table table-hover table-striped" id="table_data_rumah">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">No.Rumah</th>
                    <th scope="col">Status Rumah</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
        

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
                        <input type="number" class="form-control" id="no_rumah" name="no_rumah">
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
                <form id="editRumahForm" action="{{ url('/ketuaRt/data_rumah/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="no_rumah" style="color: #424874;">No. Rumah</label>
                        <input type="number" class="form-control" id="no_rumah" name="no_rumah">
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
          <form id="hapusForm" method="post" action="{{url('/ketuaRt/data_rumah/delete')}}">
            @csrf
            @method('DELETE')
            <input type="hidden" id="no_rumah" name="no_rumah">
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
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ url('ketuaRt/data_rumah/list') }}",
                    dataType: "json",
                    type: "POST",
                    data: function(d) {
                        d.no_rumah = $('#no_rumah').val();
                        d.customSearch = $('#customSearchBox').val();

                    }
                },
                columns: [
                    {
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "no_rumah",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "status_rumah",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: null,
                        className: "",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="${row.no_rumah}">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="${row.no_rumah}">
                                    <i class="fas fa-trash"></i>
                                </a>`;
                        }
                    }
                ]
            });

            $('#no_rumah').on('change', function() {
                dataRumah.ajax.reload();
            });

            $('#customSearchButton').on('click', function() {
            dataRumah.ajax.reload(); // Reload tabel dengan parameter pencarian baru
            });
            $('#customSearchBox').on('keyup', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                dataRumah.ajax.reload(); // Reload tabel saat menekan tombol Enter
            }
            });

            $(document).on("click", ".btn-edit", function() {
                var ids = $(this).data('id');
                $(".modal-body #id").val(ids);
                $.ajax({
                    url: "{{ url('ketuaRt/data_rumah/edit') }}",
                    type: "POST",
                    dataType: "json",
                    data: { no_rumah: ids },
                    success: function(response) {
                        $('.modal-body #no_rumah').val(response.no_rumah);
                        $('.modal-body #status_rumah').val(response.status_rumah);
                        // Isi formulir lainnya sesuai kebutuhan Anda
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan yang terjadi
                    }
                });
            });

            $(document).on("click", ".btn-delete", function() {
                var no_rumah = $(this).data('id');
                $(".modal-footer #no_rumah").val(no_rumah);
            });
        });
    </script>
@endpush
