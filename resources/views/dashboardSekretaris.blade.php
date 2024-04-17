@extends('layouts.template')
@section('content')
<div class="row">
  <div class="col-md-3">
      <div class="card" style="border-radius: 20px;">
        <div class="card-header rounded-bottom" style="border-radius: 20px;">
          <h3 class="card-title">Data Rumah</h3>
        </div>
        <div class="card-body text-center">
          <div class="row align-items-center">
            <div class="col-auto">
                <i class="fas fa-home fa-3x"></i>
            </div>
            <div class="col">
              {{-- // nanti tinggal ubah sesuai data di db --}}
              <h2>3</h2>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="card" style="border-radius: 20px;">
        <div class="card-header rounded-bottom" style="border-radius: 20px;">
          <h3 class="card-title">Data Keluarga</h3>
        </div>
        <div class="card-body text-center">
          <div class="row align-items-center">
            <div class="col-auto">
                <i class="fas fa-users fa-3x"></i>
            </div>
            <div class="col">
              <h2>4</h2>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="card" style="border-radius: 20px;">
        <div class="card-header rounded-bottom" style="border-radius: 20px;">
          <h3 class="card-title">Data Penduduk</h3>
        </div>
        <div class="card-body text-center">
          <div class="row align-items-center">
            <div class="col-auto">
                <i class="fas fa-file-alt fa-3x"></i>
            </div>
            <div class="col">
              <h2>4</h2>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="card" style="border-radius: 20px;">
        <div class="card-header rounded-bottom" style="border-radius: 20px;">
          <h3 class="card-title">Penduduk Pendatang</h3>
        </div>
        <div class="card-body text-center">
          <div class="row align-items-center">
            <div class="col-auto">
              <i class="fas fa-user-plus fa-3x"></i>
            </div>
            <div class="col">
              <h2>4</h2>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
@push('css')
    
@endpush
@push('js')
    
@endpush
