<?php

namespace App\Livewire\Pages\TechniqueforOrderPreferencebySimilaritytoIdealSolution;

use App\Models\Alternative;
use App\Models\Criteria;
use Livewire\Component;

class Table extends Component
{
    public function results()
    {
        $alternatives = Alternative::with('values.criteria')->get();
        $criterias = Criteria::all();

        // 1. Normalisasi
        $divisor = [];

        foreach ($criterias as $c) {
            $sum = 0;
            foreach ($alternatives as $alt) {
                $val = $alt->values->where('criteria_id', $c->id)->first();
                $sum += pow($val->value, 2);
            }
            $divisor[$c->id] = sqrt($sum);
        }

        // 2. Matriks ternormalisasi terbobot
        $normalized = [];

        foreach ($alternatives as $alt) {
            foreach ($alt->values as $val) {
                $c = $val->criteria;

                $r = $val->value / $divisor[$c->id];
                $y = $r * $c->weight;

                $normalized[$alt->id][$c->id] = $y;
            }
        }

        // 3. Solusi ideal (+) dan (-)
        $idealPlus = [];
        $idealMinus = [];

        foreach ($criterias as $c) {
            $column = array_column($normalized, $c->id);

            if ($c->type == 'benefit') {
                $idealPlus[$c->id] = max($column);
                $idealMinus[$c->id] = min($column);
            } else {
                $idealPlus[$c->id] = min($column);
                $idealMinus[$c->id] = max($column);
            }
        }

        // 4. Jarak ke solusi ideal
        $results = [];

        foreach ($alternatives as $alt) {
            $dPlus = 0;
            $dMinus = 0;

            foreach ($criterias as $c) {
                $y = $normalized[$alt->id][$c->id];

                $dPlus += pow($y - $idealPlus[$c->id], 2);
                $dMinus += pow($y - $idealMinus[$c->id], 2);
            }

            $dPlus = sqrt($dPlus);
            $dMinus = sqrt($dMinus);

            // 5. Nilai preferensi
            $score = $dMinus / ($dPlus + $dMinus);

            $results[] = [
                'name' => $alt->name,
                'score' => round($score, 4),
            ];
        }

        // 6. Ranking
        usort($results, fn ($a, $b) => $b['score'] <=> $a['score']);

        return $results;
    }

    public function render()
    {
        $results = $this->results();

        return view('livewire.pages.techniquefor-order-preferenceby-similarityto-ideal-solution.table', compact('results'));
    }
}
