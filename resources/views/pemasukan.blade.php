@extends('layouts.template')
@section('content')
<div class="row">
  <div class="col-md-6">
    <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahModal">Tambah</a>
  </div>
  <div class="col-md-6">
    {{-- UNTUK SEARCH --}}
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
  <table class="table table-hover table-striped" id="table_pemasukan">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nominal</th>
        <th scope="col">Jenis Pemasukan</th>
        <th scope="col">Nama Penduduk</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
  </table>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-header d-flex justify-content-around">
        <h5 class="modal-title" id="tambahModalLabel">Tambah Pemasukan RT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <p>Pilih salah satu</p>
        </div>
        {{-- <div class="btn-group" role="group" aria-label="Jenis Pemasukan"> --}}
        <div class="d-flex justify-content-around">
          <button type="button" class="btn btn-primary" style="width: 40%; border-radius: 20px; background-color: #424874; margin-bottom: 10px;" id="kasButton">KAS</button> <button type="button" class="btn btn-primary" style="width: 40%; border-radius: 20px; background-color: #424874; margin-bottom: 10px;" id="paguyubanButton">PAGUYUBAN</button>
        </div>
        {{-- </div> --}}
      </div>
    </div>
  </div>
</div>
<!-- Modal tambahan untuk KAS -->
<div class="modal fade" id="kasModal" tabindex="-1" role="dialog" aria-labelledby="kasModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kasModalLabel">Tambah Data KAS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Isi dengan formulir untuk memilih warga dan nominal -->
        <form method="POST" action="{{ url('bendahara/pemasukan/tambah') }}" class="form-horizontal"> @csrf
          <div class="form-group">
            <label for="warga_kas">Pilih Warga:</label>
            <select class="form-control" id="no_kk" name="no_kk" required>
              <option value="">- Pilih Warga -</option>
              @foreach($kk as $item)
              @php
              // Periksa apakah warga telah membayar kas pada bulan ini
              $existingData = \App\Models\iuranModel::where('no_kk', $item->no_kk)
              ->where('jenis_iuran', 'Kas')
              ->whereMonth('created_at', now()->month)
              ->whereYear('created_at', now()->year)
              ->exists();
              @endphp
              @if(!$existingData)
              <option value="{{ $item->no_kk }}">{{ $item->nama_kepala_keluarga }}</option>
              @endif
              @endforeach
            </select>
            @error('no_kk')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="nominal_kas">Nominal:</label>
            <input type="number" class="form-control" id="nominal" name="nominal" value="{{ old('nominal') }}" required>
            @error('nominal')
            <small class="form-text text-danger">{{ $message }}</small> @enderror
          </div>
          <input type="hidden" id="jenis_iuran" name="jenis_iuran" value="Kas">
          <div class="text-center">
            <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal tambahan untuk PAGUYUBAN -->
<div class="modal fade" id="paguyubanModal" tabindex="-1" role="dialog" aria-labelledby="paguyubanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paguyubanModalLabel">Tambah Data PAGUYUBAN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Isi dengan formulir untuk memilih warga dan nominal -->
        <form method="POST" action="{{ url('bendahara/pemasukan/tambah') }}" class="form-horizontal"> @csrf
          <div class="form-group">
          <form method="POST" action="{{ url('bendahara/pemasukan/tambah') }}" class="form-horizontal"> @csrf
          <div class="form-group">
            <label for="warga_kas">Pilih Warga:</label>
            <select class="form-control" id="no_kk" name="no_kk" required>
              <option value="">- Pilih Warga -</option>
              @foreach($kk as $item)
              @php
              // Periksa apakah warga telah membayar kas pada bulan ini
              $existingData = \App\Models\iuranModel::where('no_kk', $item->no_kk)
              ->where('jenis_iuran', 'Paguyuban')
              ->whereMonth('created_at', now()->month)
              ->whereYear('created_at', now()->year)
              ->exists();
              @endphp
              @if(!$existingData)
              <option value="{{ $item->no_kk }}">{{ $item->nama_kepala_keluarga }}</option>
              @endif
              @endforeach
            </select>
            @error('no_kk')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="nominal_kas">Nominal:</label>
            <input type="number" class="form-control" id="nominal" name="nominal" value="{{ old('nominal') }}" required>
            @error('nominal')
            <small class="form-text text-danger">{{ $message }}</small> @enderror
          </div>
          <input type="hidden" id="jenis_iuran" name="jenis_iuran" value="Paguyuban">
          <div class="text-center">
            <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal tambahan untuk Edit KAS -->
<div class="modal fade editKasModal" id="editKasModal" tabindex="-1" role="dialog" aria-labelledby="editKasModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editKasModalLabel">Ubah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulir untuk mengedit data KAS -->
        <form id="editPengeluaranForm" action="{{ url('/bendahara/pemasukan/update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" id="id_iuran" name="id_iuran">
          <div class="form-group">
            <label for="warga_kas">Pilih Warga:</label>
            <select class="form-control" id="no_kk" name="no_kk" required>
              <option value="">- Pilih Warga -</option> @foreach($kk as $item)
              <option value="{{ $item->no_kk }}">{{ $item->nama_kepala_keluarga }}</option>
              @endforeach
            </select> @error('no_kk')
            <small class="form-text text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="form-group">
            <label for="nominal">Nominal:</label>
            <input type="number" class="form-control" id="edit_nominal" name="nominal">
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Edit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal untuk konfirmasi hapus data -->
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
        <form id="hapusForm" action="{{url('/bendahara/pemasukan/destroy')}}" method="post">
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
@endpush

@push('js')
<script>
  // Fungsi untuk menampilkan modal tambahan berdasarkan jenis pemasukan yang dipilih
  document.getElementById('kasButton').addEventListener('click', function() {
    $('#kasModal').modal('show');
  });

  document.getElementById('paguyubanButton').addEventListener('click', function() {
    $('#paguyubanModal').modal('show');
  });

  $(document).on('click', '.btn-edit', function() {
    var jenisPemasukan = $(this).data('jenis');
    var ids = $(this).data('id');
    $('.modal-body #id_iuran').val(ids); // Atur nilai input dengan ID yang didapat dari tombol
    $.ajax({
      url: "{{ url('/bendahara/pemasukan/edit') }}", // Ganti URL dengan URL yang sesuai
      type: "POST",
      dataType: "json",
      data: {
        id_iuran: ids
      },
      success: function(response) {
        // Set nilai input dalam formulir modal dengan respons dari permintaan AJAX
        $('.modal-body #no_kk').val(response.no_kk);
        $('.modal-body #nominal').val(response.nominal);
        // Isi formulir lainnya sesuai kebutuhan Anda
      },
      error: function(xhr, status, error) {
        // Tangani kesalahan yang terjadi
      }
    });
    $('#editKasModal').modal('show');
  });

  // Fungsi untuk menampilkan modal hapus data
  document.querySelectorAll('.btn-delete').forEach(function(btnDelete) {
    btnDelete.addEventListener('click', function() {
      var form = btnDelete.closest('tr').querySelector('form#hapusForm');
      $('#hapusModal').find('form#hapusForm').attr('action', form.action);
      $('#hapusModal').modal('show');
    });
  });
</script>

<script>
  $(document).ready(function() {
    var dataPemasukan = $('#table_pemasukan').DataTable({
      serverSide: true, //jika ingin menggunakan server side processing
      ajax: {
        "url": "{{ url('bendahara/pemasukan/list') }}",
        "dataType": "json",
        "type": "POST",
        "data": function(d) {
          d.no_kk = $('#no_kk').val();
        }
      },
      columns: [{
        data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColimn()
        className: "text-center",
        orderable: false,
        searchable: false
      }, {
        data: "nominal",
        className: "",
        orderable: true, //jika ingin kolom bisa urut
        searchable: true // jika kolom bisa dicari
      }, {
        data: "jenis_iuran",
        className: "",
        orderable: true, //jika ingin kolom bisa urut
        searchable: true // jika kolom bisa dicari
      }, {
        data: "kk.nama_kepala_keluarga",
        className: "",
        orderable: true, //jika ingin kolom bisa urut
        searchable: true // jika kolom bisa dicari
      }, {
        data: "created_at_formatted", // menggunakan kolom formatted yang telah ditambahkan pada controller
        className: "",
        orderable: true, // jika ingin kolom bisa urut
        searchable: true // jika kolom bisa dicari
      }, {
        data: null,
        classname: "",
        orderable: false, //orderable true jika ingin kolom bisa diurutkan
        searchable: false, //searchable true jika ingin kolom bisa dicari
        render: function(data, type, row) {
          return '<a href="#" class="btn btn-success btn-sm btn-edit" data-id="' + row.id_iuran + '"><i class="fas fa-pen"></i></a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="' + row.id_iuran + '"><i class="fas fa-trash"></i></a>';
        }
      }]
    });

    $('#id_iuran').on('change', function() {
      dataPemasukan.ajax.reload();
    });

    $(document).on("click", ".btn-delete", function() {
      var ids = $(this).data('id');
      $(".modal-footer #id_iuran").val(ids);
    });
  });
</script>
@endpush