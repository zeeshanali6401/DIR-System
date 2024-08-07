<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportsResource\Pages;
use App\Filament\Resources\ReportsResource\Pages\Reports as PagesReports;
use App\Filament\Resources\ReportsResource\RelationManagers;
use App\Models\DIR;
use App\Models\Reports;
use App\Models\Supervisor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportsResource extends Resource
{
    protected static ?string $model = Supervisor::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Reports';

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
            ->recordUrl(false)
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('username')->searchable(),
                TextColumn::make('email')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('View')->color('success')->icon('heroicon-o-eye')->url(fn (Supervisor $record): string =>  self::getUrl('ViewReport', ['record' => $record]))
            ]);
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReports::route('/create'),
            'ViewReport' => PagesReports::route('/{record}'),
            'edit' => Pages\EditReports::route('/{record}/edit'),
        ];
    }
}
