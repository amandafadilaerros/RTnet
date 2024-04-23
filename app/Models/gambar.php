<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class gambar extends Model
{
    use HasFactory;

    protected $table = 'gambars';
    protected $primaryKey = 'id_gambar';

    // @var array
    protected $fillable = ['nama_file', 'mime_type', 'data_gambar'];
    // protected $fillable = ['level_id', 'username', 'nama'];

    public function peminjaman_gambar(): HasMany
    {
        return $this->hasMany(inventaris::class, 'id_gambar', 'id_gambar');
    }
}
