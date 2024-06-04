@extends('layouts.template')

@section('content')
<div class="row mb-4">
    <div class="col-md-9">
        <form id="exportForm" method="POST" action="{{ url('ketuaRt/data_penduduk/exportPDF') }}">
            @csrf
            <input type="hidden" name="selected_niks" id="selected_niks">
            <button type="button" class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #ff0000; width: 20%; border-color: red;" id="exportPDFButton">Eksport PDF</button>
        </form>
    </div>
    <div class="col-md-3" style="">
        <div class="row">
            <input type="text" id="customSearchBox" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
            <button class="btn btn-primary" id="customSearchButton" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
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
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="table_data_penduduk">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">No. KK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tempat</th>
                        <th scope="col">Tgl Lahir</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Gol. Darah</th>
                        <th scope="col">Agama</th>
                        <th scope="col">Status Perkawinan</th>
                        <th scope="col">Pekerjaan</th>
                        <th scope="col">Status Keluarga</th>
                        <th scope="col">Status Anggota</th>
                        <th scope="col">Jenis Penduduk</th>
                        <th scope="col">Tgl Msuk</th>
                        <th scope="col">Tgl Keluar</th>
                        <th scope="col">Dokumen</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@push('css')

@push('js')
<script>
    $(document).ready(function() {
        var dataPenduduk = $('#table_data_penduduk').DataTable({
            serverSide: true,
            searching: false,
            ajax: {
                "url": "{{ url('ketuaRt/data_penduduk/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    d.nik = $('#nik').val();
                    d.customSearch = $('#customSearchBox').val();
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "nik",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "no_kk",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "nama",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "tempat",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "tanggal_lahir",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "jenis_kelamin",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "golongan_darah",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "agama",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "status_perkawinan",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "pekerjaan",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "status_keluarga",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "status_anggota",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "jenis_penduduk",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "tgl_masuk",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "tgl_keluar",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "dokumen",
                    className: "",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        return '<img src="' + data + '" alt="Gambar KK" style="max-width: 100px; max-height: 100px;">';
                    }
                },  {
                    data: "aksi",
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                }
            ]
        });

        $('#nik').on('input', function() {
            dataPenduduk.ajax.reload();
        });

        $('#customSearchButton').on('click', function() {
            dataPenduduk.ajax.reload();
        });

        $('#customSearchBox').on('keyup', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                dataPenduduk.ajax.reload();
            }
        });

        $('#formSearch').on('submit', function(e) {
            e.preventDefault();
            dataPenduduk.ajax.reload();
        });
        
    });
</script>
@endpush
