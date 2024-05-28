@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-md-8">
    </div>
    <!-- Search -->
    <div class="col-md-4">
        <div class="row">
            <input type="text" id="search" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
            <button class="btn btn-primary" id="searchButton" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
        </div>
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
    <style>
       .dataTables_filter {
      display: none;
  }
  #searchOption option:hover {
    outline: none; /* Remove default focus outline */
    border-color: #424874; /* Change border color to match the desired color */
    box-shadow: 0 0 0 0.2rem rgba(66, 72, 116, 0.25); /* Add a box shadow to simulate focus effect */
  }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var table = $('#table_pengumuman').DataTable({
                serverSide: true,
                searchable:true
                ajax: {
                    url: "{{ url('penduduk/pengumuman') }}",
                    type: "POST",
                    dataType: "json"
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
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#searchButton').on('click', function() {
                var keyword = $('#search').val();
                table.search(keyword).draw();
            });

            $('#search').on('keypress', function(e) {
                if (e.which == 13) { // enter key
                    $('#searchButton').click();
                }
            });
        });
    </script>
@endpush
