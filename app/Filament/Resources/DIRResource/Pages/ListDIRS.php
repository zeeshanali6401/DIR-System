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
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->label('Full Export')
                        ->withFilename(date('d-m-Y'))
                        ->withWriterType(\Maatwebsite\Excel\Excel::CSV)
                        ->withColumns([
                            Column::make('team'),
                            Column::make('case_id'),
                            Column::make('culprit'),
                            Column::make('anpr_passing'),
                            Column::make('cro'),
                            Column::make('shift'),
                            Column::make('division'),
                            Column::make('ps'),
                            Column::make('case_nature'),
                            Column::make('time'),
                            Column::make('case_date_time'),
                            Column::make('caller_phone'),
                            Column::make('case_description'),
                            Column::make('location'),
                            Column::make('camera_id'),
                            Column::make('evidence'),
                            Column::make('finding_remarks'),
                            Column::make('pco_names'),
                            Column::make('feedback')
                        ]),
                    ExcelExport::make()->label('Pending DIR Exoport')
                        ->withFilename(date('d-m-Y'))
                        ->withWriterType(\Maatwebsite\Excel\Excel::CSV)
                        ->withColumns([
                            Column::make('team'),
                            Column::make('case_id'),
                            Column::make('culprit'),
                            Column::make('anpr_passing'),
                            Column::make('cro'),
                            Column::make('shift'),
                            Column::make('division'),
                            Column::make('ps'),
                            Column::make('case_nature'),
                            Column::make('time'),
                            Column::make('case_date_time'),
                            Column::make('caller_phone'),
                            Column::make('case_description'),
                            Column::make('location'),
                            Column::make('camera_id'),
                            Column::make('evidence'),
                            Column::make('finding_remarks'),
                            Column::make('pco_names'),
                            Column::make('feedback')
                        ])
                        ->modifyQueryUsing(fn ($query) => $query->where('status', 'pending')->where(function ($query2) use ($startTime, $endTime) {
                            $query2->whereBetween('created_at', [$startTime, $endTime])
                                ->orWhereBetween('created_at', [Carbon::yesterday()->setTime(22, 0), Carbon::today()->setTime(5, 59, 59)]);
                        }))
                ]),
        ];
    }
}
