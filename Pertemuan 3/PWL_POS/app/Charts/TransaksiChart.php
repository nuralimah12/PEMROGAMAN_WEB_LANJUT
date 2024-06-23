<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class TransaksiChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
{
    $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:ss');
        
    $dataRaw = DB::select(
    "SELECT sum(pd.harga * pd.jumlah) as total, DATE_FORMAT(p.created_at, '%d %M %Y') as day
    from t_penjualan_detail as pd
    inner join t_penjualan as p on p.penjualan_id = pd.penjualan_id
    where p.created_at >='".$start."' GROUP by day"
    );

    //parse array to collection
    $dataRaw = collect($dataRaw);
    //to hold processed data
    $processedData = collect();

    // dd(Carbon::now()->subDays(2)->format('d F Y'), $dataRaw, (Int) Carbon::now()->format('d'));

    for ($i=0; $i < ((Int) Carbon::now()->format('d')); $i++) { 
        $comparisonDate =  Carbon::now()->subDays($i)->format('d F Y');

        $existDate = $dataRaw->where('day', $comparisonDate);

        // if($i == 1) dd($existDate, $dataRaw, $comparisonDate, $comparisonDate == $dataRaw[$i]->day? true: false);

        if($existDate->isEmpty()){
            $processedData->prepend([
                'total' => 0,
                'day' => $comparisonDate
            ]);
        }else{
            $processedData->prepend([
                'total' => $existDate->first()->total,
                'day' => $existDate->first()->day
            ]);
        }
    }

    //Number of registrants
    $data =$processedData->pluck('total')->toArray();

    //Date
    $date = $processedData->pluck('day')->toArray();
    

    {
        return $this->chart->lineChart()
            ->setTitle('Transaksi Penjualan')
            ->setSubtitle('Transaksi Data')
            ->addData('Total Transaksi', $data)
            ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
            ->setXAxis($date);
    }
}
}