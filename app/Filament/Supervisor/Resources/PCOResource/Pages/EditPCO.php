<?php

namespace App\Filament\Supervisor\Resources\PCOResource\Pages;

use App\Filament\Supervisor\Resources\PCOResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPCO extends EditRecord
{
    protected static string $resource = PCOResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
