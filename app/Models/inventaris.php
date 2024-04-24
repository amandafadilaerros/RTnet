<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';
    protected $primaryKey = 'id_inventaris';

    // @var array
    protected $fillable = ['nama_barang', 'jumlah', 'id_gambar'];
    // protected $fillable = ['level_id', 'username', 'nama'];

    public function gambar(): BelongsTo
    {
        return $this->belongsTo(gambar::class, 'id_gambar', 'id_gambar');
    }

    public function peminjaman_inventaris(): HasMany
    {
        return $this->hasMany(peminjaman_inventaris::class, 'id_inventaris', 'id_inventaris');
    }
}
