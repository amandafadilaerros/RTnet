@extends('layouts.template')
@section('content')
<div class="col-md-6 offset-md-6 mb-4">
  <div class="input-group">
    <input type="text" class="form-control" style="border-radius: 20px ;margin-left : 200px;" placeholder="Cari...">
    <div class="input-group-append">
      <a class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874; margin-left:10px; width:100px;">Cari</a>
    </div>
  </div>
</div>
<div class="card">
  <div class="card-body">
    @if (session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif

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
      {{-- hanya CONTOH DATA TABEL --}}
      <tbody>
        <tr>
          <td>1</td>
          <td>Sound</td>
          <td>12-04-2024</td>
          <td>17-04-2024</td>
          <td>
            <a href="#" class="btn btn-sm btn-primary" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; width: 100px;" data-jenis="pengembalian" data-toggle="modal" data-target="#detailPeminjamanModal">Kembalikan</i></a>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Karpet</td>
          <td>12-04-2024</td>
          <td>17-04-2024</td>
          <td>
            <a href="#" class="btn btn-sm btn-primary" style="border-radius: 20px; background-color: #727272; margin-bottom: 10px; width: 100px;" data-jenis="detail" data-toggle="modal" data-target="#detailPeminjamanModal">Selesai</i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Pengembalian -->
<div class="modal fade" id="detailPeminjamanModal" tabindex="-1" role="dialog" aria-labelledby="kembalianModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none;">
        <h5 class="modal-title text-center w-100" id="kembalianModalLabel">Detail Peminjaman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Isi dengan formulir untuk memilih warga dan nominal -->
        <form id="kasForm">
          <div class="form-group">
            <label for="warga_kas">Nama Barang</label>
            <input type="text" class="form-control" id="nominal_kas" name="nominal_kas">
          </div>
          <div class="form-group">
            <label for="warga_kas">Jumlah Barang</label>
            <input type="number" class="form-control" id="nominal_kas" name="nominal_kas">
          </div>
          <div class="form-group">
            <label for="tanggalPeminjaman">Tanggal Peminjaman</label>
            <input type="date" class="form-control" id="tanggalPeminjaman" name="tanggalPeminjaman">
          </div>
          <div class="form-group">
            <label for="tanggalPeminjaman">Tanggal Pengembalian</label>
            <input type="date" class="form-control" id="tanggalPeminjaman" name="tanggalPeminjaman">
          </div>
          <button type="submit" id="modalActionBtn" class="btn btn-sm btn-primary mt-1 d-block mx-auto" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px; width: 200px;"></button>
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
    $('#detailPeminjamanModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var jenis = button.data('jenis'); // Extract info from data-* attributes
      var modal = $(this);
      var modalButton = modal.find('#modalActionBtn');
      if (jenis === 'detail') {
        modalButton.text('Selesai').removeClass('btn-primary').addClass('btn-success');
      } else if (jenis === 'pengembalian') {
        modalButton.text('Kembalikan').removeClass('btn-success').addClass('btn-primary');
      }
    });
  });
</script>
@endpush
