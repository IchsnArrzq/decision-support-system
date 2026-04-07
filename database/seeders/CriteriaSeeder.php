<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Criteria::insert([
            [
                'code' => 'C1',
                'name' => 'Absensi',
                'weight' => 0.4,
                'type' => 'benefit',
            ],
            [
                'code' => 'C2',
                'name' => 'Kinerja',
                'weight' => 0.35,
                'type' => 'benefit',
            ],
            [
                'code' => 'C3',
                'name' => 'Disiplin',
                'weight' => 0.25,
                'type' => 'benefit',
            ],
        ]);
    }
}
