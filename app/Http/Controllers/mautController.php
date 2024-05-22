<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Matrik;
use App\Models\Kriteria;

class mautController extends Controller
{
    public function index()
    {
        // Mendapatkan data alternatif
        $alternatifs = Alternatif::all();
    
        // Mendapatkan data kriteria
        $kriteriaList = Kriteria::all();
    
        // 1. Tabel perhitungan bobot dengan rumus bobot/100
        $bobot = $this->hitungBobot($kriteriaList);
    
        // // 2. Tabel matriks keputusan
        $matriksData = $this->matriksKeputusan($alternatifs, $kriteriaList);
        $matriksKeputusan = $matriksData['matriksKeputusan'];
        $min = $matriksData['min'];
        $max = $matriksData['max'];
    
        // // 3. Tabel Normalisasi
        $normalisasi = $this->normalisasi($matriksKeputusan, $kriteriaList);
    
        // // 4. Tabel perankingan atau preferensi
        $preferensi = $this->preferensi($normalisasi, $bobot);
    
        $breadcrumb = (object) [
            'title' => 'MAUT',
            'list' => ['--', '--'],
        ];
        $page = (object) [
            'title' => '-----',
        ];
        $activeMenu = 'maut';
    
        return view('maut', compact(
            'alternatifs',
            'kriteriaList',
            'bobot',
            'matriksKeputusan',
            'normalisasi',
            'preferensi',
            'breadcrumb',
            'page',
            'activeMenu',
            'min',
            'max'
        ));
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
  // Hitung matriks keputusan
// Hitung matriks keputusan
private function matriksKeputusan($alternatifs, $kriteriaList)
{
    $matriksKeputusan = [];
    $min = []; // Tambahkan variabel min untuk menyimpan nilai minimum
    $max = []; // Tambahkan variabel max untuk menyimpan nilai maksimum

    foreach ($alternatifs as $alternatif) {
        foreach ($kriteriaList as $kriteria) {
            $nilai = Matrik::where('id_alternatif', $alternatif->id_alternatif)
                ->where('id_kriteria', $kriteria->id_kriteria)
                ->value('nilai');

            $matriksKeputusan[$alternatif->nama_alternatif][$kriteria->id_kriteria] = $nilai ?? 0;

            // Hitung nilai maksimum dan minimum
            if (!isset($min[$kriteria->id_kriteria]) || $nilai < $min[$kriteria->id_kriteria]) {
                $min[$kriteria->id_kriteria] = $nilai;
            }
            if (!isset($max[$kriteria->id_kriteria]) || $nilai > $max[$kriteria->id_kriteria]) {
                $max[$kriteria->id_kriteria] = $nilai;
            }
        }
    }

    // Kembalikan matriks keputusan, min, dan max
    return [
        'matriksKeputusan' => $matriksKeputusan,
        'min' => $min,
        'max' => $max,
    ];
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

            if ($max - $min == 0) {
                $normalisasi[$namaAlternatif][$idKriteria] = $jenisKriteria == 'Cost' ? 1 : 0;
            } else {
                if ($jenisKriteria == 'Cost') {
                    $normalisasi[$namaAlternatif][$idKriteria] = 1 + (($min - $nilai) / ($max - $min));
                } else {
                    $normalisasi[$namaAlternatif][$idKriteria] = ($nilai - $min) / ($max - $min);
                }
            }
        }
    }
    return $normalisasi;
}





    // Perhitungan nilai preferensi
    private function preferensi($normalisasi, $bobot)
    {
        $preferensi = [];
        foreach ($normalisasi as $namaAlternatif => $nilaiKriteria) {
            $total = 0;
            foreach ($nilaiKriteria as $idKriteria => $nilai) {
                if (isset($bobot[$idKriteria])) {
                    $total += $nilai * $bobot[$idKriteria];
                } else {
                    throw new \Exception("Undefined array key $idKriteria in bobot array.");
                }
            }
            $preferensi[$namaAlternatif] = $total;
        }
        arsort($preferensi);
        return $preferensi;
    }
}
