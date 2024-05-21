@extends('layouts.template')
@section('content')
<div class="row mb-4">
    <div class="col-md-6">
     
    </div>
</div>
<div class="card">
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        <table class="table table-hover table-striped" id="table_user">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kegiatan</th>
                    <th scope="col">Jadwal Pelaksanaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kegiatan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_kegiatan }}</td>
                    <td>{{ $item->jadwal_pelaksanaan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
