@extends('layouts.template')

@section('content')
<div class="row">
  <div class="col-md-3 mb-4">
    <div class="input-group float-right">
        <select class="form-control" id="searchOption" style="border-radius: 20px;">
            <option value="" selected disabled>Cari Barang....</option>
            <option value="tersedia">Tersedia</option>
            <option value="dipinjam">Dipinjam</option>
        </select>
        <div class="input-group-append">
            <button class="btn btn-sm btn-primary mt-1" id="searchButton" style="border-radius: 20px; background-color: #424874; width: 100px;">Cari</button>
        </div>
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
        <p>Anda ingin meminjam barang ini?</p>
      </div>
      <div class="modal-footer" style="border-radius: 0 0 25px 25px;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 20px;">Batal</button>
        <button type="button" class="btn btn-primary" id="btnModalPinjam" style="border-radius: 20px; background-color: #424874; width: 200px;">Pinjam</button>
      </div>
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
            type: "POST"
        },
        columns: [
            { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
            { 
                data: "id_gambar", 
                className: "text-center", 
                orderable: false, 
                searchable: false,
                render: function(data, type, row) {
                    if (data) {
                        return '<img src="{{ url('path/to/images') }}/' + data + '" width="50" height="50">';
                    } else {
                        return '<img src="{{ url('placeholder.png') }}" width="50" height="50">'; 
                    }
                }
            },
            { data: "nama_barang", className: "text-center", orderable: true, searchable: true },
            { data: "aksi", className: "text-center", orderable: true, searchable: true },
           
        ]
    });

    $(document).on("click", ".btn-danger", function () {
    var noKK = $(this).data('no-kk');
    console.log("Fetching data for no_kk: " + noKK); // Debugging

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
            console.log(response); // Log the response for debugging

            if (response.error) {
                console.error("Error: " + response.error);
                alert("Data tidak ditemukan.");
            } else {
                // Set data peminjam ke dalam modal
                $('#nama_kepala_keluarga').text(response.nama_kepala_keluarga || 'Data tidak tersedia');
                $('#alamat').text(response.alamat || 'Data tidak tersedia');
                $('#no_rumah').text(response.no_rumah || 'Data tidak tersedia');

                // Tampilkan modal
                $('#viewModalAnggota').modal('show');
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", xhr.responseText); // Log the error for debugging
            alert("Terjadi kesalahan saat mengambil data.");
        }
        
    });
});
$(document).on("click", ".btn-pinjam", function () {
    var idInventaris = $(this).data('id');
    
    // Tampilkan modal konfirmasi
    $('#konfirmasiModal').modal('show');
});

// Delegasi event untuk tombol "Pinjam" di dalam modal konfirmasi
$(document).on('click', '#btnModalPinjam', function() {
    var idInventaris = $(this).data('id_inventaris'); // Ambil idInventaris dari tempat yang sesuai
    var idPeminjam = $(this).data('id_peminjam'); // Ambil idPeminjam dari tempat yang sesuai
    var tanggalPinjam = $('#tanggal_pinjam').val(); // Ambil tanggal_pinjam dari input form yang sesuai

    $.ajax({
        url: "{{ route('pinjam.barang') }}",
        type: "POST",
        data: {
            id_inventaris: idInventaris,
            id_peminjam: idPeminjam,
            tanggal_peminjaman: tanggalPinjam,
            _token: '{{ csrf_token() }}' // Perhatikan cara penggunaan CSRF token untuk Laravel
        },
        success: function(response) {
            // Handle success
            alert(response.success);
            $('#konfirmasiModal').modal('hide');
            // Reload DataTable or update UI as needed
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert("Terjadi kesalahan saat meminjam barang.");
            $('#konfirmasiModal').modal('hide');
        }
    });
});



    // Search barang
    $('#searchButton').on('click', function() {
        var keyword = $('#searchOption').val().toLowerCase();
        inventaris.search(keyword).draw();
    });

    // Search by date
    $('#searchDateButton').on('click', function() {
        var searchDate = $('#searchDateInput').val();
        
        $.ajax({
            url: "{{ url('penduduk/daftar_inventaris/search-by-date') }}",
            type: "POST",
            data: { searchDate: searchDate },
            success: function(response) {
                inventaris.clear().draw();
                inventaris.rows.add(response).draw();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $('#inventaris_table').on('draw.dt', function() {
        $('img[data-id-gambar]').each(function() {
            var idInventaris = $(this).data('id-gambar');
            var imgElement = $(this);
            
            $.ajax({
                url: "{{ url('inventaris/image') }}/" + idInventaris,
                type: 'GET',
                success: function(response) {
                    var imageData = 'data:' + response.mimeType + ';base64,' + response.imageData;
                    imgElement.attr('src', imageData);
                },
                error: function() {
                    imgElement.attr('src', '{{ url('placeholder.png') }}');
                }
            });
        });
    });
});
</script>
@endpush
