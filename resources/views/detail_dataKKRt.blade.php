
@extends('layouts.template')
@section('content')
<div class="card-body">
    <div class="header">
        <p><strong>Nama Kepala Keluarga :</strong> {{ $data_kk->nama_kepala_keluarga }}</p>
        <p><strong>Nomor Kartu Keluarga :</strong> {{ $data_kk->no_kk }}</p>
        <p><strong>Alamat :</strong> {{ $data_kk->alamat }}</p>
        <p><strong>Jumlah Individu :</strong> {{ $data_kk->jumlah_individu }}</p>
        <p><strong>No. Rumah / Status Rumah :</strong> {{ $data_kk->no_rumah }} / {{ $data_kk->status_rumah }}</p>
    </div>

<!-- DATA ANGGOTA KELUARGA -->
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
                    <th scope="col">Status Anggota</th>
                    <th scope="col">Jenis Penduduk</th>
                    <th scope="col">Tgl Msuk</th>
                    <th scope="col">Tgl Keluar</th>
                    <th scope="col">Dokumen</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
                <!-- <tbody>
                    <tr>
                        <td>1</td>
                        <td>santi</td>
                        <td>1234566776543</td>
                        <td>Islam</td>
                        <td>Anak</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" style="border-radius:5px; background-color: #424874;" data-toggle="modal" data-target="#viewModalAnggota"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModalAnggota"><i class="fas fa-pen"></i></a>
                            <form class="d-inline-block" method="POST" action="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?');"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                </tbody> -->
            </table>
        </div>
    </div>

<!-- DATA NON-ANGGOTA KELUARGA -->
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
                    <th scope="col">Status Keluarga</th>
                    <th scope="col">Status Anggota</th>
                    <th scope="col">Jenis Penduduk</th>
                    <th scope="col">Tgl Msuk</th>
                    <th scope="col">Tgl Keluar</th>
                    <th scope="col">Dokumen</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>35367895678004</td>
                        <td>35367895678035</td>
                        <td>Yayun Eldina</td>
                        <td>Trenggalek</td>
                        <td>11-02-2003</td>
                        <td>Perempuan</td>
                        <td>O</td>
                        <td>Islam</td>
                        <td>Belum Kawin</td>
                        <td>Mahasiswa</td>
                        <td>Anggota</td>
                        <td>Anak</td>
                        <td>Penduduk tetap</td>
                        <td>11-02-2003</td>
                        <td>12-02-2024</td>
                        <td>Gambar</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" style="border-radius: 5px; background-color: #424874;" data-toggle="modal" data-target="#viewModalNonAnggota"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModalNonAnggota"><i class="fas fa-pen"></i></a>

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
                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" style="border-radius: 25px;">

                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" style="border-radius: 25px;">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" style="border-radius: 25px;">
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" style="border-radius: 25px;">
                                </div>
                                
                        
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="laki_laki" name="jenis_kelamin[]" value="Laki-Laki">
                                    <label class="form-check-label" for="laki_laki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="perempuan" name="jenis_kelamin[]" value="Perempuan">
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <input type="text" class="form-control" id="agama" name="agama" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="status_pernikahan">Status Pernikahan</label>
                                <input type="text" class="form-control" id="status_pernikahan" name="status_pernikahan" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="ktp">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="file_upload" name="file_upload">
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" style="border-radius: 25px;">
                            </div>
                            <label for="nama_ortu">Nama Orang Tua</label><br>
                            <div class="form-group row">
                                <label for="ibu" class="col-sm-3 col-form-label">Ibu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ibu" name="ibu" style="border-radius: 25px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ayah" class="col-sm-3 col-form-label">Ayah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ayah" name="ayah" style="border-radius: 25px;">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="status_hubungan">Status Hubungan Keluarga</label>
                                <input type="text" class="form-control" id="status_hubungan" name="status_hubungan" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="golongan_darah">Golongan Darah</label>
                                <input type="text" class="form-control" id="golongan_darah" name="golongan_darah" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="pendidikan" name="pendidikan" style="border-radius: 25px;">
                            </div>
                        </div>
                    </div>
                    <!-- Tambahkan bagian lainnya sesuai kebutuhan -->
                    <a class="btn btn-sm btn-primary mt-1 d-block mx-auto" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; width: 200px;" data-toggle="modal" data-target="#tambahAnggotaModal">Tambah</a>
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
                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_nik">NIK</label>
                                <input type="text" class="form-control" id="edit_nik" name="edit_nik" value="">
                            </div>
                            <!-- Tambahkan atribut value untuk setiap input sesuai dengan data yang ingin diedit -->
                            <div class="form-group">
                                <label for="edit_nama">Nama</label>
                                <input type="text" class="form-control" id="edit_nama" name="edit_nama" value="">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="edit_tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="edit_tempat_lahir" name="edit_tempat_lahir" placeholder="Tempat" value="">
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="edit_tanggal_lahir" name="edit_tanggal_lahir" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="edit_jenis_kelamin" name="">
                                    <option>Laki-Laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                            <!-- Sisipkan nilai yang ada saat ini untuk input jenis kelamin -->
                            <div class="form-group">
                                <label for="edit_agama">Agama</label>
                                <input type="text" class="form-control" id="edit_agama" name="edit_agama" value="">
                            </div>
                            <div class="form-group">
                                <label for="edit_status_pernikahan">Status Pernikahan</label>
                                <input type="text" class="form-control" id="edit_status_pernikahan" name="edit_status_pernikahan" value="">
                            </div>
                            <div class="form-group">
                                <label for="edit_ktp">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="edit_file_upload" name="edit_file_upload">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="edit_pekerjaan" name="edit_pekerjaan" value="">
                            </div>
                            <label for="edit_nama_ortu">Nama Orang Tua</label><br>
                            <div class="form-group row">
                                <label for="edit_ibu" class="col-sm-3 col-form-label">Ibu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_nama_ortu" name="edit_nama_ortu" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="edit_ayah" class="col-sm-3 col-form-label">Ayah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_ayah" name="edit_ayah" value="">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="edit_status_hubungan">Status Hubungan Keluarga</label>
                                <input type="text" class="form-control" id="edit_status_hubungan" name="edit_status_hubungan" value="">
                            </div>
                            <div class="form-group">
                                <label for="edit_golongan_darah">Golongan Darah</label>
                                <input type="text" class="form-control" id="edit_golongan_darah" name="edit_golongan_darah" value="">
                            </div>
                            <div class="form-group">
                                <label for="edit_pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="edit_pendidikan" name="edit_pendidikan" value="">
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-sm btn-primary mt-1 d-block mx-auto" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; width: 200px;" data-toggle="modal" data-target="#editAnggotaModal">Tambah</a>
                </form>
            </div>
        </div>
    </div>
</div>

 <!-- Detail modal anggota  -->
<div class="modal fade" id="viewModalAnggota" tabindex="-1" role="dialog" aria-labelledby="viewModalAnggota" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title text-center w-100" id="viewModalAnggota" style="color: #424874">Lihat Data Non Anggota Keluarga </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="view_nik">NIK</label>
                                <input type="text" class="form-control" id="view_nik" name="view_nik" value="" disabled>
                            </div>
                            <!-- Tambahkan atribut value untuk setiap input sesuai dengan data yang ingin dilihat -->
                            <div class="form-group">
                                <label for="view_nama">Nama</label>
                                <input type="text" class="form-control" id="view_nama" name="view_nama" value="" disabled>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="view_tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="view_tempat_lahir" name="view_tempat_lahir" placeholder="Tempat" value="" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="view_tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="view_tanggal_lahir" name="view_tanggal_lahir" value="" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="view_jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="view_jenis_kelamin" name="view_jenis_kelamin" disabled>
                                    <option>Laki-Laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                            <!-- Sisipkan nilai yang ada saat ini untuk input jenis kelamin -->
                            <div class="form-group">
                                <label for="view_agama">Agama</label>
                                <input type="text" class="form-control" id="view_agama" name="view_agama" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_status_pernikahan">Status Pernikahan</label>
                                <input type="text" class="form-control" id="view_status_pernikahan" name="view_status_pernikahan" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_ktp">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="view_file_upload" name="view_file_upload" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="view_pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="view_pekerjaan" name="view_pekerjaan" value="" disabled>
                            </div>
                            <label for="view_nama_ortu">Nama Orang Tua</label><br>
                            <div class="form-group row">
                                <label for="view_ibu" class="col-sm-3 col-form-label">Ibu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="view_nama_ortu" name="view_nama_ortu" value="" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="view_ayah" class="col-sm-3 col-form-label">Ayah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="view_ayah" name="view_ayah" value="" disabled>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="view_status_hubungan">Status Hubungan Keluarga</label>
                                <input type="text" class="form-control" id="view_status_hubungan" name="view_status_hubungan" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_golongan_darah">Golongan Darah</label>
                                <input type="text" class="form-control" id="view_golongan_darah" name="view_golongan_darah" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="view_pendidikan" name="view_pendidikan" value="" disabled>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal Tambah Non-Anggota -->
<div class="modal fade" id="tambahNonAnggotaModal" tabindex="-1" role="dialog" aria-labelledby="tambahNonAnggotaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title text-center w-100" id="tambahNonAnggotaModalLabel" style="color: #424874">Tambah Data Anggota Keluarga </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" style="border-radius: 25px;">

                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" style="border-radius: 25px;">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" style="border-radius: 25px;">
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" style="border-radius: 25px;">
                                </div>
                                
                        
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="laki_laki" name="jenis_kelamin[]" value="Laki-Laki">
                                    <label class="form-check-label" for="laki_laki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="perempuan" name="jenis_kelamin[]" value="Perempuan">
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <input type="text" class="form-control" id="agama" name="agama" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="status_pernikahan">Status Pernikahan</label>
                                <input type="text" class="form-control" id="status_pernikahan" name="status_pernikahan" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="ktp">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="file_upload" name="file_upload">
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" style="border-radius: 25px;">
                            </div>
                            <label for="nama_ortu">Nama Orang Tua</label><br>
                            <div class="form-group row">
                                <label for="ibu" class="col-sm-3 col-form-label">Ibu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ibu" name="ibu" style="border-radius: 25px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ayah" class="col-sm-3 col-form-label">Ayah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ayah" name="ayah" style="border-radius: 25px;">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="status_hubungan">Status Hubungan Keluarga</label>
                                <input type="text" class="form-control" id="status_hubungan" name="status_hubungan" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="golongan_darah">Golongan Darah</label>
                                <input type="text" class="form-control" id="golongan_darah" name="golongan_darah" style="border-radius: 25px;">
                            </div>
                            <div class="form-group">
                                <label for="pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="pendidikan" name="pendidikan" style="border-radius: 25px;">
                            </div>
                        </div>
                    </div>
                    <!-- Tambahkan bagian lainnya sesuai kebutuhan -->
                    <a class="btn btn-sm btn-primary mt-1 d-block mx-auto" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; width: 200px;" data-toggle="modal" data-target="#tambahAnggotaModal">Tambah</a>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Non Anggota-->

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
                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_nik">NIK</label>
                                <input type="text" class="form-control" id="edit_nik" name="edit_nik" value="">
                            </div>
                            <!-- Tambahkan atribut value untuk setiap input sesuai dengan data yang ingin diedit -->
                            <div class="form-group">
                                <label for="edit_nama">Nama</label>
                                <input type="text" class="form-control" id="edit_nama" name="edit_nama" value="">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="edit_tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="edit_tempat_lahir" name="edit_tempat_lahir" placeholder="Tempat" value="">
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="edit_tanggal_lahir" name="edit_tanggal_lahir" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="edit_jenis_kelamin" name="">
                                    <option>Laki-Laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                            <!-- Sisipkan nilai yang ada saat ini untuk input jenis kelamin -->
                            <div class="form-group">
                                <label for="edit_agama">Agama</label>
                                <input type="text" class="form-control" id="edit_agama" name="edit_agama" value="">
                            </div>
                            <div class="form-group">
                                <label for="edit_status_pernikahan">Status Pernikahan</label>
                                <input type="text" class="form-control" id="edit_status_pernikahan" name="edit_status_pernikahan" value="">
                            </div>
                            <div class="form-group">
                                <label for="edit_ktp">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="edit_file_upload" name="edit_file_upload">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="edit_pekerjaan" name="edit_pekerjaan" value="">
                            </div>
                            <label for="edit_nama_ortu">Nama Orang Tua</label><br>
                            <div class="form-group row">
                                <label for="edit_ibu" class="col-sm-3 col-form-label">Ibu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_nama_ortu" name="edit_nama_ortu" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="edit_ayah" class="col-sm-3 col-form-label">Ayah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_ayah" name="edit_ayah" value="">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="edit_status_hubungan">Status Hubungan Keluarga</label>
                                <input type="text" class="form-control" id="edit_status_hubungan" name="edit_status_hubungan" value="">
                            </div>
                            <div class="form-group">
                                <label for="edit_golongan_darah">Golongan Darah</label>
                                <input type="text" class="form-control" id="edit_golongan_darah" name="edit_golongan_darah" value="">
                            </div>
                            <div class="form-group">
                                <label for="edit_pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="edit_pendidikan" name="edit_pendidikan" value="">
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-sm btn-primary mt-1 d-block mx-auto" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; width: 200px;" data-toggle="modal" data-target="#editAnggotaModal">Tambah</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Detail modal non anggota  -->
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
                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="view_nik">NIK</label>
                                <input type="text" class="form-control" id="view_nik" name="view_nik" value="" disabled>
                            </div>
                            <!-- Tambahkan atribut value untuk setiap input sesuai dengan data yang ingin dilihat -->
                            <div class="form-group">
                                <label for="view_nama">Nama</label>
                                <input type="text" class="form-control" id="view_nama" name="view_nama" value="" disabled>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="view_tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="view_tempat_lahir" name="view_tempat_lahir" placeholder="Tempat" value="" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="view_tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="view_tanggal_lahir" name="view_tanggal_lahir" value="" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="view_jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="view_jenis_kelamin" name="view_jenis_kelamin" disabled>
                                    <option>Laki-Laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                            <!-- Sisipkan nilai yang ada saat ini untuk input jenis kelamin -->
                            <div class="form-group">
                                <label for="view_agama">Agama</label>
                                <input type="text" class="form-control" id="view_agama" name="view_agama" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_status_pernikahan">Status Pernikahan</label>
                                <input type="text" class="form-control" id="view_status_pernikahan" name="view_status_pernikahan" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_ktp">Dokumen Kartu Tanda Penduduk</label>
                                <input type="file" class="form-control-file" id="view_file_upload" name="view_file_upload" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="view_pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="view_pekerjaan" name="view_pekerjaan" value="" disabled>
                            </div>
                            <label for="view_nama_ortu">Nama Orang Tua</label><br>
                            <div class="form-group row">
                                <label for="view_ibu" class="col-sm-3 col-form-label">Ibu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="view_nama_ortu" name="view_nama_ortu" value="" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="view_ayah" class="col-sm-3 col-form-label">Ayah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="view_ayah" name="view_ayah" value="" disabled>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="view_status_hubungan">Status Hubungan Keluarga</label>
                                <input type="text" class="form-control" id="view_status_hubungan" name="view_status_hubungan" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_golongan_darah">Golongan Darah</label>
                                <input type="text" class="form-control" id="view_golongan_darah" name="view_golongan_darah" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="view_pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="view_pendidikan" name="view_pendidikan" value="" disabled>
                            </div>
                        </div>
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
        $(document).ready(function() {
            var detailKK = $('#table_detail_data_anggota_kk').DataTable({
                serverSide: true,   //jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ url('ketuaRt/detail_kk/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.nik = $('#nik').val();
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
                        data: "status_anggota",
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
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                      data: null,
                      classname: "",
                      orderable: false, //orderable true jika ingin kolom bisa diurutkan
                      searchable: false, //searchable true jika ingin kolom bisa dicari
                      render: function (data, type, row) {
                      return '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="' + row.nik + '"><i class="fas fa-pen"></i></a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="' + row.nik + '"><i class="fas fa-trash"></i></a>';
                    }
                }
                ]
            });

            $('#nik').on('input', function() {
                detailKK.ajax.reload();
            });

            $('#formSearch').on('submit', function(e) {
                e.preventDefault(); // Menghentikan perilaku default dari tombol "Cari"
                detailKK.ajax.reload();
            });
        });
    </script>
@endpush