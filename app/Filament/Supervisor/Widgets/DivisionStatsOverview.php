<?php

namespace App\Filament\Supervisor\Widgets;

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
        $currentTime = Carbon::now();

        if ($currentTime->between(Carbon::today()->setTime(6, 0), Carbon::today()->setTime(13, 59, 59))) {
            $startTime = Carbon::today()->setTime(6, 0);
            $endTime = Carbon::today()->setTime(13, 59, 59);
        } elseif ($currentTime->between(Carbon::today()->setTime(14, 0), Carbon::today()->setTime(21, 59, 59))) {
            $startTime = Carbon::today()->setTime(14, 0);
            $endTime = Carbon::today()->setTime(21, 59, 59);
        } else {
            $startTime = Carbon::today()->setTime(22, 0);
            $endTime = Carbon::tomorrow()->setTime(5, 59, 59);
        }
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
            Stat::make('Pending: ' . DIR::where('status', 'pending')->count(), 'Valid: ' . DIR::where('status', 'valid')->count())
                ->description('Invalid: ' . DIR::where('status', 'invalid')->whereBetween('created_at', [$startTime, $endTime])->count())
                ->color('danger'),
        ];
    }
}
