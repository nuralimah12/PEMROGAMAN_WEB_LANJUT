<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'barang_id' => 1,
                'harga' => 120000,
                'jumlah' => 4,
            ],
           [
                'penjualan_id' => 1,
                'barang_id' => 2,
                'harga' => 80000,
                'jumlah' => 4,
            ],
            [
                'penjualan_id' => 1,
                'barang_id' => 3,
                'harga' => 50000,
                'jumlah' => 2,
            ],
            [
                'penjualan_id'=> 2,
                'barang_id' => 4,
                'harga' => 10000,
                'jumlah' => 10,
            ],
            [
                'penjualan_id' => 2,
                'barang_id' => 5,
                'harga' => 5000,
                'jumlah' => 10,
            ],
            [
                'penjualan_id' => 2,
                'barang_id' => 6,
                'harga' => 4000,
                'jumlah' => 7,
            ],
            [
                'penjualan_id' => 3,
                'barang_id' => 7,
                'harga' => 4000,
                'jumlah' => 11,
            ],
            [
                'penjualan_id' => 3,
                'barang_id' => 8,
                'harga' => 50000,
                'jumlah' => 5,
            ],
            [
                'penjualan_id'=> 3,
                'barang_id' => 9,
                'harga' => 45000,
                'jumlah' => 2,
            ],
            [
                'penjualan_id' => 4,
                'barang_id' => 2,
                'harga' => 80000,
                'jumlah' => 5,
            ],
            [
               'penjualan_id' => 4,
                'barang_id' => 3,
                'harga' => 50000,
                'jumlah' => 2,
            ],
            [
               'penjualan_id' => 4,
                'barang_id' => 4,
                'harga' => 10000,
                'jumlah' => 3,
            ],
            [
                'penjualan_id' => 5,
                'barang_id' => 1,
                'harga' => 120000,
                'jumlah' => 4,
            ],
            [
                'penjualan_id' => 5,
                'barang_id' => 2,
                'harga' => 80000,
                'jumlah' => 2,
            ],
            [
                'penjualan_id' => 5,
                'barang_id' => 3,
                'harga' => 50000,
                'jumlah' => 1,
            ],
            [
                'penjualan_id' => 6,
                'barang_id' => 1,
                'harga' => 120000,
                'jumlah' => 4,
            ],
            [
                'penjualan_id' => 6,
                'barang_id' => 2,
                'harga' => 80000,
                'jumlah' => 4,
            ],
            [
                'penjualan_id' => 6,
                'barang_id' => 3,
                'harga' => 50000,
                'jumlah' => 2,
            ],
            [
                'penjualan_id' => 7,
                'barang_id' => 4,
                'harga' => 10000,
                'jumlah' => 10,
            ],
            [
                'penjualan_id' => 7,
                'barang_id' => 5,
                'harga' => 5000,
                'jumlah' => 10,
            ],
            [
                'penjualan_id' => 7,
                'barang_id' => 6,
                'harga' => 4000,
                'jumlah' => 7,
            ],
            [
                'penjualan_id'=> 8,
                'barang_id' => 7,
                'harga' => 4000,
                'jumlah' => 11,
            ],
            [
                'penjualan_id' => 8,
                'barang_id' => 8,
                'harga' => 50000,
                'jumlah' => 5,
            ],
            [
                'penjualan_id' => 8,
                'barang_id' => 9,
                'harga' => 45000,
                'jumlah' => 2,
            ],
            [
                'penjualan_id' => 9,
                'barang_id' => 2,
                'harga' => 80000,
                'jumlah' => 5,
            ],
            [
                'penjualan_id'=> 9,
                'barang_id' => 3,
                'harga' => 50000,
                'jumlah' => 2,
            ],
            [
                'penjualan_id'=> 9,
                'barang_id' => 4,
                'harga' => 10000,
                'jumlah' => 3,
            ],
            [
                'penjualan_id' => 10,
                'barang_id' => 1,
                'harga' => 120000,
                'jumlah' => 4,
            ],
            [
                'penjualan_id' => 10,
                'barang_id' => 2,
                'harga' => 80000,
                'jumlah' => 2,
            ],
            [
                'penjualan_id' => 10,
                'barang_id' => 3,
                'harga' => 50000,
                'jumlah' => 1,
            ],
        ];
        DB::table('t_penjualan_detail')->insert($data);
    }
}
