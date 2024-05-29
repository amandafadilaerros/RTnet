<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('kks')->truncate();
        $data =[
            ['no_kk'=>12345678,'no_rumah'=>1,'alamat'=>'Candipanggung RT 8','jumlah_individu'=>2,'paguyuban'=>'true','nama_kepala_keluarga'=>'Yoga'],
            ['no_kk'=>22345678,'no_rumah'=>2,'alamat'=>'Candipanggung RT 8','jumlah_individu'=>2,'paguyuban'=>'false','nama_kepala_keluarga'=>'Doni'],
            ['no_kk'=>32345678,'no_rumah'=>3,'alamat'=>'Candipanggung RT 8','jumlah_individu'=>2,'paguyuban'=>'true','nama_kepala_keluarga'=>'Rafli'],
            ['no_kk'=>42345678,'no_rumah'=>4,'alamat'=>'Candipanggung RT 8','jumlah_individu'=>2,'paguyuban'=>'false','nama_kepala_keluarga'=>'Haris'],
            ['no_kk'=>52345678,'no_rumah'=>5,'alamat'=>'Candipanggung RT 8','jumlah_individu'=>2,'paguyuban'=>'true','nama_kepala_keluarga'=>'Ari'],
        ];
        DB::table('kks')->insert($data);
    }
}
