@extends('layouts.template')
@section('content')

<div class="container">

    <!-- Tabel Perhitungan Bobot -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Tabel Perhitungan Bobot</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
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
                        <td>{{ $kriteria->bobot }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Matriks Keputusan -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Tabel Matriks Keputusan</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
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
    <!-- Tampilkan nilai min dan max di bawah setiap kolom kriteria -->
    <div>
        </div>
        <tr>
            <th>Nilai Min</th>
            @foreach($kriteriaList as $kriteria)
            <td>{{ $min[$kriteria->id_kriteria] }}</td> <!-- Menampilkan nilai min -->
            @endforeach
        </tr>
        <tr>
            <th>Nilai Max</th>
        @foreach($kriteriaList as $kriteria)
        <td>{{ $max[$kriteria->id_kriteria] }}</td> <!-- Menampilkan nilai max -->
        @endforeach
    </tr>
    
</tbody>
    
</table>
</div>
</div>

    <!-- Tabel Normalisasi -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Tabel Normalisasi</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
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
        </div>
    </div>

    <!-- Tabel Preferensi -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Tabel Preferensi</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
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

</div>

@endsection
