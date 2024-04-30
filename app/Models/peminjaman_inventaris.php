<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman_inventaris extends Model
{
    protected $table = 'peminjaman_inventaris';

    // Definisikan relasi belongsTo ke model Inventaris
    public function inventaris()
    {
        return $this->belongsTo(Inventaris::class, 'id_inventaris');
    }
}
