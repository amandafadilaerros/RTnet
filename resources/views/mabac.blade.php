@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Hasil Perhitungan MABAC</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach ($kriterias as $kriteria)
                    <th>{{ $kriteria->nama_kriteria }}</th>
                    @endforeach
                    <th>Total Distance</th>
                    <th>Rank</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatifs as $alternatif)
                <tr>
                    <td>{{ $alternatif->nama_alternatif }}</td>
                    @php
                        $totalDistance = 0;
                    @endphp
                    @foreach ($kriterias as $kriteria)
                    <td>{{ isset($weightedNormalizedMatrix[$alternatif->id][$kriteria->id]) ? number_format($weightedNormalizedMatrix[$alternatif->id][$kriteria->id], 2) : '-' }}</td>
                    @php
                        if (isset($weightedNormalizedMatrix[$alternatif->id][$kriteria->id])) {
                            $totalDistance += $weightedNormalizedMatrix[$alternatif->id][$kriteria->id] - $borderApproximationMatrix[$kriteria->id];
                        }
                    @endphp
                    @endforeach
                    <td>{{ number_format($totalDistance, 2) }}</td>
                    <td>{{ $rankings[$alternatif->id] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
