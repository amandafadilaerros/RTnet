@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>

    <div class="card-body">
        @empty($pengumuman)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover tablesm">
                <tr>
                    <th>ID</th>
                    <td>{{ $pengumuman->id_pengumuman }}</td>
                </tr>
                <tr>
                    <th>Judul</th>
                    <td>{{ $pengumuman->judul }}</td>
                </tr>
                <tr>
                    <th>Kegiatan</th>
                    <td>{{ $pengumuman->kegiatan }}</td>
                </tr>
                <tr>
                    <th>Jadwal</th>
                    <td>{{ $pengumuman->jadwal_pelaksanaan }}</td>
                </tr>
            </table>
        @endempty

        <a href="{{ url('penduduk/pengumuman') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
