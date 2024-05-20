<?php

namespace App\Filament\Widgets;

use App\Models\DIR;
use Filament\Widgets\ChartWidget;

class BarChart extends ChartWidget
{
    protected static ?string $heading = 'Case Nature wise Chart';
    protected static ?int $sort = 1;


    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $caseNatureCounts = DIR::query()
            ->whereIn('case_nature', ['Traffic Offence', 'Local & Special Laws', 'Crime Against Person', 'Crime Against Property'])
            ->selectRaw('case_nature, count(*) as count')
            ->groupBy('case_nature')
            ->pluck('count', 'case_nature')
            ->toArray();

        $datasets = [
            [
                'label' => 'DIRs',
                'data' => array_values($caseNatureCounts),
                // 'backgroundColor' => [
                //     'rgba(255, 99, 132, 0.2)',
                //     'rgba(255, 159, 64, 0.2)',
                //     'rgba(255, 205, 86, 0.2)',
                //     'rgba(75, 192, 192, 0.2)',
                //     'rgba(54, 162, 235, 0.2)',
                //     'rgba(153, 102, 255, 0.2)',
                //     'rgba(201, 203, 207, 0.2)'
                // ],
                // 'borderColor' => [
                //     'rgb(255, 99, 132)',
                //     'rgb(255, 159, 64)',
                //     'rgb(255, 205, 86)',
                //     'rgb(75, 192, 192)',
                //     'rgb(54, 162, 235)',
                //     'rgb(153, 102, 255)',
                //     'rgb(201, 203, 207)'
                // ],
                'maxBarThickness' => 40,
                'borderWidth' => 2,
                'borderRadius' => 10,
            ],
        ];

        $labels = array_keys($caseNatureCounts);

        return compact('datasets', 'labels');
    }


    protected function getType(): string
    {
        return 'bar';
    }
}
