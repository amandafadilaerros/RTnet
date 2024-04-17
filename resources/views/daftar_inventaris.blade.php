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
          <th scope="col">Nama Barang</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Foto</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($inventaris as $barang)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $barang->nama_barang }}</td>
          <td>{{ $barang->jumlah }}</td>
          <td><img src="{{ asset('storage/'.$barang->foto) }}" alt="Foto Barang" style="max-width: 100px;"></td>
          <td>
            <a href="#" class="btn btn-sm btn-primary" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; width: 100px;">Edit</a>
            <form action="#" method="POST" style="display: inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" style="border-radius: 20px; margin-bottom: 10px; width: 100px;">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

@push('css')
@endpush

@push('js')
@endpush
