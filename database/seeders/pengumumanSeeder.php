<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // DB::table('pengumumans')->truncate();
        $data =[
            ['id_pengumuman'=>1,'judul'=>'Pembersihan Masjid', 'kegiatan'=>'Membersihkan masjid', 'deskripsi'=>'Pembersihan masjid ini dilakukan untuk mempersiapkan masjid sebelum kajian besar', 'jadwal_pelaksanaan'=>'2024-04-30'],
            ['id_pengumuman'=>2,'judul'=>'Kerja Bakti', 'kegiatan'=>'Kerja bakti', 'deskripsi'=>'Kerja bakti ini dilakukan dalam rangka memperingati HUT RI', 'jadwal_pelaksanaan'=>'2024-04-30'],
        ];
        DB::table('pengumumans')->insert($data);
    }
}
