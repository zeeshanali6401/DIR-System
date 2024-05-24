<?php

namespace App\Filament\Widgets;

use App\Models\DIR;
use Filament\Widgets\ChartWidget;

class DoughnutChart extends ChartWidget
{
    public ?string $filter = 'today';


    protected static ?int $sort = 3;
    protected static ?string $heading = 'Chart';
    protected static ?string $maxHeight = '300px';
    protected static ?array $options = ['scales' => ['x' => ['display' => false,], 'y' => ['display' => false,],],];

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'last_month' => 'Last month',
            'last_six_months' => 'Last 6 months',
            'year' => 'This year',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $query = DIR::query();
        $now = now();

        if ($activeFilter === 'today') {
            $query->whereDate('case_date_time', $now);
        } elseif ($activeFilter === 'last_month') {
            $oneMonthAgo = $now->copy()->subMonth();
            $query->where('case_date_time', '>=', $oneMonthAgo);
        } elseif ($activeFilter === 'last_six_months') {
            $sixMonthsAgo = $now->copy()->subMonths(6);
            $query->where('case_date_time', '>=', $sixMonthsAgo);
        } elseif ($activeFilter === 'year') {
            // Calculate the date one year ago from now
            $oneYearAgo = $now->copy()->subYear();
            // Filter records within the last year
            $query->where('case_date_time', '>=', $oneYearAgo);
        } else {
            $query->whereMonth('case_date_time', $now->month)->whereYear('case_date_time', $now->year);
        }
        // Count the found and not found records
        $foundCount = (clone $query)->where('finding_remarks', 1)->count();
        $notFoundCount = (clone $query)->where('finding_remarks', 0)->count();

        return [
            'datasets' => [
                [
                    'data' => [$foundCount, $notFoundCount],
                    'backgroundColor' => ['#00FF00', '#FF0000'],
                    'borderColor' => '#9BD0F5',
                    'hoverOffset' => 30,
                ],
            ],
            'labels' => ['Found', 'Not Found'],
        ];
    }



    public function getDescription(): ?string
    {
        return 'Founded and not founded Cases on this month';
    }
    protected function getType(): string
    {
        return 'doughnut';
    }
}
