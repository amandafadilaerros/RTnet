<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class akun extends Model
{
    use HasFactory;

    protected $table = 'akuns';
    protected $primaryKey = 'id_akun';

    protected $fillable = [
        'id_akun', 'id_user', 'password', 'nama', 'id_level'
    ];

    public function level(): HasMany
    {
        return $this->hasMany(level::class, 'id_level', 'id_level');
    }
}
