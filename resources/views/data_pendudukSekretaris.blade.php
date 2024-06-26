@extends('layouts.template')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <form action="{{ url('sekretaris/data_penduduk/export') }}" method="POST">
            @csrf
            <input type="hidden" id="nik_pdf" name="niks">
            <button id="export-pdf" class="btn btn-sm btn-primary mt-1" style="border-radius: 20px; background-color: #ff0000; width: 20%; border-color: red;">Eksport PDF</button>
        </form>
    </div>
    <div class="col-md-4" style="">
        <div class="row">
            <input type="text" id="customSearchBox" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
            <button class="btn btn-primary" id="customSearchButton" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
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
    <div class="table-responsive">
        <table class="table table-hover table-striped" id="table_data_penduduk">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Aksi</th>
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
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('css')

@push('js')
    <script>
        $(document).ready(function() {
            var dataPenduduk = $('#table_data_penduduk').DataTable({
                serverSide: true,   //jika ingin menggunakan server side processing
                searching: false,
                ajax: {
                    "url": "{{ url('sekretaris/data_penduduk/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.nik = $('#nik').val();
                        d.customSearch = $('#customSearchBox').val();
                    }
                },
                columns: [
                    {
                        data: "DT_RowIndex",    // nomor urut dari laravel datatable addIndexColimn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },{
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return '<input type="checkbox" class="data-checkbox" value="' + full.nik + '">';
                        }
                    }, {
                        data: "nik",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa urut
                        searchable: true        // jika kolom bisa dicari
                    }, {
                        data: "no_kk",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
                    }, {
                        data: "nama",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "tempat",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "tanggal_lahir",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "jenis_kelamin",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "golongan_darah",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "agama",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "status_perkawinan",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "pekerjaan",
                        className: "",
                        orderable: false,        //jika ingin kolom bisa diurutkan 
                        searchable: false        // jika ingin kolom bisa dicari
                    }, {
                        data: "status_keluarga",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "status_anggota",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "jenis_penduduk",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "tgl_masuk",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "tgl_keluar",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }, {
                        data: "dokumen",
                        className: "",
                        orderable: false,       //true, jika ingin kolom diurutkan
                        searchable: false,       //true, jika ingin kolom bisa dicari
                        render: function(data, type, full, meta) {
                            var baseUrl = '{{ asset('storage/ktps/') }}';
                            return '<img src="'+ baseUrl+'/' + data + '" alt="Gambar KK" style="max-width: 100px; max-height: 100px;">';
                        }
                    }
                ]
            });

        $('#nik').on('input', function() {
            dataPenduduk.ajax.reload();
        });

            $('#customSearchButton').on('click', function() {
                dataPenduduk.ajax.reload(); // Reload tabel dengan parameter pencarian baru
             });
            $('#customSearchBox').on('keyup', function(e) {
                if (e.key === 'Enter' || e.keyCode === 13) {
                    dataPenduduk.ajax.reload(); // Reload tabel saat menekan tombol Enter
                }
            });

            $('#formSearch').on('submit', function(e) {
                e.preventDefault(); // Menghentikan perilaku default dari tombol "Cari"
                dataPenduduk.ajax.reload();
            });
            $('#select-all').on('click', function() {
                    var rows = dataPenduduk.rows({ 'search': 'applied' }).nodes();
                    $('input[type="checkbox"]', rows).prop('checked', this.checked);
                });
    
                // Handle Export PDF button click
                $('#export-pdf').on('click', function() {
                    var selectedNiks = [];
                    $('.data-checkbox:checked').each(function() {
                        selectedNiks.push($(this).val());
                    });
    
                    // Update hidden input with comma-separated values
                    $('#nik_pdf').val(selectedNiks.join(','));

                    if (selectedNiks.length > 0) {
                        // Submit the form with updated data
                        $(this).closest('form').submit();
                    } else {
                        alert("Pilih setidaknya satu baris data untuk diekspor.");
                    }
                });
        });
    </script>
@endpush
