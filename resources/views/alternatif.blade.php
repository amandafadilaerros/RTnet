@extends('layouts.template')
@section('content')
<div class="row">
    <div class="col-md-8">
        <a class="btn btn-sm btn-primary" style="border-radius: 20px; background-color: #424874; margin-bottom: 10px;" data-toggle="modal" data-target="#tambahModal">Tambah</a>
    </div>
    <div class="col-md-4" style="">
        <div class="row">
            <input type="text" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
            <button class="btn btn-primary" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
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
    <table class="table table-hover table-striped" id="table_alternatif">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Alternatif</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
</div>
<!-- Modal tambah alternatif -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Alternatif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambahPengumumanForm" action="{{url('/ketuaRt/alternatif')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_alternatif" style="color: #424874;">Kegiatan</label>
                        <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif" required>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_pelaksanaan" style="color: #424874;">Kemudahan Pelaksanaan</label>
                        <select class="form-control" id="kemudahan_pelaksanaan" name="kemudahan_pelaksanaan">
                            <option value="1">Sangat Rendah</option>
                            <option value="2">Rendah</option>
                            <option value="3">Cukup</option>
                            <option value="4">Tinggi</option>
                            <option value="5">Sangat Tinggi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_pelaksanaan" style="color: #424874;">Jumlah Partisipan</label>
                        <select class="form-control" id="jumlah_partisipan" name="jumlah_partisipan">
                            <option value="1">1 - 5 Orang</option>
                            <option value="2">6 - 10 Orang</option>
                            <option value="3">11 - 15 Orang</option>
                            <option value="4">16 - 20 Orang</option>
                            <option value="5">> 20 Orang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_pelaksanaan" style="color: #424874;">Tingkat Urgensi</label>
                        <select class="form-control" id="tingkat_urgensi" name="tingkat_urgensi">
                            <option value="1">Sangat Rendah</option>
                            <option value="2">Rendah</option>
                            <option value="3">Cukup</option>
                            <option value="4">Tinggi</option>
                            <option value="5">Sangat Tinggi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_pelaksanaan" style="color: #424874;">Dampak Sosial</label>
                        <select class="form-control" id="dampak_sosial" name="dampak_sosial">
                            <option value="1">Sangat Rendah</option>
                            <option value="2">Rendah</option>
                            <option value="3">Cukup</option>
                            <option value="4">Tinggi</option>
                            <option value="5">Sangat Tinggi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_pelaksanaan" style="color: #424874;">Dana Yang Dibutuhkan</label>
                        <select class="form-control" id="tingkat_uang" name="tingkat_uang">
                            <option value="1">&lt; 200.000</option>
                            <option value="2">200.000 &le; - &lt; 400.000</option>
                            <option value="3">400.000 &le; - &lt; 600.000</option>
                            <option value="4">600.000 &le; - &lt; 800.000</option>
                            <option value="5">&ge; 800.000</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal edit pengeluaran -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Alternatif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPengumumanForm" action="{{url('/ketuaRt/alternatif/edit')}}" method="POST">
                    @csrf
                    <input type="hidden" id="id_alternatif_edit" name="id_alternatif" value="">
                    <div class="form-group">
                        <label for="nama_alternatif" style="color: #424874;">Kegiatan</label>
                        <input type="text" class="form-control" id="nama_alternatif_edit" name="nama_alternatif" required>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_pelaksanaan" style="color: #424874;">Kemudahan Pelaksanaan</label>
                        <select class="form-control" id="kemudahan_pelaksanaan_edit" name="kemudahan_pelaksanaan">
                            <option value="1">Sangat Rendah</option>
                            <option value="2">Rendah</option>
                            <option value="3">Cukup</option>
                            <option value="4">Tinggi</option>
                            <option value="5">Sangat Tinggi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_pelaksanaan" style="color: #424874;">Jumlah Partisipan</label>
                        <select class="form-control" id="jumlah_partisipan_edit" name="jumlah_partisipan">
                            <option value="1">1 - 5 Orang</option>
                            <option value="2">6 - 10 Orang</option>
                            <option value="3">11 - 15 Orang</option>
                            <option value="4">16 - 20 Orang</option>
                            <option value="5">> 20 Orang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_pelaksanaan" style="color: #424874;">Tingkat Urgensi</label>
                        <select class="form-control" id="tingkat_urgensi_edit" name="tingkat_urgensi">
                            <option value="1">Sangat Rendah</option>
                            <option value="2">Rendah</option>
                            <option value="3">Cukup</option>
                            <option value="4">Tinggi</option>
                            <option value="5">Sangat Tinggi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_pelaksanaan" style="color: #424874;">Dampak Sosial</label>
                        <select class="form-control" id="dampak_sosial_edit" name="dampak_sosial">
                            <option value="1">Sangat Rendah</option>
                            <option value="2">Rendah</option>
                            <option value="3">Cukup</option>
                            <option value="4">Tinggi</option>
                            <option value="5">Sangat Tinggi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_pelaksanaan" style="color: #424874;">Dana Yang Dibutuhkan</label>
                        <select class="form-control" id="tingkat_uang_edit" name="tingkat_uang">
                            <option value="1">&lt; 200.000</option>
                            <option value="2">200.000 &le; - &lt; 400.000</option>
                            <option value="3">400.000 &le; - &lt; 600.000</option>
                            <option value="4">600.000 &le; - &lt; 800.000</option>
                            <option value="5">&ge; 800.000</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="border-radius: 20px; background-color: #424874; width:200px;">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- hapus modal --}}
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
                <form id="hapusForm" action="{{url('/ketuaRt/alternatif/delete')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id_alternatif" id="id_alternatif">
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
    $(document).ready(function() {
        var dataBarang = $('#table_alternatif').DataTable({
            serverSide: true,
            searching: false,
            ajax: {
                "url": "{{ url('ketuaRt/alternatif/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    d.id_alternatif = $('#id_alternatif').val();
                }
            },
            columns: [{
                data: "DT_RowIndex", //nomor urut dari laravel datatable addindexcolumn()
                classname: "text-center",
                orderable: false,
                searchable: false
            }, {
                data: "nama_alternatif",
                classname: "",
                orderable: false, //orderable false jika ingin kolom bisa diurutkan
                searchable: false, //searchable false jika ingin kolom bisa dicari
            }, {
                data: null,
                classname: "",
                orderable: false, //orderable true jika ingin kolom bisa diurutkan
                searchable: false, //searchable true jika ingin kolom bisa dicari
                render: function(data, type, row) {
                    return '<a href="#" class="btn btn-success btn-sm btn-edit" data-toggle="modal" data-target="#editModal" data-id="' + row.id_alternatif + '"><i class="fas fa-pen"></i></a> <a href="#" class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#hapusModal" data-id="' + row.id_alternatif + '"><i class="fas fa-trash"></i></a>';
                }
            }]
        });
        $('#kategori_id').on('change', function() {
            dataBarang.ajax.reload();
        });
        $(document).on("click", ".btn-edit", function() {
            var id_alternatif = $(this).data('id');
            $("#id_alternatif_edit").val(id_alternatif);

            // Menggunakan AJAX untuk mengambil data alternatif dan nilai-nilai matrik
            $.ajax({
                url: "{{ url('ketuaRt/alternatif/getData') }}",
                type: "POST",
                dataType: "json",
                data: {
                    id_alternatif: id_alternatif
                },
                success: function(response) {
                    // Mengisi nilai input dalam formulir modal dengan respons dari permintaan AJAX
                    $('#nama_alternatif_edit').val(response.nama_alternatif.nama_alternatif);
                    for (let i = 0; i < response.nilai_matrik.length; i++) {
                        const nilaiMatrik = response.nilai_matrik[i];

                        // Kemudahan Pelaksanaan
                        if (nilaiMatrik.id_kriteria === 1) {
                        $('#kemudahan_pelaksanaan_edit').val(nilaiMatrik.nilai);
                        } else if (nilaiMatrik.id_kriteria === 2) {
                            $('#jumlah_partisipan_edit').val(nilaiMatrik.nilai);
                        } else if (nilaiMatrik.id_kriteria === 3) {
                            $('#tingkat_urgensi_edit').val(nilaiMatrik.nilai);
                        } else if (nilaiMatrik.id_kriteria === 4) {
                            $('#dampak_sosial_edit').val(nilaiMatrik.nilai);
                        } else if (nilaiMatrik.id_kriteria === 5) {
                            $('#tingkat_uang_edit').val(nilaiMatrik.nilai);
                        }
                        // console.log(nilaiMatrik.nilai);
                    }
                },
                error: function(xhr, status, error) {
                    // Tangani kesalahan yang terjadi
                    console.error(xhr);
                }
            });
        });


        $(document).on("click", ".btn-delete", function() {
            var ids = $(this).data('id');
            $(".modal-footer #id_alternatif").val(ids);
        });
    });
</script>
@endpush