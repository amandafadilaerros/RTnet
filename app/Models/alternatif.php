<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatifs';
    protected $primaryKey = 'id_alternatif';
    protected $fillable = ['nama_alternatif']; // Pastikan nama_alternatif ada di fillable

    public function matriks()
    {
        return $this->hasMany(Matrik::class, 'id_alternatif', 'id_alternatif');
    }
}
