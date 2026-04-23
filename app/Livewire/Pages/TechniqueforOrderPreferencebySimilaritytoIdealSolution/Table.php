<?php

namespace App\Livewire\Pages\TechniqueforOrderPreferencebySimilaritytoIdealSolution;

use App\Models\Alternative;
use App\Models\Criteria;
use Livewire\Component;

class Table extends Component
{
    public function criterias()
    {
        return Criteria::query()
            ->orderBy('code')
            ->get();
    }

    public function results()
    {
        $criterias = $this->criterias();
        $alternatives = Alternative::query()
            ->whereNotNull('code')
            ->with('values.criteria')
            ->get()
            ->filter(function ($alternative) use ($criterias) {
                return $criterias->every(function ($criteria) use ($alternative) {
                    return $alternative->values->contains('criteria_id', $criteria->id);
                });
            })
            ->values();

        if ($criterias->isEmpty() || $alternatives->isEmpty()) {
            return [];
        }

        // 1. Normalisasi
        $divisor = [];

        foreach ($criterias as $c) {
            $sum = 0;
            foreach ($alternatives as $alt) {
                $val = $alt->values->where('criteria_id', $c->id)->first();
                $sum += pow((float) $val->value, 2);
            }
            $divisor[$c->id] = $sum > 0 ? sqrt($sum) : 1;
        }

        // 2. Matriks ternormalisasi terbobot
        $normalized = [];

        foreach ($alternatives as $alt) {
            foreach ($criterias as $c) {
                $val = $alt->values->where('criteria_id', $c->id)->first();
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
            $score = ($dPlus + $dMinus) > 0 ? $dMinus / ($dPlus + $dMinus) : 0;

            $results[] = [
                'code' => $alt->code,
                'brand' => $alt->brand,
                'name' => $alt->name,
                'category' => $alt->category,
                'transmission' => $alt->transmission,
                'price' => $alt->price,
                'score' => round($score, 4),
            ];
        }

        // 6. Ranking
        usort($results, fn ($a, $b) => $b['score'] <=> $a['score']);

        foreach ($results as $index => &$result) {
            $result['rank'] = $index + 1;
        }
        unset($result);

        return $results;
    }

    public function render()
    {
        $results = $this->results();
        $criterias = $this->criterias();

        return view('livewire.pages.techniquefor-order-preferenceby-similarityto-ideal-solution.table', compact('results', 'criterias'));
    }
}
