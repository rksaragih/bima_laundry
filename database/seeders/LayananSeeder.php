<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanan = [
            [
                'jenis_laundry' => 'Setrika',
                'harga' => 6000,
                'kategori' => 'Reguler'
            ],
            [
                'jenis_laundry' => 'Cuci Kering',
                'harga' => 7000,
                'kategori' => 'Reguler'
            ],
            [
                'jenis_laundry' => 'Cuci Kering + Setrika 1',
                'harga' => 10000,
                'kategori' => 'Reguler'
            ],
            [
                'jenis_laundry' => 'Cuci Kering + Setrika 2',
                'harga' => 9000,
                'kategori' => 'Reguler'
            ],
            [
                'jenis_laundry' => 'Cuci Kering + Setrika 3',
                'harga' => 8000,
                'kategori' => 'Reguler'
            ],
            [
                'jenis_laundry' => 'Satuan',
                'harga' => 0,
                'kategori' => 'Reguler'
            ],
            [
                'jenis_laundry' => 'Setrika Express',
                'harga' => 7000,
                'kategori' => 'Express'
            ],
            [
                'jenis_laundry' => 'Express 3 Jam',
                'harga' => 20000,
                'kategori' => 'Express'
            ],
            [
                'jenis_laundry' => 'Express 8 Jam',
                'harga' => 18000,
                'kategori' => 'Express'
            ],
            [
                'jenis_laundry' => 'Express 12 Jam',
                'harga' => 12000,
                'kategori' => 'Express'
            ],
            [
                'jenis_laundry' => 'Satuan',
                'harga' => 0,
                'kategori' => 'Express'
            ],
        ];

        foreach ($layanan as $data) {
            Layanan::firstOrCreate(
                [
                    'jenis_laundry' => $data['jenis_laundry'],
                    'kategori' => $data['kategori']
                ],
                [
                    'harga' => $data['harga']
                ]
            );
        }
    }
}
