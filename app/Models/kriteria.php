<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';
    protected $primaryKey = 'id_kriteria';
    

    public function alternatif()
    {
        return $this->belongsToMany(Alternatif::class, 'matrik', 'id_kriteria', 'id_alternatif')
                    ->withPivot('nilai');
    }
}
