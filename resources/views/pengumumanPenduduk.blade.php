@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-md-8">
    </div>
    <!-- Search -->
    <div class="col-md-4">
        <div class="row">
            <input type="text" class="form-control" style="border-radius: 20px; width: 260px;" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
            <button class="btn btn-primary" type="button" style="border-radius: 20px; width: 80px; margin-left: 20px; margin-bottom: 10px; background-color: #424874;">Cari</button>
        </div>
    </div>
</div>        
<div class="card">
    <div class="card-body">
        <table class="table table-hover table-striped" id="table_user">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Pengumuman</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><p>&lt;Kerja Bakti&gt; Pembetulan saluran air depan masjid &lt;19 Maret 2023&gt;</p></td>
                    <td>
                        <button class="btn btn-primary btn-detail" data-toggle="modal" data-target="#detailModal" style="border-radius: 10px; background-color: #424874;"><i class="fas fa-eye"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><p>&lt;RAPAT&gt; Di rumah Bpk Susanto &lt;16 Maret 2023&gt;</p></td>
                    <td>
                        <button class="btn btn-primary btn-detail" data-toggle="modal" data-target="#detailModal" style="border-radius: 10px; background-color: #424874;"><i class="fas fa-eye"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><p>&lt;LOMBA&gt; Kegiatan RW &lt;17 Agustus 2023&gt;</p></td>
                    <td>
                        <button class="btn btn-primary btn-detail" data-toggle="modal" data-target="#detailModal" style="border-radius: 10px; background-color: #424874;"><i class="fas fa-eye"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Detail Pengumuman -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Pengumuman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="judul">Judul:</label>
                    <input type="text" class="form-control" id="judul" readonly value="Kerja Bakti">
                </div>
                <div class="form-group">
                    <label for="kegiatan">Kegiatan:</label>
                    <input type="text" class="form-control" id="kegiatan" readonly value="Pembetulan saluran air depan masjid">
                </div>
                <div class="form-group">
                    <label for="jadwal">Jadwal:</label>
                    <input type="text" class="form-control" id="jadwal" readonly value="19 Maret 2023">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
    
@endpush

@push('js')

@endpush
