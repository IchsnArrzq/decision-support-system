<?php

namespace App\Livewire\Pages\WeightedProduct;

use App\Models\Alternative;
use App\Models\Criteria;
use Livewire\Component;

class Table extends Component
{
    public function results()
    {
        $alternatives = Alternative::with('values.criteria')->get();
        $criterias = Criteria::all();

        $results = [];
        $totalS = 0;

        // 1. hitung S
        foreach ($alternatives as $alt) {
            $S = 1;

            foreach ($alt->values as $val) {
                $criteria = $val->criteria;

                // benefit = +
                // cost = -
                $weight = ($criteria->type == 'benefit')
                    ? $criteria->weight
                    : -$criteria->weight;

                $S *= pow($val->value, $weight);
            }

            $results[] = [
                'name' => $alt->name,
                'S' => $S,
            ];

            $totalS += $S;
        }

        // 2. hitung V (normalisasi)
        foreach ($results as &$row) {
            $row['score'] = round($row['S'] / $totalS, 4);
        }

        // 3. ranking
        usort($results, fn ($a, $b) => $b['score'] <=> $a['score']);

        return $results;
    }

    public function render()
    {
        $results = $this->results();

        return view('livewire.pages.weighted-product.table', compact('results'));
    }
}
