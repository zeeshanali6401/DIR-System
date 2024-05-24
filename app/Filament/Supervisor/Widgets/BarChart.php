<?php

namespace App\Filament\Supervisor\Widgets;

use App\Models\DIR;
use Filament\Widgets\ChartWidget;

class BarChart extends ChartWidget
{
    protected static ?string $heading = 'Case Nature wise Chart';
    protected static ?int $sort = 1;
    public ?string $filter = 'today';

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

        switch ($activeFilter) {
            case 'today':
                $query->whereDate('case_date_time', $now);
                break;
            case 'last_month':
                $oneMonthAgo = $now->copy()->subMonth();
                $query->where('case_date_time', '>=', $oneMonthAgo);
                break;
            case 'last_six_months':
                $sixMonthsAgo = $now->copy()->subMonths(6);
                $query->where('case_date_time', '>=', $sixMonthsAgo);
                break;
            case 'year':
                $oneYearAgo = $now->copy()->subYear();
                $query->where('case_date_time', '>=', $oneYearAgo);
                break;
            default:
                $query->whereMonth('case_date_time', $now->month)->whereYear('case_date_time', $now->year);
                break;
        }

        $caseNatureCounts = $query
            ->whereIn('case_nature', ['Traffic Offence', 'Local & Special Laws', 'Crime Against Person', 'Crime Against Property'])
            ->selectRaw('case_nature, count(*) as count')
            ->groupBy('case_nature')
            ->pluck('count', 'case_nature')
            ->toArray();

        $datasets = [
            [
                'label' => 'DIRs',
                'data' => array_values($caseNatureCounts),
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
