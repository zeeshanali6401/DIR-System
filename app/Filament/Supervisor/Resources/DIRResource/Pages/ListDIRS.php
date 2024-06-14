<?php

namespace App\Filament\Supervisor\Resources\DIRResource\Pages;

use App\Filament\Supervisor\Resources\DIRResource;
use App\Models\DIR;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\View\View;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;


class ListDIRS extends ListRecords
{
    protected static string $resource = DIRResource::class;
    public function getHeading(): string
    {
        return "Manage DIRs";
    }
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
            Action::make('export')
                ->modalHeading('Export Data')
                ->modalContent(view('pages.export'))
                ->modalSubmitAction(false)
                ->modalCancelAction(false)
                ->modalWidth(MaxWidth::Small),
            Actions\CreateAction::make()->label('Create DIR'),
        ];
    }
}
