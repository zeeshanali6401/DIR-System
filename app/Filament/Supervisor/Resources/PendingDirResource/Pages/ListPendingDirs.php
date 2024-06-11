<?php

namespace App\Filament\Supervisor\Resources\PendingDirResource\Pages;

use App\Filament\Supervisor\Resources\PendingDirResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendingDirs extends ListRecords
{
    protected static string $resource = PendingDirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
