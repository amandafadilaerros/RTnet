
@extends('layouts.template')
@section('content')
<div class="card-body">
    <div class="header">
        <p><strong>Nama Kepala Keluarga :</strong> {{ $data_kk->nama_kepala_keluarga }}</p>
        <p><strong>Nomor Kartu Keluarga :</strong> {{ $data_kk->no_kk }}</p>
        <p><strong>Alamat :</strong> {{ $data_kk->alamat }}</p>
        <p><strong>Jumlah Individu :</strong> {{ $data_kk->jumlah_individu }}</p>
        <p><strong>No. Rumah / Status Rumah :</strong> {{ $data_kk->no_rumah }} / {{ $data_kk->rumah->status_rumah }}</p>
    </div>

<!-- DATA ANGGOTA KELUARGA -->
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        @error('nik')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="hidden" id="NKK" value="{{$data_kk->no_kk}}">
        <div class="row">
            <div class="col-md-8">
                <h2>Data Anggota Keluarga</h2>
                <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahAnggotaModal">Tambah</a>
            </div>
            <div class="col-md-4" style="">
            <div class="row">
                <input type="text" id="customSearchBox1" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                <button class="btn btn-primary" id="customSearchButton1" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
            </div>
        </div>
        </div>
        <div class="header">
            <!-- // <div class="table-responsive"> -->
        <div class="table-responsive">
        <table class="table table-hover table-striped" id="table_detail_data_anggota_kk">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIK</th>
                    <th scope="col">No. KK</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tempat</th>
                    <th scope="col">Tgl Lahir</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Gol. Darah</th>
                    <th scope="col">Agama</th>
                    <th scope="col">Status Perkawinan</th>
                    <th scope="col">Pekerjaan</th>
                    <th scope="col">Status Keluarga</th>
                    <th scope="col">Jenis Penduduk</th>
                    <th scope="col">Tgl Msuk</th>
                    <th scope="col">Tgl Keluar</th>
                    <th scope="col">Dokumen</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            </table>
        </div>
        </div>
    </div>

<!-- DATA NON-ANGGOTA KELUARGA -->
    <div class="card-body">
        @if (session('success2'))
        <div class="alert alert-success">{{session('success2')}}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <h2>Data Non-Anggota Keluarga</h2>
                <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahNonAnggotaModal">Tambah</a>
            </div>
            <div class="col-md-4" style="">
            <div class="row">
                <input type="text" id="customSearchBox2" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                <button class="btn btn-primary" id="customSearchButton2" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
            </div>
        </div>
        </div>
        <div class="header">
        <!-- <div class="table-responsive"> -->
        <div class="table-responsive">
        <table class="table table-hover table-striped" id="table_detail_data_non_anggota_kk">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIK</th>
                    <th scope="col">No. KK</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tempat</th>
                    <th scope="col">Tgl Lahir</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Gol. Darah</th>
                    <th scope="col">Agama</th>
                    <th scope="col">Status Perkawinan</th>
                    <th scope="col">Pekerjaan</th>
                    <th scope="col">Jenis Penduduk</th>
                    <th scope="col">Tgl Msuk</th>
                    <th scope="col">Tgl Keluar</th>
                    <th scope="col">Dokumen</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
        </table>
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
                <form action="{{url('/ketuaRt/detail_kk/create')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="no_kk" id="no_kkTambah" value="{{$data_kk->no_kk}}">
                    <input type="hidden" name="jenis_penduduk" id="jenis_pendudukTambah" value="tetap">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control" id="nik" name="nik" style="border-radius: 25px;">
                            </div>
                            <!-- NO. KK Otomatis -->
                                <input type="hidden" class="form-control" id="no_kk" name="no_kk" value="{{ $data_kk->no_kk }}" style="border-radius: 25px;">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" style="border-radius: 25px;">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat" style="border-radius: 25px;">
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
                                <label for="golongan_darah">Golongan Darah</label>
                                <select class="form-control" id="golongan_darah" name="golongan_darah" style="border-radius: 25px;">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="agama">Agama</label>
                                <select class="form-control" id="agama" name="agama" style="border-radius: 25px;">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status_perkawinan">Status Perkawinan</label>
                                <select class="form-control" id="status_perkawinan" name="status_perkawinan" style="border-radius: 25px;">
                                    <option value="Kawin">Kawin</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="status_keluarga">Status Keluarga</label>
                                <select class="form-control" id="status_keluarga" name="status_keluarga" style="border-radius: 25px;">
                                    <option value="Suami">Suami</option>
                                    <option value="Istri">Istri</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Menantu">Menantu</option>
                                    <option value="Cucu">Cucu</option>
                                    <option value="Keponakan">Keponakan</option>
                                    <option value="Orang tua">Orang tua</option>
                                    <option value="Mertua">Mertua</option>
                                </select>
                            </div>
                            <!-- Jenis Penduduk Otomatis -->
                                <input type="hidden" class="form-control" id="jenis_penduduk" name="jenis_penduduk" value="Tetap" style="border-radius: 25px;">
                            <div class="form-group">
                                <label for="dokumen">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="dokumen" name="dokumen">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary mt-1 d-block mx-auto" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; width: 200px;">Tambah</button>
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
                <form action="{{url('/ketuaRt/detail_kk/update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="nik_awal" id="edit_nik">
                            <input type="hidden" name="no_kk" id="edit_no_kk">
                            <div class="form-group">
                                <label for="edit_nik">NIK</label>
                                <input type="number" class="form-control" id="edit_nik" name="nik" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="edit_nama">Nama</label>
                                <input type="text" class="form-control" id="edit_nama" name="nama" style="border-radius: 25px;">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="edit_tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="edit_tempat_lahir" name="tempat" style="border-radius: 25px;">
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir" style="border-radius: 25px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="edit_laki_laki" name="jenis_kelamin" value="l">
                                <label class="form-check-label" for="laki_laki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="edit_perempuan" name="jenis_kelamin" value="p">
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_golongan_darah">Golongan Darah</label>
                                <select class="form-control" id="edit_golongan_darah" name="golongan_darah" style="border-radius: 25px;">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="edit_agama">Agama</label>
                                <select class="form-control" id="edit_agama" name="agama" style="border-radius: 25px;">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                        <div class="form-group">
                                <label for="edit_status_perkawinan">Status Perkawinan</label>
                                <select class="form-control" id="edit_status_perkawinan" name="status_perkawinan" style="border-radius: 25px;">
                                    <option value="Kawin">Kawin</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="edit_pekerjaan" name="pekerjaan" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="edit_status_keluarga">Status Keluarga</label>
                                <select class="form-control" id="edit_status_keluarga" name="status_keluarga" style="border-radius: 25px;">
                                    <option value="Suami">Suami</option>
                                    <option value="Istri">Istri</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Menantu">Menantu</option>
                                    <option value="Cucu">Cucu</option>
                                    <option value="Keponakan">Keponakan</option>
                                    <option value="Orang tua">Orang tua</option>
                                    <option value="Mertua">Mertua</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dokumen">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="dokumen" name="dokumen">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary mt-1 d-block mx-auto" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; width: 200px;">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal Tambah Non Anggota -->
<div class="modal fade" id="tambahNonAnggotaModal" tabindex="-1" role="dialog" aria-labelledby="tambahNonAnggotaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title text-center w-100" id="tambahNonAnggotaModalLabel" style="color: #424874">Tambah Data Non Anggota Keluarga </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/ketuaRt/detail_kk/create2')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">  
                            <input type="hidden" name="no_kk" id="no_kkTambah" value="{{$data_kk->no_kk}}">
                            <input type="hidden" name="jenis_penduduk2" id="nonPenduduk" value="kos">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control" id="nik" name="nik" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" style="border-radius: 25px;">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat" style="border-radius: 25px;">
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
                                <label for="golongan_darah">Golongan Darah</label>
                                <select class="form-control" id="golongan_darah" name="golongan_darah">
                                    <option>A</option>
                                    <option>B</option>
                                    <option>AB</option>
                                    <option>O</option>
                                </select>
                            </div>
                           
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="agama">Agama</label>
                                <select class="form-control" id="agama" name="agama" style="border-radius: 25px;">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status_perkawinan">Status Perkawinan</label>
                                <select class="form-control" id="status_perkawinan" name="status_perkawinan" style="border-radius: 25px;">
                                    <option value="Kawin">Kawin</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" style="border-radius: 25px;">
                            </div>
                                <input type="hidden" class="form-control" id="jenis_penduduk" name="jenis_penduduk" value="Tetap" style="border-radius: 25px;">
                            <div class="form-group">
                                <label for="dokumen">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="dokumen" name="dokumen">
                            </div>
                        </div>
                    </div>
                    <!-- Tambahkan bagian lainnya sesuai kebutuhan -->
                    <button class="btn btn-sm btn-primary mt-1 d-block mx-auto" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; width: 200px;">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit non anggota -->
<div class="modal fade" id="editModalNonAnggota" tabindex="-1" role="dialog" aria-labelledby="editNonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title text-center w-100" id="editNonModalLabel" style="color: #424874">Ubah Data Anggota Keluarga </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/ketuaRt/detail_kk/update2')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="nik_awal" id="edit_nik">
                            <input type="hidden" name="no_kk" id="edit_no_kk">
                            <div class="form-group">
                                <label for="edit_nik">NIK</label>
                                <input type="number" class="form-control" id="edit_nik" name="nik" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="edit_nama">Nama</label>
                                <input type="text" class="form-control" id="edit_nama" name="nama" style="border-radius: 25px;">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="edit_tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="edit_tempat_lahir" name="tempat" style="border-radius: 25px;">
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir" style="border-radius: 25px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="edit_laki_laki_non" name="jenis_kelamin" value="l">
                                <label class="form-check-label" for="laki_laki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="edit_perempuan_non" name="jenis_kelamin" value="p">
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_golongan_darah">Golongan Darah</label>
                                <select class="form-control" id="edit_golongan_darah" name="golongan_darah" style="border-radius: 25px;">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="edit_agama">Agama</label>
                                <select class="form-control" id="edit_agama" name="agama" style="border-radius: 25px;">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                        <div class="form-group">
                                <label for="edit_status_perkawinan">Status Perkawinan</label>
                                <select class="form-control" id="edit_status_perkawinan" name="status_perkawinan" style="border-radius: 25px;">
                                    <option value="Kawin">Kawin</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="edit_pekerjaan" name="pekerjaan" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="dokumen">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="dokumen" name="dokumen">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary mt-1 d-block mx-auto" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; width: 200px;">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin menghapus data ini?
        </div>
        <div class="modal-footer justifiy-content">
          <form id="hapusForm" action="{{url('/ketuaRt/detail_kk/delete')}}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="nik" id="delete_nik">
            <input type="hidden" name="no_kk" id="delete_no_kk">
            <div class="text-center">
              <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Hapus</button>
            </div>
          </form>
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
        // Data Anggota
        $(document).ready(function() {
            var detailKK = $('#table_detail_data_anggota_kk').DataTable({
                serverSide: true,   //jika ingin menggunakan server side processing
                searching: false,
                ajax: {
                    "url": "{{ url('ketuaRt/detail_kk/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.nik = $('#nik').val();
                        d.no_kk = $('#NKK').val();
                        d.customSearch = $('#customSearchBox1').val();

                    }
                },
                columns: [
                    {
                        data: "DT_RowIndex",    // nomor urut dari laravel datatable addIndexColimn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "nik",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa urut
                        searchable: true        // jika kolom bisa dicari
                    }, {
                        data: "no_kk",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                        data: "nama",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "tempat",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "tanggal_lahir",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "jenis_kelamin",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "golongan_darah",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "agama",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "status_perkawinan",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "pekerjaan",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                        data: "status_keluarga",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "jenis_penduduk",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "tgl_masuk",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "tgl_keluar",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "dokumen",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false,       //true, jika ingin kolom bisa dicari
                        render: function(data, type, full, meta) {
                        var baseUrl = '{{ asset('storage/ktps/') }}';
                        return '<img src="'+ baseUrl+'/' + data + '" alt="Gambar KTP" style="max-width: 100px; max-height: 100px;">';
                      }
                    }, {
                      data: null,
                      classname: "",
                      orderable: false, //orderable true jika ingin kolom bisa diurutkan
                      searchable: false, //searchable true jika ingin kolom bisa dicari
                      render: function (data, type, row) {
                      return '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModalAnggota" data-id="' + row.nik + '"><i class="fas fa-pen"></i></a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="' + row.nik + '"><i class="fas fa-trash"></i></a>';
                    }
                }
                ]
            });

            $('#nik').on('input', function() {
                detailKK.ajax.reload();
            });

            $('#customSearchButton1').on('click', function() {
                detailKK.ajax.reload(); // Reload tabel dengan parameter pencarian baru
            });
            $('#customSearchBox1').on('keyup', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
               detailKK.ajax.reload(); // Reload tabel saat menekan tombol Enter
            }
            });

            $('#formSearch').on('submit', function(e) {
                e.preventDefault(); // Menghentikan perilaku default dari tombol "Cari"
                detailKK.ajax.reload();
            });
        });

        // Data non anggota 
        $(document).ready(function() {
            var detailKK = $('#table_detail_data_non_anggota_kk').DataTable({
                serverSide: true,   //jika ingin menggunakan server side processing
                searching: false,
                ajax: {
                    "url": "{{ url('ketuaRt/detail_kk/list2') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.nik = $('#nik').val();
                        d.no_kk = $('#NKK').val();
                        d.customSearch = $('#customSearchBox2').val();

                    }
                },
                columns: [
                    {
                        data: "DT_RowIndex",    // nomor urut dari laravel datatable addIndexColimn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "nik",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa urut
                        searchable: true        // jika kolom bisa dicari
                    }, {
                        data: "no_kk",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                        data: "nama",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "tempat",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "tanggal_lahir",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "jenis_kelamin",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "golongan_darah",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "agama",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "status_perkawinan",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "pekerjaan",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                        data: "jenis_penduduk",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "tgl_masuk",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "tgl_keluar",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "dokumen",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false,       //true, jika ingin kolom bisa dicari
                        render: function(data, type, full, meta) {
                        var baseUrl = '{{ asset('storage/ktps/') }}';
                        return '<img src="'+ baseUrl+'/' + data + '" alt="Gambar KTP" style="max-width: 100px; max-height: 100px;">';
                      }
                    }, {
                      data: null,
                      classname: "",
                      orderable: false, //orderable true jika ingin kolom bisa diurutkan
                      searchable: false, //searchable true jika ingin kolom bisa dicari
                      render: function (data, type, row) {
                      return '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModalNonAnggota" data-id="' + row.nik + '"><i class="fas fa-pen"></i></a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="' + row.nik + '"><i class="fas fa-trash"></i></a>';
                    }
                }
                ]
            });

            $('#nik').on('input', function() {
                detailKK.ajax.reload();
            });

            $('#customSearchButton2').on('click', function() {
                detailKK.ajax.reload(); // Reload tabel dengan parameter pencarian baru
            });
            
            $('#customSearchBox2').on('keyup', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
               detailKK.ajax.reload(); // Reload tabel saat menekan tombol Enter
            }
            });

            $('#formSearch').on('submit', function(e) {
                e.preventDefault(); // Menghentikan perilaku default dari tombol "Cari"
                detailKK.ajax.reload();
            });
            $(document).on("click", ".btn-edit", function () {
                var ids = $(this).data('id');
                // $(".modal-body #id_pengumuman").val( ids );
                $.ajax({
                    url: "{{ url('ketuaRt/detail_kk/edit') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        nik: ids
                    },
                    success: function(response) {
                        // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
                        $('.modal-body #edit_nik').val(response.NIK);
                        $('.modal-body #edit_no_kk').val(response.no_kk);
                        $('.modal-body #edit_nama').val(response.nama);
                        $('.modal-body #edit_tempat_lahir').val(response.tempat);
                        $('.modal-body #edit_tanggal_lahir').val(response.tanggal_lahir);
                        if (response.jenis_kelamin === 'l') {
                            $('#edit_laki_laki').prop('checked', true);
                        } else if (response.jenis_kelamin === 'p') {
                            $('#edit_perempuan').prop('checked', true);
                        }
                        
                        if (response.jenis_kelamin === 'l') {
                            $('#edit_laki_laki_non').prop('checked', true);
                        } else if (response.jenis_kelamin === 'p') {
                            $('#edit_perempuan_non').prop('checked', true);
                        }
                        $('.modal-body #edit_golongan_darah').val(response.golongan_darah);
                        $('.modal-body #edit_agama').val(response.agama);
                        $('.modal-body #edit_status_perkawinan').val(response.status_perkawinan);
                        $('.modal-body #edit_pekerjaan').val(response.pekerjaan);
                        $('.modal-body #edit_status_keluarga').val(response.status_keluarga);
                        $('.modal-body #edit_tgl_masuk').val(response.tgl_masuk);
                        $('.modal-body #edit_tgl_keluar').val(response.tgl_keluar);
                        // Isi formulir lainnya sesuai kebutuhan Anda
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan yang terjadi
                    }
                });
            });
            $(document).on("click", ".btn-delete", function () {
                var ids = $(this).data('id');
                $(".modal-footer #delete_nik").val( ids );
                $.ajax({
                    url: "{{ url('ketuaRt/detail_kk/edit') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        nik: ids
                    },
                    success: function(response) {
                        // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
                        $('.modal-footer #delete_no_kk').val(response.no_kk);
                        // Isi formulir lainnya sesuai kebutuhan Anda
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan yang terjadi
                    }
                });
            });
        });
    </script>


@endpush