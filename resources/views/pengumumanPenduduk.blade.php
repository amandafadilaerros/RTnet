@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-md-8">
    </div>
    <!-- Search -->
    <div class="col-md-4">
        {{-- <div class="row">
            <input type="text" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
            <button class="btn btn-primary" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
        </div> --}}
    </div>
</div>        
<div class="card">
    <div class="card-body">
        <table class="table table-hover table-striped" id="table_pengumuman">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Pengumuman</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@push('css')
    
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('#table_pengumuman').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('penduduk/pengumuman') }}",
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
                    {
                        data: "judul",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        className: "",
                        orderable: true,
                        searchable: true
                    }
                ]
            });
        });
    </script>

@endpush
