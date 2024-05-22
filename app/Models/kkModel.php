<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\penduduk_tetapModel;

class kkModel extends Model
{
    protected $table = 'kks'; //mendefiniskan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'no_kk'; //mendefiniskan primary key dari tabel yang digunakan

    protected $fillable = ['no_kk','nama_kepala_keluarga','id_level', 'jumlah_individu','alamat','dokumen' ];

    public function level(): HasMany
    {
        return $this->hasMany(level::class, 'id_level', 'id_level');
    }
}
