
@extends('layouts.template')
@section('content')
<div class="card-body">
    <div class="header">
    @if ($kks->count() > 0)
        <table border="0">
        <?php $no = 1; ?>
        @foreach ($kks as $kk)  
            <tr>
                <div class="row">
                    <div class="col-md-3">Nama Kepala Keluarga :</div>
                    <div class="col-md-9">{{$kk -> nama_kepala_keluarga}}</div>
                </div>
                <div class="row">
                    <div class="col-md-3">NIK :</div>
                    <div class="col-md-9">{{$kk -> no_kk}}</div>
                </div>
                <div class="row">
                    <div class="col-md-3">Alamat :</div>
                    <div class="col-md-9">{{$kk -> alamat}}</div>
                </div>
                <div class="row">
                    <div class="col-md-3">Jumlah Anggota Keluarga :</div>
                    <div class="col-md-9">{{$kk -> jumlah_individu}}</div>
                </div>
            </tr>
        @endforeach
        </table>
    @else
    @endif
        
        
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
                <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahAnggotaModal">Tambah</a>
            </div>
          
        </div>
        <div class="header">
        @if ($ktps->count() > 0)    
            <table class="table table-hover table-striped" id="table_user">
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
                <tbody>
                <?php $no = 1; ?>
                @foreach ($ktps as $ktp)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$ktp -> nama}}</td>
                        <td>{{$ktp -> NIK}}</td>
                        <td>{{$ktp -> agama}}</td>
                        <td>{{$ktp -> status_keluarga}}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm btn-show" style="border-radius:5px; background-color: #424874;" data-toggle="modal" data-target="#viewModalAnggota" data-id="{{$ktp->NIK}}"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-success btn-sm btn-update" data-toggle="modal" data-id="{{$ktp->NIK}}" data-target="#editModalAnggota"><i class="fas fa-pen"></i></a>
                            <form class="d-inline-block" method="POST" action="{{url('/penduduk/DaftarAnggota/delete')}}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="NIK" value="{{$ktp->NIK}}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?');"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
        @endif
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
                <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahNonAnggotaModal">Tambah</a>
            </div>
            {{-- <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" style="border-radius: 20px ;margin-left : 200px;" placeholder="Search...">
                    <div class="input-group-append">
                        <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-left:10px;">Search</a>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="header">
            @if ($ktpss->count() > 0) 
            <table class="table table-hover table-striped" id="table_user">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; ?>
                @foreach ($ktpss as $ktp)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$ktp -> nama}}</td>
                        <td>{{$ktp -> NIK}}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm btn-show-non" style="border-radius: 5px; background-color: #424874;" data-toggle="modal" data-target="#viewModalNonAnggota" data-id="{{$ktp->NIK}}"><i class="fas fa-eye"></i></a>
                            <a href="#" data-id="{{$ktp->NIK}}" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModalNonAnggota"><i class="fas fa-pen"></i></a>

                            <form class="d-inline-block" method="POST" action="{{url('/penduduk/DaftarAnggota/delete')}}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="NIK" value="{{$ktp->NIK}}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?');"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            @endif
        </div>
    </div>
</div>
<!-- Modal Tambah Anggota -->

<div class="modal fade" id="tambahAnggotaModal" tabindex="-1" role="dialog" aria-labelledby="tambahAnggotaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title text-center w-100" id="tambahAnggotaModalLabel" style="color: #424874">Tambah Data Anggota Keluarga </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/penduduk/tambah_daftaranggota')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NIK">NIK</label>
                                <input type="text" class="form-control" id="NIKTambah" name="NIK" style="border-radius: 25px;" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="namaTambah" name="nama" style="border-radius: 25px;" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="tempat">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempatTambah" name="tempat" placeholder="Tempat" style="border-radius: 25px;" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahirTambah" name="tanggal_lahir" style="border-radius: 25px;" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="golongan_darah">Golongan Darah</label>
                                <select class="form-control" id="golongan_darahTambah" name="golongan_darah" style="border-radius: 25px;" re>
                                    <option value="A">A</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="laki_lakiTambah" name="jenis_kelamin" value="l">
                                    <label class="form-check-label" for="laki_laki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="perempuanTambah" name="jenis_kelamin" value="p">
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <select class="form-control" id="agamaTambah" name="agama" style="border-radius: 25px;" required>
                                    <option value="Islam">Islam</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="dokumen">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="dokumen" name="dokumen" >
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <div class="form-group">
                                    <label for="status_perkawinan">Status Perkawinan</label>
                                    <select class="form-control" id="status_perkawinanTambah" name="status_perkawinan" style="border-radius: 25px;" required>
                                        <option value="Sudah Menikah">Sudah Menikah</option>
                                        <option value="Belum Menikah">Belum Menikah</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaanTambah" name="pekerjaan" style="border-radius: 25px;" required>
                            </div>
                            
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="status_keluarga">Status Keluarga</label>
                                    <select class="form-control" id="status_keluargaTambah" name="status_keluarga" style="border-radius: 25px;" required>
                                        <option value="Suami">Suami</option>
                                        <option value="Istri">Istri</option>
                                        <option value="Anak">Anak</option>
                                        <option value="Famili Lain">Famili lain</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tgl_masuk">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="tgl_masukTambah" name="tgl_masuk" style="border-radius: 25px;" >
                            </div>

                            <div class="form-group">
                                <label for="tgl_keluar">Tanggal Keluar</label>
                                <input type="date" class="form-control" id="tgl_keluarTambah" name="tgl_keluar" style="border-radius: 25px;" >
                            </div>

                        </div>
                    </div>
                    <!-- Tambahkan bagian lainnya sesuai kebutuhan -->
                    <button type="submit" class="btn btn-sm btn-primary mt-1 d-block mx-auto" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; width: 200px;">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit anggota -->

<div class="modal fade" id="editModalAnggota" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title text-center w-100" id="editModalLabel" style="color: #424874">Ubah Data Anggota Keluarga </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{('/penduduk/DaftarAnggota/Update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- <form action="{{('/penduduk/tambah_daftaranggota')}}" method="POST" enctype="multipart/form-data"> --}}
                            {{-- @csrf --}}
                            <div class="row">
                                <input type="hidden" id="nik" name="nik">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="NIK">NIK</label>
                                        <input type="text" class="form-control" id="NIK" name="NIK" style="border-radius: 25px;">
        
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" style="border-radius: 25px;">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="tempat">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat" name="tempat" style="border-radius: 25px;">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" style="border-radius: 25px;">
                                        </div>
                                        
                                
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="laki_laki" name="jenis_kelamin" value="l">
                                            <label class="form-check-label" for="laki_laki">Laki-Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="perempuan" name="jenis_kelamin" value="p">
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                    

                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="golongan_darah">Golongan Darah</label>
                                            <select class="form-control" id="golongan_darah" name="golongan_darah" style="border-radius: 25px;">
                                                <option value="A">A</option>
                                                <option value="AB">AB</option>
                                                <option value="B">B</option>
                                                <option value="O">O</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <select class="form-control" id="agama" name="agama" style="border-radius: 25px;" >
                                            <option value="Islam">Islam</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Konghucu">Konghucu</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="dokumen">Dokumen Kartu Tanda Penduduk</label>
                                        <input type="file" class="form-control-file" id="dokumen" name="dokumen">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="status_perkawinan">Status Perkawinan</label>
                                            <select class="form-control" id="status_perkawinan" name="status_perkawinan" style="border-radius: 25px;">
                                                <option value="Sudah Menikah">Sudah Menikah</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" style="border-radius: 25px;">
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="status_keluarga">Status Keluarga</label>
                                            <select class="form-control" id="status_keluarga" name="status_keluarga" style="border-radius: 25px;">
                                                <option value="Suami">Suami</option>
                                                <option value="Istri">Istri</option>
                                                <option value="Anak">Anak</option>
                                                <option value="Famili Lain">Famili lain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_masuk">Tanggal Masuk</label>
                                        <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" style="border-radius: 25px;">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_keluar">Tanggal Keluar</label>
                                        <input type="date" class="form-control" id="tgl_keluar" name="tgl_keluar" style="border-radius: 25px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; border: none; width: 200px;">Simpan</button>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
</div>

{{-- view modal anggota --}}
<div class="modal fade" id="viewModalAnggota" tabindex="-1" role="dialog" aria-labelledby="viewModalAnggota" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title text-center w-100" id="viewModalAnggota" style="color: #424874">Lihat Data Anggota Keluarga </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="view_nik">NIK</label>
                                <input type="text" class="form-control" id="view_NIK" name="view_NIK" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_nama">Nama</label>
                                <input type="text" class="form-control" id="view_nama" name="view_nama" value="" disabled>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="view_tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="view_tempat" name="view_tempat" value="" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="view_tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="view_tanggal_lahir" name="view_tanggal_lahir" value="" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="view_jenis_kelamin">Jenis Kelamin</label>
                                <input type="text" class="form-control" id="view_jenis_kelamin" name="view_jenis_kelamin"value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_agama">Agama</label>
                                <input type="text" class="form-control" id="view_agama" name="view_agama" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_status_pernikahan">Status Pernikahan</label>
                                <input type="text" class="form-control" id="view_status_perkawinan" name="view_status_pernikahan" value="{" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_ktp">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="view_dokumen" name="view_dokumen" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="view_pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="view_pekerjaan" name="view_pekerjaan" value="{" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_status_hubungan">Status Hubungan Keluarga</label>
                                <input type="text" class="form-control" id="view_status_keluarga" name="view_status_hubungan" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_golongan_darah">Golongan Darah</label>
                                <input type="text" class="form-control" id="view_golongan_darah" name="view_golongan_darah" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_tgl_masuk">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="view_tgl_masuk" name="view_tgl_masuk" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_tgl_keluar">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="view_tgl_keluar" name="view_tgl_keluar" value="" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal Tambah Non-Anggota -->
<div class="modal fade" id="tambahNonAnggotaModal" tabindex="-1" role="dialog" aria-labelledby="tambahNonAnggotaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title text-center w-100" id="tambahNonAnggotaModalLabel" style="color: #424874">Tambah Data NonAnggota Keluarga </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/penduduk/tambah_daftaranggota_kos')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- <input type="hidden" id="kos" name="kos"> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="NIKNon" name="NIK" style="border-radius: 25px;" required>

                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" style="border-radius: 25px;" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat" name="tempat" style="border-radius: 25px;" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" style="border-radius: 25px;" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="laki_laki" name="jenis_kelamin" value="l" >
                                    <label class="form-check-label" for="laki_laki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="perempuan" name="jenis_kelamin" value="p" >
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="golongan_darah">Golongan Darah</label>
                                <select class="form-control" id="golongan_darah" name="golongan_darah" style="border-radius: 25px;" required>
                                    <option value="A">A</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <select class="form-control" id="agama" name="agama" style="border-radius: 25px;" required>
                                    <option value="Islam">Islam</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ktp">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="dokumen" name="dokumen" >
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="status_perkawinan">Status Perkawinan</label>
                                    <select class="form-control" id="status_perkawinan" name="status_perkawinan" style="border-radius: 25px;" required>
                                        <option value="Sudah Menikah">Sudah Menikah</option>
                                        <option value="Belum Menikah">Belum Menikah</option>
                                    </select>
                                </div>
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" style="border-radius: 25px;" required>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="status_keluarga">Status Keluarga</label>
                                    <select class="form-control" id="status_keluargaNon" name="status_keluarga" style="border-radius: 25px;" required>
                                        <option value="Suami">Suami</option>
                                        <option value="Istri">Istri</option>
                                        <option value="Anak">Anak</option>
                                        <option value="Keponakan">Keponakan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tgl_masuk">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" style="border-radius: 25px;" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_keluar">Tanggal Keluar</label>
                                <input type="date" class="form-control" id="tgl_keluar" name="tgl_keluar" style="border-radius: 25px;">
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Tambahkan bagian lainnya sesuai kebutuhan -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary mt-3" style="border-radius: 20px; background-color: #424874; width: fit-content;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit non-->

<div class="modal fade" id="editModalNonAnggota" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title text-center w-100" id="editModalLabel" style="color: #424874">Ubah Data Anggota Keluarga </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/penduduk/DaftarAnggota/Update')}}" method="POST"
                enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="NIK_non" name="nik">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- <input type="hidden" id="nik" name="nik"> --}}
                            <div class="form-group">
                                <label for="edit_nik">NIK</label>
                                <input type="text" class="form-control" id="NIK_non" name="NIK" style="border-radius: 25px;">
                            </div>
                            <!-- Tambahkan atribut value untuk setiap input sesuai dengan data yang ingin diedit -->
                            <div class="form-group">
                                <label for="edit_nama">Nama</label>
                                <input type="text" class="form-control" id="nama_non" name="nama" style="border-radius: 25px;">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="edit_tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_non" name="tempat" placeholder="Tempat" style="border-radius: 25px;">
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir_non" name="tanggal_lahir" style="border-radius: 25px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="laki_laki_non" name="jenis_kelamin" value="l">
                                    <label class="form-check-label" for="laki_laki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="perempuan_non" name="jenis_kelamin" value="p">
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label for="edit_golongan_darah">Golongan Darah</label>
                                    <select class="form-control" id="golongan_darah_non" name="golongan_darah" style="border-radius: 25px;">
                                        <option value="A">A</option>
                                        <option value="AB">AB</option>
                                        <option value="B">B</option>
                                        <option value="O">O</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Sisipkan nilai yang ada saat ini untuk input jenis kelamin -->
                            <div class="form-group">
                                <label for="edit_agama">Agama</label>
                                <select class="form-control" id="agama_non" name="agama" style="border-radius: 25px;" re>
                                    <option value="Islam">Islam</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_ktp">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="dokumen_non" name="dokumen">
                            </div>
                        </div>
                        <div class="col-md-6">
                    
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="edit_status_perkawinan">Status Perkawinan</label>
                                        <select class="form-control" id="status_perkawinan_non" name="status_perkawinan" style="border-radius: 25px;">
                                            <option value="Sudah Menikah">Sudah Menikah</option>
                                            <option value="Belum Menikah">Belum Menikah</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="form-group">
                                <label for="edit_pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan_non" name="pekerjaan" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="edit_status_keluarga">Status Hubungan Dalam Keluarga</label>
                                    <select class="form-control" id="status_keluarga_non" name="status_keluarga" style="border-radius: 25px;">
                                        <option value="Suami">Suami</option>
                                        <option value="Istri">Istri</option>
                                        <option value="Anak">Anak</option>
                                        <option value="Famili Lain">Famili lain</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_tgl_masuk">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="tgl_masuk_non" name="tgl_masuk" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="edit_tgl_keluar">Tanggal Keluar</label>
                                <input type="date" class="form-control" id="tgl_keluar_non" name="tgl_keluar" style="border-radius: 25px;">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; border: none; width: 200px;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- view modal non anggota --}}


<div class="modal fade" id="viewModalNonAnggota" tabindex="-1" role="dialog" aria-labelledby="viewModalNonAnggota" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title text-center w-100" id="viewModalNonAnggota" style="color: #424874">Lihat Data Non Anggota Keluarga </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="view_nik">NIK</label>
                                <input type="text" class="form-control" id="view_nik_non" name="view_nik" value="" disabled>
                            </div>
                            <!-- Tambahkan atribut value untuk setiap input sesuai dengan data yang ingin dilihat -->
                            <div class="form-group">
                                <label for="view_nama">Nama</label>
                                <input type="text" class="form-control" id="view_nama_non" name="view_nama" value="" disabled>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="view_tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="view_tempat_non" name="view_tempat_lahir" placeholder="Tempat" value="" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="view_tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="view_tanggal_lahir_non" name="view_tanggal_lahir" value="" disabled>
                                 </div>
                            </div>
                            <div class="form-group">
                                <label for="view_jenis_kelamin">Jenis Kelamin</label>
                                <input type="text" class="form-control" id="view_jenis_kelamin_non" name="view_jenis_kelamin"value="" disabled>
                            </div>
                            <!-- Sisipkan nilai yang ada saat ini untuk input jenis kelamin -->
                            <div class="form-group">
                                <label for="view_agama">Agama</label>
                                <input type="text" class="form-control" id="view_agama_non" name="view_agama" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_status_pernikahan">Status Pernikahan</label>
                                <input type="text" class="form-control" id="view_status_perkawinan_non" name="view_status_pernikahan" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_ktp">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="view_dokumen_non" name="view_file_upload" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="view_pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="view_pekerjaan_non" name="view_pekerjaan" value="" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label for="view_status_hubungan">Status Hubungan Keluarga</label>
                                <input type="text" class="form-control" id="view_status_keluarga_non" name="view_status_hubungan" value="" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label for="view_golongan_darah">Golongan Darah</label>
                                <input type="text" class="form-control" id="view_golongan_darah_non" name="view_golongan_darah" value="" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="view_tgl_masuk">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="view_tgl_masuk_non" name="view_tgl_masuk" value="" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="view_tgl_keluar">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="view_tgl_keluar_non" name="view_tgl_keluar" value="" disabled>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>




@endsection
@push('css')
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
    .col-md-6 h2 {
        color: #424874;
        font-style: bold;
    }
    </style>
@endpush
@push('js')
    <script> 
        $(document).ready(function () {
            $(document).on("click", ".btn-show", function () {
                var ids = $(this).data('id');
                $.ajax({
                    url: "{{ url('penduduk/DaftarAnggota') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        NIK: ids
                    },
                    success: function(response) {
                        // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
                        $('#ViewModalAnggota .modal-body #view_NIK').val(response.NIK);
                        $('#ViewModalAnggota .modal-body #view_nama').val(response.nama);
                        $('#ViewModalAnggota .modal-body #view_tempat').val(response.tempat);
                        $('#ViewModalAnggota .modal-body #view_tanggal_lahir').val(response.tanggal_lahir);
                        $('#ViewModalAnggota .modal-body #view_jenis_kelamin').val(response.jenis_kelamin);
                        $('#ViewModalAnggota .modal-body #view_golongan_darah').val(response.golongan_darah);
                        $('#ViewModalAnggota .modal-body #view_agama').val(response.agama);
                        $('#ViewModalAnggota .modal-body #view_status_perkawinan').val(response.status_perkawinan);
                        $('#ViewModalAnggota .modal-body #view_pekerjaan').val(response.pekerjaan);
                        $('#ViewModalAnggota .modal-body #view_status_keluarga').val(response.status_keluarga);
                        // $('#ViewModalAnggota .modal-body #view_status_anggota').val(response.status_anggota);
                        $('#ViewModalAnggota .modal-body #view_dokumen').val(response.dokumen);
                        $('#ViewModalAnggota .modal-body #view_tgl_masuk').val(response.tgl_masuk);
                        $('#ViewModalAnggota .modal-body #view_tgl_keluar').val(response.tgl_keluar);
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan yang terjadi
                    }
                });
            });
        });
        $(document).ready(function () {
            $(document).on("click", ".btn-show-non", function () {
                var ids = $(this).data('id');
                $.ajax({
                    url: "{{ url('penduduk/DaftarAnggota') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        NIK: ids
                    },
                    success: function(response) {
                        // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
                        $('#ViewModalNonAnggota .modal-body #view_NIK_non').val(response.NIK);
                        $('#ViewModalNonAnggota .modal-body #view_nama_non').val(response.nama);
                        $('#ViewModalNonAnggota .modal-body #view_tempat_non').val(response.tempat);
                        $('#ViewModalNonAnggota .modal-body #view_tanggal_lahir_non').val(response.tanggal_lahir);
                        $('#ViewModalNonAnggota .modal-body #view_jenis_kelamin_non').val(response.jenis_kelamin);
                        $('#ViewModalNonAnggota .modal-body #view_golongan_darah_non').val(response.golongan_darah);
                        $('#ViewModalNonAnggota .modal-body #view_agama_non').val(response.agama);
                        $('#ViewModalNonAnggota .modal-body #view_status_perkawinan_non').val(response.status_perkawinan);
                        $('#ViewModalNonAnggota .modal-body #view_pekerjaan_non').val(response.pekerjaan);
                        $('#ViewModalNonAnggota .modal-body #view_status_keluarga_non').val(response.status_keluarga);
                        
                        // $('#ViewModalNonAnggota .modal-body #view_status_anggota_non').val(response.status_anggota);
                        $('#ViewModalNonAnggota .modal-body #view_dokumen_non').val(response.dokumen);
                        $('#ViewModalNonAnggota .modal-body #view_tgl_masuk_non').val(response.tgl_masuk);
                        $('#ViewModalNonAnggota .modal-body #view_tgl_keluar_non').val(response.tgl_keluar);
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan yang terjadi
                    }
                });
            });
        });
     $(document).on("click", ".btn-update", function () {
        var ids = $(this).data('id');
        $(".modal-body #nik").val( ids );
        $.ajax({
            url: "{{ url('penduduk/DaftarAnggota') }}",
            type: "POST",
            dataType: "json",
            data: {
                NIK: ids
            },
            success: function(response) {
                // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
                $('.modal-body #NIK').val(response.NIK);
                $('.modal-body #nama').val(response.nama);
                $('.modal-body #tempat').val(response.tempat);
                $('.modal-body #tanggal_lahir').val(response.tanggal_lahir);

                if (response.jenis_kelamin === 'l') {
                    $('.modal-body #laki_laki').prop('checked', true);
                } else if (response.jenis_kelamin === 'p') {
                    $('.modal-body #perempuan').prop('checked', true);
        }
                $('.modal-body #golongan_darah').val(response.golongan_darah);
                $('.modal-body #agama').val(response.agama);
                $('.modal-body #status_perkawinan').val(response.status_perkawinan);
                $('.modal-body #pekerjaan').val(response.pekerjaan);
                // $('.modal-body #status_anggota').val(response.status_anggota);
                $('.modal-body #status_keluarga').val(response.status_keluarga);

                if (response.status_keluarga === 'Anak') {
                    $('.modal-body #anak').prop('checked', true);
                } else if (response.status_keluarga === 'Kepala Keluarga') {
                    $('.modal-body #kepala_keluarga').prop('checked', true);
                } else {
                    $('.modal-body #ibu_rumah_tangga').prop('checked', true);
                }
                $('.modal-body #dokumen').val(response.dokumen);
                $('.modal-body #tgl_masuk').val(response.tgl_masuk);
                $('.modal-body #tgl_keluar').val(response.tgl_keluar);
                // Isi formulir lainnya sesuai kebutuhan Anda
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan yang terjadi
            }
        });
     });
     $(document).on("click", ".btn-edit", function () {
        var ids = $(this).data('id');
        $(".modal-body #nik").val( ids );
        $.ajax({
            url: "{{ url('penduduk/DaftarAnggota') }}",
            type: "POST",
            dataType: "json",
            data: {
                NIK: ids
            },
            success: function(response) {
                // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
                $('.modal-body #NIK_non').val(response.NIK);
                $('.modal-body #nama_non').val(response.nama);
                $('.modal-body #tempat_non').val(response.tempat);
                $('.modal-body #tanggal_lahir_non').val(response.tanggal_lahir);

                if (response.jenis_kelamin === 'l') {
                    $('.modal-body #laki_laki_non').prop('checked', true);
                } else if (response.jenis_kelamin === 'p') {
                    $('.modal-body #perempuan_non').prop('checked', true);
        }
                $('.modal-body #golongan_darah_non').val(response.golongan_darah);
                $('.modal-body #agama_non').val(response.agama);
                $('.modal-body #status_perkawinan_non').val(response.status_perkawinan);
                $('.modal-body #pekerjaan_non').val(response.pekerjaan);
                $('.modal-body #status_keluarga_non').val(response.status_keluarga);
                // $('.modal-body #status_anggota_non').val(response.status_anggota);

                if (response.status_keluarga === 'Anak') {
                    $('.modal-body #anak_non').prop('checked', true);
                } else if (response.status_keluarga === 'Kepala Keluarga') {
                    $('.modal-body #kepala_keluarga_non').prop('checked', true);
                } else {
                    $('.modal-body #ibu_rumah_tangga_non').prop('checked', true);
                }
                // $('.modal-body #status_anggota_non').val(response.status_anggota);
                $('.modal-body #dokumen_non').val(response.dokumen);
                $('.modal-body #tgl_masuk_non').val(response.tgl_masuk);
                $('.modal-body #tgl_keluar_non').val(response.tgl_keluar);
                // Isi formulir lainnya sesuai kebutuhan Anda
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan yang terjadi
            }
        });
     });
    </script>
@endpush
</body>
</html>