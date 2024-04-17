@extends('layouts.template')
@section('content')
<div class="dashboard">
    <div class="section">
        <h2 style="text-align: center; color: #424874;">Data Penduduk</h2>
        <h2 class="fas fa-users" style="color: #424874; font-size: 60px;"></h2>
        <span style="text-align: center; font-size: 60px; color: #424874;">3</span>
    </div>
    <div class="section">
        <h2 style="text-align: center; color: #424874;">Pengumuman</h2>
        <h2 class="fas fa-bullhorn" style="color: #424874; font-size: 60px;"></h2>
        <span style="text-align: center; font-size: 60px; color: #424874;">4</span>
    </div>
    <div class="section">
        <h2 style="text-align: center; color: #424874;">Data Inventaris</h2>
        <h2 class="fas fa-archive" style="color: #424874; font-size: 60px;"></h2>
        <span style="text-align: center; font-size: 60px; color: #424874;">4</span>
    </div>
    <div class="section">
        <h2 style="text-align: center; color: #424874;">Penduduk Pendatang</h2>
        <h2 class="fas fa-user-plus" style="color: #424874; font-size: 60px;"></h2>
        <span style="text-align: center; font-size: 60px; color: #424874;">4</span>
    </div>
    <div class="section">
        <h2 style="text-align: center; color: #424874;">Kotak Kerja Bakti</h2>
        <h2 class="fas fa-hands-helping" style="color: #424874; font-size: 60px;"></h2>
        <span style="text-align: center; font-size: 60px; color: #424874;">6</span>
    </div>
    <div class="section">
        <h2 style="text-align: center; color: #424874;">Laporan Keuangan</h2>
        <h2 class="fas fa-file-invoice-dollar" style="color: #424874; font-size: 60px;"></h2>
        <span style="text-align: center; font-size: 60px; color: #424874;">8</span>
    </div>
    <div class="big">
        <h2 style="color: #424874;"><i class="fas fa-chart-line" style="color: #424874; font-size: 50px;"></i> Pertambahan Warga Setiap Bulan</h2>
        <div id="chart-container">
            <!-- Tempat untuk menampilkan grafik -->
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .dashboard {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .section {
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        text-align: center;
    }

    .big {
        padding: 20px;
        background-color: #f7f7f7;
        border-radius: 8px;
        width: 100%;
        padding: 30px;
        margin-top: 20px;
        /* Menetapkan kolom grid untuk elemen besar */
        grid-column-start: 1;
        /* Menyamakan lebar dengan 3 kolom di atasnya */
        grid-column-end: span 3;
    }

    #chart-container {
        width: 100%;
        height: 300px;
        background-color: #ffffff;
        border-radius: 8px;
    }
</style>
@endpush
