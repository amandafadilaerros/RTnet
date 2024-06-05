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
              <h2>{{$rumah}}</h2>
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
              <h2>{{$kk}}</h2>
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
              <h2>{{$ktpTetap}}</h2>
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
</div>

@endsection
@push('css')
<style>
    .dashboard {
        display: flex;
        flex-wrap: wrap;
        gap: 50px;
        padding: 20px;
    }
    .section, .big {
        flex: 1;
        min-width: 400px;
        padding: 20px;
    }
    .section {
        flex: 1;
        min-width: 400px;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
    }

    /* .big {
        flex: 2;
        min-width: 400px;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        width: 1000px;
        order: 1;
    } */

   

    #chart-container {
    width: 80vw;
    height: 100%; /* Menggunakan tinggi 100% untuk mengisi seluruh area div */
    background-color: #ffffff;
    border-radius: 8px;
    padding: 20px; /* Menambahkan padding untuk menjaga jarak dari batas div */
    box-sizing: border-box; /* Menyesuaikan box-sizing untuk memperhitungkan padding */
}


</style>
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
  $(document).ready(function() {

        var data = {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'Penduduk',
                data: @json(array_values($data_bulan)), // Data jumlah penduduk untuk setiap bulan
                backgroundColor: 'rgba(155, 102, 255, 0.2)',
                borderColor: 'rgba(102, 0, 153, 1)',
                borderWidth: 1
            }]
        };

        var options = {
            responsive: true,
            maintainAspectRatio: false, // Tambahkan ini untuk membuat chart responsif
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: false,
                    text: 'Pertambahan Warga Tiap Bulan'
                }
            },
            scales: {
                y: {
                    beginAtZero: true, // Mulai sumbu Y dari nilai 0
                    ticks: {
                        stepSize: 1 // Langkah interval antara setiap nilai pada sumbu Y
                    }
                }
            }
        };

        var ctx = document.getElementById('line-chart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
</script>
@endpush

