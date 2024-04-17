@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-md-6">
      <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahModal">Tambah</a>
    </div>
    <div class="col-md-6">
      {{-- UNTUK SEARCH --}}
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
      <table class="table table-bordered table-hover table-sm" id="table_user">
          <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nominal</th>
                <th scope="col">Jenis Pengeluaran</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Penggunaan</th>
                <th scope="col">Aksi</th>
              </tr>
          </thead>
          {{-- hanya CONTOH DATA TABEL --}}
          <tbody>
            <tr>
                <td>1</td>
                <td>15000</td>
                <td>Kas</td>
                <td>2024-04-15</td>
                <td>RW</td>
                <td>
                  <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="1" data-jenis="kas"><i class="fas fa-pen"></i></a>
                  <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>12000</td>
                <td>Paguyuban</td>
                <td>2024-04-15</td>
                <td>Kematian</td>
                <td>
                    <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="1" data-jenis="paguyuban"><i class="fas fa-pen"></i></a>
                  <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>10000</td>
                <td>Kas</td>
                <td>2024-04-15</td>
                <td>Kematian</td>
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
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Pengeluaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="tambahPengeluaranForm">
            <div class="form-group">
              <label for="jenis_keuangan">Jenis Keuangan:</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis_keuangan" id="kas" value="kas" checked>
                <label class="form-check-label" for="kas">
                  Kas
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis_keuangan" id="paguyuban" value="paguyuban">
                <label class="form-check-label" for="paguyuban">
                  Paguyuban
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="tujuan">Tujuan:</label>
              <input type="text" class="form-control" id="tujuan" name="tujuan">
            </div>
            <div class="form-group">
              <label for="nominal">Nominal:</label>
              <input type="text" class="form-control" id="nominal" name="nominal">
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
                <h5 class="modal-title" id="editModalLabel">Edit Pengeluaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPengeluaranForm">
                    <div class="form-group">
                        <label for="jenis_keuangan_edit">Jenis Keuangan:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_keuangan_edit" id="kas_edit" value="kas" checked>
                            <label class="form-check-label" for="kas_edit">
                                Kas
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_keuangan_edit" id="paguyuban_edit" value="paguyuban">
                            <label class="form-check-label" for="paguyuban_edit">
                                Paguyuban
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tujuan_edit">Tujuan:</label>
                        <input type="text" class="form-control" id="tujuan_edit" name="tujuan_edit">
                    </div>
                    <div class="form-group">
                        <label for="nominal_edit">Nominal:</label>
                        <input type="text" class="form-control" id="nominal_edit" name="nominal_edit">
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