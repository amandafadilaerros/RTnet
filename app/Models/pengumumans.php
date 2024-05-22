<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengumumans extends Model
{
    protected $table = 'pengumumans';
    protected $primaryKey = 'id_pengumuman';

    protected $fillable = [
        'id_pengumuman','judul', 'kegiatan', 'jadwal_pelaksanaan', 'deskripsi'
    ];
}
