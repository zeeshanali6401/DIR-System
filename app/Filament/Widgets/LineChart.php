<?php

namespace App\Filament\Widgets;

use App\Models\DIR;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class LineChart extends ChartWidget
{
    protected static ?string $heading = 'Cases';
    protected static string $color = 'info';
    protected function getData(): array
{
    $currentYear = date('Y');
    $lastCaseDate = DIR::whereYear('case_date', $currentYear)->max('case_date');
    $lastMonth = $lastCaseDate ? (new Carbon($lastCaseDate))->month : 0;
    $months = collect(range(1, $lastMonth))->map(function ($month) use ($currentYear) {
        return DIR::whereYear('case_date', $currentYear)
                   ->whereMonth('case_date', '=', $month)
                   ->count();
    })->toArray();
    return [
        'datasets' => [
            [
                'label' => 'Cases',
                'data' => $months,
                'backgroundColor' => '#36A2EB',
                'borderColor' => '#9BD0F5',
            ],
        ],
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    ];
}



// protected function getData(): array
    // {
    //     $january = DIR::whereMonth('case_date', '=', 1)->count();
    //     $fabuary = DIR::whereMonth('case_date', '=', 2)->count();
    //     $march = DIR::whereMonth('case_date', '=', 3)->count();
    //     $april = DIR::whereMonth('case_date', '=', 4)->count();
    //     $may = DIR::whereMonth('case_date', '=', 5)->count();
    //     $jun = DIR::whereMonth('case_date', '=', 6)->count();
    //     $july = DIR::whereMonth('case_date', '=', 7)->count();
    //     $august = DIR::whereMonth('case_date', '=', 8)->count();
    //     $september = DIR::whereMonth('case_date', '=', 9)->count();
    //     $october = DIR::whereMonth('case_date', '=', 10)->count();
    //     $november = DIR::whereMonth('case_date', '=', 11)->count();
    //     $december = DIR::whereMonth('case_date', '=', 12)->count();

    //     return [
    //         'datasets' => [
    //             [
    //                 'label' => 'Cases',
    //                 'data' => [$january, $fabuary, $march, $april, $may, $jun, $july, $august, $september, $october, $november, $december],
    //                 'backgroundColor' => '#36A2EB',
    //                 'borderColor' => '#9BD0F5',
    //             ],
    //         ],
    //         'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    //     ];
    // }
    public function getDescription(): ?string
    {
        return 'The number of DIR recorded per month.';
    }
    protected function getType(): string
    {
        return 'line';
    }
}
