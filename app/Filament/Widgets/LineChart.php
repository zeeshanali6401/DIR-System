<?php

namespace App\Filament\Widgets;

use App\Models\DIR;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class LineChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly stats';
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
                    'label' => 'Total Cases Stat',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate)
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
    public function getDescription(): ?string
    {
        return 'The number of DIR recorded per month.';
    }
    protected function getType(): string
    {
        return 'line';
    }
}
