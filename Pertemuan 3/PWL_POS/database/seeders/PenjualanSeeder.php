<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 3,
                'pembeli' => 'Gadis',
                'penjualan_kode' => 'A001',
                'penjualan_tanggal' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Ereen',
                'penjualan_kode' => 'A002',
                'penjualan_tanggal' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Sonnya',
                'penjualan_kode' => 'A003',
                'penjualan_tanggal' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Rossy',
                'penjualan_kode' => 'A004',
                'penjualan_tanggal' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Lia',
                'penjualan_kode' => 'A005',
                'penjualan_tanggal' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Bangkit',
                'penjualan_kode' => 'A006',
                'penjualan_tanggal' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Hendra',
                'penjualan_kode' => 'A007',
                'penjualan_tanggal' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Rahmat',
                'penjualan_kode' => 'A008',
                'penjualan_tanggal' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Ferly',
                'penjualan_kode' => 'A009',
                'penjualan_tanggal' => now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Arya',
                'penjualan_kode' => 'A0010',
                'penjualan_tanggal' => now(),
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
