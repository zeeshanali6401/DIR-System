<?php

namespace App\Filament\Widgets;

use App\Models\DIR;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class LineChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 2;
    protected static ?string $heading = 'Total DIR Counts of this year';
    protected static string $color = 'info';
    protected function getData(): array
    {
        $currentYear = date('Y');
        $lastCaseDate = DIR::whereYear('case_date_time', $currentYear)->max('case_date_time');
        $lastMonth = $lastCaseDate ? (new Carbon($lastCaseDate))->month : 0;
        $months = collect(range(1, $lastMonth))->map(function ($month) use ($currentYear) {
            return DIR::whereYear('case_date_time', $currentYear)
                ->whereMonth('case_date_time', '=', $month)
                ->count();
        })->toArray();
        return [
            'datasets' => [
                [
                    'label' => 'DIR',
                    'data' => $months,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => 0.6
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }



    // protected function getData(): array
    // {
    //     $january = DIR::whereMonth('case_date_time', '=', 1)->count();
    //     $fabuary = DIR::whereMonth('case_date_time', '=', 2)->count();
    //     $march = DIR::whereMonth('case_date_time', '=', 3)->count();
    //     $april = DIR::whereMonth('case_date_time', '=', 4)->count();
    //     $may = DIR::whereMonth('case_date_time', '=', 5)->count();
    //     $jun = DIR::whereMonth('case_date_time', '=', 6)->count();
    //     $july = DIR::whereMonth('case_date_time', '=', 7)->count();
    //     $august = DIR::whereMonth('case_date_time', '=', 8)->count();
    //     $september = DIR::whereMonth('case_date_time', '=', 9)->count();
    //     $october = DIR::whereMonth('case_date_time', '=', 10)->count();
    //     $november = DIR::whereMonth('case_date_time', '=', 11)->count();
    //     $december = DIR::whereMonth('case_date_time', '=', 12)->count();

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
