<?php

namespace App\Filament\Resources\Pages;

use App\Filament\Resources\DIRResource;
use Filament\Resources\Pages\ViewRecord;

class DirImages extends ViewRecord
{
    protected static string $resource = DIRResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.supervisor.pages.record-view';
}
