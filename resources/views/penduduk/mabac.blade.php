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
                        <td>{{ $bobot[$kriteria->id_kriteria] }}</td>
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
                        <th>{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($alternatifs as $alternatif)
                    <tr>
                        <td>{{ $alternatif->nama_alternatif }}</td>
                        @foreach($kriteriaList as $kriteria)
                        <td>{{ $matriksKeputusan[$alternatif->nama_alternatif][$kriteria->id_kriteria] }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                    <tr>
                        <th>Nilai Min</th>
                        @foreach($kriteriaList as $kriteria)
                        <td>{{ $minValues[$kriteria->id_kriteria] }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Nilai Max</th>
                        @foreach($kriteriaList as $kriteria)
                        <td>{{ $maxValues[$kriteria->id_kriteria] }}</td>
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
                        <th>{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($alternatifs as $alternatif)
                    <tr>
                        <td>{{ $alternatif->nama_alternatif }}</td>
                        @foreach($kriteriaList as $kriteria)
                        <td>{{ $normalisasi[$alternatif->nama_alternatif][$kriteria->id_kriteria] }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Elemen Matrik Pertimbangan (V) -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Tabel Elemen Matrik Pertimbangan (V)</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach($kriteriaList as $kriteria)
                        <th>{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($alternatifs as $alternatif)
                    <tr>
                        <td>{{ $alternatif->nama_alternatif }}</td>
                        @foreach($kriteriaList as $kriteria)
                        <td>{{ $matrikPertimbangan[$alternatif->nama_alternatif][$kriteria->id_kriteria] }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Matriks Area Perkiraan Batas (G) -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Tabel Matriks Area Perkiraan Batas (G)</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        @foreach($kriteriaList as $kriteria)
                        <th>{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($kriteriaList as $kriteria)
                        <td>{{ $areaPerkiraanBatas[$kriteria->id_kriteria] }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Matriks Jarak Elemen Alternatif dari Batas Perkiraan Daerah (Q) -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Tabel Matriks Jarak Elemen Alternatif dari Batas Perkiraan Daerah (Q)</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach($kriteriaList as $kriteria)
                        <th>{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($alternatifs as $alternatif)
                    <tr>
                        <td>{{ $alternatif->nama_alternatif }}</td>
                        @foreach($kriteriaList as $kriteria)
                        <td>{{ $jarakElemen[$alternatif->nama_alternatif][$kriteria->id_kriteria] }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Perankingan -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Tabel Perankingan</h2>
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
                    @foreach($preferensi as $alternatif => $nilaiPreferensi)
                    <tr>
                        <td>{{ $alternatif }}</td>
                        <td>{{ number_format($nilaiPreferensi, 2) }}</td>
                        <td>{{ $rank++ }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
