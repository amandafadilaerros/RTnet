<?php

namespace App\Http\Controllers;

use App\Models\alternatif;
use App\Models\kriteria;
use Illuminate\Http\Request;

class MabacController extends Controller
{
    public function calculateMabac()
    {
        // Fetch data
        $alternatifs = alternatif::all();
        $kriterias = kriteria::all(); // Fetch all criteria
        // dd($kriterias, $alternatifs);
        // Step 1: Normalize decision matrix
        $normalizedMatrix = $this->normalizeMatrix($alternatifs, $kriterias);

        // Step 2: Calculate weighted normalized decision matrix
        $weightedNormalizedMatrix = $this->weightedNormalizedMatrix($normalizedMatrix, $kriterias);

        // Step 3: Determine the border approximation area matrix
        $borderApproximationMatrix = $this->borderApproximationMatrix($weightedNormalizedMatrix);

        // Step 4: Calculate the distance to the border approximation area
        $distances = $this->calculateDistances($borderApproximationMatrix, $weightedNormalizedMatrix);

        // Step 5: Rank the alternatives
        $rankings = $this->rankAlternatives($distances);

        // Pass all necessary data to the view
        return view('ketuaRt/mabac', compact('alternatifs', 'kriterias', 'weightedNormalizedMatrix', 'borderApproximationMatrix', 'rankings'));
    }

    // Step 1: Normalize decision matrix
    private function normalizeMatrix($alternatifs, $kriterias)
    {
        $normalizedMatrix = [];

        // Benefit
        // Implement your logic to normalize the decision matrix (for example, using min-max normalization)
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                // Normalize each value based on the criteria's range
                // Example logic, replace with your actual normalization method
                $normalizedValue = ($alternatif->{$kriteria->nama_kriteria} - $kriteria->min_value) / ($kriteria->max_value - $kriteria->min_value);
                $normalizedMatrix[$alternatif->id][$kriteria->id] = $normalizedValue;
            }
        }

        // Cost
        // Implement your logic to normalize the decision matrix (for example, using min-max normalization)
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                // Normalize each value based on the criteria's range
                // Example logic, replace with your actual normalization method
                $normalizedValue = ($alternatif->{$kriteria->nama_kriteria} - $kriteria->max_value) / ($kriteria->min_value - $kriteria->max_value);
                $normalizedMatrix[$alternatif->id][$kriteria->id] = $normalizedValue;
            }
        }

        return $normalizedMatrix;
    }

    // Step 2: Calculate weighted normalized decision matrix
    private function weightedNormalizedMatrix($normalizedMatrix, $kriterias)
    {
        $weightedNormalizedMatrix = [];

        // Implement your logic to calculate the weighted normalized matrix
        foreach ($normalizedMatrix as $alternatifId => $criteriaValues) {
            foreach ($kriterias as $kriteria) {
                // Example logic: multiply normalized value by criteria weight
                $weightedNormalizedValue = $criteriaValues[$kriteria->id] * $kriteria->bobot;
                $weightedNormalizedMatrix[$alternatifId][$kriteria->id] = $weightedNormalizedValue;
            }
        }

        return $weightedNormalizedMatrix;
    }

    // Step 3: Determine the border approximation area matrix
    private function borderApproximationMatrix($weightedNormalizedMatrix)
    {
        $borderApproximationMatrix = [];

        // Implement your logic to calculate the border approximation matrix
        foreach ($weightedNormalizedMatrix as $alternatifId => $criteriaValues) {
            // Example logic: find the maximum value for each criteria
            foreach ($criteriaValues as $kriteriaId => $value) {
                if (!isset($borderApproximationMatrix[$kriteriaId]) || $value > $borderApproximationMatrix[$kriteriaId]) {
                    $borderApproximationMatrix[$kriteriaId] = $value;
                }
            }
        }

        return $borderApproximationMatrix;
    }

    // Step 4: Calculate the distance to the border approximation area
    private function calculateDistances($borderApproximationMatrix, $weightedNormalizedMatrix)
    {
        $distances = [];

        // Implement your logic to calculate distances
        foreach ($weightedNormalizedMatrix as $alternatifId => $criteriaValues) {
            $distance = 0;
            foreach ($criteriaValues as $kriteriaId => $value) {
                // Example Euclidean distance calculation
                $distance += pow($value - $borderApproximationMatrix[$kriteriaId], 2);
            }
            $distances[$alternatifId] = sqrt($distance);
        }

        return $distances;
    }

    // Step 5: Rank the alternatives
    private function rankAlternatives($distances)
    {
        // Sort distances to determine rankings
        arsort($distances);

        // Assign ranks
        $rankings = [];
        $rank = 1;
        foreach ($distances as $alternatifId => $distance) {
            $rankings[$alternatifId] = $rank++;
        }

        return $rankings;
    }
}
