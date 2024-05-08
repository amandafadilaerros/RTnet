@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card" style="border-radius: 20px;">
          <div class="card-header rounded-bottom" style="border-radius: 20px;">
            <h3 class="card-title">Laporan Keuangan</h3>
          </div>
          <div class="card-body text-center">
            <div class="row align-items-center">
              <div class="col-auto">
                <i class="fas fa-file-alt fa-3x" style="color: #424874;"></i>
              </div>
              <div class="col">
                <h2 style="color: #424874;">{{ $laporan_keuangan }}</h2>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card" style="border-radius: 20px;">
          <div class="card-header rounded-bottom" style="border-radius: 20px;">
            <h3 class="card-title">Inventaris</h3>
          </div>
          <div class="card-body text-center">
            <div class="row align-items-center">
              <div class="col-auto">
                  <i class="fas fa-archive fa-3x" style="color: #424874;"></i>
              </div>
              <div class="col">
                <h2 style="color: #424874;">{{ $inventaris }}</h2>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card" style="border-radius: 20px;">
          <div class="card-header rounded-bottom" style="border-radius: 20px;">
            <h3 class="card-title">Pengumuman</h3>
          </div>
          <div class="card-body text-center">
            <div class="row align-items-center">
              <div class="col-auto">
                <i class="fas fa-bullhorn fa-3x" style="color: #424874;"></i>
              </div>
              <div class="col">
                <h2 style="color: #424874;">{{ $pengumuman }}</h2>
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

    .card-title{
        font-size: 30px;
    }
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
        // Data pertambahan warga tiap bulan
        var data = {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni','Juli','Agustus', 'September','Oktober', 'November','Desember'],
        datasets: [{
            label: 'Penduduk Tetap',
            data: [], // Contoh data penduduk tetap
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }, {
            label: 'Penduduk Kos',
            data: [], // Contoh data penduduk kos
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };
        var options = {
            responsive: true,
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
                    beginAtZero: true
                }
            }
        };
        // Inisialisasi grafik menggunakan Chart.js
        var ctx = document.getElementById('line-chart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    });
    
</script>
@endpush
