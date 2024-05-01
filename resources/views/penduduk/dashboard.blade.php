@extends('layouts.template')

@section('content')
<div class="dashboard">
    <div class="section">
        <h2 style="text-align: center; color: #424874;">Laporan Keuangan</h2>
        <div class="icon">
            <i class="fas fa-file-alt" style="color: #424874; font-size: 60px;"></i>
        </div>
        <div class="value" style="text-align: center; font-size: 60px; color: #424874">
            {{ $laporan_keuangan }}
        </div>
    </div>
    <div class="section">
        <h2 style="text-align: center; color: #424874;">Inventaris</h2>
        <div class="icon">
            <i class="fas fa-archive" style="color: #424874; font-size: 60px;"></i>
        </div>
        <div class="value" style="text-align: center; font-size: 60px; color: #424874">
            {{ $inventaris }}
        </div>
    </div>
    <div class="section">
        <h2 style="text-align: center; color: #424874;">Pengumuman</h2>
        <div class="icon">
            <i class="fas fa-bullhorn" style="color: #424874; font-size: 60px;"></i>
        </div>
        <div class="value" style="text-align: center; font-size: 60px; color: #424874">
            {{ $pengumuman }}
        </div>
    </div>
    <div class="big">
        <h2 style="color: #424874;">
            <i class="fas fa-chart-line" style="color: #424874; font-size: 50px;"></i> Pertumbuhan Penduduk
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
        background-color: #ffffff;
        border-radius: 8px;
    }

    .big {
        flex: 2;
        width: 1000px;
        order: 1;
    }

    .icon, .value {
        text-align: center;
    }

  
</style>
@endpush

@push('js')
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
