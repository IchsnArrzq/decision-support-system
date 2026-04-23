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
        $alternatives = [
            [
                'code' => 'MTR001',
                'name' => 'BeAT Sporty CBS',
                'brand' => 'Honda',
                'category' => 'Matic',
                'transmission' => 'Otomatis',
                'price' => 18500000,
            ],
            [
                'code' => 'MTR002',
                'name' => 'Gear 125 S',
                'brand' => 'Yamaha',
                'category' => 'Matic',
                'transmission' => 'Otomatis',
                'price' => 20600000,
            ],
            [
                'code' => 'MTR003',
                'name' => 'Nex II Standard',
                'brand' => 'Suzuki',
                'category' => 'Matic',
                'transmission' => 'Otomatis',
                'price' => 19200000,
            ],
            [
                'code' => 'MTR004',
                'name' => 'Callisto 110',
                'brand' => 'TVS',
                'category' => 'Matic',
                'transmission' => 'Otomatis',
                'price' => 21000000,
            ],
            [
                'code' => 'MTR005',
                'name' => 'Supra X 125 FI',
                'brand' => 'Honda',
                'category' => 'Bebek',
                'transmission' => 'Semi Otomatis',
                'price' => 19100000,
            ],
            [
                'code' => 'MTR006',
                'name' => 'Jupiter Z1',
                'brand' => 'Yamaha',
                'category' => 'Bebek',
                'transmission' => 'Semi Otomatis',
                'price' => 21000000,
            ],
            [
                'code' => 'MTR007',
                'name' => 'CB150 Verza',
                'brand' => 'Honda',
                'category' => 'Sport/Kopling',
                'transmission' => 'Manual',
                'price' => 23500000,
            ],
            [
                'code' => 'MTR008',
                'name' => 'Vixion R',
                'brand' => 'Yamaha',
                'category' => 'Sport/Kopling',
                'transmission' => 'Manual',
                'price' => 34500000,
            ],
            [
                'code' => 'MTR009',
                'name' => 'GSX-R150',
                'brand' => 'Suzuki',
                'category' => 'Sport/Kopling',
                'transmission' => 'Manual',
                'price' => 38800000,
            ],
            [
                'code' => 'MTR010',
                'name' => 'W175 SE',
                'brand' => 'Kawasaki',
                'category' => 'Sport/Kopling',
                'transmission' => 'Manual',
                'price' => 36900000,
            ],
            [
                'code' => 'MTR011',
                'name' => 'PCX 160 CBS',
                'brand' => 'Honda',
                'category' => 'Skuter Maxi',
                'transmission' => 'Otomatis',
                'price' => 32700000,
            ],
            [
                'code' => 'MTR012',
                'name' => 'NMAX 155 Connected',
                'brand' => 'Yamaha',
                'category' => 'Skuter Maxi',
                'transmission' => 'Otomatis',
                'price' => 36300000,
            ],
            [
                'code' => 'MTR013',
                'name' => 'Sprint 150 i-get',
                'brand' => 'Vespa',
                'category' => 'Skuter Premium',
                'transmission' => 'Otomatis',
                'price' => 56600000,
            ],
            [
                'code' => 'MTR014',
                'name' => 'Panarea 125',
                'brand' => 'Benelli',
                'category' => 'Skuter Retro',
                'transmission' => 'Otomatis',
                'price' => 26900000,
            ],
        ];

        foreach ($alternatives as $alternative) {
            Alternative::updateOrCreate(
                ['code' => $alternative['code']],
                $alternative
            );
        }

        $codes = collect($alternatives)->pluck('code');

        Alternative::query()
            ->where(function ($query) use ($codes) {
                $query->whereNotIn('code', $codes)
                    ->orWhereNull('code');
            })
            ->delete();
    }
}
