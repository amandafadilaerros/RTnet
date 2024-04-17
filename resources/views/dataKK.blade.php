@extends('layouts.template')
@section('content')
<div class="card">
  {{-- <div class="card-header">
      <h3 class="card-title">
        {{ $page->title }}
      </h3>
      <div class="card-tools">
          <a href="{{url('user/create')}}" class="btn btn-sm btn-primary mt-1">Tambah</a>
      </div>
  </div> --}}
  <div class="card-body">
      @if (session('success'))
          <div class="alert alert-success">{{session('success')}}</div>
      @endif
      @if (session('error'))
          <div class="alert alert-danger">{{session('error')}}</div>
      @endif
      <div class="row">
          <div class="col-md-6">
            <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahModal">Tambah</a>
          </div>
          <div class="col-md-6">
            {{-- UNTUK SEARCH --}}
          </div>
      </div>
      <table class="table table-bordered table-hover table-sm" id="table_user">
          <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">No. Rumah</th>
                <th scope="col">Kepala Keluarga</th>
                <th scope="col">No. KK</th>
                <th scope="col">RW/RT</th>
                <th scope="col">Jumlah Individu</th>
                <th scope="col">Aksi</th>
              </tr>
          </thead>
          {{-- hanya CONTOH DATA TABEL --}}
          <tbody>
            <tr>
                <td>1</td>
                <td>112</td>
                <td>Susanto</td>
                <td>01919289828727</td>
                <td>08/06</td>
                <td>12</td>
                <td>
                    <a href="{{url('/ketuaRt/detail_anggota')}}" class="btn btn-primary btn-detail" style="border-radius: 10px; background-color: #424874;"><i class="fas fa-eye"></i></a>
                    <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="1" data-jenis="kas"><i class="fas fa-pen"></i></a>
                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>113</td>
                <td>Katiman</td>
                <td>01919289828727</td>
                <td>08/06</td>
                <td>2</td>
                <td>
                    <a href="{{url('/ketuaRt/detail_anggota')}}" class="btn btn-primary btn-detail" style="border-radius: 10px; background-color: #424874;"><i class="fas fa-eye"></i></a>
                    <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="1" data-jenis="paguyuban"><i class="fas fa-pen"></i></a>
                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>114</td>
                <td>Mardi</td>
                <td>01919289828727</td>
                <td>08/06</td>
                <td>4</td>
                <td>
                    <a href="{{url('/ketuaRt/detail_anggota')}}" class="btn btn-primary btn-detail" style="border-radius: 10px; background-color: #424874;"><i class="fas fa-eye"></i></a>
                    <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="1" data-jenis="kas"><i class="fas fa-pen"></i></a>
                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        </tbody>
      </table>
  </div>
</div>
<!-- Modal tambah pengeluaran -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="tambahModalLabel">Tambah Data Kartu Keluarga</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="noKK">No KK</label>
                <input type="text" class="form-control" id="noKK" placeholder="Masukkan No KK">
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat">
              </div>
              <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" class="form-control" id="nik" placeholder="Masukkan NIK">
              </div>
              <div class="form-group">
                <label for="namaKepalaKeluarga">Nama Kepala Keluarga</label>
                <input type="text" class="form-control" id="namaKepalaKeluarga" placeholder="Masukkan Nama Kepala Keluarga">
              </div>
              <div class="form-group">
                <label for="jumlahAnggotaKeluarga">Jumlah Anggota Keluarga</label>
                <input type="number" class="form-control" id="jumlahAnggotaKeluarga" placeholder="Masukkan Jumlah Anggota Keluarga">
              </div>
              <div class="form-group">
                <label for="agama">Agama</label>
                <select class="form-control" id="agama">
                  <option value="islam">Islam</option>
                  <option value="kristen">Kristen</option>
                  <option value="katolik">Katolik</option>
                  <option value="hindu">Hindu</option>
                  <option value="budha">Budha</option>
                </select>
              </div>
              <div class="form-group">
                <label for="statusPernikahan">Status Pernikahan</label>
                <select class="form-control" id="statusPernikahan">
                  <option value="kawin">Kawin</option>
                  <option value="belumKawin">Belum Kawin</option>
                </select>
              </div>
              <div class="form-group">
                <label for="nomorRumah">Nomor Rumah</label>
                <input type="text" class="form-control" id="nomorRumah" placeholder="Masukkan Nomor Rumah">
              </div>
              <div class="form-group">
                <label for="tempatTanggalLahir">Tempat Tanggal Lahir</label>
                <input type="date" class="form-control" id="tempatTanggalLahir">
              </div>
              <div class="form-group">
                <label for="pendidikan">Pendidikan</label>
                <select class="form-control" id="pendidikan">
                  <option value="SD">SD</option>
                  <option value="SMP">SMP</option>
                  <option value="SMA">SMA</option>
                  <option value="D1">D1</option>
                  <option value="D2">D2</option>
                  <option value="S1">S1</option>
                  <option value="S2">S2</option>
                  <option value="S3">S3</option>
                </select>
              </div>
              <div class="form-group">
                <label for="jenisPekerjaan">Jenis Pekerjaan</label>
                <input type="text" class="form-control" id="jenisPekerjaan" placeholder="Masukkan Jenis Pekerjaan">
              </div>
              <div class="form-group">
                <label for="dokumenKK">Dokumen Kartu Keluarga</label>
                <input type="file" class="form-control-file" id="dokumenKK">
              </div>
            </form>
          </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px; margin-top: 10px; margin-bottom: 10px;">Tambah</button>
            </div>
      </div>
    </div>
</div>  
  <!-- Modal edit pengeluaran -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Edit Data Kartu Keluarga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="noKK">No KK</label>
                    <input type="text" class="form-control" id="noKK" placeholder="Masukkan No KK">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat">
                  </div>
                  <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" placeholder="Masukkan NIK">
                  </div>
                  <div class="form-group">
                    <label for="namaKepalaKeluarga">Nama Kepala Keluarga</label>
                    <input type="text" class="form-control" id="namaKepalaKeluarga" placeholder="Masukkan Nama Kepala Keluarga">
                  </div>
                  <div class="form-group">
                    <label for="jumlahAnggotaKeluarga">Jumlah Anggota Keluarga</label>
                    <input type="number" class="form-control" id="jumlahAnggotaKeluarga" placeholder="Masukkan Jumlah Anggota Keluarga">
                  </div>
                  <div class="form-group">
                    <label for="agama">Agama</label>
                    <select class="form-control" id="agama">
                      <option value="islam">Islam</option>
                      <option value="kristen">Kristen</option>
                      <option value="katolik">Katolik</option>
                      <option value="hindu">Hindu</option>
                      <option value="budha">Budha</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="statusPernikahan">Status Pernikahan</label>
                    <select class="form-control" id="statusPernikahan">
                      <option value="kawin">Kawin</option>
                      <option value="belumKawin">Belum Kawin</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nomorRumah">Nomor Rumah</label>
                    <input type="text" class="form-control" id="nomorRumah" placeholder="Masukkan Nomor Rumah">
                  </div>
                  <div class="form-group">
                    <label for="tempatTanggalLahir">Tempat Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tempatTanggalLahir">
                  </div>
                  <div class="form-group">
                    <label for="pendidikan">Pendidikan</label>
                    <select class="form-control" id="pendidikan">
                      <option value="SD">SD</option>
                      <option value="SMP">SMP</option>
                      <option value="SMA">SMA</option>
                      <option value="D1">D1</option>
                      <option value="D2">D2</option>
                      <option value="S1">S1</option>
                      <option value="S2">S2</option>
                      <option value="S3">S3</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="jenisPekerjaan">Jenis Pekerjaan</label>
                    <input type="text" class="form-control" id="jenisPekerjaan" placeholder="Masukkan Jenis Pekerjaan">
                  </div>
                  <div class="form-group">
                    <label for="dokumenKK">Dokumen Kartu Keluarga</label>
                    <input type="file" class="form-control-file" id="dokumenKK">
                  </div>
                </form>
              </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px; margin-top: 10px; margin-bottom: 10px;">Tambah</button>
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
          <form id="hapusForm" method="" action="">
            @csrf
            @method('DELETE')
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
@endpush

@push('js')
@endpush