<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ktp extends Model
{
    protected $table = 'ktps'; //mendefiniskan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'NIK'; //mendefiniskan primary key dari tabel yang digunakan

    protected $fillable = ['no_kk','nama', 'tempat', 'tanggal_lahir', 'jenis_kelamin', 'golongan_darah', 'agama', 'status_perkawinan', 'pekerjaan', 'status_keluarga', 'status_anggota', 'jenis_penduduk', 'dokumen'];

    public function peminjaman_inventaris(){
        return $this->hasMany(peminjaman_inventaris::class, 'id_peminjam', 'NIK');
    }
    protected $fillable = ['NIK','no_kk','nama', 'tempat', 'tanggal_lahir', 'jenis_kelamin', 'golongan_darah', 'agama', 'status_perkawinan', 'pekerjaan', 'status_keluarga', 'status_anggota' ,'jenis_penduduk' , 'dokumen'];

    public function kkModel(): HasMany{
        return $this->hasMany(kkModel::class, 'no_kk', 'no_kk');
    }
}
