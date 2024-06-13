<?php

namespace App\Filament\Pco\Pages;

use App\Filament\Pco\Resources\DIRResource;
use Filament\Resources\Pages\ViewRecord;

class DirImages extends ViewRecord
{
    protected static string $resource = DIRResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.supervisor.pages.record-view';
}
