<?php

namespace App\Filament\Supervisor\Resources\CurrentDirResource\Pages;

use App\Filament\Supervisor\Resources\CurrentDirResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCurrentDirs extends ListRecords
{
    public function getHeading(): string
    {
        $currentTime = date('H:i');
        if ($currentTime >= '06:00' && $currentTime <= '13:59') {
            $shift = 'DIRs for 06:00AM to 02:00PM';
        } elseif ($currentTime >= '14:00' && $currentTime <= '21:59') {
            $shift = 'DIRs for 02:00PM to 10:00PM';
        } else {
            $shift = 'DIRs for 10:00PM to 06:00AM';
        }
        return $shift;
    }
    protected static string $resource = CurrentDirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
