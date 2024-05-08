<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class peminjaman_inventaris extends Model
{
    protected $table = 'peminjaman_inventaris';

    // Definisikan relasi belongsTo ke model Inventaris
    public function inventaris(): BelongsTo
    {
        return $this->belongsTo(Inventaris::class, 'id_inventaris');
    }
}
