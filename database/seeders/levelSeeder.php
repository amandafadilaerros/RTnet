<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class levelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            ['id_level'=>1,'nama_level'=>'ketua_rt'],
            ['id_level'=>2,'nama_level'=>'bendahara'],
            ['id_level'=>3,'nama_level'=>'sekretaris'],
            ['id_level'=>4,'nama_level'=>'penduduk'],
        ];
        DB::table('levels')->insert($data);
    }
}
