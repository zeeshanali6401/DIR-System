<?php

namespace App\Filament\Widgets;

use App\Models\DIR;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class CaseChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly statistics of found cases';
    protected static string $color = 'info';
    protected function getData(): array
    {
        $data = Trend::model(DIR::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Found Cases',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate)
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
