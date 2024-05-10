<?php

namespace App\Filament\Resources\DIRResource\Pages;

use App\Filament\Resources\DIRResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListDIRS extends ListRecords
{
    protected static string $resource = DIRResource::class;
    protected static ?string $title = 'DIR';
    protected ?string $heading = 'Daily Investigation Report';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Create DIR'),
            ExportAction::make()
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename(date('d-m-Y'))
                        ->withWriterType(\Maatwebsite\Excel\Excel::CSV)
                        ->withColumns([
                            // Column::make('id'),
                        ])
                ]),
        ];
    }
}
