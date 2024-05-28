<?php

namespace App\Filament\Resources\CurrentDirResource\Pages;

use App\Filament\Resources\CurrentDirResource;
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
