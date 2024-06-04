<!DOCTYPE html>
<html>
<head>
    <title>Data Penduduk PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Data Penduduk</h2>
    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>No. KK</th>
                <th>Nama</th>
                <th>Tempat</th>
                <th>Tgl Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Gol. Darah</th>
                <th>Agama</th>
                <th>Status Perkawinan</th>
                <th>Pekerjaan</th>
                <th>Status Keluarga</th>
                <th>Status Anggota</th>
                <th>Jenis Penduduk</th>
                <th>Tgl Masuk</th>
                <th>Tgl Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $penduduk)
            <tr>
                <td>{{ $penduduk->nik }}</td>
                <td>{{ $penduduk->no_kk }}</td>
                <td>{{ $penduduk->nama }}</td>
                <td>{{ $penduduk->tempat }}</td>
                <td>{{ $penduduk->tanggal_lahir }}</td>
                <td>{{ $penduduk->jenis_kelamin }}</td>
                <td>{{ $penduduk->golongan_darah }}</td>
                <td>{{ $penduduk->agama }}</td>
                <td>{{ $penduduk->status_perkawinan }}</td>
                <td>{{ $penduduk->pekerjaan }}</td>
                <td>{{ $penduduk->status_keluarga }}</td>
                <td>{{ $penduduk->status_anggota }}</td>
                <td>{{ $penduduk->jenis_penduduk }}</td>
                <td>{{ $penduduk->tgl_masuk }}</td>
                <td>{{ $penduduk->tgl_keluar }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
