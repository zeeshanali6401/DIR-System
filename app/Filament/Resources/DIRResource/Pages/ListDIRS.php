<?php

namespace App\Filament\Resources\DIRResource\Pages;

use App\Filament\Exports\DirPendingExporter;
use App\Filament\Exports\PendingExporter;
use App\Filament\Resources\DIRResource;
use Filament\Actions;
use Filament\Actions\ExportAction as ActionsExportAction;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Support\Enums\MaxWidth;

class ListDIRS extends ListRecords
{
    protected static string $resource = DIRResource::class;
    protected static ?string $title = 'DIR';
    protected ?string $heading = 'Daily Incident Report';

    protected function getHeaderActions(): array
    {
        $currentTime = Carbon::now();
        $startTime = Carbon::today();
        $endTime = Carbon::tomorrow()->subSecond();

        if ($currentTime->between(Carbon::today()->setTime(6, 0), Carbon::today()->setTime(13, 59, 59))) {
            $startTime->setTime(6, 0);
            $endTime = Carbon::today()->setTime(13, 59, 59);
        } elseif ($currentTime->between(Carbon::today()->setTime(14, 0), Carbon::today()->setTime(21, 59, 59))) {
            $startTime->setTime(14, 0);
            $endTime = Carbon::today()->setTime(21, 59, 59);
        } else {
            $startTime->subDay()->setTime(22, 0);
            $endTime->subDay()->setTime(5, 59, 59);
        }
        return [
            // Actions\CreateAction::make()->label('Create DIR'),
            Action::make('export')
                ->modalHeading('Export Data')
                ->modalContent(view('pages.export'))
                ->modalSubmitAction(false)
                ->modalCancelAction(false)
                ->modalWidth(MaxWidth::Small),
        ];
    }
}
