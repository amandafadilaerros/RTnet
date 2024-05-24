<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            rumahSeeder::class,
            pengumumanSeeder::class,
            kriteriaSeeder::class,
            alternatifSeeder::class,
            matrikSeeder::class,
            levelSeeder::class,
            akunSeeder::class,
            kkSeeder::class,
            ktpSeeder::class,
            iuranSeeder::class,
            inventarisSeeder::class,
            peminjaman_inventarisSeeder::class
        ]);

    }
}
