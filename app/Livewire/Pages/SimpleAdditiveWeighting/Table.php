<?php

namespace App\Livewire\Pages\SimpleAdditiveWeighting;

use App\Models\Alternative;
use App\Models\Criteria;
use Livewire\Component;

class Table extends Component
{
    public function results()
    {
        // ambil data
        $alternatives = Alternative::with('values.criteria')->get();
        $criterias = Criteria::all();

        // 1. cari max & min tiap kriteria
        $max = [];
        $min = [];

        foreach ($criterias as $criteria) {
            $values = [];

            foreach ($alternatives as $alt) {
                $val = $alt->values->where('criteria_id', $criteria->id)->first();
                if ($val) {
                    $values[] = $val->value;
                }
            }

            $max[$criteria->id] = max($values);
            $min[$criteria->id] = min($values);
        }

        // 2. hitung nilai SAW
        $results = [];

        foreach ($alternatives as $alt) {
            $score = 0;

            foreach ($alt->values as $val) {
                $criteria = $val->criteria;

                // normalisasi
                if ($criteria->type == 'benefit') {
                    $r = $val->value / $max[$criteria->id];
                } else {
                    $r = $min[$criteria->id] / $val->value;
                }

                // hitung skor
                $score += $r * $criteria->weight;
            }

            $results[] = [
                'name' => $alt->name,
                'score' => round($score, 4),
            ];
        }

        // 3. ranking
        usort($results, fn ($a, $b) => $b['score'] <=> $a['score']);

        return $results;
    }

    public function render()
    {
        $results = $this->results();

        return view('livewire.pages.simple-additive-weighting.table', compact('results'));
    }
}
