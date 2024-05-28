<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class kkModel extends Model
{
    protected $table = 'kks'; //mendefiniskan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'no_kk'; //mendefiniskan primary key dari tabel yang digunakan

    protected $fillable = ['no_kk','nama_kepala_keluarga', 'jumlah_individu', 'alamat', 'no_rumah', 'dokumen','paguyuban'];


    public function level(): HasMany
    {
        return $this->hasMany(level::class, 'id_level', 'id_level');
    }
    public function rumah(): BelongsTo {
        return $this->belongsTo(rumahModel::class, 'no_rumah', 'no_rumah');
    }
}
