<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'kmf',
                'barang_nama' => 'Kemeja Flanel',
                'harga_beli' => 100000,    
                'harga_jual' => 120000,          
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'kmp',
                'barang_nama' => 'Kemeja Polos',
                'harga_beli' => 80000,    
                'harga_jual' => 100000,          
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 2,
                'barang_kode' => 'ktt',
                'barang_nama' => 'Kue Tart',
                'harga_beli' => 50000,    
                'harga_jual' => 60000,        
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 2,
                'barang_kode' => 'snb',
                'barang_nama' => 'Snack Balado',
                'harga_beli' => 10000,    
                'harga_jual' => 15000,             
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 3,
                'barang_kode' => 'ssu',
                'barang_nama' => 'Susu UHT',
                'harga_beli' => 5000,    
                'harga_jual' => 6000,                 
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 3,
                'barang_kode' => 'tht',
                'barang_nama' => 'Teh Boto',
                'harga_beli' => 4000,    
                'harga_jual' => 5000,  
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 3,
                'barang_kode' => 'kpb',
                'barang_nama' => 'Kopi Botol',
                'harga_beli' => 4000,    
                'harga_jual' => 5000,  
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 4,
                'barang_kode' => 'pnc',
                'barang_nama' => 'Panci',
                'harga_beli' => 50000,    
                'harga_jual' => 60000,  
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 4,
                'barang_kode' => 'wjn',
                'barang_nama' => 'Wajan',
                'harga_beli' => 45000,    
                'harga_jual' => 50000,  
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => 'lps',
                'barang_nama' => 'Lipstik',
                'harga_beli' => 15000,    
                'harga_jual' => 16000,  
            ],
            ];
            DB::table('m_barang')->insert($data);
        }

}
