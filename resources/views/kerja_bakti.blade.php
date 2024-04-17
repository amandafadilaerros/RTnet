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
        <a href="{{url('kerja_bakti/create')}}" class="btn btn-sm btn-primary mt-1">Tambah</a>
    </div>
</div> --}}
<div class="card-body">
    @if (session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif

      <table class="table table-straped table-hover " id="table_user">
          <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kegiatan</th>
                <th scope="col">Aksi</th>
              </tr>
          </thead>
          {{-- hanya CONTOH DATA TABEL --}}
          <tbody>
            <tr>
                <td>1</td>
                <td>Pembetulan saluran air depan masjid</td>
                <td>
                  <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #9e9e9e; margin-bottom: 10px; border: none; width: 100px;" data-toggle="modal" data-target="#hapusModal">Akhiri</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Mengganti kran air depan masjid</td>
                <td>
                    <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; border: none; width: 100px;" data-toggle="modal" data-target="#editModal">Jadwalkan</a>
                </td> 
                
            </tr>
            <tr>
                <td>3</td>
                <td>Mengganti toa masjid</td>
                <td>
                <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; border: none; width: 100px;" data-toggle="modal" data-target="#editModal">Jadwalkan</a>
                </td>
            </tr>
        </tbody>
      </table>
  </div>
</div>

<!-- Modal Tambah-->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-header d-flex justify-content-between align-items-center">
        <h5 class="modal-title text-center" id="tambahModalLabel" style="font-weight: bold; color: #424874; margin: 0 auto;">Penjadwalan Kerja Bakti</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 20px; right: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Isi dengan formulir untuk memasukkan kegiatan dan jadwal pelaksanaan -->
        <form id="kerjabaktiForm">
            <div class="form-group">
                <label for="nama_kegiatan" style="color: #424874;">Kegiatan</label>
                <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan">
            </div>
            <div class="form-group">
                <label for="jadwal_pelaksanaan" style="color: #424874;">Jadwal Pelaksanaan</label>
                <input type="date" class="form-control" id="jadwal_pelaksanaan" name="jadwal_pelaksanaan">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; border: none; width: 200px;">Beritahu Warga</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit/Jadwalkan-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-header d-flex justify-content-between align-items-center">
        <h5 class="modal-title text-center" id="editModalLabel" style="font-weight: bold; color: #424874; margin: 0 auto;">Penjadwalan Kerja Bakti</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 20px; right: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Isi dengan formulir untuk memasukkan kegiatan dan jadwal pelaksanaan -->
        <form id="kerjabaktiForm">
            <div class="form-group">
                <label for="nama_kegiatan" style="color: #424874;">Kegiatan</label>
                <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan">
            </div>
            <div class="form-group">
                <label for="jadwal_pelaksanaan" style="color: #424874;">Nilai Kriteria 1</label>
                <input type="text" class="form-control" id="jadwal_pelaksanaan" name="jadwal_pelaksanaan">
            </div>
            <div class="form-group">
                <label for="jadwal_pelaksanaan" style="color: #424874;">Nilai Kriteria 2</label>
                <input type="text" class="form-control" id="jadwal_pelaksanaan" name="jadwal_pelaksanaan">
            </div>
            <div class="form-group">
                <label for="jadwal_pelaksanaan" style="color: #424874;">Nilai Kriteria 3</label>
                <input type="text" class="form-control" id="jadwal_pelaksanaan" name="jadwal_pelaksanaan">
            </div>
            <div class="form-group">
                <label for="jadwal_pelaksanaan" style="color: #424874;">Dana Yang Dibutuhkan</label>
                <input type="text" class="form-control" id="jadwal_pelaksanaan" name="jadwal_pelaksanaan">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; border: none; width: 200px;">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-header d-flex justify-content-between align-items-center">
        <h5 class="modal-title text-center" id="hapusModalLabel" style="font-weight: bold; color: #424874; margin: 0 auto;">Konfirmasi Hapus Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 20px; right: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin menghapus data ini?
      </div>
      <div class="modal-footer justifiy-content">
        <form id="hapusForm" method="" action="">
          @csrf
          @method('DELETE')
          <div class="text-center">
            <button type="submit" class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; border: none; width:200px;">Hapus</button>
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
@endpush 