<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserChart
{
    protected $chart;
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }
    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');

        $dr = DB::select(
            "SELECT sum(pd.jumlah) as count, DATE_FORMAT(p.created_at, '%W %d %M') as day 
            FROM t_penjualan_detail as pd 
            INNER JOIN t_penjualan as p ON pd.penjualan_id = p.penjualan_id
            WHERE p.created_at >= '".$start."' 
            GROUP BY day"
        );

        $dr = collect($dr);
        $prosessData = collect();

        for ($i=0; $i < ((Int) Carbon::now()->format('d')); $i++) { 
            $date =  Carbon::now()->subDays($i)->format('l d F');
            $existDate = $dr->where('day', $date);
            if($existDate->isEmpty()){
                $prosessData->prepend([
                    'count' => 0,
                    'day' => $date
                ]);
            }else{
                $prosessData->prepend([
                    'count' => $existDate->first()->count,
                    'day' => $existDate->first()->day
                ]);
            }
        }
        $data = $prosessData->pluck('count')->toArray();
        $date = $prosessData->pluck('day')->toArray();
        return $this->chart->barChart()
            ->setTitle('Grafik Barang Terjual')
            ->addData('Jumlah Barang Terjual', $data)
            ->setXAxis($date);
    }
}
