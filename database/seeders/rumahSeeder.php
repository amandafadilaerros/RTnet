<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            ['no_rumah'=>1,'status_rumah'=>'Rumah Pribadi'],
            ['no_rumah'=>2,'status_rumah'=>'Rumah Pribadi'],
            ['no_rumah'=>3,'status_rumah'=>'Rumah Pribadi'],
            ['no_rumah'=>4,'status_rumah'=>'Rumah Pribadi'],
            ['no_rumah'=>5,'status_rumah'=>'Rumah Pribadi'],
        ];
        DB::table('rumah')->insert($data);
    }
}
