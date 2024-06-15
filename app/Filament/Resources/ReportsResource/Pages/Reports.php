<?php

namespace App\Filament\Resources\ReportsResource\Pages;

use App\Filament\Resources\ReportsResource;
use App\Filament\Resources\SurveyorResource\Pages;
use App\Filament\Resources\SurveyorResource;
use App\Models\DIR;
use App\Models\District;
use App\Models\Project;
use App\Models\Supervisor;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Resources\Pages\Page;
use Filament\Support\Enums\Alignment;
use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\View\View;

class Reports extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    public $record;
    protected static string $resource = ReportsResource::class;

    protected static string $view = 'filament.resources.reports-resource.pages.reports';
    protected function getTableQuery()
    {
        $Supervisor_id = Supervisor::find($this->record)->username;
        return DIR::query()->where('supervisor_id', $Supervisor_id);
    }
    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('case_id'),
            TextColumn::make('team')->label('Name'),
            TextColumn::make('shift'),
            TextColumn::make('gang_name'),
            TextColumn::make('status'),
            TextColumn::make('status')
                    ->state(function (DIR $record): string {
                        return $record->status === 'valid' ? 'valid' : 'invalid';
                    })->badge()
                    ->color(fn (string $state): string => $state === 'valid' ? 'success' : 'danger'),
            TextColumn::make('finding_remarks')->label('Findings')
                    ->state(function (DIR $record): string {
                        return $record->finding_remarks == 1 ? 'Found' : 'Not Found';
                    })->badge()
                    ->color(fn (string $state): string => $state == 'Found' ? 'success' : 'danger'),
        ];
    }
    protected function getTableFilters(): array
    {
        return [
            Filter::make('case_date_time')
                ->form([
                    DatePicker::make('created_from')->default(now()),
                    DatePicker::make('created_until'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('case_date_time', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('case_date_time', '<=', $date),
                        );
                }),
            SelectFilter::make('status')
                ->options([
                    'pending' => 'Pending',
                    'vlid' => 'Valid',
                    'invalid' => 'Invalid',
                ]),
            SelectFilter::make('finding_remarks')
                ->options([
                    1 => 'Found',
                    0 => 'Not Found',
                ]),
            SelectFilter::make('case_nature')
                ->options([
                    'Crime Against Property' => 'Crime Against Property',
                    'Local & Special Laws' => 'Local & Special Laws',
                    'Crime Against Person' => 'Crime Against Person',
                    'Traffic Offence' => 'Traffic Offence'
                ]),
            SelectFilter::make('ps')
                ->options(DIR::all()->pluck('ps', 'ps')),
        ];
    }
}
