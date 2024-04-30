@extends('layouts.template')

@section('content')
<div class="card">
    {{-- <div class="card-header">
        <h3 class="card-title">Data Penduduk</h3>
    </div> --}}
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <!-- Export PDF button -->
                <button class="btn btn-secondary" type="button" style="border-radius: 20px; width: 120px; margin-bottom: 10px;">Export PDF</button>
            </div>
            <!-- Search -->
            <div class="col-md-4">
                <div class="row">
                    <input type="text" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                    <button class="btn btn-primary" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
                </div>
            </div>
        </div>

        <table class="table table-hover table-striped" id="table_penduduk_tetap">
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
                    <th scope="col">Status Perkawinan</th>
                    <th scope="col">Tgl Msuk</th>
                    <th scope="col">Tgl Keluar</th>
                    <th scope="col">Dokumen</th>
                </tr>
            </thead>
            <!-- <tbody>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>Laki-laki</td>
                    <td>1234567890123456</td>
                    <td>1234567890</td>
                    <td>Dewasa</td>
                    <td>A+</td>
                    <td>Belum Menikah</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jane Doe</td>
                    <td>Perempuan</td>
                    <td>9876543210987654</td>
                    <td>0987654321</td>
                    <td>Remaja</td>
                    <td>B-</td>
                    <td>Menikah</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Alice Smith</td>
                    <td>Perempuan</td>
                    <td>5678901234567890</td>
                    <td>5678901234</td>
                    <td>Bayi</td>
                    <td>O-</td>
                    <td>Belum Menikah</td>
                </tr>
            </tbody> -->
        </table>
    </div>
</div>
@endsection
@push('css')

@push('js')
    <script>
        $(document).ready(function() {
            var dataPendudukTetap = $('#table_penduduk_tetap').DataTable({
                serverSide: true,   //jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ url('ketuaRt/penduduk_tetap/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.nik = $('#nik').val();
                    }
                },
                columns: [
                    {
                        data: "DT_RowIndex",    // nomor urut dari laravel datatable addIndexColimn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "NIK",
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
                    }{
                        data: "pekerjaan",
                        className: "",
                        orderable: true,        //jika ingin kolom bisa diurutkan 
                        searchable: true        // jika ingin kolom bisa dicari
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
                        searchable: false       //true, jika ingin kolom bisa dicari
                    }
                ]
            });

            // $('#no_rumah').on('changes', function() {
            //     dataRumah.ajax.reload();
            // });
            $('#nik').on('input', function() {
                dataRumah.ajax.reload();
            });

            $('#formSearch').on('submit', function(e) {
                e.preventDefault(); // Menghentikan perilaku default dari tombol "Cari"
                dataRumah.ajax.reload();
            });
        });
    </script>
@endpush


@endpush