<?php

namespace App\Filament\Resources\PCOResource\Pages;

use App\Filament\Resources\PCOResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPCOS extends ListRecords
{
    protected static string $resource = PCOResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Create DIR'),
        ];
    }
}
