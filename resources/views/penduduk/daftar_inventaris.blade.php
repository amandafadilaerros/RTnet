@extends('layouts.template')

@section('content')

<div class="row">
  <div class="col-md-3 mb-4">
    <div class="input-group float-right">
        <input type="text" class="form-control" id="searchInput" style="border-radius: 20px;" placeholder="Cari barang...">
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
          <th scope="col">No</th>
          <th scope="col">Gambar</th>
          <th scope="col">Nama Barang</th>
          <th scope="col">Aksi</th>
          <th scope="col">Detail Peminjam</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<!-- Modal untuk melihat detail peminjam -->
<div class="modal fade" id="viewModalAnggota" tabindex="-1" role="dialog" aria-labelledby="viewModalAnggotaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewModalAnggotaLabel">Detail Peminjam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><strong>Nama:</strong> <span id="nama"></span></p>
          <p><strong>Jenis Kelamin:</strong> <span id="jenis_kelamin"></span></p>
       
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  

@push('css')
<style>
  .dataTables_filter {
      display: none;
  }
</style>
@endpush

@endsection

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
                        return '<img src="path/to/images/' + data + '" width="50" height="50">';
                    } else {
                        return '<img src="placeholder.png" width="50" height="50">'; 
                    }
                }
            },
            { data: "nama_barang", className: "text-center", orderable: true, searchable: true },
            { data: "aksi", className: "text-center", orderable: true, searchable: true },
            { 
                data: null, 
                className: "text-center", 
                orderable: false, 
                searchable: false,
                render: function(data, type, row) {
                    return '<a href="#" class="btn btn-primary btn-sm btn-view" style="border-radius:5px; background-color: #424874;" data-toggle="modal" data-target="#viewModalAnggota" data-id-peminjam="' + row.id_peminjam + '"><i class="fas fa-eye"></i></a>';
                }
            }
        ]
    });

    $('#inventaris_table').on('click', '.btn-view', function() {
    var idPeminjam = $(this).data('NIK');
    
    $.ajax({
        url: "{{ url('penduduk/daftar_inventaris/show') }}/" + idPeminjam,
        type: "GET",
        success: function(response) {
            $('#nama').text(response.nama);
            $('#jenis_kelamin').text(response.jenis_kelamin);
         
            $('#viewModalAnggota').modal('show');
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});






    $('#searchButton').on('click', function() {
        var keyword = $('#searchInput').val().toLowerCase();
        inventaris.search(keyword).draw();
    });

    $('#searchDate').on('change', function() {
        var searchDate = $('#searchDate').val();
        
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
                    imgElement.attr('src', 'placeholder.png');
                }
            });
        });
    });
});
</script>
@endpush
