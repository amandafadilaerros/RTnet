@extends('layouts.template')

@section('content')
<div class="row">
  <div class="col-md-3 mb-4">
    <div class="input-group float-right">
        <select class="form-control" id="searchOption" style="border-radius: 20px;">
            <option value="" selected disabled>Filter</option>
            <option value="tersedia">Tersedia</option>
            <option value="dipinjam">Dipinjam</option>
        </select>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
      <table class="table table-hover table-striped" id="inventaris_table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal untuk melihat detail peminjam -->
<div class="modal fade" id="viewModalAnggota" tabindex="-1" role="dialog" aria-labelledby="viewModalAnggotaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-header" style="background-color: #424874; color: white; border-radius: 25px 25px 0 0;">
        <h5 class="modal-title" id="viewModalAnggotaLabel">Detail Peminjam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Nama Kepala Keluarga: <span id="nama_kepala_keluarga"></span></p>
        <p>Alamat: <span id="alamat"></span></p>
        <p>No Rumah: <span id="no_rumah"></span></p>
      </div>
      <div class="modal-footer" style="border-radius: 0 0 25px 25px;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 20px;">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Peminjaman Barang -->
<div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-header" style="background-color: #424874; color: white; border-radius: 25px 25px 0 0;">
        <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Peminjaman Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="pinjamBarangForm" action="{{ url('penduduk/daftar_inventaris/pinjam/barang') }}" method="POST">
          @csrf
          <p id="konfirmasiText">Anda ingin meminjam inventaris <span id="nama_barang"></span> ?</p>
          <input type="hidden" class="form-control" id="id_inventaris" name="id_inventaris">
      </div>
      <div class="modal-footer" style="border-radius: 0 0 25px 25px;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 20px;">Batal</button>
        <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width: 200px;">Pinjam</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection

@push('css')
<style>
  .dataTables_filter {
      display: none;
  }
  #searchOption option:hover {
    outline: none; /* Remove default focus outline */
    border-color: #424874; /* Change border color to match the desired color */
    box-shadow: 0 0 0 0.2rem rgba(66, 72, 116, 0.25); /* Add a box shadow to simulate focus effect */
  }
</style>
@endpush

@push('js')
<script>
$(document).ready(function() {
    var inventaris = $('#inventaris_table').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: "{{ url('penduduk/daftar_inventaris/list') }}",
            type: "POST",
            data: function(d) {
                d.status = $('#searchOption').val(); // Mengirimkan filter status ke server
            }
        },
        columns: [
            { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
            { 
              data: "gambar",
                  classname: "",
                  orderable: false, //orderable false jika ingin kolom bisa diurutkan
                  searchable: false, //searchable false jika ingin kolom bisa dicari
                  render: function(data, type, full, meta) {
                        var baseUrl = '{{ asset('storage/inventaris/') }}';
                        return '<img src="'+ baseUrl+'/' + data + '" alt="Gambar inventaris" style="max-width: 100px; max-height: 100px;">';
                      }
            },
            { data: "inventaris.nama_barang", className: "text-center", orderable: true, searchable: true },
            { data: "aksi", className: "text-center", orderable: false, searchable: false }
        ]
    });

    // Event listener untuk filter status
    $('#searchOption').on('change', function() {
        inventaris.draw(); // Redraw tabel dengan filter baru
    });

    $(document).on('click', '.btn-danger', function() {
        var noKK = $(this).data('no-kk');
        console.log("Fetching data for no_kk: " + noKK);

        if (noKK === undefined) {
            console.error("no_kk is undefined");
            return;
        }

        $.ajax({
            url: "{{ url('penduduk/daftar_inventaris/show/{request}') }}",
            type: "POST",
            dataType: "json",
            data: { no_kk: noKK },
            success: function(response) {
                console.log(response);

                if (response.error) {
                    console.error("Error: " + response.error);
                    alert("Data tidak ditemukan.");
                } else {
                    $('#nama_kepala_keluarga').text(response.nama_kepala_keluarga || 'Data tidak tersedia');
                    $('#alamat').text(response.alamat || 'Data tidak tersedia');
                    $('#no_rumah').text(response.no_rumah || 'Data tidak tersedia');
                    $('#viewModalAnggota').modal('show');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", xhr.responseText);
                alert("Terjadi kesalahan saat mengambil data.");
            }
        });
    });

    $(document).on('click', '.pinjam-btn', function() {
        var idInventaris = $(this).data('id');
        var namaBarang = $(this).data('nama-barang');
    

        $('#id_inventaris').val(idInventaris); // Set value pada input hidden di modal
        $('#id_inventaris_display').text(idInventaris); // Set ID untuk ditampilkan di modal
        $('#nama_barang').text(namaBarang); // Set nama barang di modal konfirmasi
      

        $('#konfirmasiModal').modal('show'); // Tampilkan modal
    });

    $('#searchButton').on('click', function() {
        var keyword = $('#searchOption').val().toLowerCase();
        inventaris.search(keyword).draw();
    });

});
</script>
@endpush
