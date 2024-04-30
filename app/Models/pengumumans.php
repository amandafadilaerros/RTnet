<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengumumans extends Model
{
    use HasFactory;

    protected $table = 'pengumumans';
    protected $primaryKey = 'id_pengumuman';

    // @var array
    protected $fillable = ['judul', 'kegiatan', 'jadwal_pelaksanaan'];
    // protected $fillable = ['level_id', 'username', 'nama'];

    // public function gambar(): BelongsTo{
    //     return $this->belongsTo(gambar::class, 'id_gambar', 'id_gambar');
    // }

    // public function peminjaman_inventaris(): HasMany
    // {
    //     return $this->hasMany(peminjaman_inventaris::class, 'id_inventaris', 'id_inventaris');
    // }
}
