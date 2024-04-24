@extends('layouts.template')

@section('content')
<div class="dashboard">
    <div class="section">
        <h2 style="text-align: center; color: #424874;">Laporan Keuangan</h2>
        <h2 class="fas fa-file-alt" style="color: #424874; font-size: 60px;"></h2>
        <span style="text-align: center; font-size: 60px; color: #424874">{{ $laporan_keuangan }}</span>
    </div>
    <div class="section">
        <h2 style="text-align: center; color: #424874;">Inventaris</h2>
        <h2 class="fas fa-archive" style="color: #424874; font-size: 60px;"></h2>
        <span style="text-align: center; font-size: 60px; color: #424874">{{ $inventaris }}</span>
    </div>
    {{-- <div class="section">
        <h2 style="text-align: center; color: #424874;">Pengumuman</h2>
        <h2 class="fas fa-bullhorn" style="color: #424874; font-size: 60px;"></h2>
        <span style="text-align: center; font-size: 60px; color: #424874">{{ $pengumuman }}</span>
    </div> --}}
    <div class="big">
        <h2 style="color: #424874;"><i class="fas fa-chart-line" style="color: #424874; font-size: 50px;"></i> Pertambahan Warga Tiap Bulan</h2>
        <div id="chart-container">
            <!-- Tempat untuk menampilkan grafik -->
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
@endpush
