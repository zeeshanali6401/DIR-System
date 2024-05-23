<?php

namespace App\Filament\Widgets;

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
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }
    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $caseNatureCounts = [];

        // Define date ranges based on the filter
        switch ($activeFilter) {
            case 'today':
                $startDate = now()->startOfDay();
                $endDate = now()->endOfDay();
                break;
            case 'week':
                $startDate = now()->startOfWeek();

                $endDate = now()->endOfWeek();
                break;
            case 'month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            case 'year':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;
            default:
                $startDate = null;
                $endDate = null;
                break;
        }

        if ($startDate && $endDate) {
            $caseNatureCounts = DIR::query()
                ->whereBetween('created_at', [$startDate, $endDate])
                ->whereIn('case_nature', ['Traffic Offence', 'Local & Special Laws', 'Crime Against Person', 'Crime Against Property'])
                ->selectRaw('case_nature, count(*) as count')
                ->groupBy('case_nature')
                ->pluck('count', 'case_nature')
                ->toArray();
        }

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
