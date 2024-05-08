@extends('layouts.template')

@section('content')

<div class="row">
  
  <div class="col-md-3 mb-4"> <!-- Mengubah kelas col-md-8 menjadi col-md-3 -->
    <div class="input-group float-right">
        <input type="text" class="form-control" id="searchInput" style="border-radius: 20px;" placeholder="Cari berdasarkan nama barang...">
    </div>
</div>

  <div class="col-md-4">
    <div class="input-group">
      <input type="date" class="form-control" id="searchDate" style="border-radius: 20px;" placeholder="Cari berdasarkan tanggal...">
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
            <th scope="col">ID Inventaris</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Aksi</th>
            
        </tr>
    </thead>
    </table>
  </div>
</div>
@push('css')
<style>
  /* Menyembunyikan fitur pencarian di tabel */
  .dataTables_filter {
      display: none;
  }
</style>

    <!-- Tambahkan CSS tambahan jika diperlukan -->
@endpush


@endsection

@push('js')
<script>
   $(document).ready(function() {
    var inventaris = $('#inventaris_table').DataTable({
        serverSide: true,   // Jika ingin menggunakan server-side processing
        searching: true,    // Mengaktifkan fitur pencarian
        
        ajax: {
            "url": "{{ url('penduduk/daftar_inventaris/list') }}", // Ganti URL dengan endpoint yang sesuai
            "dataType": "json",
            "type": "POST"
        },
        columns: [
            {
                data: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false
            },
            // Kolom untuk menampilkan gambar
            {
                data: "id_gambar",
                className: "",
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    if (data) {
                        return '<img data-id-gambar="' + row.id_inventaris + '" width="50" height="50">';
                    } else {
                        return '<img src="placeholder.png" width="50" height="50">'; // Replace with placeholder image path
                    }
                }
            },
            {
                // Kolom untuk nama barang
                data: "nama_barang",
                className: "",
                orderable: true,
                searchable: true
            },
            // Kolom untuk aksi (Dipinjam/Tersedia)
            {
              data: "aksi",
                className: "text-center",
                orderable: false,
                searchable: false,
            }
        ]
    });
    
    // Fungsi untuk melakukan pencarian saat tombol "Cari" ditekan
    $('#searchButton').on('click', function() {
        var keyword = $('#searchInput').val().toLowerCase();
        inventaris.search(keyword).draw();
    });
    

    // Fungsi untuk melakukan pencarian berdasarkan tanggal
    $('#searchButton').click(function() {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        // Kirim permintaan AJAX ke server dengan parameter startDate dan endDate
        $.ajax({
            url: 'pencarian.php',
            type: 'GET',
            data: { startDate: startDate, endDate: endDate },
            success: function(response) {
                // Tampilkan hasil pencarian di sini
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
    
    // Menampilkan gambar inventaris
    $('#table_inventaris').on('draw.dt', function() {
        $('img[data-id-gambar]').each(function() {
            var idInventaris = $(this).data('id-gambar');
            var imgElement = $(this); // Simpan referensi objek gambar
            
            $.ajax({
                url: "http://localhost/RTnet/public/inventaris/image/" + idInventaris,
                type: 'GET',
                success: function(response) {
                    var imageData = 'data:' + response.mimeType + ';base64,' + response.imageData;
                    imgElement.attr('src', imageData);
                },
                error: function() {
                    imgElement.attr('src', 'placeholder.png');
                }
            });
        });
    });
    
    
});

    
</script>
@endpush
