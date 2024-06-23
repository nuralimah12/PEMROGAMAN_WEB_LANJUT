<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class StockChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Get total stock from t_stok table
        $stocks = DB::table('t_stok')
            ->select(DB::raw('SUM(stok_jumlah) as total_stok'))
            ->first();

        $totalStock = $stocks->total_stok;

        return $this->chart->barChart()
            ->setTitle('Grafik Total Sisa Stok Barang')
            ->addData('Total Sisa Stok', [$totalStock])
            ->setXAxis(['Total Stok']);
    }
}
