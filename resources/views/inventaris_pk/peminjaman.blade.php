@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row justify-content-end">
            <div class="col-md-10">
                <form action="{{url('/penduduk/peminjaman/search')}}" class="form-inline justify-content-end" method="post">
                  @csrf
                    <input type="text" class="form-control form-control-sm mr-sm-2 mt-1" name="search"
                        placeholder="Search Inventaris" value="{{ request('search') }}">
                    <button class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #424874;"
                        type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    @if ($minjams->count() > 0)
      <table class="table table-bordered table-hover table-sm" id="table_user">
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
            <?php $no = 1; ?>
            @foreach ( $minjams as $minjam)
                  <tr>
                      <td>{{$no++}}</td>
                      <td>{{$minjam -> inventaris->nama_barang}}</td>
                      <td>{{$minjam -> tanggal_peminjaman}}</td>
                      <td>{{$minjam -> tanggal_kembali}}</td>
                      <td>
                          @if($minjam->tanggal_kembali)
                          <button class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #747998; min-width: 170px; max-width: 70%;" type="submit" data-target="#pengembalian">Selesai</button>
                          @else
                          <button class="btn btn-sm btn-primary mt-1 btn-edit" style="border-radius: 20px; background-color: #424874; min-width: 170px; max-width: 70%;" type="submit" data-toggle="modal" data-target="#pengembalian" data-id="{{$minjam->id_peminjaman}}">Kembalikan</button>
                          @endif
                      </td>
                  </tr>
            @endforeach
        </tbody>
      </table>
    @else
    @endif

  </div>
</div>
<!-- Peminjaman Barang -->
<div class="modal fade" id="pengembalian" tabindex="-1" role="dialog" aria-labelledby="pengembalian" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-header">
        <h5 class="modal-title" id="pengembalian">Detail Peminjaman</h5>
      <form method="POST" action="{{ url('peminjaman') }}" class="form-horizontal">
        @csrf
        {{ method_field('PUT') }}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </form>
    </div>
    <div class="modal-body">
      <div class="text-center">
        <form action="{{ url('penduduk/peminjaman/update') }}" method="POST">
          @csrf
            <input type="hidden" id="id" name="id" value="">
            <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Kembalikan</button>
          </form>
        </div>
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
    $(document).on("click", ".btn-edit", function() {
      var ids= $(this).data('id');
      $(".modal-body #id").val( ids );
    });
  });
</script>
@endpush