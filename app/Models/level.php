<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class level extends Model
{
    use HasFactory;

    protected $table = 'levels'; //mendefiniskan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'id_level'; //mendefiniskan primary key dari tabel yang digunakan
}
