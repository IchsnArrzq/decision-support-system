<?php

namespace Database\Seeders;

use App\Models\Value;
use Illuminate\Database\Seeder;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Value::insert([
            // ANDI (id = 1)
            [
                'alternative_id' => 1,
                'criteria_id' => 1,
                'value' => 80,
            ],
            [
                'alternative_id' => 1,
                'criteria_id' => 2,
                'value' => 70,
            ],
            [
                'alternative_id' => 1,
                'criteria_id' => 3,
                'value' => 90,
            ],

            // BUDI (id = 2)
            [
                'alternative_id' => 2,
                'criteria_id' => 1,
                'value' => 85,
            ],
            [
                'alternative_id' => 2,
                'criteria_id' => 2,
                'value' => 80,
            ],
            [
                'alternative_id' => 2,
                'criteria_id' => 3,
                'value' => 85,
            ],

            // CITRA (id = 3)
            [
                'alternative_id' => 3,
                'criteria_id' => 1,
                'value' => 78,
            ],
            [
                'alternative_id' => 3,
                'criteria_id' => 2,
                'value' => 85,
            ],
            [
                'alternative_id' => 3,
                'criteria_id' => 3,
                'value' => 88,
            ],

            // DEWI (id = 4)
            [
                'alternative_id' => 4,
                'criteria_id' => 1,
                'value' => 90,
            ],
            [
                'alternative_id' => 4,
                'criteria_id' => 2,
                'value' => 75,
            ],
            [
                'alternative_id' => 4,
                'criteria_id' => 3,
                'value' => 80,
            ],
        ]);
    }
}
