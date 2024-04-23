<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class iuran extends Model
{
    protected $table = 'iurans';
    protected $primaryKey = 'id_iuran';

    protected $fillable = ['nominal','keterangan','jenis_transaksi','jenis_iuran','no_kk'];

    public function kk(): BelongsTo
    {
        return $this->belongsTo(kk::class, 'no_kk', 'no_kk');
    }
}
