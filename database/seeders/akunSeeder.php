<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class akunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // DB::table('akuns')->truncate();
        $data =[
            ['id_akun'=>12345678,'id_level'=>1,'nama'=>'Yoga','password'=>Hash::make('12345')],
            ['id_akun'=>22345678,'id_level'=>2,'nama'=>'Doni','password'=>Hash::make('12345')],
            ['id_akun'=>32345678,'id_level'=>3,'nama'=>'Rafli','password'=>Hash::make('12345')],
            ['id_akun'=>42345678,'id_level'=>4,'nama'=>'Haris','password'=>Hash::make('12345')],
            ['id_akun'=>52345678,'id_level'=>4,'nama'=>'Ari','password'=>Hash::make('12345')],
        ];
        DB::table('akuns')->insert($data);
    }
}
