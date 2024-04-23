@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Filter -->
        <div class="col-md-4">
            <select class="form-select" style="border-radius: 20px; width: 170px" aria-label="Filter" aria-describedby="filter-addon">
                <option selected>Filter</option>
                <option value="1">Bulan ini</option>
                <option value="2">Bulan lalu</option>
                <option value="3">Tahun ini</option>
                <option value="4">Tahun lalu</option>
            </select>
        </div>
    </div>
    <!-- Search -->
    <div class="col-md-4" style="">
        <div class="row">
            <input type="text" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
            <button class="btn btn-primary" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
        </div>
    </div>
</div>        
<div class="card">
    {{-- <div class="card-header">
        <h3 class="card-title">Laporan Keuangan</h3>
    </div> --}}
    <div class="card-body">
        <table class="table table-hover table-striped" id="table_user">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Keuangan Masuk</th>
                    <th scope="col">Keuangan Keluar</th>
                    <th scope="col">Saldo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Kas</td>
                    <td>100,000</td>
                    <td>100,000</td>
                    <td>100,000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Kas</td>
                    <td>100,000</td>
                    <td>100,000</td>
                    <td>100,000</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Kas</td>
                    <td>100,000</td>
                    <td>100,000</td>
                    <td>100,000</td>
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
