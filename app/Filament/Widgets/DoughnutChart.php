<?php

namespace App\Filament\Widgets;

use App\Models\DIR;
use Filament\Widgets\ChartWidget;

class DoughnutChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Chart';
    protected static ?string $maxHeight = '300px';
    protected static ?array $options = ['scales' => ['x' => ['display' => false,], 'y' => ['display' => false,],],];
    protected function getData(): array
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $foundCount = DIR::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('finding_remarks', 1)
            ->count();

        $notFoundCount = DIR::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('finding_remarks', 0)
            ->count();

        return [
            'datasets' => [
                [
                    'data' => [$foundCount, $notFoundCount],
                    'backgroundColor' => ['#00FF00', '#FF0000'],
                    'borderColor' => '#9BD0F5',
                    'hoverOffset' => 30,
                ],

            ],
            'labels' => ['Found', 'Not Found '],
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
