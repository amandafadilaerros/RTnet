<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendudukKosModel extends Model
{
    protected $table = 'penduduk_kos';
    protected $primaryKey = 'id_penduduk_kos';

    protected $fillable = [
        'id_penduduk_kos',
        'nama',
        'NIK'
    ];

    public function ktp()
    {
        return $this->hasMany(KtpModel::class, 'NIK', 'NIK');
    }
}
