@extends('layouts.template')
@section('content')
<div class="row">
  <div class="col-md-6">
    <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahModal">Tambah</a>
  </div>
  <div class="col-md-6">
    <div class="row justify-content-end">
      <form id="searchForm" class="form-inline">
        <div class="form-group">
          <input type="text" class="form-control" id="search" style="border-radius: 20px; width: 260px;" placeholder="Cari disini..." aria-label="Search" aria-describedby="search-addon">
        </div>
        <button type="submit" class="btn btn-primary" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
      </form>
    </div>
  </div>
</div>
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
  <table class="table table-hover table-striped" id="table_pengeluaran">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nominal</th>
        <th scope="col">Jenis Iuran</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Penggunaan</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    </tbody>
  </table>
</div>
</div>
<!-- Modal tambah pengeluaran -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahModalLabel">Tambah Pengeluaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('bendahara/pengeluaran/tambah') }}" class="form-horizontal"> @csrf
          <div class="form-group">
            <label for="jenis_keuangan">Jenis Keuangan:</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jenis_iuran" id="kas" value="Kas" checked>
              <label class="form-check-label" for="kas">
                Kas
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jenis_iuran" id="paguyuban" value="Paguyuban">
              <label class="form-check-label" for="paguyuban">
                Paguyuban
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="tujuan">Tujuan:</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
            @error('keterangan')
            <small class="form-text text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="form-group">
            <label for="nominal_kas">Nominal:</label>
            <input type="number" class="form-control" id="nominal" name="nominal" required>
            @error('nominal')
            <small class="form-text text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal edit pengeluaran -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Pengeluaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editPengeluaranForm" action="{{ url('/bendahara/pengeluaran/update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" id="id_iuran" name="id_iuran">
          <div class="form-group">
            <label for="jenis_keuangan_edit">Jenis Keuangan:</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jenis_iuran" id="jenis_iuran" value="Kas" checked>
              <label class="form-check-label" for="jenis_iuran">
                Kas
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="jenis_iuran" id="jenis_iuran" value="Paguyuban">
              <label class="form-check-label" for="jenis_iuran">
                Paguyuban
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="tujuan_edit">Tujuan:</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan">
          </div>
          <div class="form-group">
            <label for="nominal">Nominal:</label>
            <input type="number" class="form-control" id="nominal" name="nominal">
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Simpan</button>
          </div>
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
        <form id="hapusForm" action="{{url('/bendahara/pengeluaran/destroy')}}" method="post">
          @csrf
          @method('DELETE')
          <input type="hidden" name="id_iuran" id="id_iuran">
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
  /* Menyembunyikan fitur pencarian di tabel */
  .dataTables_filter {
      display: none;
  }
</style>

    <!-- Tambahkan CSS tambahan jika diperlukan -->
@endpush

@push('js')
<script>
  $(document).on('click', '.btn-edit', function() {
    var ids = $(this).data('id');
    $('.modal-body #id_iuran').val(ids); // Atur nilai input dengan ID yang didapat dari tombol
    $.ajax({
      url: "{{ url('/bendahara/pengeluaran/edit') }}", // Ganti URL dengan URL yang sesuai
      type: "POST",
      dataType: "json",
      data: {
        id_iuran: ids
      },
      success: function(response) {
        // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
        $('.modal-body #jenis_iuran').val(response.jenis_iuran);
        $('.modal-body #keterangan').val(response.keterangan);
        $('.modal-body #nominal').val(response.nominal);
        // Isi formulir lainnya sesuai kebutuhan Anda
      },
      error: function(xhr, status, error) {
        // Tangani kesalahan yang terjadi
      }
    });
    $('#editModal').modal('show');
  });


  $(document).ready(function() {
    var dataPengeluaran = $('#table_pengeluaran').DataTable({
      serverSide: true, //jika ingin menggunakan server side processing
      ajax: {
        "url": "{{ url('bendahara/pengeluaran/list') }}",
        "dataType": "json",
        "type": "POST",
        "data": function(d) {
          d.no_kk = $('#no_kk').val();
          d.search = $('#search').val();
        }
      },
      columns: [{
        data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColimn()
        className: "text-center",
        orderable: false,
      }, {
        data: "nominal",
        className: "",
        orderable: true, //jika ingin kolom bisa urut
      }, {
        data: "jenis_iuran",
        className: "",
        orderable: true, //jika ingin kolom bisa urut
      }, {
        data: "created_at_formatted", // menggunakan kolom formatted yang telah ditambahkan pada controller
        className: "",
        orderable: true, // jika ingin kolom bisa urut
        searchable: true // jika kolom bisa dicari
      }, {
        data: "keterangan",
        className: "",
        orderable: true, //jika ingin kolom bisa urut
      }, {
        data: null,
        classname: "",
        orderable: false, //orderable true jika ingin kolom bisa diurutkan
        render: function(data, type, row) {
          return '<a href="#" class="btn btn-success btn-sm btn-edit" data-id="' + row.id_iuran + ' "><i class="fas fa-pen"></i></a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="' + row.id_iuran + '"><i class="fas fa-trash"></i></a>';
        }
      }]
    });

    $('#id_iuran').on('change', function() {
      dataPengeluaran.ajax.reload();
    });

    $('#searchForm').on('submit', function(e) {
      e.preventDefault(); // Mencegah form untuk submit
      dataPengeluaran.ajax.reload(); // Memuat ulang data tabel dengan pencarian yang baru
    });

    $(document).on("click", ".btn-delete", function() {
      var ids = $(this).data('id');
      $(".modal-footer #id_iuran").val(ids);
    });
  });
</script>
@endpush