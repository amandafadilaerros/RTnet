@extends('layouts.template')
@section('content')
<div class="row">
  <div class="col-md-4">
      <div class="card" style="border-radius: 20px;">
        <div class="card-header rounded-bottom" style="border-radius: 20px;">
          <h3 class="card-title">Pemasukan</h3>
        </div>
        <div class="card-body text-center">
          <div class="row align-items-center">
            <div class="col-auto">
              <i class="fas fa-money-bill fa-3x"></i>
            </div>
            <div class="col">
              {{-- // nanti tinggal ubah sesuai data di db --}}
              <h2>{{ $totalPemasukan }}</h2>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-md-4">
      <div class="card" style="border-radius: 20px;">
        <div class="card-header rounded-bottom" style="border-radius: 20px;">
          <h3 class="card-title">Pengeluaran</h3>
        </div>
        <div class="card-body text-center">
          <div class="row align-items-center">
            <div class="col-auto">
              <i class="fas fa-money-bill-alt fa-3x"></i>
            </div>
            <div class="col">
              <h2>{{ $totalPengeluaran }}</h2>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-md-4">
      <div class="card" style="border-radius: 20px;">
        <div class="card-header rounded-bottom" style="border-radius: 20px;">
          <h3 class="card-title">Laporan Keuangan</h3>
        </div>
        <div class="card-body text-center">
          <div class="row align-items-center">
            <div class="col-auto">
              <i class="fas fa-file-invoice-dollar fa-3x"></i>
            </div>
            <div class="col">
              <h2>{{ $totalPemasukan - $totalPengeluaran }}</h2>
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
