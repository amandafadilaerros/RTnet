@extends('layouts.template')

@section('content')
<div class="container">
    <!-- Tabel Kriteria dan Rentang Nilai -->
    <div class="card mb-4">
        <div class="card-header">
            <h2 class="h4">Kriteria dan Rentang Nilai</h2>
        </div>
        <div class="card-body">
            @foreach($rentangNilai as $item)
                @if(in_array($item['nama'], ['Kemudahan Pelaksanaan', 'Jumlah Partisipan', 'Tingkat Urgensi', 'Dampak Sosial', 'Dana']))
                    <div class="mb-4">
                        <h5 class="h4">{{ $item['nama'] }}</h5>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Nilai</th>
                                    <th>Deskripsi</th>
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
                @endif
            @endforeach
        </div>
    </div>

    <!-- Tabel Kriteria -->
    <div class="card mb-4">
        <div class="card-header">
            <h2 class="h4">Tabel Kriteria</h2>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
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
@endsection

@push('css')
<!-- Custom CSS here if needed -->
@endpush

@push('js')
<!-- Custom JS here if needed -->
@endpush
