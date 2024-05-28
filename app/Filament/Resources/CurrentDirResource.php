<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurrentDirResource\Pages;
use App\Filament\Resources\CurrentDirResource\RelationManagers;
use App\Models\CurrentDir;
use App\Models\DIR;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CurrentDirResource extends Resource
{
    protected static ?string $model = DIR::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                TextColumn::make('finding_remarks')
                    ->state(function (DIR $record): string {
                        return $record->finding_remarks == 1 ? 'Found' : 'Not Found';
                    })->badge()
                    ->color(fn (string $state): string => $state == 'Found' ? 'success' : 'danger'),
                CheckboxColumn::make('status')->label('Valid'),
                TextColumn::make('division')->sortable()->searchable(),
                TextColumn::make('ps')->sortable()->searchable(),
                TextColumn::make('case_nature')->sortable(),
                TextColumn::make('case_date_time')->label('Date'),
                TextColumn::make('caller_phone')->searchable(),
                TextColumn::make('case_description'),
                TextColumn::make('location')->searchable(),
                TextColumn::make('camera_id')->searchable(),
                TextColumn::make('evidence')->searchable(),

                // TextColumn::make('finding_remarks')->sortable(),
                TextColumn::make('pco_names'),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
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
            'index' => Pages\ListCurrentDirs::route('/'),
            'edit' => Pages\EditCurrentDir::route('/{record}/edit'),
        ];
    }
}
