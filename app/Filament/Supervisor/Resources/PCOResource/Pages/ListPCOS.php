<?php

namespace App\Filament\Supervisor\Resources\PCOResource\Pages;

use App\Filament\Supervisor\Resources\PCOResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPCOS extends ListRecords
{
    protected static string $resource = PCOResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
