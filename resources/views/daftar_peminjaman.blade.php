@extends('layouts.template')
@section('content')
<div class="col-md-6 offset-md-6 mb-4">
  <div class="input-group">
    <input type="text" class="form-control" style="border-radius: 20px ;margin-left : 200px;" placeholder="Cari...">
    <div class="input-group-append">
      <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-left:10px; width:100px;">Cari</a>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-body">
    @if (session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif

    <table class="table table-hover table-striped" id="table_user" style="border-radius: 50px;">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama Warga</th>
          <th scope="col">Nama Barang</th>
          <th scope="col">Jumlah Peminjaman</th>
          <th scope="col">Tanggal Peminjaman</th>
          <th scope="col">Tanggal Pengembalian</th>
          <th scope="col">Status Peminjaman</th>
        </tr>
      </thead>
      {{-- hanya CONTOH DATA TABEL --}}
      <tbody>
        <tr>
          <td>1</td>
          <td>Suyatno</td>
          <td>Sound</td>
          <td>2</td>
          <td>12-04-2024</td>
          <td>17-04-2024</td>
          <td>
            <a href="#" class="btn btn-sm btn-primary" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; width: 100px;">Dipinjam</i></a>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Karto</td>
          <td>Karpet</td>
          <td>1</td>
          <td>12-04-2024</td>
          <td>17-04-2024</td>
          <td>
            <a href="#" class="btn btn-sm btn-primary" style="border-radius: 20px; background-color: #727272; margin-bottom: 10px; width: 100px;">Selesai</i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


@endsection

@push('css')
@endpush

@push('js')
@endpush
