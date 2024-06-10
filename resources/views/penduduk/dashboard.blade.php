@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
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
                        <h2 style="color: #424874;">{{ $totalPemasukan - $totalPengeluaran }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
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
    <div class="col-md-4 mb-4">
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
        <i class="fas fa-chart-line" style="color: #424874; font-size: 30px;"></i> Pertumbuhan Penduduk
    </h2>
    <div id="chart-container">
        <canvas id="line-chart"></canvas>
    </div>
</div>
@endsection

@push('css')
<style>
    .card-title {
        font-size: 30px;
    }

    .big {
        padding: 20px;
    }

    #chart-container {
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        border-radius: 8px;
        padding: 20px;
        box-sizing: border-box;
    }

    @media (max-width: 767.98px) {
        .card-title {
            font-size: 20px;
        }

        .big {
            padding: 10px;
        }

        #chart-container {
            padding: 10px;
        }
    }
</style>
@endpush

@push('js')
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
