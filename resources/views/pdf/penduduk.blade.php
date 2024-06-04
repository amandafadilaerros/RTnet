<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk</title>
    <style>
        /* Atur gaya CSS sesuai kebutuhan Anda */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Data Penduduk</h1>
    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>No. KK</th>
                <th>Nama Lengkap</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Golongan Darah</th>
                <th>Agama</th>
                <th>Status Perkawinan</th>
                <th>Jenis Penduduk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penduduk as $data)
                <tr>
                    <td>{{ $data->NIK }}</td>
                    <td>{{ $data->no_kk }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->tempat }}</td>
                    <td>{{ $data->tanggal_lahir }}</td>
                    <td>{{ $data->jenis_kelamin }}</td>
                    <td>{{ $data->golongan_darah }}</td>
                    <td>{{ $data->agama }}</td>
                    <td>{{ $data->status_perkawinan }}</td>
                    <td>{{ $data->jenis_penduduk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
