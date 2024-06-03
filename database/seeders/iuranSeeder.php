<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class iuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('iurans')->truncate();
        $data =[
            ['id_iuran'=>1,'nominal'=>1000, 'keterangan'=>'lunas', 'jenis_transaksi'=>'tunai', 'jenis_iuran'=>'kas', 'bulan'=>'2024-05-21', 'no_kk'=>12345678],
            ['id_iuran'=>2,'nominal'=>12000, 'keterangan'=>'lunas', 'jenis_transaksi'=>'tunai', 'jenis_iuran'=>'kas', 'bulan'=>'2024-05-21', 'no_kk'=>32345678],
        ];
        DB::table('iurans')->insert($data);
    }
}
