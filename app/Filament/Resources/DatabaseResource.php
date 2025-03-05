<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DatabaseResource\Pages;
use App\Filament\Resources\DatabaseResource\RelationManagers;
use App\Models\Database;
use App\Models\Ec;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use BladeUI\Icons\Components\Icon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;



class DatabaseResource extends Resource
{
    protected static ?string $model = Database::class;

    protected static ?string $title = 'USE Database';

    protected static ?string $navigationGroup = 'Database';
    protected static ?string $navigationLabel = 'USE Database';
    protected static ?string $navigationIcon = 'heroicon-o-database';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Fieldset::make('Electric Cooperative')
            ->schema([
                Select::make('ec')
                ->label('EC Name')
                ->options(Ec::all()->pluck('name','name'))
                ->searchable()->required(),
            ]),
            Fieldset::make('Location')
            ->schema([
                TextInput::make('island')
                ->label('Major Island'),
                TextInput::make('region')
                ->label('Region'),
                TextInput::make('province')
                ->label('Province'),
                TextInput::make('district')
                ->label('District'),
                TextInput::make('citymun')
                ->label('City/ Municipality'),
                TextInput::make('brgy')
                ->label('Barangay'),
                TextInput::make('sitio')
                ->label('Purok/Zone/District'),
            ]),
            Fieldset::make('Status')
            ->schema([
                Select::make('status')
                ->label('Status of Energization')
                ->options([
                    'E' => 'Energized',
                    'UE' => 'Unenergized',
                    'C' => 'Completed',
                ]),

                DatePicker::make('energdate')->label('Date of Energization'),
                TextInput::make('brgycert')
                ->label('with Brgy Certification?'),
                TextInput::make('epelecsol')
                ->label('Electrification Solution'),
                TextInput::make('epelecsolspecific')
                ->label('Electrification Solution-Specific'),
                TextInput::make('eptargetyear')
                ->label('Target Year'),
                TextInput::make('eptotalhouse')
                ->label('Total Household'),
            ]),
            Fieldset::make('Funding Requirements')
            ->schema([
                TextInput::make('frprojcost')
                ->label('Project Cost'),
                TextInput::make('frgenfundsource')
                ->label('General Funding Source'),
                TextInput::make('frfundsource')
                ->label('Specific Funding Source'),
                TextInput::make('frfundstatus')
                ->label('Status of Funding'),
            ]),
            Fieldset::make('Issues & Concerns')
            ->schema([
                TextInput::make('icpeaceorder')
                ->label('Peace & Order'),
                TextInput::make('icrightway')
                ->label('Right of Way'),
                TextInput::make('icnoroad')
                ->label('No Road Network/ Inaccessible'),
                TextInput::make('icscathouse')
                ->label('Scattered Households'),
                TextInput::make('icislandbrgymun')
                ->label('Island Barangay/ Municipality'),
                TextInput::make('icremote')
                ->label('Remote and Far Flung Areas'),
                TextInput::make('icothers')
                ->label('Others'),
                TextInput::make('remarks')
                ->label('Remarks'),
            ]),
        ]);
    }

  
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // IconColumn::make('status')
                //     ->options([
                //         'heroicon-s-light-bulb' => fn ($status) => $status === 'E', // When the `status` is `accepted`, render the `check-circle` Heroicon.
                //         'heroicon-s-x-circle' => fn ($status) => $status === 'UE', // When the `status` is `declined`, render the `x-circle` Heroicon.
                //         'heroicon-s-check-circle' => fn ($status) => $status === 'C',
                //     ])->colors([
                //         'warning' => 'E',
                //         'danger' => 'UE',
                //         'success' => 'C',
                //     ]),
                Tables\Columns\BadgeColumn::make('status')->alignCenter()
                ->enum([
                    'E' => 'Energized',
                    'C' => 'Completed',
                    'UE' => 'Unenergized',
                ])
                ->colors([
                    'success' => 'E',
                    'primary' => 'C',
                    'danger' => 'UE',
                ]),
                Tables\Columns\TextColumn::make('ec')->sortable()->size('sm')->label('EC')->alignCenter(),
                Tables\Columns\TextColumn::make('island')->sortable()->size('sm')->label('Island'),
                Tables\Columns\TextColumn::make('region')->sortable()->size('sm')->label('Region'),
                Tables\Columns\TextColumn::make('province')->sortable()->size('sm')->label('Province'),
                Tables\Columns\TextColumn::make('district')->sortable()->size('sm')->label('District'),
                Tables\Columns\TextColumn::make('citymun')->sortable()->size('sm')->label('City/Municipality')->searchable(),
                Tables\Columns\TextColumn::make('brgy')->sortable()->size('sm')->label('Barangay')->searchable(),
                Tables\Columns\TextColumn::make('sitio')->sortable()->size('sm')->label('Sitio/ Purok')->searchable(),
                Tables\Columns\TextColumn::make('energdate')->sortable()->date()->size('sm')->label('Date of Energization')->toggleable(isToggledHiddenByDefault:true),
                IconColumn::make('brgycert')
                ->options([
                    'heroicon-s-check-circle' => fn ($status) => $status === 'Yes' || $status === 'yes', // When the `status` is `accepted`, render the `check-circle` Heroicon.
                    'heroicon-s-x-circle' => fn ($status) => $status === 'No' || $status === 'no', // When the `status` is `declined`, render the `x-circle` Heroicon.
                ])->colors([
                    'success' => 'Yes',
                    'danger' => 'No',

                ])->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('eptargetyear')->sortable()->size('sm')->label('Target Year'),
                Tables\Columns\TextColumn::make('epelecsol')->sortable()->size('sm')->label('Electrification Solution')->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('epelecsolspecific')->sortable()->size('sm')->label('Electrification Solution-Specific')->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('eptotalhouse')->sortable()->size('sm')->label('Total Household')->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('frprojcost')->money('php' , 2)->label('Project Cost')->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('frgenfundsource')->sortable()->size('sm')->label('General Funding Source')->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('frfundsource')->sortable()->size('sm')->label('Specific Funding Source')->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('frfundstatus')->sortable()->size('sm')->label('Funding Status')->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('icpeaceorder')->sortable()->size('sm')->label('Peace&Order')->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('icrightway')->sortable()->size('sm')->label('Right of Way')->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('icnoroad')->sortable()->size('sm')->label('No Road Network/ Inaccessible')->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('icscathouse')->sortable()->size('sm')->label('Scattered Household')->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('icislandbrgymun')->sortable()->size('sm')->label('Island Barangay/ Municipalty')->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('icremote')->sortable()->size('sm')->label('Remote and Far Flung Areas')->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('icothers')->sortable()->size('sm')->label('Others')->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\TextColumn::make('remarks')->sortable()->size('sm')->label('Remarks')->toggleable(isToggledHiddenByDefault:true),
                

            ])
            ->filters([
                SelectFilter::make('status')
                ->multiple()
                ->options([
                    'E' => 'Energized',
                    'UE' => 'Unenergized',
                    'C' => 'Completed',
                ])->attribute('status'),


                SelectFilter::make('EC')
                ->multiple()
                ->label('EC Name')
                ->options(Database::all()->pluck('ec','ec'))
                ->searchable(),

                SelectFilter::make('province')
                ->multiple()
                ->label('Province')
                ->options(Database::all()->pluck('province','province'))
                ->searchable(),

                SelectFilter::make('citymun')
                ->multiple()
                ->label('City/Municipality')
                ->options(Database::all()->pluck('citymun','citymun'))
                ->searchable(),

                SelectFilter::make('brgy')
                ->multiple()
                ->label('Barangay')
                ->options(Database::all()->pluck('brgy','brgy'))
                ->searchable(),

                Filter::make('energdate')
                ->form([
                    Forms\Components\DatePicker::make('date_from'),
                    Forms\Components\DatePicker::make('date_until'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['date_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('energdate', '>=', $date),
                        )
                        ->when(
                            $data['date_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('energdate', '<=', $date),
                        );
                })->columns(2),
                ])
            ->actions([
               
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('Export with options')
                ->defaultPageOrientation('landscape'), // Page orientation for pdf files. portrait or landscape
                ExportBulkAction::make()->exports([
                    ExcelExport::make('form')->fromForm()
                    ->askForFilename(),              
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
            'index' => Pages\ListDatabases::route('/'),
            'create' => Pages\CreateDatabase::route('/create'),
            'edit' => Pages\EditDatabase::route('/{record}/edit'),
        ];
    }    
    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $office = $user->office;

        if ($office == 'NEA'){
            return parent::getEloquentQuery()->where('ec','!=', 'Admin');
        }
        else{
            return parent::getEloquentQuery()->where('ec','=', $office);
        }
    }
}
