<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alternatif extends Model
{
    use HasFactory;
    protected $table = 'alternatifs';
    protected $primaryKey = 'id_alternatif';
    protected $fillable = ['nama_alternatif'];

}
