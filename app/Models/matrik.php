<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matrik extends Model
{
    use HasFactory;

    protected $table = 'matriks';
    public $incrementing = false;
    protected $fillable = ['id_kriteria', 'id_alternatif', 'nilai'];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif', 'id_alternatif');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }
}
