@extends('layouts.template')

@section('content')
<div class="card">
    {{-- <div class="card-header">
        <h3 class="card-title">Data Penduduk</h3>
    </div> --}}
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
          
            </div>
            <!-- Search -->
            <div class="col-md-4" style="">
                <div class="row">
                    <input type="text" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                    <button class="btn btn-primary" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
                </div>
            </div>
        </div>        
        <table class="table table-hover table-striped" id="table_user">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kelamin</th>
                    <th scope="col">NIK</th>
                    <th scope="col">No.KK</th>
                    <th scope="col">Jenis Penduduk</th>
                    <th scope="col">Golongan Darah</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>Laki-laki</td>
                    <td>1234567890123456</td>
                    <td>1234567890</td>
                    <td>Dewasa</td>
                    <td>A+</td>
                    <td>Belum Menikah</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jane Doe</td>
                    <td>Perempuan</td>
                    <td>9876543210987654</td>
                    <td>0987654321</td>
                    <td>Remaja</td>
                    <td>B-</td>
                    <td>Menikah</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Alice Smith</td>
                    <td>Perempuan</td>
                    <td>5678901234567890</td>
                    <td>5678901234</td>
                    <td>Bayi</td>
                    <td>O-</td>
                    <td>Belum Menikah</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('css')
    
@endpush
@push('js')
    
@endpush
