<?php

namespace App\Filament\Supervisor\Resources\CurrentDirResource\Pages;

use App\Filament\Supervisor\Resources\CurrentDirResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCurrentDir extends EditRecord
{
    protected static string $resource = CurrentDirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
