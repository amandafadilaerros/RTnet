<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\alternatif;
use App\Models\matrik;
use App\Models\kriteria;

class MabacController extends Controller
{
    public function index()
    {
        // Mendapatkan data alternatif
        $alternatifs = Alternatif::all();

        // Mendapatkan data kriteria
        $kriteriaList = Kriteria::all();

        // 1. Tabel perhitungan bobot dengan rumus bobot/100
        $bobot = $this->hitungBobot($kriteriaList);

        // Jika tidak ada data alternatif, berikan respon yang sesuai
        if ($alternatifs->isEmpty()) {
            return view('mabac', [
                'alternatifs' => $alternatifs,
                'kriteriaList' => $kriteriaList,
                'bobot' => $bobot,
                'matriksKeputusan' => [],
                'matrikPertimbangan' => [],
                'areaPerkiraanBatas' => [],
                'jarakElemen' => [],
                'normalisasi' => [],
                'preferensi' => [],
                'breadcrumb' => (object) [
                    'title' => 'MABAC',
                    'list' => ['--', '--'],
                ],
                'page' => (object) [
                    'title' => '-----',
                ],
                'activeMenu' => 'mabac',
                'minValues' => [],
                'maxValues' => [],
            ]);
        }
        // 2. Tabel matriks keputusan
        $matriksKeputusan = $this->matriksKeputusan($alternatifs, $kriteriaList);

        // 3. Tabel Normalisasi
        $normalisasi = $this->normalisasi($matriksKeputusan, $kriteriaList);

        // 4. Tabel Perhitungan Elemen Matrik Pertimbangan (V)
        $matrikPertimbangan = $this->matrikPertimbangan($normalisasi, $bobot);

        // 5. Tabel Matriks Area Perkiraan Batas (G)
        $areaPerkiraanBatas = $this->areaPerkiraanBatas($matrikPertimbangan, count($alternatifs));

        // 6. Tabel Perhitungan Matriks Jarak Elemen Alternatif dari Batas Perkiraan Daerah (Q)
        $jarakElemen = $this->jarakElemen($matrikPertimbangan, $areaPerkiraanBatas);

        // 7. Tabel Perankingan
        $preferensi = $this->preferensi($jarakElemen);
        // Di dalam method index() MabacController

        // Ambil nilai minimum dan maksimum dari matriks keputusan
        $minValues = [];
        $maxValues = [];
        foreach ($kriteriaList as $kriteria) {
            $nilaiKriteria = array_column($matriksKeputusan, $kriteria->id_kriteria);
            $minValues[$kriteria->id_kriteria] = min($nilaiKriteria);
            $maxValues[$kriteria->id_kriteria] = max($nilaiKriteria);
        }

        // Lanjutkan ke tahap-tahap perhitungan berikutnya


        $breadcrumb = (object) [
            'title' => 'MABAC',
            'list' => ['Kerja Bakti', 'Mabac'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'mabac';

        return view(
            'mabac',
            compact(
                'alternatifs',
                'kriteriaList',
                'bobot',
                'matriksKeputusan',
                'matrikPertimbangan',
                'areaPerkiraanBatas',
                'jarakElemen',
                'normalisasi',
                'preferensi',
                'breadcrumb',
                'page',
                'activeMenu',
                'minValues',
                'maxValues'
            )
        );
    }

    // Hitung bobot kriteria
    private function hitungBobot($kriteriaList)
    {
        $bobot = [];
        foreach ($kriteriaList as $kriteria) {
            $bobot[$kriteria->id_kriteria] = $kriteria->bobot / 100;
        }
        return $bobot;
    }

    // Hitung matriks keputusan
    private function matriksKeputusan($alternatifs, $kriteriaList)
    {
        $matriksKeputusan = [];

        foreach ($alternatifs as $alternatif) {
            foreach ($kriteriaList as $kriteria) {
                $nilai = Matrik::where('id_alternatif', $alternatif->id_alternatif)
                    ->where('id_kriteria', $kriteria->id_kriteria)
                    ->value('nilai');

                $matriksKeputusan[$alternatif->nama_alternatif][$kriteria->id_kriteria] = $nilai ?? 0;
            }
        }

        return $matriksKeputusan;
    }

    // Normalisasi data
    private function normalisasi($matriksKeputusan, $kriteriaList)
    {
        $normalisasi = [];

        foreach ($kriteriaList as $kriteria) {
            $idKriteria = $kriteria->id_kriteria;
            $jenisKriteria = $kriteria->jenis_kriteria;

            $nilaiKriteria = array_column($matriksKeputusan, $idKriteria);

            $min = min($nilaiKriteria);
            $max = max($nilaiKriteria);

            foreach ($matriksKeputusan as $namaAlternatif => $nilaiAlternatif) {
                $nilai = $nilaiAlternatif[$idKriteria];



                if ($jenisKriteria == 'Cost') {
                    $normalisasi[$namaAlternatif][$idKriteria] = ($nilai - $max) / ($min - $max);
                } else {
                    $normalisasi[$namaAlternatif][$idKriteria] = ($nilai - $min) / ($max - $min);

                }
            }
        }
        return $normalisasi;
    }

    // Perhitungan Elemen Matrik Pertimbangan (V)
    private function matrikPertimbangan($normalisasi, $bobot)
    {
        $matrikPertimbangan = [];
        foreach ($normalisasi as $namaAlternatif => $nilaiKriteria) {
            foreach ($nilaiKriteria as $idKriteria => $nilai) {
                $matrikPertimbangan[$namaAlternatif][$idKriteria] = $bobot[$idKriteria] * $nilai + $bobot[$idKriteria];
            }
        }
        return $matrikPertimbangan;
    }

    // Matriks Area Perkiraan Batas (G)
    private function areaPerkiraanBatas($matrikPertimbangan, $jumlahAlternatif)
    {
        $areaPerkiraanBatas = [];

        foreach ($matrikPertimbangan as $namaAlternatif => $nilaiKriteria) {
            foreach ($nilaiKriteria as $idKriteria => $nilai) {
                if (!isset($areaPerkiraanBatas[$idKriteria])) {
                    $areaPerkiraanBatas[$idKriteria] = 1;
                }
                //mengalikan semua di satu kriteria
                $areaPerkiraanBatas[$idKriteria] *= $nilai;
            }
        }

        // Hitung akar pangkat ke jumlah alternatif dari hasil perkalian
        foreach ($areaPerkiraanBatas as $idKriteria => $nilai) {
            $areaPerkiraanBatas[$idKriteria] = pow($nilai, 1 / $jumlahAlternatif);
        }

        return $areaPerkiraanBatas;
    }


    // Perhitungan Matriks Jarak Elemen Alternatif dari Batas Perkiraan Daerah (Q)
    private function jarakElemen($matrikPertimbangan, $areaPerkiraanBatas)
    {
        $jarakElemen = [];
        foreach ($matrikPertimbangan as $namaAlternatif => $nilaiKriteria) {
            foreach ($nilaiKriteria as $idKriteria => $nilai) {
                $jarakElemen[$namaAlternatif][$idKriteria] = $nilai - $areaPerkiraanBatas[$idKriteria];
            }
        }
        return $jarakElemen;
    }

    // Perhitungan nilai preferensi
    private function preferensi($jarakElemen)
    {
        $preferensi = [];
        foreach ($jarakElemen as $namaAlternatif => $nilaiKriteria) {
            $total = array_sum($nilaiKriteria);
            $preferensi[$namaAlternatif] = $total;
        }
        arsort($preferensi);
        return $preferensi;
    }
}
