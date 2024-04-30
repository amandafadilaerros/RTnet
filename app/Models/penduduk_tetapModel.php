<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class penduduk_tetap extends Model
{
    protected $table = 'ktps'; //mendefiniskan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'nik'; //mendefiniskan primary key dari tabel yang digunakan

    protected $fillable = ['nik','no_kk', 'nama', 'tempat', 'tanggal_lahir', 'jenis_kelamin', 'golongan_darah', 'agama', 'starus_kawin', 'pekerjaan', 'status_keluarga', 'status_anggota', 'jenis_penduduk', 'tgl_masuk', 'tgl_keluar', 'dokumen'];

    public function kk(): BelongsTo
    {
        return $this->belongsTo(kkModel::class, 'no_kk');
    }

}
