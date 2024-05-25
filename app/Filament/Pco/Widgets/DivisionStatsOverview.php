<?php

namespace App\Filament\Pco\Widgets;

use App\Models\DIR;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DivisionStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $currentDate = Carbon::today(); // Get the current date

        return [
            Stat::make('City', DIR::where('division', 'city')
                ->where('user_email', auth()->user()->email)
                ->whereDate('created_at', $currentDate)
                ->count())
                ->description('All City DIRs')
                ->color('success'),
            Stat::make('Sader', DIR::where('division', 'sader')
                ->where('user_email', auth()->user()->email)

                ->whereDate('created_at', $currentDate)
                ->count())
                ->description('All Sader DIRs')
                ->color('success'),
            Stat::make('Civil Lines', DIR::where('division', 'Civil_lines')
                ->where('user_email', auth()->user()->email)
                ->whereDate('created_at', $currentDate)
                ->count())
                ->description('All Civil Lines DIRs')
                ->color('success'),
            Stat::make('Iqbal Town', DIR::where('division', 'iqbal_town')
                ->where('user_email', auth()->user()->email)
                ->whereDate('created_at', $currentDate)
                ->count())
                ->description('All Iqbal Town DIRs')
                ->color('success'),
            Stat::make('Model Town', DIR::where('division', 'model_town')
                ->where('user_email', auth()->user()->email)
                ->whereDate('created_at', $currentDate)
                ->count())
                ->description('All Model Town DIRs')
                ->color('success'),
            Stat::make('Cantt', DIR::where('division', 'cantt')
                ->where('user_email', auth()->user()->email)
                ->whereDate('created_at', $currentDate)
                ->count())
                ->description('All Cantt DIRs')
                ->color('success'),
        ];
    }
}
