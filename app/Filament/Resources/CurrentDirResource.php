<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurrentDirResource\Pages;
use App\Filament\Resources\CurrentDirResource\RelationManagers;
use App\Filament\Resources\DIRResource\Pages\ViewDirRecord;
use App\Models\CurrentDir;
use App\Models\DIR;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
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
    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';
    protected static ?string $navigationLabel = 'Recent DIRs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->description(function (Get $get) use ($form) {
                        if ($form->getOperation() !== 'edit') {
                            $caseId = $get('case_id');
                            $record = DIR::where('case_id', $caseId)->first();

                            if ($record) {
                                $name = $record->pco_names; // Assuming the 'name' column exists in the 'DIR' model
                                return "DIR is already created by: $name";
                            }
                        }
                    })
                    ->schema([
                        Hidden::make('user_ip')
                            ->default(getHostByName(php_uname('n'))),
                        Hidden::make('user_hostname')
                            ->default(getHostByName(php_uname('getHostName'))),
                        Hidden::make('user_id')
                            ->default(auth()->user()->id),
                        Hidden::make('user_email')
                            ->default(auth()->user()->email),
                        TextInput::make('case_id')->live()->unique(function () use ($form) {
                            if ($form->getOperation() === 'edit') {
                                return false;
                            }
                        })
                            ->disabled(function () use ($form) {
                                if ($form->getOperation() === 'edit') {
                                    return true;
                                }
                            })
                            ->mask('LHR-99999999-9999999')
                            ->placeholder('LHR-99999999-9999'),

                        Select::make('team')->required()->alpha()
                            ->options([
                                'A' => 'A',
                                'B' => 'B',
                                'C' => 'C',
                            ])
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        TextInput::make('shift')->default(function () {
                            $currentTime = date('H:i');
                            if ($currentTime >= '06:00' && $currentTime <= '13:59') {
                                $shift = 'A';
                            } elseif ($currentTime >= '14:00' && $currentTime <= '21:59') {
                                $shift = 'B';
                            } else {
                                $shift = 'C';
                            }
                            return $shift;
                        })->readOnly()
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        Select::make('division')->required()
                            ->options([
                                'city' => 'City',
                                'cantt' => 'Cantt',
                                'civil_lines' => 'Civil Lines',
                                'iqbal_town' => 'Iqbal Town',
                                'model_town' => 'Model Town',
                                'sader' => 'Sader',
                            ])
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            })->searchable(),
                        Select::make('ps')->required()
                            ->label('PS')
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            })
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

                        Textarea::make('case_description')->required()
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        TextInput::make('location')->required()
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        Select::make('cro')
                            ->options([
                                'yes' => 'yes',
                                'no' => 'no',
                            ])
                            ->required()
                            ->label('CRO')
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        TextInput::make('face_trace')->required()
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        TextInput::make('anpr_passing')->required()
                            ->label('ANPR Passing')
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        TextInput::make('culprit')->required()
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        TextInput::make('fir_number')->required()
                            ->label('FIR Number')
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        Select::make('case_nature')
                            ->required()->options([
                                'Traffic Offence' => 'Traffic Offence',
                                'Local & Special Laws' => 'Local & Special Laws',
                                'Crime Against Person' => 'Crime Against Person',
                                'Crime Against Property' => 'Crime Against Property'
                            ])->searchable()
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        DateTimePicker::make('case_date_time')
                            ->timezone('Asia/Karachi')
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        TextInput::make('caller_phone')->required()
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        TextInput::make('camera_id')->required()
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        TextInput::make('evidence')->required()
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        // TextInput::make('finding_remarks')->required(),
                        TextInput::make('pco_names')->required()
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        Radio::make('finding_remarks')->required()
                            ->options([
                                1 => 'Found',
                                0 => 'Not Found',
                            ])
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            }),
                        Textarea::make('feedback')
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            })->dehydrateStateUsing(fn (string $state = null): string => $state ?? 'Pending'),
                        FileUpload::make('images')
                            ->hidden(function (Get $get) use ($form): bool {
                                if ($form->getOperation() !== 'edit') {
                                    $caseId = $get('case_id');
                                    if (!$caseId) {
                                        return false;
                                    }
                                    $recordExists = DIR::where('case_id', $caseId)->exists();
                                    if ($recordExists) {
                                        return true;
                                    }
                                } else {
                                    return false;
                                }
                                return false;
                            })
                            ->multiple()
                            ->directory('images')
                            ->required()->image()
                            ->downloadable()
                    ])->columns(3),
            ])->columns(4);
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
                Tables\Actions\Action::make('View')->color('success')->icon('heroicon-o-eye')->url(fn (DIR $record): string =>  self::getUrl('ViewDirRecord', ['record' => $record])),
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
            'ViewDirRecord' => ViewDirRecord::route('/{record}/ViewDirRecord'),
        ];
    }
}