<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman_inventaris extends Model
{
    protected $table = 'peminjaman_inventaris';
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'id_peminjaman','id_inventaris','id_peminjam','tanggal_peminjaman','tanggal_kembali'
    ];

    public function inventaris(){
        return $this->belongsTo(inventaris::class, 'id_inventaris','id_inventaris');
    }
}
