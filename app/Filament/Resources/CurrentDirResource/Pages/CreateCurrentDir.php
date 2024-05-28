<?php

namespace App\Filament\Resources\CurrentDirResource\Pages;

use App\Filament\Resources\CurrentDirResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCurrentDir extends CreateRecord
{
    protected static string $resource = CurrentDirResource::class;
}
