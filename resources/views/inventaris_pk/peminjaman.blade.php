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


        @if ($minjams->count() > 0)
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
                        <button class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #747998; min-width: 170px; max-width: 70%;" type="submit" data-target="#pengembalian">Selesai</button>
                        @else
                        <button class="btn btn-sm btn-primary mt-1 btn-edit" style="border-radius: 20px; background-color: #424874; min-width: 170px; max-width: 70%;" type="button" data-toggle="modal" data-target="#pengembalian" data-id="{{ $minjam->id_peminjaman }}">Kembalikan</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>Tidak ada data peminjaman saat ini.</p>
        @endif
    </div>
</div>

<!-- Modal untuk peminjaman barang -->
<div class="modal fade" id="pengembalian" tabindex="-1" role="dialog" aria-labelledby="pengembalianLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 25px;">
            <div class="modal-header">
                <h5 class="modal-title" id="pengembalianLabel">Detail Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="{{ url('peminjaman') }}" method="POST" class="form-horizontal">
                        @csrf
                        {{ method_field('PUT') }}
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
            var id = $(this).data('id');
            $(".modal-body #id").val(id);
        });
    });
</script>
@endpush
