<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            ['id_kriteria'=>1,'nama_kriteria'=>'Kemudahan Pelaksanaan', 'bobot'=>20, 'jenis_kriteria'=>'Benefit'],
            ['id_kriteria'=>2,'nama_kriteria'=>'Jumlah Partisipan', 'bobot'=>15, 'jenis_kriteria'=>'Benefit'],
            ['id_kriteria'=>3,'nama_kriteria'=>'Tingkat Urgensi', 'bobot'=>20, 'jenis_kriteria'=>'Benefit'],
            ['id_kriteria'=>4,'nama_kriteria'=>'Dampak Sosial', 'bobot'=>25, 'jenis_kriteria'=>'Cost'],
            ['id_kriteria'=>5,'nama_kriteria'=>'Dana', 'bobot'=>20, 'jenis_kriteria'=>'Cost'],
        ];
        DB::table('kriterias')->insert($data);
    }
}
