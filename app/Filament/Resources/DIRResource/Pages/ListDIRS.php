<?php

namespace App\Filament\Resources\DIRResource\Pages;

use App\Filament\Resources\DIRResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDIRS extends ListRecords
{
    protected static string $resource = DIRResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
