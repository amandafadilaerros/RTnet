@extends('layouts.template')
@section('content')
<div class="row">
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
              {{-- // nanti tinggal ubah sesuai data di db --}}
              <h2>{{$ktpTetap}}</h2>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="card" style="border-radius: 20px;">
        <div class="card-header rounded-bottom" style="border-radius: 20px;">
          <h3 class="card-title">Pengumuman</h3>
        </div>
        <div class="card-body text-center">
          <div class="row align-items-center">
            <div class="col-auto">
                <i class="fas fa-bullhorn fa-3x"></i>
            </div>
            <div class="col">
              <h2>{{$pengumuman}}</h2>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-md-3">
      <div class="card" style="border-radius: 20px;">
        <div class="card-header rounded-bottom" style="border-radius: 20px;">
          <h3 class="card-title">Data Inventaris</h3>
        </div>
        <div class="card-body text-center">
          <div class="row align-items-center">
            <div class="col-auto">
              <i class="fas fa-boxes fa-3x"></i>
            </div>
            <div class="col">
              <h2>{{$inventaris}}</h2>
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
              <h2>{{$ktpKos}}</h2>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<div class="big">
  <h2 style="color: #424874;">
      <i class="fas fa-chart-line" style="color: #424874; font-size: 60px;"></i> Pertumbuhan Penduduk
  </h2>
  <div id="chart-container">
      <canvas id="line-chart"></canvas>
  </div>
</div>
@endsection
@push('css')
    
@endpush
@push('js')
    
@endpush
