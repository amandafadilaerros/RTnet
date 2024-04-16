<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .dashboard {
            display: flex;
            flex-wrap: wrap;
            gap: 50px;
            padding: 20px;
        }

        .section {
            flex: 1;
            min-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
        }

        .big {
            flex: 2;
            min-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            width: 1000px;
            order: 1;
        }

        #chart-container {
            width: 100%;
            height: 300px;
            background-color: #ffffff;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    @extends('layouts.template')
    @section('content')
    <div class="dashboard">
        <div class="section">
            <h2 style="text-align: center ;color: #424874;">Laporan Keuangan</h2>
            <h2 class="fas fa-file-alt" style= "color: #424874; font-size: 60px;"></h2>
            <span style="text-align:center; font-size: 60px; color: #424874">10</span>
            
        </div>
        <div class="section">
            <h2 style="text-align: center; color: #424874;">Inventaris </h2>
            <h2 class="fas fa-archive" style="color: #424874; font-size: 60px;"></h2>
            <span style="text-align:center; font-size: 60px; color: #424874">10</span>
        </div>
        <div class="section">
            <h2 style="text-align: center; color: #424874;">Pengumuman </h2>
            <h2 class="fas fa-bullhorn" style="color: #424874; font-size: 60px;"> </h2>
            <span style="text-align:center; font-size: 60px; color: #424874">10</span>
        </div>
        <div class="big">
     
            <h2 style="color: #424874;"><i class="fas fa-chart-line" style="color: #424874; font-size: 50px;"></i> Pertambahan Warga Tiap Bulan</h2>
            <div id="chart-container">
                <!-- Tempat untuk menampilkan grafik -->
            
            </div>
        </div>
    </div>
    
    
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="script.js"></script>
    <script>
        // Ambil data penduduk dari backend (misalnya dari server atau API)
        const dataPenduduk = [100, 150, 200, 250, 300, 350, 400];

        // Buat chart menggunakan Chart.js
        const ctx = document.getElementById('chart-container').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: dataPenduduk,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {}
        });
    </script>
    @endsection
    @push('css')
    @endpush
</body>

</html>
