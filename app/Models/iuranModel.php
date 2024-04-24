<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IuranModel extends Model
{
    use HasFactory;

    protected $table = 'iurans';

    protected $primaryKey = 'id_iuran';

    protected $fillable = [
        'nominal',
        'keterangan',
        'jenis_transaksi',
        'jenis_iuran',
        'no_kk',
    ];

    // Definisikan relasi dengan model KK (Kartu Keluarga)
    public function kartuKeluarga()
    {
        return $this->belongsTo(kk::class, 'no_kk', 'no_kk');
    }
}
