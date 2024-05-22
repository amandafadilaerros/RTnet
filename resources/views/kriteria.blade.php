@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <!-- Tabel Kriteria dan Rentang Nilai -->
    <div class="card-header">
        <h2 class="h2">Kriteria dan Rentang Nilai</h2>
    </div>
    <div class="card-body">
        @foreach($rentangNilai as $item)
            @if(in_array($item['nama'], ['Kemudahan Pelaksanaan', 'Jumlah Partisipan', 'Tingkat Urgensi', 'Dampak Sosial', 'Dana']))
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="h4">{{ $item['nama'] }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" style="min-width: 100%;"> <!-- Menggunakan min-width agar tabel tetap responsif -->
                                <thead>
                                    <tr>
                                        <th>Rentang</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($item['rentang'] as $key => $value)
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Tabel Kriteria -->
        <div class="card-header">
        <h2 class="h2">Bobot Kriteria</h2>
        </div>
        <div class="card-body">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="h4">Tabel Kriteria</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" style="min-width: 100%;"> <!-- Menggunakan min-width agar tabel tetap responsif -->
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Bobot (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kriteria as $item)
                                <tr>
                                    <td>{{ $item->nama_kriteria }}</td>
                                    <td>{{ $item->bobot }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<!-- Custom CSS here if needed -->
@endpush

@push('js')
<!-- Custom JS here if needed -->
@endpush
