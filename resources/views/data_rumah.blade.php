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
        <a href="{{url('kerjabakti/create')}}" class="btn btn-sm btn-primary mt-1">Tambah</a>
    </div>
</div> --}}
<div class="card-body">
    @if (session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif

    <table class="table table-hover table-striped" id="table_user">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">No.Rumah</th>
                <th scope="col">Status Rumah</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        {{-- hanya CONTOH DATA TABEL --}}
        <tbody>
            <tr>
                <td>1</td>
                <td>112</td>
                <td>Kos Besar</td>
                <td>
                  <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal"><i class="fas fa-pen"></i></a>
                  <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>113</td>
                <td>Rumah Pribadi</td>
                <td>
                  <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal"><i class="fas fa-pen"></i></a>
                  <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>113</td>
                <td>Kontrakan</td>
                <td>
                  <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal"><i class="fas fa-pen"></i></a>
                  <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
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
                <!-- Isi dengan formulir untuk memasukkan data rumah -->
                <form id="tambahRumahForm">
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
                <h5 class="modal-title text-center" id="editModalLabel" style="font-weight: bold; color: #424874; margin: 0 auto;">Edit Data Rumah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 20px; right: 20px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Isi dengan formulir untuk mengedit data rumah -->
                <form id="editRumahForm">
                    <div class="form-group">
                        <label for="edit_no_rumah" style="color: #424874;">No. Rumah</label>
                        <input type="text" class="form-control" id="edit_no_rumah" name="edit_no_rumah">
                    </div>
                    <div class="form-group">
                        <label for="edit_status_rumah" style="color: #424874;">Status Rumah</label>
                        <select class="form-control" id="edit_status_rumah" name="edit_status_rumah">
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
<!-- <script>
  // Fungsi untuk menampilkan modal tambahan berdasarkan jenis pemasukan yang dipilih
  document.getElementById('kasButton').addEventListener('click', function() {
    $('#kasModal').modal('show');
  });

  document.getElementById('paguyubanButton').addEventListener('click', function() {
    $('#paguyubanModal').modal('show');
  });
</script> -->
@endpush