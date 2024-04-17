@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-md-8"></div>
    <!-- Search -->
    <div class="col-md-4" style="">
        <div class="row">
            <input type="text" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
            <button class="btn btn-primary" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
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
      <table class="table table-bordered table-hover table-sm" id="table_user">
          <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Kelamin</th>
                <th scope="col">NIK</th>
                <th scope="col">No. KK</th>
                <th scope="col">Jenis Penduduk</th>
                <th scope="col">Usia</th>
                <th scope="col">Gol. darah</th>
                <th scope="col">Status</th>
              </tr>
          </thead>
          {{-- hanya CONTOH DATA TABEL --}}
          <tbody>
            <tr>
                <td>1</td>
                <td>Susanto</td>
                <td>L</td>
                <td>1234</td>
                <td>01919289828727</td>
                <td>Tetap</td>
                <td>20</td>
                <td>O</td>
                <td>Kawin</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Katiman</td>
                <td>L</td>
                <td>1135</td>
                <td>01919289828727</td>
                <td>Baru</td>
                <td>21</td>
                <td>B</td>
                <td>Belum Kawin</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Mardi</td>
                <td>L</td>
                <td>1142</td>
                <td>01919289828727</td>
                <td>Tetap</td>
                <td>32</td>
                <td>A</td>
                <td>Kawin</td>
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