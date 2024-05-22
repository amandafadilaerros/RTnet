<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class inventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            ['id_inventaris'=>1,'nama_barang'=>'sapu', 'jumlah'=>2],
        ];
        DB::table('inventaris')->insert($data);
    }
}
