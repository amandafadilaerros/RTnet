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
            <input type="text" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
            <button class="btn btn-primary" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
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
      <table class="table table-bordered table-hover table-sm" id="table_user">
          <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal Pengembalian </th>
                <th scope="col">Peminjaman</th>
                <th scope="col">Aksi</th>
              </tr>
          </thead>
          {{-- hanya CONTOH DATA TABEL --}}
          <tbody>
            <tr>
                <td>1</td>
                <td>
                  <img src="{{URL::asset('img/speaker.png')}}" alt="Placeholder" class="img-fluid img-thumbnail" style="width: 80px; height: auto;">
                </td>
                <td>Sound</td>
                <td>2024-04-15</td>
                <td>
                  <span class="badge badge-danger">Dipinjam</span>
                </td>
                <td>
                  <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="1" data-jenis="kas"><i class="fas fa-pen"></i></a>
                  <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>
                  <img src="{{URL::asset('img/carpet.png')}}" alt="Placeholder" class="img-fluid img-thumbnail" style="width: 80px; height: auto;">
                </td>
                <td>Karpet</td>
                <td></td>
                <td>
                    <span class="badge badge-success">Tersedia</span>
                </td>
                <td>
                    <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="1" data-jenis="paguyuban"><i class="fas fa-pen"></i></a>
                  <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>
                    <img src="{{URL::asset('img/sprayer.png')}}" alt="" class="img-fluid img-thumbnail" style="width: 80px; height: auto;">
                </td>
                <td>Semprotan</td>
                <td></td>
                <td>
                    <span class="badge badge-success">Tersedia</span>
                </td>
                <td>
                  <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="1" data-jenis="kas"><i class="fas fa-pen"></i></a>
                  <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        </tbody>
      </table>
  </div>
</div>
<!-- Modal tambah pengeluaran -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 25px;">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Data Inventaris</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="tambahPengeluaranForm">
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
                <h5 class="modal-title" id="editModalLabel">Edit Pengeluaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPengeluaranForm">
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
          <form id="hapusForm" method="" action="">
            @csrf
            @method('DELETE')
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
@endpush