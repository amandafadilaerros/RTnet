<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ktp extends Model
{
    protected $table = 'ktps'; //mendefiniskan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'NIK'; //mendefiniskan primary key dari tabel yang digunakan

    protected $fillable = ['no_kk','nama', 'tempat', 'tanggal_lahir', 'jenis_kelamin', 'golongan_darah', 'agama', 'status_perkawinan', 'pekerjaan', 'status_keluarga', 'status_anggota', 'jenis_penduduk', 'dokumen'];
}
