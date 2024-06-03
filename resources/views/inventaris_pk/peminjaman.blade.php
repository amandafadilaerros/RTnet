@extends('layouts.template')

@section('content')
<div class="row">
  <div class="col-md-8">
      <!-- Filter -->
      <div class="col-md-4">
          
      </div>
  </div>
  <!-- Search -->
  <div class="col-md-4">
      <div class="row">
            <input type="text" class="form-control" id="searchInput" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
            <div class="input-group-append">
            
                <button class="btn btn-primary" id="searchButton" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
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
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="table_user">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tanggal Peminjaman</th>
                        <th scope="col">Tanggal Pengembalian</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($minjams as $minjam)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $minjam->inventaris->nama_barang }}</td>
                            <td>{{ $minjam->tanggal_peminjaman }}</td>
                            <td>{{ $minjam->tanggal_kembali }}</td>
                            <td>
                                @if ($minjam->tanggal_kembali)
                                    <button class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; min-width: 170px; background-color: #747998;">Selesai</button>
                                    @else
                                    {{-- <button class="btn btn-sm btn-primary mt-1 btn-edit" style="border-radius: 20px; min-width: 170px; background-color: #424874;" data-toggle="modal" data-target="#pengembalian" data-id="{{ $minjam->id_peminjaman }}">Kembalikan</button> --}}
                                    <button class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; min-width: 170px; background-color: #747998;">Belum Selesai</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($minjams->isEmpty())
            <p class="text-center">Tidak ada data peminjaman.</p>
        @endif
    </div>
</div>

<!-- Modal Peminjaman Barang -->
<div class="modal fade" id="pengembalian" tabindex="-1" role="dialog" aria-labelledby="pengembalian" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 25px;">
            <div class="modal-header">
                <h5 class="modal-title" id="pengembalianLabel">Detail Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('penduduk/peminjaman/update') }}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <button type="submit" class="btn btn-primary" style="border-radius: 20px; width: 200px; background-color: #424874;">Kembalikan</button>
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
@endpush
@push('js')
<script>
  
    $(document).ready(function() {
        // Inisialisasi DataTable
        $('#table_user').DataTable();

        // Tambahkan event click untuk tombol edit
        $(document).on("click", ".btn-edit", function() {
            var id = $(this).data('id');
            $("#id").val(id);
        });

        // Fungsi pencarian
        $("#searchButton").click(function() {
            var searchText = $("#searchInput").val().toLowerCase();
            $('#table_user').DataTable().search(searchText).draw();
        });
    });
</script>
@endpush
