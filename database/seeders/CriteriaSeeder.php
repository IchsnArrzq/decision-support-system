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
        $criteriaData = [
            [
                'code' => 'C1',
                'name' => 'Harga OTR',
                'indicator' => 'Harga on the road motor',
                'unit' => 'Rupiah',
                'weight' => 0.22,
                'type' => 'cost',
            ],
            [
                'code' => 'C2',
                'name' => 'Konsumsi BBM',
                'indicator' => 'Efisiensi pemakaian bahan bakar',
                'unit' => 'km/l',
                'weight' => 0.18,
                'type' => 'benefit',
            ],
            [
                'code' => 'C3',
                'name' => 'Biaya Servis Tahunan',
                'indicator' => 'Estimasi biaya servis rutin per tahun',
                'unit' => 'Rupiah/tahun',
                'weight' => 0.12,
                'type' => 'cost',
            ],
            [
                'code' => 'C4',
                'name' => 'Fitur Keamanan dan Teknologi',
                'indicator' => 'Skor fitur seperti ABS, smart key, panel digital',
                'unit' => 'Skor 1-100',
                'weight' => 0.14,
                'type' => 'benefit',
            ],
            [
                'code' => 'C5',
                'name' => 'Ketersediaan Bengkel dan Sparepart',
                'indicator' => 'Kemudahan akses bengkel resmi dan suku cadang',
                'unit' => 'Skor 1-100',
                'weight' => 0.12,
                'type' => 'benefit',
            ],
            [
                'code' => 'C6',
                'name' => 'Kenyamanan Berkendara',
                'indicator' => 'Skor kenyamanan untuk penggunaan harian',
                'unit' => 'Skor 1-100',
                'weight' => 0.10,
                'type' => 'benefit',
            ],
            [
                'code' => 'C7',
                'name' => 'Performa Mesin',
                'indicator' => 'Skor performa akselerasi dan tenaga',
                'unit' => 'Skor 1-100',
                'weight' => 0.07,
                'type' => 'benefit',
            ],
            [
                'code' => 'C8',
                'name' => 'Nilai Jual Kembali',
                'indicator' => 'Skor estimasi harga jual kembali',
                'unit' => 'Skor 1-100',
                'weight' => 0.05,
                'type' => 'benefit',
            ],
        ];

        foreach ($criteriaData as $criteria) {
            Criteria::updateOrCreate(
                ['code' => $criteria['code']],
                $criteria
            );
        }

        Criteria::query()
            ->whereNotIn('code', collect($criteriaData)->pluck('code'))
            ->delete();
    }
}
