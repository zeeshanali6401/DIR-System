<?php

namespace App\Filament\Pco\Resources\DIRResource\Pages;

use App\Filament\Pco\Resources\DIRResource;
use Filament\Actions;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewDirRecord extends ViewRecord
{
    protected static string $resource = DIRResource::class;
    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Fieldset::make('')
                    ->schema([
                        TextEntry::make('case_id')->label('Case ID'),
                        TextEntry::make('caller_phone')->label('Caller Phone'),
                        TextEntry::make('case_date_time')->label('Case Date Time'),
                        TextEntry::make('ps')->label('PS'),
                        TextEntry::make('case_nature')->label('Case Nature'),
                        TextEntry::make('location')->label('Location'),
                        TextEntry::make('case_description')->label('Case Description'),
                        TextEntry::make('camera_id')->label('Camera ID'),
                        TextEntry::make('evidence')->label('Evidence'),
                        TextEntry::make('cro')->label('CRO'),
                        TextEntry::make('face_trace')->label('Face Trace'),
                        TextEntry::make('anpr_passing')->label('ANPR Passing'),
                        TextEntry::make('finding_remarks')->label('Finding Remarks'),
                        TextEntry::make('team')->label('Team'),
                        TextEntry::make('culprit')->label('Culprit'),
                        TextEntry::make('fir_number')->label('FIR Number'),
                        TextEntry::make('feedback')->label('Feedback'),
                        TextEntry::make('shift')->label('Shift'),
                        TextEntry::make('division')->label('Division'),
                        TextEntry::make('pco_names')->label('PCO Names'),
                        TextEntry::make('user_ip')->label('User IP'),
                        TextEntry::make('status')->label('Status'),
                        TextEntry::make('user_email')->label('User Email'),
                        TextEntry::make('user_hostname')->label('User Hostname'),
                    ])->columns(3),
                Section::make()->schema([
                    ImageEntry::make('images')->limit(7)
                        ->limitedRemainingText()
                ])
            ]);
    }
}
