<?php

namespace App\Charts;

use App\Models\LevelModel;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class userChart
{
    protected $chart;
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }
    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $levelMember = LevelModel::where('level_nama', 'Member')->first();
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
   
        $dr = DB::select(
        "SELECT count(user_id) as count, DATE_FORMAT(d.created_at, '%W %d %M') as day 
        from m_user as d 
        where d.level_id =".$levelMember->level_id." and  d.created_at >=".$start."
        GROUP by day"
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
        $data =$prosessData->pluck('count')->toArray();
        $date = $prosessData->pluck('day')->toArray();
        return $this->chart->barChart()
        ->setTitle('Grafik Member')
        ->addData('Physical sales', $data)
        ->setXAxis($date);
    }
}
