<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota Keluarga</title>
    <style>
        /* CSS Anda di sini */
      
        .header {
            max-width: 10000px;
            margin: 20px auto; 
            padding: 20px;
            background-color: #ffffff; 
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .col-md-6 h2{
            color: #424874;
            font-style: bold;
        }



    </style>
</head>
@extends('layouts.template')
@section('content')
<div class="card-body">
   <div class="header">
    <p><strong>Kepala Keluarga &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong> John Doe</p>
    <p><strong>Nomor Kartu Keluarga &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong> 123456789</p>
    <p><strong>Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong> Jalan Contoh No. 123</p>
    <p><strong>Jumlah Individu &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</strong> 2</p>
    <p><strong>No. Rumah / Status Rumah &nbsp;&nbsp; :</strong> 123 / Hunian Tetap</p>
    
  </div>
  <div class="card-body">
      @if (session('success'))
      <div class="alert alert-success">{{session('success')}}</div>
      @endif
      @if (session('error'))
      <div class="alert alert-danger">{{session('error')}}</div>
      @endif
      <div class="row">
          <div class="col-md-6">
              <h2>Data Anggota Keluarga</h2>
              <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahModal">Tambah</a>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" style="border-radius: 20px ;margin-left : 200px;" placeholder="Search...">
                    <div class="input-group-append">
                        <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-left:10px;">Search</a>
                    </div>
                </div>
            </div>
            
            
            
        </div>
        <div class="header">
        <table class="table table-bordered table-hover table-sm" id="table_user">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">NIK</th>
                <th scope="col">Agama</th>
                <th scope="col">Status Keluarga</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        
        {{-- hanya CONTOH DATA TABEL --}}
        <tbody>
          <tr>
              <td>1</td>
              <td>santi</td>
              <td>1234566776543</td>
              <td>Islam</td>
              <td>Anak</td>
              <td>
                <a href="#" class="btn btn-primary btn-sm" style="border-radius:5px; background-color: #424874;"><i class="fas fa-eye"></i></a> <!-- Tombol view -->
                <a href="" class="btn btn-success btn-sm"><i class="fas fa-pen"></i></a>
                <form class="d-inline-block" method="POST" action="">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?');"><i class="fas fa-trash"></i></button>
                </form>
              </td>
          </tr>
     
      </tbody>
    </table>
</div>
</div>



<div class="card-body">
    
    @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <h2>Data Non-Anggota Keluarga</h2>
          <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahModal">Tambah</a>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" style="border-radius: 20px ;margin-left : 200px;" placeholder="Search...">
                <div class="input-group-append">
                    <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-left:10px;">Search</a>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
    <table class="table table-bordered table-hover table-sm" id="table_user">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">NIK</th>
                <th scope="col">Agama</th>
                <th scope="col">tanggal Masuk</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        
        {{-- hanya CONTOH DATA TABEL --}}
        <tbody>
          <tr>
              <td>1</td>
              <td>susan</td>
              <td>1234566776543</td>
              <td>Islam</td>
              <td>12-02-2024</td>
              <td>
                <a href="#" class="btn btn-primary btn-sm" style="border-radius:5px; background-color: #424874;"><i class="fas fa-eye"></i></a> <!-- Tombol view -->
                <a href="" class="btn btn-success btn-sm"><i class="fas fa-pen"></i></a>
                <form class="d-inline-block" method="POST" action="">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?');"><i class="fas fa-trash"></i></button>
                </form>
              </td>
          </tr>
       
      </tbody>
    </table>
</div>
</div>
</div>
</div>

</div>
</body>
</html>

@endsection
@push('css')
@endpush
