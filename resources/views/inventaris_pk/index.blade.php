@extends('layouts.template')
@section('content')
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
      <div class="row">
        <div class="col-md-6 text-right">
          <form action="{{url('inventaris')}}" class="form-inline justify-content-end">
            <input type="text" class="form-control form-control-sm mr-sm-2 mt-1" name="search" placeholder="Cari Inventaris" value="{{Request::get('search')}}">
            <button class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874;" type="submit">Search</button>
          </form>
        </div>
          {{-- <div class="col-md-6">
            <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahModal">Tambah</a>
          </div> --}}
          <div class="col-md-6">
            {{-- UNTUK SEARCH --}}
            <div class="col-md-6">
              <form action="{{url('inventaris')}}" class="form-inline">
                <input type="text" class="form-control form-control-sm mr-sm-2 mt-1" name="search" placeholder="Cari Tanggal" value="{{Request::get('search')}}">
                <button class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874;" type="submit">Search</button>
              </form>
            </div>

          </div>
      </div>
      <table class="table table-bordered table-hover table-sm" id="table_user">
          <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Nama</th>
                <th scope="col">Peminjaman</th>
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
                <td>
                  <button type="button" class="btn btn-danger btn-sm btn-block custom-width" data-toggle="modal" data-target="#pinjamInven" data-nama="Sound">dipinjam</button>
                  <style>
                    .custom-width {
                      border-radius: 30px/30px;
                      width: 100%;
                      max-width: 25px;
                      min-width: 120px;
                    }
                  </style>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>
                  <img src="{{URL::asset('img/carpet.png')}}" alt="Placeholder" class="img-fluid img-thumbnail" style="width: 80px; height: auto;">
                </td>
                <td>Karpet</td>
                <td>
                  <button type="button" class="btn btn-success btn-sm btn-block custom-width" data-toggle="modal" data-target="#pinjamInven" data-nama="Sound">Tersedia</button>
                  <style>
                    .custom-width {
                      border-radius: 30px/30px;
                      width: 100%;
                      max-width: 25px;
                      min-width: 120px;
                    }
                  </style>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>
                    <img src="{{URL::asset('img/sprayer.png')}}" alt="" class="img-fluid img-thumbnail" style="width: 80px; height: auto;">
                </td>
                <td>Semprotan</td>
                <td>
                  <button type="button" class="btn btn-success btn-sm btn-block custom-width" data-toggle="modal" data-target="#pinjamInven" data-nama="Sound">Tersedia</button>
                  <style>
                    .custom-width {
                      border-radius: 30px/30px;
                      width: 100%;
                      max-width: 25px;
                      min-width: 120px;
                    }
                  </style>
                </td>
                </td>
            </tr>
        </tbody>
      </table>
  </div>
</div>
<!-- Peminjaman Barang -->
<div class="modal fade" id="pinjamInven" tabindex="-1" role="dialog" aria-labelledby="pinjamInvenLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 25px;">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahInvenLabel">Peminjaman Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="pinjam_barang">
            <div class="form-group">
              <label for="pinjam">Jumlah Barang</label>
              <div class="form-group">
                <input type="text" class="form-control" name="jumlah" id="nama_barang" placeholder="Jumlah">
                </label>
              </div>
              <div class="form-group">
                <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian">
                </label>
              </div>
            </div>
          </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Pinjam</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal edit pengeluaran -->
  {{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
</div>  --}}
{{-- <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
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
  </div> --}}


@endsection
@push('css')
@endpush

@push('js')
@endpush