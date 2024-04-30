<?php

namespace App\Filament\Resources\DIRResource\Pages;

use App\Filament\Resources\DIRResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDIRS extends ListRecords
{
    protected static string $resource = DIRResource::class;
    protected static ?string $title = 'DIR';
    protected ?string $heading = 'Daily Investigation Report';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Create DIR'),
        ];
    }
}
