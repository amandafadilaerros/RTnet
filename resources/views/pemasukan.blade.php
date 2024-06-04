@extends('layouts.template')
@section('content')
<div class="row">
  <div class="col-md-6 mb-4">
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
  <table class="table table-hover table-striped" id="table_pemasukan">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nominal</th>
        <th scope="col">Jenis Pemasukan</th>
        <th scope="col">Nama Penduduk</th>
        <th scope="col">Pembayaran Bulan Ke</th>
        <th scope="col">Tanggal Pembayaran</th>
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
        <form method="POST" action="{{ url('bendahara/pemasukan/tambah') }}" class="form-horizontal">
          @csrf
          <div class="form-group">
            <label for="warga_kas">Pilih Warga:</label>
            <select class="form-control" id="no_kk" name="no_kk" required>
              <option value="">- Pilih Warga -</option>
              @foreach($kk as $item)
              <option value="{{ $item->no_kk }}">{{ $item->nama_kepala_keluarga }}</option>
              @endforeach
            </select>
            @error('no_kk')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="bulan_mulai">Bulan Mulai:</label>
            <input type="month" class="form-control" id="bulan_mulai" name="bulan_mulai" required>
            @error('bulan_mulai')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="bulan_selesai">Bulan Selesai:</label>
            <input type="month" class="form-control" id="bulan_selesai" name="bulan_selesai">
            @error('bulan_selesai')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="nominal_kas">Nominal:</label>
            <input type="number" class="form-control" id="nominal" name="nominal" value="{{ old('nominal') }}" readonly>
            @error('nominal')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
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

<!-- Modal tambahan untuk Paguyuban -->
<div class="modal fade" id="paguyubanModal" tabindex="-1" role="dialog" aria-labelledby="paguyubanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paguyubanModalLabel">Tambah Data Paguyuban</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('bendahara/pemasukan/tambah') }}" class="form-horizontal">
          @csrf
          <div class="form-group">
            <label for="warga_paguyuban">Pilih Warga:</label>
            <select class="form-control" id="no_kk_paguyuban" name="no_kk" required>
              <option value="">- Pilih Warga -</option>
              @foreach($kkPaguyuban as $item)
              <option value="{{ $item->no_kk }}">{{ $item->nama_kepala_keluarga }}</option>
              @endforeach
            </select>
            @error('no_kk')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="bulan_mulai_paguyuban">Bulan Mulai:</label>
            <input type="month" class="form-control" id="bulan_mulai_paguyuban" name="bulan_mulai" required>
            @error('bulan_mulai')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="bulan_selesai_paguyuban">Bulan Selesai:</label>
            <input type="month" class="form-control" id="bulan_selesai_paguyuban" name="bulan_selesai">
            @error('bulan_selesai')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="nominal_paguyuban">Nominal:</label>
            <input type="number" class="form-control" id="nominal_paguyuban" name="nominal" value="{{ old('nominal') }}" readonly>
            @error('nominal')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <input type="hidden" id="jenis_iuran_paguyuban" name="jenis_iuran" value="Paguyuban">
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
            <input type="number" class="form-control" id="nominal" name="nominal">
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
  document.getElementById('kasButton').addEventListener('click', function() {
    $('#kasModal').modal('show');
    setupModalEvents('Kas', 20000, 'no_kk', 'bulan_mulai', 'bulan_selesai', 'nominal');
  });

  document.getElementById('paguyubanButton').addEventListener('click', function() {
    $('#paguyubanModal').modal('show');
    setupModalEvents('Paguyuban', 15000, 'no_kk_paguyuban', 'bulan_mulai_paguyuban', 'bulan_selesai_paguyuban', 'nominal_paguyuban');
  });

  function setupModalEvents(jenis_iuran, defaultNominal, noKkId, bulanMulaiId, bulanSelesaiId, nominalId) {
    $('#' + noKkId).off('change').on('change', function() {
      var no_kk = $(this).val();

      if (no_kk) {
        $.ajax({
          url: "{{ url('/bendahara/pemasukan/checkIuran') }}",
          type: 'GET',
          data: {
            no_kk: no_kk,
            jenis_iuran: jenis_iuran
          },
          success: function(response) {
            var baseNominal = defaultNominal;
            var bulanMulai = response.bulanSelanjutnya;

            if (jenis_iuran === 'Kas') {
              if (response.count_no_kk > 1) {
                baseNominal = 10000;
              } else if (response.status_rumah === 'Kos Kecil') {
                baseNominal = 15000;
              } else if (response.status_rumah === 'Kos Besar') {
                baseNominal = 20000;
              } else {
                baseNominal = 12000;
              }
            } else {
              baseNominal = 15000;
            }

            $('#' + bulanMulaiId).val(bulanMulai);
            $('#' + nominalId).val(baseNominal);

            updateNominalBasedOnMonths(baseNominal, bulanMulaiId, bulanSelesaiId, nominalId);
          }
        });
      }
    });

    $('#' + bulanMulaiId + ', #' + bulanSelesaiId).off('change').on('change', function() {
      updateNominalBasedOnMonths(defaultNominal, bulanMulaiId, bulanSelesaiId, nominalId);
    });

    // Validasi bulan mulai dan bulan selesai
    $('#' + bulanMulaiId + ', #' + bulanSelesaiId).change(function() {
      var bulanMulai = $('#' + bulanMulaiId).val();
      var bulanSelesai = $('#' + bulanSelesaiId).val();

      if (bulanMulai && bulanSelesai) {
        if (bulanSelesai < bulanMulai) {
          alert('Bulan selesai tidak boleh sebelum bulan mulai.');
          $('#' + bulanSelesaiId).val(''); // Kosongkan input bulan selesai
        }
      }
    });
  }

  function updateNominalBasedOnMonths(baseNominal, bulanMulaiId, bulanSelesaiId, nominalId) {
    var bulanMulai = $('#' + bulanMulaiId).val();
    var bulanSelesai = $('#' + bulanSelesaiId).val();
    var nominal = baseNominal; // Nilai default

    if (bulanMulai && !bulanSelesai) {
      $('#' + nominalId).val(nominal);
    } else if (bulanMulai && bulanSelesai) {
      var startDate = new Date(bulanMulai);
      var endDate = new Date(bulanSelesai);
      var diffInMonths = (endDate.getFullYear() - startDate.getFullYear()) * 12 + endDate.getMonth() - startDate.getMonth() + 1;

      if (diffInMonths === 1) {
        $('#' + nominalId).val(nominal);
      } else {
        nominal = nominal * diffInMonths;
        $('#' + nominalId).val(nominal);
      }
    }
  }


  $(document).ready(function() {
    // Event listener untuk tombol edit
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

    // Event listener untuk tombol hapus
    $(document).on('click', '.btn-delete', function() {
      var ids = $(this).data('id');
      $(".modal-footer #id_iuran").val(ids);
      $('#hapusModal').modal('show'); // Tampilkan modal hapus
    });
  });
</script>

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var dataPemasukan = $('#table_pemasukan').DataTable({
      serverSide: true,
      ajax: {
        url: "{{ url('bendahara/pemasukan/list') }}",
        type: "POST",
        data: function(d) {
          d.search = $('#search').val();
        },
        error: function(xhr, error, thrown) {
          console.log('Error fetching data: ', error);
          console.log('XHR: ', xhr);
          console.log('Thrown: ', thrown);
          alert('An error occurred while fetching data.');
        }
      },
      columns: [{
          data: "DT_RowIndex",
          className: "text-center",
          orderable: false,
          searchable: false
        },
        {
          data: "nominal",
          className: "",
          orderable: true,
          searchable: true
        },
        {
          data: "jenis_iuran",
          className: "",
          orderable: true,
          searchable: true
        },
        {
          data: "kk.nama_kepala_keluarga",
          className: "",
          orderable: true,
          searchable: true
        },
        {
          data: "bulan_formatted",
          className: "",
          orderable: true,
          searchable: true
        },
        {
          data: "transaksi_formatted",
          className: "",
          orderable: true,
          searchable: true
        },
        {
          data: null,
          className: "",
          orderable: false,
          searchable: false,
          render: function(data, type, row) {
            return '<a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="' + row.id_iuran + '"><i class="fas fa-trash"></i></a>';
          }
        }
      ],
      initComplete: function() {
        console.log('DataTable initialized');
      }
    });

    $('#search').on('input', function() {
      dataPemasukan.ajax.reload();
    });
  });



  $('#id_iuran').on('change', function() {
    dataPemasukan.ajax.reload();
  });

  $('#searchForm').on('submit', function(e) {
    e.preventDefault(); // Mencegah form untuk submit
    dataPemasukan.ajax.reload(); // Memuat ulang data tabel dengan pencarian yang baru
  });

  $(document).on("click", ".btn-delete", function() {
    var ids = $(this).data('id');
    $(".modal-footer #id_iuran").val(ids);
  });
</script>
@endpush