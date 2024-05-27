<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ktpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            ['NIK'=>1213,'no_kk'=>12345678,'nama'=>'Yoga', 'tempat'=>'Malang', 'tanggal_lahir'=>'2024-05-21', 'jenis_kelamin'=>'l', 'golongan_darah'=>'A', 'agama'=>'Islam', 'status_perkawinan'=>'belum kawin','pekerjaan'=>'mahasiswa', 'status_keluarga'=>'Anak', 'status_anggota'=>'keluarga', 'jenis_penduduk'=>'Tetap'],
            ['NIK'=>2121,'no_kk'=>32345678,'nama'=>'Rafli', 'tempat'=>'Malang', 'tanggal_lahir'=>'2024-05-21', 'jenis_kelamin'=>'l', 'golongan_darah'=>'A', 'agama'=>'Islam', 'status_perkawinan'=>'belum kawin','pekerjaan'=>'mahasiswa', 'status_keluarga'=>'Anak', 'status_anggota'=>'keluarga', 'jenis_penduduk'=>'Tetap'],
            ['NIK'=>3212,'no_kk'=>22345678,'nama'=>'Doni', 'tempat'=>'Malang', 'tanggal_lahir'=>'2024-05-21', 'jenis_kelamin'=>'l', 'golongan_darah'=>'A', 'agama'=>'Islam', 'status_perkawinan'=>'belum kawin','pekerjaan'=>'mahasiswa', 'status_keluarga'=>'Anak', 'status_anggota'=>'keluarga', 'jenis_penduduk'=>'Tetap'],
            ['NIK'=>4213,'no_kk'=>42345678,'nama'=>'Haris', 'tempat'=>'Malang', 'tanggal_lahir'=>'2024-05-21', 'jenis_kelamin'=>'l', 'golongan_darah'=>'A', 'agama'=>'Islam', 'status_perkawinan'=>'belum kawin','pekerjaan'=>'mahasiswa', 'status_keluarga'=>'Anak', 'status_anggota'=>'keluarga', 'jenis_penduduk'=>'Tetap'],
            ['NIK'=>4214,'no_kk'=>52345678,'nama'=>'Ari', 'tempat'=>'Malang', 'tanggal_lahir'=>'2024-05-21', 'jenis_kelamin'=>'l', 'golongan_darah'=>'A', 'agama'=>'Islam', 'status_perkawinan'=>'belum kawin','pekerjaan'=>'mahasiswa', 'status_keluarga'=>'Anak', 'status_anggota'=>'keluarga', 'jenis_penduduk'=>'Tetap'],
        ];
        DB::table('ktps')->insert($data);
    }
}
