<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman_inventaris extends Model
{
    protected $table = 'peminjaman_inventaris';
    protected $primaryKey = 'id_peminjaman';
    protected $fiilable = ['id_peminjaman', 'id_inventaris', 'id_peminjam', 'jumlah_peminjaman', 'tanggal_peminjaman', 'tanggal_kembali'];

    // Definisikan relasi belongsTo ke model Inventaris
    public function inventaris()
    {
        return $this->belongsTo(Inventaris::class, 'id_inventaris');
    }
}
