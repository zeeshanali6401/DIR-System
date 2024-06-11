<?php

namespace App\Filament\Supervisor\Resources\PendingDirResource\Pages;

use App\Filament\Supervisor\Resources\PendingDirResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendingDir extends EditRecord
{
    protected static string $resource = PendingDirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
