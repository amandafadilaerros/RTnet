@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Kriteria dan Rentang Nilai
            </div>
            <div class="card-body">
                @foreach($rentangNilai as $item)
                    <h5>{{ $item['nama'] }}</h5>
                    <ul>
                        @foreach($item['rentang'] as $key => $value)
                            <li>{{ $key }} = {{ $value }}</li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Tabel Kriteria
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Bobot</th>
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
@endsection
@push('css')
    
@endpush
@push('js')

@endpush