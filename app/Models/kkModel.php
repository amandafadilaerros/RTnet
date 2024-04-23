<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class kkModel extends Model
{
    protected $table = 'kks'; //mendefiniskan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'no_kk'; //mendefiniskan primary key dari tabel yang digunakan

    protected $fillable = ['no_kk','nama_kepala_keluarga', 'id_level', 'jumlah_individu', 'alamat', 'dokumen'];

    public function penduduk_tetap(): HasMany
    {
        return $this->hasMany(penduduk_tetapModel::class, 'id_penduduk_tetap');
    }
}
