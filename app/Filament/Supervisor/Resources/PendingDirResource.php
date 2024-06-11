<?php

namespace App\Filament\Supervisor\Resources;

use App\Filament\Supervisor\Resources\DIRResource\Pages\ViewDirRecord;
use App\Filament\Supervisor\Resources\PendingDirResource\Pages;
use App\Filament\Supervisor\Resources\PendingDirResource\RelationManagers;
use App\Models\DIR;
use App\Models\PendingDir;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PendingDirResource extends Resource
{
    protected static ?string $model = DIR::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationLabel = 'Pending DIRs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $currentTime = Carbon::now();

                if ($currentTime->between(Carbon::today()->setTime(6, 0), Carbon::today()->setTime(13, 59, 59))) {
                    $startTime = Carbon::today()->setTime(6, 0);
                    $endTime = Carbon::today()->setTime(13, 59, 59);
                } elseif ($currentTime->between(Carbon::today()->setTime(14, 0), Carbon::today()->setTime(21, 59, 59))) {
                    $startTime = Carbon::today()->setTime(14, 0);
                    $endTime = Carbon::today()->setTime(21, 59, 59);
                } else {
                    $startTime = Carbon::today()->setTime(22, 0);
                    $endTime = Carbon::tomorrow()->setTime(5, 59, 59);
                }
                $query->whereBetween('created_at', [$startTime, $endTime])->where('status', 'pending');
            })
            ->poll('4s')
            ->modifyQueryUsing(function (Builder $query) {
                $currentTime = Carbon::now();

                if ($currentTime->between(Carbon::today()->setTime(6, 0), Carbon::today()->setTime(13, 59, 59))) {
                    $startTime = Carbon::today()->setTime(6, 0);
                    $endTime = Carbon::today()->setTime(13, 59, 59);
                } elseif ($currentTime->between(Carbon::today()->setTime(14, 0), Carbon::today()->setTime(21, 59, 59))) {
                    $startTime = Carbon::today()->setTime(14, 0);
                    $endTime = Carbon::today()->setTime(21, 59, 59);
                } else {
                    $startTime = Carbon::today()->setTime(22, 0);
                    $endTime = Carbon::tomorrow()->setTime(5, 59, 59);
                }

                $query->whereBetween('created_at', [$startTime, $endTime]);
            })

            ->recordAction(null)
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->columns([
                TextColumn::make('team')->sortable()->searchable(),
                TextColumn::make('shift')->sortable(),
                ImageColumn::make('images')->circular()
                    ->stacked(),
                TextColumn::make('finding_remarks')->label('Findings')
                    ->state(function (DIR $record): string {
                        return $record->finding_remarks == 1 ? 'Found' : 'Not Found';
                    })->badge()
                    ->color(fn (string $state): string => $state == 'Found' ? 'success' : 'danger'),
                TextColumn::make('division')->sortable()->searchable(),
                TextColumn::make('ps')->sortable()->searchable(),
                SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'valid' => 'Valid',
                        'invalid' => 'Invalid',
                    ])->rules(['required'])
            ])
            ->actions([
                Tables\Actions\Action::make('View')->color('success')->icon('heroicon-o-eye')->url(fn (DIR $record): string =>  self::getUrl('ViewDirRecord', ['record' => $record])),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            // ->bulkActions([
            //     Tables\Actions\DeleteBulkAction::make(),
            // ])
            ->recordUrl(null);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendingDirs::route('/'),
            // 'create' => Pages\CreatePendingDir::route('/create'),
            // 'edit' => Pages\EditPendingDir::route('/{record}/edit'),
            'ViewDirRecord' => ViewDirRecord::route('/{record}/ViewDirRecord'),
        ];
    }
}
