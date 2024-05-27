<?php

namespace App\Filament\Widgets;

use App\Models\DIR;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DivisionStatsOverview extends BaseWidget
{
    use HasWidgetShield;

    protected function getStats(): array
    {
        $currentDate = Carbon::today(); // Get the current date

        return [
            Stat::make('City', DIR::where('division', 'city')
                ->whereDate('created_at', $currentDate)
                ->count())
                ->description('All City DIRs')
                ->color('success'),
            Stat::make('Sader', DIR::where('division', 'sader')
                ->whereDate('created_at', $currentDate)
                ->count())
                ->description('All Sader DIRs')
                ->color('success'),
            Stat::make('Civil Lines', DIR::where('division', 'Civil_lines')
                ->whereDate('created_at', $currentDate)
                ->count())
                ->description('All Civil Lines DIRs')
                ->color('success'),
            Stat::make('Iqbal Town', DIR::where('division', 'iqbal_town')
                ->whereDate('created_at', $currentDate)
                ->count())
                ->description('All Iqbal Town DIRs')
                ->color('success'),
            Stat::make('Model Town', DIR::where('division', 'model_town')
                ->whereDate('created_at', $currentDate)
                ->count())
                ->description('All Model Town DIRs')
                ->color('success'),
            Stat::make('Cantt', DIR::where('division', 'cantt')
                ->whereDate('created_at', $currentDate)
                ->count())
                ->description('All Cantt DIRs')
                ->color('success'),
        ];
    }
}
