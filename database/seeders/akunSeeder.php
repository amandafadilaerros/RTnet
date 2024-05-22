<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class akunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            ['id_akun'=>12345678,'id_level'=>1,'nama'=>'Yoga'],
            ['id_akun'=>22345678,'id_level'=>2,'nama'=>'Doni'],
            ['id_akun'=>32345678,'id_level'=>3,'nama'=>'Rafli'],
            ['id_akun'=>42345678,'id_level'=>4,'nama'=>'Haris'],
            ['id_akun'=>52345678,'id_level'=>4,'nama'=>'Ari'],
        ];
        DB::table('akuns')->insert($data);
    }
}
