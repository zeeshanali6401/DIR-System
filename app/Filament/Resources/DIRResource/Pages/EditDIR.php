<?php

namespace App\Filament\Resources\DIRResource\Pages;

use App\Filament\Resources\DIRResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDIR extends EditRecord
{
    protected static string $resource = DIRResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
