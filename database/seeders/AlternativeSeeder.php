<?php

namespace Database\Seeders;

use App\Models\Alternative;
use Illuminate\Database\Seeder;

class AlternativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alternative::insert([
            [
                'name' => 'Andi',
            ],
            [
                'name' => 'Budi',
            ],
            [
                'name' => 'Citra',
            ],
            [
                'name' => 'Dewi',
            ],
        ]);
    }
}
