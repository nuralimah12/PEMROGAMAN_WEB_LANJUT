<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'pkn',
                'kategori_nama' => 'Pakaian',            
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'mkn',
                'kategori_nama' => 'Makanan',            
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'mnm',
                'kategori_nama' => 'Minuman',            
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'gbh',
                'kategori_nama' => 'Gerabah',            
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'kmk',
                'kategori_nama' => 'Kosmetik',            
            ],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
