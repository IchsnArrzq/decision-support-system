<?php

namespace Database\Seeders;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Value;
use Illuminate\Database\Seeder;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matrix = [
            'MTR001' => [
                'C1' => 18500000,
                'C2' => 60,
                'C3' => 1200000,
                'C4' => 78,
                'C5' => 95,
                'C6' => 80,
                'C7' => 70,
                'C8' => 92,
            ],
            'MTR002' => [
                'C1' => 20600000,
                'C2' => 55,
                'C3' => 1300000,
                'C4' => 80,
                'C5' => 90,
                'C6' => 82,
                'C7' => 72,
                'C8' => 86,
            ],
            'MTR003' => [
                'C1' => 19200000,
                'C2' => 58,
                'C3' => 1250000,
                'C4' => 74,
                'C5' => 78,
                'C6' => 78,
                'C7' => 68,
                'C8' => 75,
            ],
            'MTR004' => [
                'C1' => 21000000,
                'C2' => 52,
                'C3' => 1400000,
                'C4' => 72,
                'C5' => 65,
                'C6' => 79,
                'C7' => 66,
                'C8' => 62,
            ],
            'MTR005' => [
                'C1' => 19100000,
                'C2' => 60,
                'C3' => 1250000,
                'C4' => 70,
                'C5' => 94,
                'C6' => 76,
                'C7' => 71,
                'C8' => 90,
            ],
            'MTR006' => [
                'C1' => 21000000,
                'C2' => 58,
                'C3' => 1300000,
                'C4' => 68,
                'C5' => 89,
                'C6' => 77,
                'C7' => 73,
                'C8' => 84,
            ],
            'MTR007' => [
                'C1' => 23500000,
                'C2' => 45,
                'C3' => 1700000,
                'C4' => 75,
                'C5' => 93,
                'C6' => 79,
                'C7' => 80,
                'C8' => 85,
            ],
            'MTR008' => [
                'C1' => 34500000,
                'C2' => 41,
                'C3' => 2200000,
                'C4' => 82,
                'C5' => 90,
                'C6' => 81,
                'C7' => 86,
                'C8' => 82,
            ],
            'MTR009' => [
                'C1' => 38800000,
                'C2' => 40,
                'C3' => 2500000,
                'C4' => 84,
                'C5' => 77,
                'C6' => 75,
                'C7' => 90,
                'C8' => 78,
            ],
            'MTR010' => [
                'C1' => 36900000,
                'C2' => 38,
                'C3' => 2300000,
                'C4' => 70,
                'C5' => 76,
                'C6' => 78,
                'C7' => 78,
                'C8' => 76,
            ],
            'MTR011' => [
                'C1' => 32700000,
                'C2' => 47,
                'C3' => 1800000,
                'C4' => 88,
                'C5' => 93,
                'C6' => 90,
                'C7' => 84,
                'C8' => 91,
            ],
            'MTR012' => [
                'C1' => 36300000,
                'C2' => 45,
                'C3' => 2000000,
                'C4' => 90,
                'C5' => 90,
                'C6' => 92,
                'C7' => 88,
                'C8' => 90,
            ],
            'MTR013' => [
                'C1' => 56600000,
                'C2' => 33,
                'C3' => 3200000,
                'C4' => 80,
                'C5' => 60,
                'C6' => 87,
                'C7' => 82,
                'C8' => 72,
            ],
            'MTR014' => [
                'C1' => 26900000,
                'C2' => 42,
                'C3' => 2100000,
                'C4' => 76,
                'C5' => 58,
                'C6' => 83,
                'C7' => 75,
                'C8' => 68,
            ],
        ];

        $alternativeIds = Alternative::query()
            ->whereNotNull('code')
            ->pluck('id', 'code');

        $criteriaIds = Criteria::query()
            ->pluck('id', 'code');

        $rows = [];
        $now = now();

        foreach ($matrix as $alternativeCode => $criteriaValues) {
            $alternativeId = $alternativeIds[$alternativeCode] ?? null;

            if (! $alternativeId) {
                continue;
            }

            foreach ($criteriaValues as $criteriaCode => $value) {
                $criteriaId = $criteriaIds[$criteriaCode] ?? null;

                if (! $criteriaId) {
                    continue;
                }

                $rows[] = [
                    'alternative_id' => $alternativeId,
                    'criteria_id' => $criteriaId,
                    'value' => $value,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        Value::query()->delete();

        if (! empty($rows)) {
            Value::insert($rows);
        }
    }
}
