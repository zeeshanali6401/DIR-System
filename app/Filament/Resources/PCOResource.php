<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PCOResource\Pages;
use App\Filament\Resources\PCOResource\RelationManagers;
use App\Models\PCO;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PCOResource extends Resource
{
    protected static ?string $model = PCO::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->maxLength(255)->required(),
                TextInput::make('username')->maxLength(255)->required(),
                TextInput::make('email')->email()->maxLength(255)->required(),
                TextInput::make('designation')->required(),
                TextInput::make('password')
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state))->password(),
                Select::make('roles')
                    ->relationship('roles', 'name', fn (Builder $query) => $query->whereNot('name', 'super_admin'))
                    ->preload()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('username'),
                TextColumn::make('designation')->sortable(),
                TextColumn::make('roles.name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPCOS::route('/'),
            'create' => Pages\CreatePCO::route('/create'),
            'edit' => Pages\EditPCO::route('/{record}/edit'),
        ];
    }
}
