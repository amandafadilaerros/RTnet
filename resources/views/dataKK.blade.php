@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-md-6">
        <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874;width:20%" data-toggle="modal" data-target="#tambahModal">Tambah</a>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <input type="text" class="form-control" style="border-radius: 20px ;margin-left : 200px;" placeholder="Cari...">
            <div class="input-group-append">
                <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-left:10px; width:100px;">Cari</a>
            </div>
        </div>
    </div>
</div>
<div class="card">
  {{-- <div class="card-header">
      <h3 class="card-title">
        {{ $page->title }}
      </h3>
      <div class="card-tools">
          <a href="{{url('data_kk/create')}}" class="btn btn-sm btn-primary mt-1">Tambah</a>
      </div>
  </div> --}}
  <div class="card-body">
      @if (session('success'))
          <div class="alert alert-success">{{session('success')}}</div>
      @endif
      @if (session('error'))
          <div class="alert alert-danger">{{session('error')}}</div>
      @endif
      <table class="table table-hover table-striped" id="table_data_kk">
          <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">No. KK</th>
                <th scope="col">Nama Kepala Keluarga</th>
                <th scope="col">Jumlah Individu</th>
                <th scope="col">Alamat</th>
                <th scope="col">Dokumen</th>
                <th scope="col">Aksi</th>
              </tr>
          </thead>
        
<!-- Modal tambah KK -->
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
            <form method="" action="">
              @csrf
              <div class="form-group">
                <label for="noKK">No KK</label>
                <input type="text" class="form-control" id="noKK" name="no_kk" placeholder="Masukkan No KK">
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat">
              </div>
              <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK">
              </div>
              <div class="form-group">
                <label for="namaKepalaKeluarga">Nama Kepala Keluarga</label>
                <input type="text" class="form-control" id="namaKepalaKeluarga" name="nama" placeholder="Masukkan Nama Kepala Keluarga">
              </div>
              <div class="form-group">
                <label for="jumlahAnggotaKeluarga">Jumlah Anggota Keluarga</label>
                <input type="number" class="form-control" id="jumlahAnggotaKeluarga" name="jumlah_anggota" placeholder="Masukkan Jumlah Anggota Keluarga">
              </div>
              <div class="form-group">
                <label for="agama">Agama</label>
                <select class="form-control" id="agama" name="agama">
                  <option value="islam">Islam</option>
                  <option value="kristen">Kristen</option>
                  <option value="katolik">Katolik</option>
                  <option value="hindu">Hindu</option>
                  <option value="budha">Budha</option>
                </select>
              </div>
              <div class="form-group">
                <label for="statusPernikahan">Status Pernikahan</label>
                <select class="form-control" id="statusPernikahan" name="status_pernikahan">
                  <option value="kawin">Kawin</option>
                  <option value="belumKawin">Belum Kawin</option>
                </select>
              </div>
              <div class="form-group">
                <label for="nomorRumah">Nomor Rumah</label>
                <input type="text" class="form-control" id="nomorRumah" name="no_rumah" placeholder="Masukkan Nomor Rumah">
              </div>
              <div class="form-group">
                <label for="tempatTanggalLahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggalLahir" name="tanggal_lahir">
              </div>
              <div class="form-group">
                <label for="tempatTanggalLahir">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempatLahir" name="tempat_lahir">
              </div>
              <div class="form-group">
                <label for="pendidikan">Pendidikan</label>
                <select class="form-control" id="pendidikan" name="pendidikan">
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
                <input type="text" class="form-control" id="jenisPekerjaan" name="pekerjaan" placeholder="Masukkan Jenis Pekerjaan">
              </div>
              <div class="form-group">
                <label for="dokumenKK">Dokumen Kartu Keluarga</label>
                <input type="file" class="form-control-file" id="dokumenKK" name="dokumen">
              </div>
              <div class="text-center">
                  <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px; margin-top: 10px; margin-bottom: 10px;">Tambah</button>
              </div>
            </form>
          </div>
      </div>
    </div>
</div>  

<!-- Modal edit KK -->
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
                  @csrf
                  <div class="form-group">
                    <label for="noKK">No KK</label>
                    <input type="text" class="form-control" id="noKK" name="noKK" placeholder="Masukkan No KK">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat">
                  </div>
                  <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK">
                  </div>
                  <div class="form-group">
                    <label for="namaKepalaKeluarga">Nama Kepala Keluarga</label>
                    <input type="text" class="form-control" id="namaKepalaKeluarga" name="namaKepalaKeluarga" placeholder="Masukkan Nama Kepala Keluarga">
                  </div>
                  <div class="form-group">
                    <label for="jumlahAnggotaKeluarga">Jumlah Anggota Keluarga</label>
                    <input type="number" class="form-control" id="jumlahAnggotaKeluarga" name="jumlahAnggotaKeluarga" placeholder="Masukkan Jumlah Anggota Keluarga">
                  </div>
                  <div class="form-group">
                    <label for="agama">Agama</label>
                    <select class="form-control" id="agama" name="agama">
                      <option value="islam">Islam</option>
                      <option value="kristen">Kristen</option>
                      <option value="katolik">Katolik</option>
                      <option value="hindu">Hindu</option>
                      <option value="budha">Budha</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="statusPernikahan">Status Pernikahan</label>
                    <select class="form-control" id="statusPernikahan" name="statusPernikahan">
                      <option value="kawin">Kawin</option>
                      <option value="belumKawin">Belum Kawin</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nomorRumah">Nomor Rumah</label>
                    <input type="text" class="form-control" id="nomorRumah" name="nomorRumah" placeholder="Masukkan Nomor Rumah">
                  </div>
                  <div class="form-group">
                    <label for="tanggalLahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir">
                  </div>
                  <div class="form-group">
                    <label for="tempatLahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempatLahir" name="tempat">
                  </div>
                  <div class="form-group">
                    <label for="pendidikan">Pendidikan</label>
                    <select class="form-control" id="pendidikan" name="pendidikan">
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
                    <input type="text" class="form-control" id="jenisPekerjaan" name="pekerjaan" placeholder="Masukkan Jenis Pekerjaan">
                  </div>
                  <div class="form-group">
                    <label for="dokumenKK">Dokumen Kartu Keluarga</label>
                    <input type="file" class="form-control-file" id="dokumenKK" name="dokumenKK">
                  </div>
                  <div class="text-center">
                      <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px; margin-top: 10px; margin-bottom: 10px;">Tambah</button>
                  </div>
                </form>
              </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
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
    <script>
        $(document).ready(function() {
            var dataKK = $('#table_data_kk').DataTable({
                serverSide: true,   //jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ url('ketuaRt/data_kk/list') }}",
                    "dataType": "json",
                    "type": "POST"
                },
                columns: [
                    {
                        data: "DT_RowIndex",    // nomor urut dari laravel datatable addIndexColimn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "no_kk",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa urut
                        searchable: true        // jika kolom bisa dicari
                    }, {
                        data: "nama_kepala_keluarga",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                      data: "jumlah_individu",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                      data: "alamat",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                      data: "dokumen",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                      data: null,
                      classname: "",
                      orderable: false, //orderable true jika ingin kolom bisa diurutkan
                      searchable: false, //searchable true jika ingin kolom bisa dicari
                      render: function (data, type, row) {
                        return '<a href="#" class="btn btn-primary btn-sm btn-detail" data-toggle="modal" data-target="#detailModal" data-id="' + row.no_kk + '"><i class="fas fa-info-circle"></i></a> <a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="' + row.no_kk + '"><i class="fas fa-pen"></i></a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="' + row.no_kk + '"><i class="fas fa-trash"></i></a>';

                  }
              }
          ]
      });
      $('#no_kk').on('change', function(){
          dataKK.ajax.reload();
      });
        $(document).on("click", ".btn-edit", function () {
        var ids = $(this).data('id');
        $(".modal-body #noKK").val( ids );
        $.ajax({
            url: "{{ url('ketuaRt/data_kk/edit') }}",
            type: "POST",
            dataType: "json",
            data: {
                no_kk: ids
            },
            success: function(response) {
                // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
                $('.modal-body #alamat').val(response.kk.alamat);
                $('.modal-body #nik').val(response.ktp[0].NIK);
                $('.modal-body #namaKepalaKeluarga').val(response.kk.nama_kepala_keluarga);
                $('.modal-body #jumlahAnggotaKeluarga').val(response.kk.jumlah_individu);
                $('.modal-body #jenisPekerjaan').val(response.ktp[0].pekerjaan);
                $('.modal-body #tempatLahir').val(response.ktp[0].tempat);
                $('.modal-body #tanggalLahir').val(response.ktp[0].tanggal_lahir);
                $('.modal-body #nomorRumah').val(response.kk.no_rumah);
                $('.modal-body #dokumen').val(response.dokumen);
                // Isi formulir lainnya sesuai kebutuhan Anda
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan yang terjadi
            }
        });
    });
    $(document).on("click", ".btn-delete", function () {
        var no_kk = $(this).data('id');
        $(".modal-footer #no_kk").val( no_kk );
    });
});
    </script>
@endpush
