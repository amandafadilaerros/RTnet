<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class rumahModel extends Model
{

    protected $table = 'rumahs'; //mendefiniskan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'no_rumah'; //mendefiniskan primary key dari tabel yang digunakan

    protected $fillable = ['no_rumah','status_rumah'];

    public function kk(): HasMany
    {
        return $this->hasMany(kkModel::class, 'no_kk');
    }

}
