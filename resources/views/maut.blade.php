@extends('layouts.template')
@section('content')
<div class="card">
<div class="card-body">
<h1>Hasil Perhitungan MAUT</h1>

<h2>Tabel Perhitungan Bobot</h2>
<table class="table table-hover table-striped" id="table_alternatif">
    <thead>
        <tr>
            <th>Kriteria</th>
            <th>Bobot (%)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kriteriaList as $kriteria)
        <tr>
            <td>{{ $kriteria->nama_kriteria }}</td>
            <td>{{ $kriteria->bobot  }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br><br>
<h2>Tabel Matriks Keputusan</h2>
<table class="table table-hover table-striped" id="table_alternatif">
    <thead>
        <tr>
            <th>Alternatif</th>
            @foreach($kriteriaList as $kriteria)
            <th>{{ ucfirst(str_replace('_', ' ', $kriteria->nama_kriteria)) }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($matriksKeputusan as $alternatif => $nilaiKriteria)
        <tr>
            <td>{{ $alternatif }}</td>
            @foreach($nilaiKriteria as $nilai)
            <td>{{ $nilai }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
<br><br>
<h2>Tabel Normalisasi</h2>
<table class="table table-hover table-striped" id="table_alternatif">
    <thead>
        <tr>
            <th>Alternatif</th>
            @foreach($kriteriaList as $kriteria)
            <th>{{ ucfirst(str_replace('_', ' ', $kriteria->nama_kriteria)) }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($normalisasi as $alternatif => $nilaiKriteria)
        <tr>
            <td>{{ $alternatif }}</td>
            @foreach($nilaiKriteria as $nilai)
            <td>{{ number_format($nilai, 2) }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
<br><br>
<h2>Tabel Preferensi</h2>
<table class="table table-hover table-striped" id="table_alternatif">
    <thead>
        <tr>
            <th>Alternatif</th>
            <th>Nilai Preferensi</th>
            <th>Ranking</th>
        </tr>
    </thead>
    <tbody>
        @php
        $rank = 1;
        @endphp
        @foreach($preferensi as $alternatif => $nilai)
        <tr>
            <td>{{ $alternatif }}</td>
            <td>{{ number_format($nilai, 2) }}</td>
            <td>{{ $rank++ }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>

@endsection