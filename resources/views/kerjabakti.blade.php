@extends('layouts.template')
@section('content')
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
      <div class="row">
          <div class="col-md-6">
            <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahModal">Tambah</a>
          </div>
          <div class="col-md-6">
            {{-- UNTUK SEARCH --}}
          </div>
      </div>
      <table class="table table-bordered table-hover table-sm" id="table_user">
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
                <form class="d-inline-block" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #9e9e9e; margin-bottom: 10px; border: none; width: 100px;" onclick="return confirm('Apakah Anda yakin menghapus data ini?') data-toggle="modal" data-target="#tambahModal">Akhiri</a>
                    </form> 
                </td>
                  <!-- <a href="" class="btn btn-success btn-sm"><i class="fas fa-pen"></i></a>
                  <form class="d-inline-block" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?');"><i class="fas fa-trash"></i></button>
                  </form> 
                </td>  -->
            </tr>
            <tr>
                <td>2</td>
                <td>Mengganti kran air depan masjid</td>
                <td>
                    <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; border: none; width: 100px;" data-toggle="modal" data-target="#tambahModal">Jadwalkan</a>
                    <!-- <form class="d-inline-block" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?');"><i class="fas fa-trash"></i></button>
                  </form>  -->
                </td> 
                
            </tr>
            <tr>
                <td>3</td>
                <td>Mengganti toa masjid</td>
                <td>
                <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; border: none; width: 100px;" data-toggle="modal" data-target="#tambahModal">Jadwalkan</a>
                  <!-- <form class="d-inline-block" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?');"><i class="fas fa-trash"></i></button>
                  </form> -->
                </td>
            </tr>
        </tbody>
      </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
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