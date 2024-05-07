@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row justify-content-end">
            <div class="col-md-10">
                <form action="{{ url('inventaris') }}" class="form-inline justify-content-end">
                    <input type="text" class="form-control form-control-sm mr-sm-2 mt-1" name="search"
                        placeholder="Search Inventaris" value="{{ request('search') }}">
                    <button class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874;"
                        type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
      <table class="table table-bordered table-hover table-sm" id="table_user">
          <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal Peminjaman</th>
                <th scope="col">Tanggal Pengembalian</th>
                <th scope="col">Aksi</th>
              </tr>
          </thead>
          {{-- hanya CONTOH DATA TABEL --}}
          <tbody>
            <tr>
                <td>1</td>
                <td>Sound</td>
                <td>12-02-2024</td>
                <td>-</td>
                <td>
                    <button class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; min-width: 170px; max-width: 70%;" type="submit" data-toggle="modal" data-target="#pengembalian">Kembalikan</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Karpet</td>
                <td>12-02-2024</td>
                <td>12-02-2024</td>
                <td>
                  <button class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; min-width: 170px; max-width: 70%;" type="submit" data-toggle="modal" data-target="#pengembalian">Selesai</button>
                </td>
        </tbody>
      </table>
  </div>
</div>
<!-- Peminjaman Barang -->
<div class="modal fade" id="pengembalian" tabindex="-1" role="dialog" aria-labelledby="pengembalian" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 25px;">
        <div class="modal-header">
          <h5 class="modal-title" id="pengembalian">Detail Peminjaman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="pinjam_barang">
          </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Pinjam</button>
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
