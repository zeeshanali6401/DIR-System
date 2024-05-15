<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DIRResource\Pages;
use App\Filament\Resources\DIRResource\RelationManagers;
use App\Models\DIR;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ImageColumn;

class DIRResource extends Resource
{
    protected static ?string $model = DIR::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';
    protected static ?string $navigationLabel = 'DIR';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('team')->required()->alpha(),
                        TextInput::make('shift')->required()->alpha(),
                        Select::make('division')->required()
                            ->options([
                                'city' => 'City',
                                'cant' => 'Cant',
                                'civil_lines' => 'Civil Lines',
                                'iqbal_town' => 'Iqbal Town',
                                'model_town' => 'Model Town',
                                'sader' => 'Sader',
                            ])->searchable(),
                        Select::make('ps')->required()
                            ->options([
                                'shafiqabad' => 'Shafiqabad',
                                'gowal_mandi' => 'Gowal Mandi',
                                'data_darbar' => 'Data Darbar',
                                'ravi_road' => 'Ravi Road',
                                'new_anarkali' => 'New Anarkali',
                                'lohari_gate' => 'Lohari Gate',
                                'shahdara' => 'Shahdara',
                                'defence_a' => 'Defence A',
                                'defence_b' => 'Defence B',
                                'factory_area' => 'Factory Area',
                                'south_cantt' => 'South Cantt',
                                'north_cantt' => 'North Cantt',
                                'mustafabad' => 'Mustafabad',
                                'ghaziabad' => 'Ghaziabad',
                                'baghbanpura' => 'Baghbanpura',
                                'harbancepura' => 'Harbancepura',
                                'manawan' => 'Manawan',
                                'batapur' => 'Batapur',
                                'barki' => 'Barki',
                                'hadyara' => 'Hadyara',
                                'hair' => 'Hair',
                                'defence_c' => 'Defence C',
                                'mastigate' => 'Mastigate',
                                'misri_shah' => 'Misri Shah',
                                'islampura' => 'Islampura',
                                'badami_bagh' => 'Badami Bagh',
                                'shadbagh' => 'Shadbagh',
                                'garden_town' => 'Garden Town',
                                'shadman' => 'Shadman',
                                'gulberg' => 'Gulberg',
                                'liaqatabad' => 'Liaqatabad',
                                'kot_lakhpat' => 'Kot Lakhpat',
                                'model_town' => 'Model Town',
                                'nishter_colony' => 'Nishter Colony',
                                'faisal_town' => 'Faisal Town',
                                'ichhra' => 'Ichhra',
                                'market_ghalib' => 'Market Ghalib',
                                'kahna' => 'Kahna',
                                'ps_qie' => 'PS QIE',
                                'ps_township' => 'PS Township',
                                'ps_johartown' => 'PS Johartown',
                                'ps_satukatla' => 'PS Satukatla',
                                'ps_mustafa_town' => 'PS Mustafa Town',
                                'ps_raiwand' => 'PS Raiwand'
                            ])->searchable(),

                        Textarea::make('case_description')->required(),
                        TextInput::make('location')->required(),
                        TextInput::make('case_nature')->required(),
                        DatePicker::make('case_date'),
                            // ->minDate(date('Y-m-d'))
                            // ->native(false),
                        TimePicker::make('time')->required(),
                        TextInput::make('caller_phone')->required(),
                        TextInput::make('camera_id')->required(),
                        TextInput::make('evidence')->required(),
                        // TextInput::make('finding_remarks')->required(),
                        TextInput::make('pco_names')->required(),
                        Radio::make('finding_remarks')->required()
                            ->options([
                                1 => 'Found',
                                0 => 'Not Found',
                            ]),
                        FileUpload::make('images')
                            ->multiple()
                            ->directory('images')
                            ->required()->image()
                            ->downloadable()
                    ])->columns(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('team')->sortable(),
                TextColumn::make('shift')->sortable(),
                ImageColumn::make('images')->circular()
                    ->stacked(),
                TextColumn::make('finding_remarks')
                    ->state(function (DIR $record): string {
                        return $record->finding_remarks == 1 ? 'Found' : 'Not Found';
                    })->badge()
                    ->color(fn (string $state): string => $state == 'Found' ? 'success' : 'danger'),
                TextColumn::make('division')->sortable(),
                TextColumn::make('ps')->sortable(),
                TextColumn::make('case_nature')->sortable(),
                TextColumn::make('case_date')->label('Date'),
                TextColumn::make('time')->sortable(),
                TextColumn::make('caller_phone'),
                TextColumn::make('case_description'),
                TextColumn::make('location'),
                TextColumn::make('camera_id'),
                TextColumn::make('evidence'),
                // TextColumn::make('finding_remarks')->sortable(),
                TextColumn::make('pco_names'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDIRS::route('/'),
            'create' => Pages\CreateDIR::route('/create'),
            'edit' => Pages\EditDIR::route('/{record}/edit')
        ];
    }
}
